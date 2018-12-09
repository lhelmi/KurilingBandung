<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wisata_model extends CI_Model
{

    public $table = 'wisata';
    public $id = 'id_wisata';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    function get_kode(){
        $this->db->select('RIGHT(wisata.id_wisata,4) as kode', FALSE);
        $this->db->order_by('id_wisata','DESC');    
        $this->db->limit(1);
          $query = $this->db->get('wisata');      //cek dulu apakah ada sudah ada kode di tabel.    
          if($query->num_rows() <> 0){      
           //jika kode ternyata sudah ada.      
           $data = $query->row();      
           $kode = intval($data->kode) + 1;    
          }
          else {      
           //jika kode belum ada      
           $kode = 1;    
          }
          $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
          $kodejadi = "WST-".$kodemax;    // hasilnya ODJ-9921-0001 dst.
          return $kodejadi;  
    }

    function get_fasilitas(){
            $this->db->join('fasilitas', 'fasilitas.id_wisata=wisata.id_wisata');
            $this->db->where('fasilitas.is_delete=', '0');
            return $this->db->get('wisata')->result();
    }

    function get_fasilitasdb($id){
            $this->db->join('fasilitas', 'fasilitas.id_wisata=wisata.id_wisata');
            $this->db->where('fasilitas.is_delete=', '0');
            $this->db->where('wisata.id_wisata=', $id);
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

    public function get_selected_by_id_kel($id_kel){
        $this->db->where('id_kel', $id_kel);
        $this->db->join('kecamatan', 'kelurahan.id_kec = kecamatan.id_kec');
        $this->db->join('kota', 'kecamatan.id_kota = kota.id_kota');
        $this->db->where('kelurahan.is_delete=', '0');
        return $this->db->get('kelurahan')->row();
    }

    public function get_kotaadmin(){
        $this->db->order_by('nama_kota', 'asc');
        $this->db->where('is_delete=', '0');
        $this->db->where('kota.NIP=', $this->session->userdata('NIP'));
        return $this->db->get('kota')->result();
    }

    function get_gambar(){
            $this->db->join('gambar', 'gambar.id_wisata=wisata.id_wisata');
            $this->db->where('gambar.is_delete=', '0');
            return $this->db->get('wisata')->result();
        
    }

    function get_gambardb($id){
        $this->db->join('gambar', 'gambar.id_wisata=wisata.id_wisata');
        $this->db->where('gambar.is_delete=', '0');
        $this->db->where('wisata.id_wisata=', $id);
        return $this->db->get('wisata')->result();
        
    }

    // get all
    function get_all()
    {
        $this->db->join('pemilik', 'wisata.NIK=pemilik.NIK');
        $this->db->join('kota', 'wisata.id_kota=kota.id_kota');
        $this->db->join('kecamatan', 'wisata.id_kec=kecamatan.id_kec');
        $this->db->join('kelurahan', 'wisata.id_kel=kelurahan.id_kel');
        
        $this->db->where('wisata.is_delete', '0');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_all_admin()
    {
        $this->db->join('pemilik', 'wisata.NIK=pemilik.NIK');
        $this->db->join('kota', 'wisata.id_kota=kota.id_kota');
        $this->db->join('kecamatan', 'wisata.id_kec=kecamatan.id_kec');
        $this->db->join('kelurahan', 'wisata.id_kel=kelurahan.id_kel');
        $this->db->where('kota.NIP=', $this->session->userdata('NIP'));
        $this->db->where('wisata.is_delete', '0');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_all_owner()
    {
        $this->db->join('pemilik', 'wisata.NIK=pemilik.NIK');
        $this->db->join('kota', 'wisata.id_kota=kota.id_kota');
        $this->db->join('kecamatan', 'wisata.id_kec=kecamatan.id_kec');
        $this->db->join('kelurahan', 'wisata.id_kel=kelurahan.id_kel');
        $this->db->where('pemilik.NIK', $this->session->userdata('username'));
        $this->db->where('wisata.is_delete', '0');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }


     function get_NIK()
    {
        $this->db->order_by('nama_pemilik', $this->order);
        return $this->db->get('pemilik')->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->join('pemilik', 'wisata.NIK=pemilik.NIK');
        $this->db->join('kota', 'wisata.id_kota=kota.id_kota');
        $this->db->join('kecamatan', 'wisata.id_kec=kecamatan.id_kec');
        $this->db->join('kelurahan', 'wisata.id_kel=kelurahan.id_kel');
        $this->db->where($this->id, $id);
        
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows_admin($q = NULL) {
    	$this->db->join('pemilik', $q='wisata.NIK=pemilik.NIK');
        $this->db->join('kota', $q='wisata.id_kota=kota.id_kota');
        $this->db->join('kecamatan', $q='wisata.id_kec=kecamatan.id_kec');
        $this->db->join('kelurahan', $q='wisata.id_kel=kelurahan.id_kel');
        $this->db->where('kota.NIP=', $q=$this->session->userdata('NIP'));
        $this->db->where('wisata.is_delete', $q='0');
    	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data_admin($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('nama_wisata', $q);
        $this->db->join('pemilik', $q='wisata.NIK=pemilik.NIK');
        $this->db->join('kota', $q='wisata.id_kota=kota.id_kota');
        $this->db->join('kecamatan', $q='wisata.id_kec=kecamatan.id_kec');
        $this->db->join('kelurahan', $q='wisata.id_kel=kelurahan.id_kel');
        $this->db->where('kota.NIP=', $q=$this->session->userdata('NIP'));
        $this->db->where('wisata.is_delete', $q='0');
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    function total_rows($q = NULL) {
        $this->db->join('pemilik', $q='wisata.NIK=pemilik.NIK');
        $this->db->join('kota', $q='wisata.id_kota=kota.id_kota');
        $this->db->join('kecamatan', $q='wisata.id_kec=kecamatan.id_kec');
        $this->db->join('kelurahan', $q='wisata.id_kel=kelurahan.id_kel');
        
        $this->db->where('wisata.is_delete', $q='0');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('nama_wisata', $q);
        $this->db->join('pemilik', $q='wisata.NIK=pemilik.NIK');
        $this->db->join('kota', $q='wisata.id_kota=kota.id_kota');
        $this->db->join('kecamatan', $q='wisata.id_kec=kecamatan.id_kec');
        $this->db->join('kelurahan', $q='wisata.id_kel=kelurahan.id_kel');
        
        $this->db->where('wisata.is_delete', $q='0');
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    function total_rowsown($q = NULL) {
        $this->db->like('nama_wisata', $q);
        $this->db->join('kota', $q='wisata.id_kota=kota.id_kota');
        $this->db->join('kecamatan', $q='wisata.id_kec=kecamatan.id_kec');
        $this->db->join('kelurahan', $q='wisata.id_kel=kelurahan.id_kel');
        $this->db->where('wisata.is_delete', $q='0');
        $this->db->where('NIK', $this->session->userdata('username'));
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function get_limit_dataown($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('nama_wisata', $q);
        $this->db->join('kota', $q='wisata.id_kota=kota.id_kota');
        $this->db->join('kecamatan', $q='wisata.id_kec=kecamatan.id_kec');
        $this->db->join('kelurahan', $q='wisata.id_kel=kelurahan.id_kel');
        $this->db->where('wisata.is_delete', $q='0');
        $this->db->where('NIK', $this->session->userdata('username'));
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->set('reg_time', 'NOW()', false);
        $this->db->insert($this->table, $data);
    }

    function eksport_data() {
        $this->db->select("id_wisata, nama_wisata, deskripsi, reg_time, kota.nama_kota, kecamatan.nama_kec, kelurahan.nama_kel, lat, lng, alamat_wisata, tiket_dewasa, tiket_anak, NIK");
        $this->db->join('kota', 'wisata.id_kota=kota.id_kota');
        $this->db->join('kecamatan', 'wisata.id_kec=kecamatan.id_kec');
        $this->db->join('kelurahan', 'wisata.id_kel=kelurahan.id_kel');
        $this->db->where('wisata.is_delete=', '0');
        $this->db->from('wisata');
        return $this->db->get();
    }

    function eksport_dataadmin() {
        $this->db->select("id_wisata, nama_wisata, deskripsi, reg_time, kota.nama_kota, kecamatan.nama_kec, kelurahan.nama_kel, lat, lng, alamat_wisata, tiket_dewasa, tiket_anak, NIK");
        $this->db->join('kota', 'wisata.id_kota=kota.id_kota');
        $this->db->join('kecamatan', 'wisata.id_kec=kecamatan.id_kec');
        $this->db->join('kelurahan', 'wisata.id_kel=kelurahan.id_kel');
        $this->db->where('kota.NIP=', $this->session->userdata('NIP'));
        $this->db->where('wisata.is_delete=', '0');
        $this->db->from('wisata');
        return $this->db->get();
    }



    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {   
        $this->db->set('is_delete', '1');
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
        
    }

}

// function total_rows($q = NULL) {
//  //    // $this->db->like('id_wisata', $q);
//     // $this->db->like('nama_wisata', $q);
//     // // $this->db->or_like('id_kota', $q);
//     // // $this->db->or_like('id_kec', $q);
//     // // $this->db->or_like('id_kel', $q);
//     // // $this->db->or_like('lat', $q);
//     // // $this->db->or_like('lng', $q);
//     // // $this->db->or_like('alamat_wisata', $q);
//     // // $this->db->or_like('tiket_dewasa', $q);
//     // // $this->db->or_like('tiket_anak', $q);
//     // // $this->db->or_like('NIK', $q);
//  //    $this->db->where('is_delete', $q='0');
//     // $this->db->from($this->table);
//  //        return $this->db->count_all_results();
//  //    }

    // function get_id_kel()
    // {
    //     $this->db->join('kecamatan', 'kecamatan.id_kota=kota.id_kota');
    //     $this->db->join('kelurahan', 'kelurahan.id_kec=kecamatan.id_kec');
    //     $this->db->where('kota.NIP=', $this->session->userdata('NIP'));
    //     $this->db->order_by('nama_kel');
    //     return $this->db->get('kota')->result();
    // }

    // function get_id_kelow()
    // {
    //     $this->db->join('kecamatan', 'kecamatan.id_kota=kota.id_kota');
    //     $this->db->join('kelurahan', 'kelurahan.id_kec=kecamatan.id_kec');
    //     $this->db->where('kecamatan.is_delete=', '0');
    //     //$this->db->where('kecamatan.id_kec=', $kec),
    //     $this->db->order_by('nama_kel');
    //     return $this->db->get('kota')->result();
    // }

 //    function get_limit_data($limit, $start = 0, $q = NULL) {
 // //        $this->db->order_by($this->id, $this->order);
 // //        // $this->db->like('id_wisata', $q);
 //    // $this->db->like('nama_wisata', $q);
 //    // // $this->db->or_like('id_kota', $q);
 //    // // $this->db->or_like('id_kec', $q);
 //    // // $this->db->or_like('id_kel', $q);
 //    // // $this->db->or_like('lat', $q);
 //    // // $this->db->or_like('lng', $q);
 //    // // $this->db->or_like('alamat_wisata', $q);
 //    // // $this->db->or_like('tiket_dewasa', $q);
 //    // // $this->db->or_like('tiket_anak', $q);
 //    // // $this->db->or_like('NIK', $q);
 // //    $this->db->where('is_delete', $q='0');
 //    // $this->db->limit($limit, $start);
 // //        return $this->db->get($this->table)->result();
 // //    }

    // function get_exportadmin()
    // {
    //     $this->db->order_by($this->id, $this->order);
    //     $this->db->join('kota', 'wisata.id_kota=kota.id_kota');
    //     $this->db->join('kecamatan', 'wisata.id_kec=kecamatan.id_kec');
    //     $this->db->join('kelurahan', 'wisata.id_kel=kelurahan.id_kel');
    //     $this->db->where('kota.NIP=', $this->session->userdata('NIP'));
    //     return $this->db->get($this->table)->result();
        
    // }

    // function get_export()
    // {
    //     $this->db->order_by($this->id, $this->order);
    //     $this->db->join('kota', 'wisata.id_kota=kota.id_kota');
    //     $this->db->join('kecamatan', 'wisata.id_kec=kecamatan.id_kec');
    //     $this->db->join('kelurahan', 'wisata.id_kel=kelurahan.id_kel');
    //     return $this->db->get($this->table)->result();
        
    // }

/* End of file Wisata_model.php */
/* Location: ./application/models/Wisata_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-31 14:20:54 */
/* http://harviacode.com */