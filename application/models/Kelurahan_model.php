<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelurahan_model extends CI_Model
{

    public $table = 'kelurahan';
    public $id = 'id_kel';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->join('kecamatan', 'kelurahan.id_kec=kecamatan.id_kec');
        $this->db->join('kota', 'kecamatan.id_kota=kota.id_kota');
        $this->db->join('admin', 'kota.NIP=admin.NIP');
        //$this->db->where('kota.NIP=', $q=$this->session->userdata('NIP'));
        $this->db->where('kelurahan.is_delete=', '0');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_all_admin()
    {
        $this->db->join('kecamatan', 'kelurahan.id_kec=kecamatan.id_kec');
        $this->db->join('kota', 'kecamatan.id_kota=kota.id_kota');
        $this->db->join('admin', 'kota.NIP=admin.NIP');
        $this->db->where('kota.NIP=', $q=$this->session->userdata('NIP'));
        $this->db->where('kelurahan.is_delete=', '0');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
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

    public function get_kotaadmin(){
        $this->db->order_by('nama_kota', 'asc');
        $this->db->where('is_delete=', '0');
        $this->db->where('kota.NIP=', $this->session->userdata('NIP'));
        return $this->db->get('kota')->result();
    }

    public function get_selected_by_id_kec($id_kec){
        $this->db->where('id_kec', $id_kec);
        $this->db->join('kota', 'kecamatan.id_kota = kota.id_kota');
        $this->db->where('kecamatan.is_delete=', '0');
        return $this->db->get('kecamatan')->row();
    }

    
    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
    $this->db->or_like('kelurahan.nama_kel', $q);
    $this->db->join('kecamatan', $q='kelurahan.id_kec=kecamatan.id_kec');
    $this->db->join('kota', $q='kecamatan.id_kota=kota.id_kota');
    $this->db->join('admin', $q='kota.NIP=admin.NIP');
    //$this->db->where('kota.NIP=', $q=$this->session->userdata('NIP'));
    $this->db->where('kelurahan.is_delete=', '0');
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
    $this->db->or_like('kelurahan.nama_kel', $q);
    $this->db->join('kecamatan', $q='kelurahan.id_kec=kecamatan.id_kec');
    $this->db->join('kota', $q='kecamatan.id_kota=kota.id_kota');
    $this->db->join('admin', $q='kota.NIP=admin.NIP');
    //$this->db->where('kota.NIP=', $q=$this->session->userdata('NIP'));
    $this->db->where('kelurahan.is_delete=', '0');
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    function total_rows_admin($q = NULL) {
    $this->db->or_like('kelurahan.nama_kel', $q);
    $this->db->join('kecamatan', $q='kelurahan.id_kec=kecamatan.id_kec');
    $this->db->join('kota', $q='kecamatan.id_kota=kota.id_kota');
    $this->db->join('admin', $q='kota.NIP=admin.NIP');
    $this->db->where('kota.NIP=', $q=$this->session->userdata('NIP'));
    $this->db->where('kelurahan.is_delete=', '0');
    $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data_admin($limit, $start = 0, $q = NULL) {
    $this->db->or_like('kelurahan.nama_kel', $q);
    $this->db->join('kecamatan', $q='kelurahan.id_kec=kecamatan.id_kec');
    $this->db->join('kota', $q='kecamatan.id_kota=kota.id_kota');
    $this->db->join('admin', $q='kota.NIP=admin.NIP');
    $this->db->where('kota.NIP=', $q=$this->session->userdata('NIP'));
    $this->db->where('kelurahan.is_delete=', '0');
    $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }



    // insert data
    function insert($data)
    {
        
        $this->db->insert($this->table, $data);
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

/* End of file Kelurahan_model.php */
/* Location: ./application/models/Kelurahan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-31 14:20:54 */
/* http://harviacode.com */