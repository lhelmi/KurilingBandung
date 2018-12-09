<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class Kurilingbandung_model extends CI_Model {

    public $table = 'pemilik';
    public $id = 'NIK';
    public $order = 'ASC';   

    function __construct(){
        parent::__construct();
    }

    function get_all_clustering()
    {
        $this->db->where('is_delete=', '0');
        return $this->db->get('wisata')->result();
    }

    public function get_kota(){
        $this->db->order_by('nama_kota', 'asc');
        $this->db->where('is_delete=', '0');
        return $this->db->get('kota')->result();
    }

    public function get_kec(){
        // kita joinkan tabel kota dengan provinsi
        $this->db->order_by('nama_kec', 'asc');
        $this->db->join('kota', 'kecamatan.id_kota = kota.id_kota');
        $this->db->where('kecamatan.is_delete=', '0');
        return $this->db->get('kecamatan')->result();
    }   

    public function get_kel(){
        // kita joinkan tabel kecamatan dengan kota
        $this->db->order_by('nama_kel', 'asc');
        $this->db->join('kecamatan', 'kelurahan.id_kec = kecamatan.id_kec');
        $this->db->where('kelurahan.is_delete=', '0');
        return $this->db->get('kelurahan')->result();
    }
    
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function get_by_email($email)
    {
        $this->db->where('email_pemilik', $email);
        return $this->db->get($this->table)->row();
    }

    function loginown($NIK,$password) {
        $this->db->where('NIK', $NIK);
        $this->db->where('password', $password);
        $this->db->where('is_delete=', '0');
        $this->db->where('is_Reg=', '1');
        $this->db->where('is_active=', '1');
        $query =  $this->db->get('pemilik');
        return $query->num_rows();
    }
    
    function data_loginown($NIK,$password) {
        $this->db->get('pemilik');
        $this->db->where('NIK', $NIK);
        $this->db->where('password', $password);
        $this->db->where('is_delete=', '0');
        $this->db->where('is_Reg=', '1');
        $this->db->where('is_active=', '1');
        return $this->db->get('pemilik')->row();
    }

    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    function registasi($id)
    {
        $this->db->set('is_Reg', '1');
        $this->db->set('reg_time', 'NOW()', false);
        $this->db->where($this->id, $id);
        $this->db->update($this->table);
    }

    function reset($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function update_views($id, $data)
    {
        $this->db->where('id_wisata', $id);
        $this->db->update('wisata', $data);
    }

    function get_limit_data($limit, $start = 0, $q=null, $qkot=null, $qkec=null, $qkel=null) {
        
        $this->db->join('kelurahan', 'wisata.id_kel=kelurahan.id_kel');
        $this->db->join('kecamatan', 'wisata.id_kec=kecamatan.id_kec');
        $this->db->join('kota', 'wisata.id_kota=kota.id_kota');
        $this->db->join('admin', 'kota.NIP=admin.NIP');
        $this->db->join('gambar', 'gambar.id_wisata=wisata.id_wisata');
        $this->db->where('wisata.is_delete=', '0');

        $this->db->like('wisata.nama_wisata', $q);
        $this->db->like('wisata.id_kota', $qkot);
        $this->db->like('wisata.id_kec', $qkec);
        $this->db->like('wisata.id_kel', $qkel);


        
        $this->db->group_by('gambar.id_wisata');
        $this->db->limit($limit, $start);

        return $this->db->get('wisata')->result();
    }

    function total_rows($q = NULL, $qkot=null, $qkec=null, $qkel=null) {
        
        
        $this->db->join('kelurahan', 'wisata.id_kel=kelurahan.id_kel');
        $this->db->join('kecamatan', 'wisata.id_kec=kecamatan.id_kec');
        $this->db->join('kota', 'wisata.id_kota=kota.id_kota');
        $this->db->join('admin', 'kota.NIP=admin.NIP');
        $this->db->join('gambar', 'gambar.id_wisata=wisata.id_wisata');
        $this->db->where('wisata.is_delete=', '0');

        $this->db->like('wisata.nama_wisata', $q);
        $this->db->like('wisata.id_kota', $qkot);
        $this->db->like('wisata.id_kec', $qkec);
        $this->db->like('wisata.id_kel', $qkel);

        
        
        $this->db->group_by('gambar.id_wisata');
        
        return count($this->db->get('wisata')->result());
    }

    function get_populer_data() {
        $this->db->order_by('wisata.views', 'desc');

        $this->db->join('kelurahan', 'wisata.id_kel=kelurahan.id_kel');
        $this->db->join('kecamatan', 'wisata.id_kec=kecamatan.id_kec');
        $this->db->join('kota', 'wisata.id_kota=kota.id_kota');
        $this->db->join('admin', 'kota.NIP=admin.NIP');
        $this->db->join('gambar', 'gambar.id_wisata=wisata.id_wisata');
        $this->db->where('wisata.is_delete=', '0');
        $this->db->group_by('gambar.id_wisata');

        $this->db->limit(6, 0);

        return $this->db->get('wisata')->result();
    }

    function get_fasilitas(){
            $this->db->join('fasilitas', 'fasilitas.id_wisata=wisata.id_wisata');
            $this->db->where('fasilitas.is_delete=', '0');
            return $this->db->get('wisata')->result();
    }

    function get_gambar(){
            $this->db->join('gambar', 'gambar.id_wisata=wisata.id_wisata');
            $this->db->where('gambar.is_delete=', '0');
            return $this->db->get('wisata')->result();
        
    }

    function get_wisata_by_id($id)
    {
        $this->db->join('pemilik', 'wisata.NIK=pemilik.NIK');
        $this->db->join('kota', 'wisata.id_kota=kota.id_kota');
        $this->db->join('kecamatan', 'wisata.id_kec=kecamatan.id_kec');
        $this->db->join('kelurahan', 'wisata.id_kel=kelurahan.id_kel');
        $this->db->where('id_wisata', $id);
        
        return $this->db->get('wisata')->row();
    }
}