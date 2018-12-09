<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notif_model extends CI_Model
{
	public $table = 'pemilik';
    public $id = 'NIK';
    public $order = 'ASC';

	function __construct()
    {
        parent::__construct();
    }

    function get_all_notif()
    {
        $this->db->limit(5);
        $this->db->where('is_Reg=', '1');   
        $this->db->where('is_active=', '0');
        $this->db->where('is_delete=', '0');
        return $this->db->get($this->table)->result();
    }

    function totoal_all_notif()
    {
        $this->db->where('is_Reg=', '1');   
        $this->db->where('is_active=', '0');
        $this->db->where('is_delete=', '0');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}