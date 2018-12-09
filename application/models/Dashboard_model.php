<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
 	
 	public $table = 'wisata';
    public $id = 'id_wisata';
    public $order = 'DESC';
    

    function __construct()
    {
        parent::__construct();
    }

    function get_wisata($q)
    {
        $this->db->join('pemilik', 'wisata.NIK=pemilik.NIK');
        $this->db->join('kota', 'wisata.id_kota=kota.id_kota');
        $this->db->join('kecamatan', 'wisata.id_kec=kecamatan.id_kec');
        $this->db->join('kelurahan', 'wisata.id_kel=kelurahan.id_kel');
        $this->db->where('wisata.is_delete', '0');
        $this->db->where('kota.id_kota', $q);
    	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function get_pemilik($q)
    {
        $this->db->where('pemilik.is_delete', '0');
        $this->db->where('pemilik.is_active', $q);
        $this->db->from('pemilik');
        return $this->db->count_all_results();
    }

    // function get_all_y($y)
    // {
    //     $this->db->where('is_delete', '0');
    //     $this->db->where('date_format(reg_time, "%y")=', $y);
    // 	$this->db->from($this->table);
    //     return $this->db->count_all_results();
    // }
}