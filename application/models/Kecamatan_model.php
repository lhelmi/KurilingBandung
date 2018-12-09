<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kecamatan_model extends CI_Model
{

    public $table = 'kecamatan';
    public $id = 'id_kec';
    public $order = 'DESC';
    public $id_kota = 'id_kota';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->join('kota', 'kecamatan.id_kota=kota.id_kota');
        $this->db->join('admin', 'kota.NIP=admin.NIP');
        $this->db->where('kecamatan.is_delete=', '0');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_all_admin()
    {
        $this->db->join('kota', 'kecamatan.id_kota=kota.id_kota');
        $this->db->join('admin', 'kota.NIP=admin.NIP');
        $this->db->where('kota.NIP=', $this->session->userdata('NIP'));
        $this->db->where('kecamatan.is_delete=', '0');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    public function get_kota(){
        $this->db->order_by('nama_kota', 'asc');
        $this->db->where('is_delete=', '0');
        return $this->db->get('kota')->result();
    }

    public function get_kotaadmin(){
        $this->db->order_by('nama_kota', 'asc');
        $this->db->where('is_delete=', '0');
        $this->db->where('kota.NIP=', $this->session->userdata('NIP'));
        return $this->db->get('kota')->result();
    }

    public function get_selected($id_kec){
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
    //function total_rows($q = NULL) {
    // $this->db->or_like('kecamatan.nama_kec', $q);
    // $this->db->join('kota', $q='kecamatan.id_kota=kota.id_kota');
    // $this->db->join('admin', $q='kota.NIP=admin.NIP');
    // $this->db->where('kecamatan.is_delete=', $q='0');
    
    // $this->db->from($this->table);
    //     return $this->db->count_all_results();
    // }

    // // get data with limit and search
    // function get_limit_data($limit, $start = 0, $q = NULL) {
    // $this->db->order_by($this->id, $this->order);
    // $this->db->or_like('kecamatan.nama_kec', $q);
    // $this->db->join('kota', $q='kecamatan.id_kota=kota.id_kota');
    // $this->db->join('admin', $q='kota.NIP=admin.NIP');
    // $this->db->where('kecamatan.is_delete=', $q='0');
    // $this->db->limit($limit, $start);

    //     return $this->db->get($this->table)->result();
    // }

    // function get_limit_data_admin($limit, $start = 0, $q = NULL) {
    // $this->db->order_by($this->id, $this->order);
    // $this->db->or_like('kecamatan.nama_kec', $q);
    // $this->db->join('kota', $q='kecamatan.id_kota=kota.id_kota');
    // $this->db->join('admin', $q='kota.NIP=admin.NIP');
    // $this->db->where('kota.NIP=', $q=$this->session->userdata('NIP'));
    // $this->db->where('kecamatan.is_delete=', $q='0');
    // $this->db->limit($limit, $start);

    //     return $this->db->get($this->table)->result();
    // }

    // function total_rows_admin($q = NULL) {
    // $this->db->or_like('kecamatan.nama_kec', $q);
    // $this->db->join('kota', $q='kecamatan.id_kota=kota.id_kota');
    // $this->db->join('admin', $q='kota.NIP=admin.NIP');
    // $this->db->where('kota.NIP=', $q=$this->session->userdata('NIP'));
    // $this->db->where('kecamatan.is_delete=', $q='0');
    // $this->db->from($this->table);
    //     return $this->db->count_all_results();
    // }