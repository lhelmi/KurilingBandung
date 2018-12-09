<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class Auth_model extends CI_Model {

   

    function __construct()
    {
        parent::__construct();
    }
    
//    untuk mengcek jumlah username dan password yang sesuai
    function login($username,$password) {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->where('is_delete=', '0');
        $query =  $this->db->get('admin');
        return $query->num_rows();
    }
    
//    untuk mengambil data hasil login
    function data_login($username,$password) {
        $this->db->get('admin');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->where('is_delete=', '0');
        return $this->db->get('admin')->row();
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
}