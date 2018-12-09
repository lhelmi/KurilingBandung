<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gambar_model extends CI_Model
{

    public $table = 'gambar';
    public $id = 'id_gambar';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_gambar', $q);
	$this->db->or_like('nama_gambar', $q);
	$this->db->or_like('id_wisata', $q);
	$this->db->or_like('is_delete', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_gambar', $q);
	$this->db->or_like('nama_gambar', $q);
	$this->db->or_like('id_wisata', $q);
	$this->db->or_like('is_delete', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert_batch($this->table, $data);
    }

    // update data
    function update($data , $id_gambar)
    {
        //$this->db->where($this->id, $id);
        //$this->db->update($this->table, $data);
        $this->db->update_batch($this->table, $data, $id_gambar);
    }

    // delete data
    function delete($id)
    {
        $this->db->set('is_delete', '1');
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

}

/* End of file Gambar_model.php */
/* Location: ./application/models/Gambar_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-07-07 12:39:13 */
/* http://harviacode.com */