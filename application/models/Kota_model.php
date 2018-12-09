<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kota_model extends CI_Model
{

    public $table = 'kota';
    public $id = 'id_kota';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->where('is_delete=', '0');
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get data admin by nip
    function get_nip()
    {
        $this->db->order_by('nama', $this->order);
        $this->db->where('is_delete=', '0');
        return $this->db->get('admin')->result();

    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_kota', $q);
	$this->db->or_like('nama_kota', $q);
	$this->db->or_like('NIP', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_kota', $q);
	$this->db->or_like('nama_kota', $q);
	$this->db->or_like('NIP', $q);
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

/* End of file Kota_model.php */
/* Location: ./application/models/Kota_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-31 14:20:54 */
/* http://harviacode.com */