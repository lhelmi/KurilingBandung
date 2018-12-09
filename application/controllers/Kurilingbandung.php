<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kurilingbandung extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Wisata_model');
        $this->load->model('Fasilitas_model');
        $this->load->model('Gambar_model');
        $this->load->model('Auth_model');
        $this->load->model('Pemilik_model');
        $this->load->model('Kurilingbandung_model');

        $this->load->library('form_validation');
    }

    public function index()
    {   
        $q = urldecode($this->input->get('q', TRUE));
        $qkot = urldecode($this->input->get('qkot', TRUE));
        $qkec = urldecode($this->input->get('qkec', TRUE));
        $qkel = urldecode($this->input->get('qkel', TRUE));

        $start = intval($this->input->get('start'));
        
        if ($q <> '' || $qkot <> '' || $qkec <> '' || $qkel <> '') {
            $config['base_url'] = base_url() . 'Kurilingbandung/blog_home.html?q=' . urlencode($q) . 'qkot=' . urlencode($qkot) . 'qkec=' . urlencode($qkec) . 'qkel=' . urlencode($qkel);
            $config['first_url'] = base_url() . 'Kurilingbandung/blog_home.html?q=' . urlencode($q) . 'qkot=' . urlencode($qkot) . 'qkec=' . urlencode($qkec) . 'qkel=' . urlencode($qkel);
        } else {
            $config['base_url'] = base_url() . 'Kurilingbandung/blog_home.html';
            $config['first_url'] = base_url() . 'Kurilingbandung/blog_home.html';
        }

        $config['per_page'] = 3;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kurilingbandung_model->total_rows($q, $qkot, $qkec, $qkel);
        $Kurilingbandung = $this->Kurilingbandung_model->get_limit_data($config['per_page'], $start, $q, $qkot, $qkec, $qkel);

        $data = array(
            'Kurilingbandung_data' => $this->Kurilingbandung_model->get_populer_data(),
            'action' => site_url('kurilingbandung/login_action'),
            'cari' => set_value('Cari'),
            'button' => 'CARI SEKARANG',
            'q' => $q,
            'qkot' => $qkot,
            'qkec' => $qkec,
            'qkel' => $qkel,
            'gid_kota' => $qkot, 
            'gid_kec' => $qkec,
            'gid_kel' => $qkel,
            'id_kota' => $this->Wisata_model->get_kota(),
            'id_kec' => $this->Wisata_model->get_kec(),
            'id_kel' => $this->Wisata_model->get_kel(),
        );

       $this->load->view('Kurilingbandung/index', $data);
    }

    public function blog_home()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $qkot = urldecode($this->input->get('qkot', TRUE));
        $qkec = urldecode($this->input->get('qkec', TRUE));
        $qkel = urldecode($this->input->get('qkel', TRUE));

        $start = intval($this->input->get('start'));
        
        if ($q <> '' || $qkot <> '' || $qkec <> '' || $qkel <> '') {
            $config['base_url'] = base_url() . 'Kurilingbandung/blog_home.html?q=' . urlencode($q) . 'qkot=' . urlencode($qkot) . 'qkec=' . urlencode($qkec) . 'qkel=' . urlencode($qkel);
            $config['first_url'] = base_url() . 'Kurilingbandung/blog_home.html?q=' . urlencode($q) . 'qkot=' . urlencode($qkot) . 'qkec=' . urlencode($qkec) . 'qkel=' . urlencode($qkel);
        } else {
            $config['base_url'] = base_url() . 'Kurilingbandung/blog_home.html';
            $config['first_url'] = base_url() . 'Kurilingbandung/blog_home.html';
        }

        $config['per_page'] = 4;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kurilingbandung_model->total_rows($q, $qkot, $qkec, $qkel);
        $Kurilingbandung = $this->Kurilingbandung_model->get_limit_data($config['per_page'], $start, $q, $qkot, $qkec, $qkel);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'wisata_data' => $Kurilingbandung,
            'q' => $q,
            'qkot' => $qkot,
            'qkec' => $qkec,
            'qkel' => $qkel,
            'pagination' => $this->pagination->create_links(),
            'start' => $start,
            'Kurilingbandung_data' => $this->Kurilingbandung_model->get_populer_data(),
            'gid_kota' => $qkot, 
            'gid_kec' => $qkec,
            'gid_kel' => $qkel,
            'id_kota' => $this->Wisata_model->get_kota(),
            'id_kec' => $this->Wisata_model->get_kec(),
            'id_kel' => $this->Wisata_model->get_kel(),
        );
       $this->load->view('Kurilingbandung/blog-home', $data);
    }

    public function blog_single($id){
        $q = urldecode($this->input->get('q', TRUE));
        $qkot = urldecode($this->input->get('qkot', TRUE));
        $qkec = urldecode($this->input->get('qkec', TRUE));
        $qkel = urldecode($this->input->get('qkel', TRUE));

        $start = intval($this->input->get('start'));
        
        if ($q <> '' || $qkot <> '' || $qkec <> '' || $qkel <> '') {
            $config['base_url'] = base_url() . 'Kurilingbandung/blog_home.html?q=' . urlencode($q) . 'qkot=' . urlencode($qkot) . 'qkec=' . urlencode($qkec) . 'qkel=' . urlencode($qkel);
            $config['first_url'] = base_url() . 'Kurilingbandung/blog_home.html?q=' . urlencode($q) . 'qkot=' . urlencode($qkot) . 'qkec=' . urlencode($qkec) . 'qkel=' . urlencode($qkel);
        } else {
            $config['base_url'] = base_url() . 'Kurilingbandung/blog_home.html';
            $config['first_url'] = base_url() . 'Kurilingbandung/blog_home.html';
        }

        $config['per_page'] = 3;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kurilingbandung_model->total_rows($q, $qkot, $qkec, $qkel);
        $Kurilingbandung = $this->Kurilingbandung_model->get_limit_data($config['per_page'], $start, $q, $qkot, $qkec, $qkel);

        $row = $this->Kurilingbandung_model->get_wisata_by_id($id);

        $views = $row->views + 1;
        $updateview = array(
            'views' => $views,
        );
        $this->Kurilingbandung_model->update_views($row->id_wisata, $updateview);

        $data = array(
            'id_wisata' => set_value('id_wisata', $row->id_wisata),
            'nama_wisata' => set_value('nama_wisata', $row->nama_wisata),
            'lat' => set_value('lat', $row->lat),
            'lng' => set_value('lng', $row->lng),
            'alamat_wisata' => set_value('alamat_wisata', $row->alamat_wisata),
            'deskripsi' => set_value('deskripsi', $row->deskripsi),
            'tiket_dewasa' => set_value('tiket_dewasa', $row->tiket_dewasa),
            'tiket_anak' => set_value('tiket_anak', $row->tiket_anak),
            'Kurilingbandung_data' => $this->Kurilingbandung_model->get_populer_data(),
            'gambar' => $this->Kurilingbandung_model->get_gambar(),
            'fasilitas' => $this->Kurilingbandung_model->get_fasilitas(),
            'clustering' => $this->Kurilingbandung_model->get_all_clustering(),
            'q' => $q,
            'qkot' => $qkot,
            'qkec' => $qkec,
            'qkel' => $qkel,
            'gid_kota' => $qkot, 
            'gid_kec' => $qkec,
            'gid_kel' => $qkel,
            'id_kota' => $this->Wisata_model->get_kota(),
            'id_kec' => $this->Wisata_model->get_kec(),
            'id_kel' => $this->Wisata_model->get_kel(),
              
        );
        
        $this->load->view('Kurilingbandung/blog_single', $data);
    }

    public function about()
    {
       $this->load->view('Kurilingbandung/about');
    }

    public function contact()
    {
       $this->load->view('Kurilingbandung/contact');
    }

    public function login()
    {
        $data = array(
            'title' => 'Form Login',
            'action' => site_url('kurilingbandung/login_action'),
            'username' => set_value('username'),
            'password' => set_value('password'),
            'button' => 'Masuk',
        );

       $this->load->view('Kurilingbandung/login', $data);
    }

    public function login_action()
    {
       $this->login_rules();
       if ($this->form_validation->run() == FALSE) {
            $this->login();
       }else{
            $login = $this->Kurilingbandung_model->loginown($this->input->post('username'), ($hash = sha1($this->input->post('password'))));
            if ($login==1) {
                $row = $this->Kurilingbandung_model->data_loginown($this->input->post('username'), ($hash = sha1($this->input->post('password'))));
                
                $data = array(
                    'logged' => TRUE,
                    'username' => $row->NIK,
                    'Nama' => $row->nama_pemilik,
                    'is_admin' => FALSE,
                );
                $this->session->set_userdata($data);
                redirect(site_url('wisata'));
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Username atau Password Salah.</div>');
                redirect(site_url('Kurilingbandung/login'));
            }    
       }
    }

    public function daftar($error=null)
    {
         $data = array(
            'button' => 'Daftar',
            'action' => site_url('Kurilingbandung/daftar_action'),
        'NIK' => set_value('NIK'),
        'nama_pemilik' => set_value('nama_pemilik'),
        'tmp_lahir' => set_value('tmp_lahir'),
        'tgl_lahir' => set_value('tgl_lahir'),
        'jk_pemilik' => set_value('jk_pemilik'),
        'alamat_pemilik' => set_value('alamat_pemilik'),
        'password' => set_value('password'),
        'email_pemilik' => set_value('email_pemilik'),
        'notelp_pemilik' => set_value('notelp_pemilik'),
        'file_ktp' => set_value('file_ktp'),
        'error' => $error['error']
        );

       $this->load->view('Kurilingbandung/daftar', $data);
    }

    public function daftar_action()
    {
        $this->daftar_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->daftar();
        } else {
            
            $image = explode(".", $_FILES['file_ktp']['name']);
            $rename = $this->input->post('NIK',TRUE) . '.' . end($image);
            $config['upload_path']    ='./upload/owner/';
            $config['allowed_types'] = 'jpg|png|gif|bmp';
            $config['max_size']       =5000;
            $config['file_name']    = $rename;

            $this->load->library('upload',$config);
            if(!$this->upload->do_upload('file_ktp')){
                $error = array('error' => $this->upload->display_errors());
                $this->daftar($error);
            }else{
                $data = array(
                    'NIK' => $this->input->post('NIK',TRUE),
                    'nama_pemilik' => $this->input->post('nama_pemilik',TRUE),
                    'tmp_lahir' => $this->input->post('tmp_lahir',TRUE),
                    'tgl_lahir' => $this->input->post('tgl_lahir',TRUE),
                    'jk_pemilik' => $this->input->post('jk_pemilik',TRUE),
                    'alamat_pemilik' => $this->input->post('alamat_pemilik',TRUE),
                    'password' => $hash = sha1($this->input->post('password',TRUE)),
                    'email_pemilik' => $this->input->post('email_pemilik',TRUE),
                    'notelp_pemilik' => $this->input->post('notelp_pemilik',TRUE),
                    'file_ktp' => $rename,
                );
                $this->Kurilingbandung_model->insert($data);
                $this->sendMail();
                $this->session->set_flashdata('message', '<div class="alert alert-success">Anda Sudah Mendaftar Silahkan Perikasa Email Anda Untuk Registrasi.</div>');
                redirect(site_url('kurilingbandung/login'));
            }
        }
    }

    public function lupa_password()
    {
        $data = array(
            'title' => 'Form Lupa Password',
            'action' => site_url('kurilingbandung/lupa_password_action'),
            'email_pemilik' => set_value('email_pemilik'),
            'button' => 'Kirim',
        );

       $this->load->view('Kurilingbandung/lupa_password', $data);
    }

    public function lupa_password_action(){
        $this->form_validation->set_rules('email_pemilik', 'email pemilik', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        if ($this->form_validation->run() == FALSE) {
            $this->lupa_password();
        } else {
            $this->lupa_password_mail();
            $this->session->set_flashdata('message', '<div class="alert alert-success">Email Reset Password Akan Segera Terkirim Ke Email Anda, Silahkan Perikasa Email Anda Untuk Melakukan Reset Password</div>');
            redirect(site_url('Kurilingbandung/login'));
        }
    }

    public function Reset($id){
        
        $row = $this->Kurilingbandung_model->get_by_id($id);
        
        $data = array(
            'button' => 'Reset!',
            'action' => site_url('Kurilingbandung/Reset_action'),
            'NIK' => set_value('NIK', $row->NIK),
        'password' => set_value('password'),
        'confirm_password' => set_value('confirm_password'),
        
        );

        $this->load->view('Kurilingbandung/ResetPassword', $data);
    }

    public function Reset_action(){
        $this->reset_pass_rules();
        
        if ($this->form_validation->run() == FALSE) {
            $this->Reset($this->input->post('NIK', TRUE));
        } else {
            
            $data = array(
                'password' => $hash = sha1($this->input->post('password',TRUE)),    
            );
            
            $this->Kurilingbandung_model->reset($this->input->post('NIK', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Password Anda Berhasil diubah Silahkan Login</div>');
            
            redirect(site_url('Kurilingbandung/login'));
        }
    }

    

    function sendMail() {
        $ci = get_instance();
        $ci->load->library('email');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "Wisatabandungdotcom@gmail.com";
        $config['smtp_pass'] = "Wisatabandungdotcom13";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        
        
        $ci->email->initialize($config);
 
        $ci->email->from('Wisatabandungdotcom@gmail.com', 'Admin Wisata Bandung');
        $list = array($this->input->post('email_pemilik'));
        $ci->email->to($list);
        $email = $this->session->userdata($this->input->post('email_pemilik'));
        $NIK = $this->input->post('NIK');
        $ci->email->subject('Aktifasi akun anda di website wisata bandung');
        $ci->email->message('<!DOCTYPE html><html><head></head><body>
                                <p> Hai, '.$this->input->post('nama_pemilik'). '<br> Akun anda akan diregistrasi dengan NIK ' . $NIK .' Silahkan lanjutkan proses registrasi dengan mengklik tombol di bawah ini. <br>
                                '. anchor(site_url('Kurilingbandung/Aktifasi/'.$NIK),'Aktifkan Akun')  .' <br>
                                Terima Kasih!
                                </body></html>');
        if ($this->email->send()) {
            
        } else {
            show_error($this->email->print_debugger());
        }
    }

    function lupa_password_mail() {
        $ci = get_instance();
        $ci->load->library('email');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "Wisatabandungdotcom@gmail.com";
        $config['smtp_pass'] = "Wisatabandungdotcom13";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        
        
        $ci->email->initialize($config);
 
        $ci->email->from('Wisatabandungdotcom@gmail.com', 'Admin Wisata Bandung');
        $list = array($this->input->post('email_pemilik'));
        $ci->email->to($list);
        $email = $this->session->userdata($this->input->post('email_pemilik'));
        $ssemail = $this->input->post('email_pemilik');
        $row = $this->Kurilingbandung_model->get_by_email($ssemail);
        
        $NIKxx = $row->NIK;
        $ci->email->subject('Aktifasi akun anda di website wisata bandung');
        $ci->email->message('<!DOCTYPE html><html><head></head><body>
                                <p> Hai, <br> Anda Akan Melakukan Reset Password Silahkan Lanjutkan dengan mengklik tombol di bawah ini. <br>
                                '. anchor(site_url('Kurilingbandung/Reset/'.$NIKxx),'Aktifkan Akun')  .' <br>
                                Terima Kasih!
                                </body></html>');
        if ($this->email->send()) {
            
        } else {
            show_error($this->email->print_debugger());
        }
    }

    public function Aktifasi($id){

        $Aktifasi = $this->Kurilingbandung_model->registasi($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Email anda sudah teregistrasi, akun anda sendang dalam prosess aktifasi oleh admin.</div>');
        redirect(site_url('Kurilingbandung/login'));    
    }

    public function login_rules(){
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function reg_email($str){
        if (!preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $str)) {
            $this->form_validation->set_message('reg_email', 'Email is Invalid');
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function reg_pass($str){
        if (!preg_match('/^\S*(?=\S{7,15})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $str)) {
            $this->form_validation->set_message('reg_pass', 'Password Must Be Between 7 and 15 Characters and Must Contain At Least One Lowercase Letter One Uppercase Letter and One Digit');
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function daftar_rules() 
    {
        $this->form_validation->set_rules('nama_pemilik', 'nama pemilik', 'trim|required');
        $this->form_validation->set_rules('tmp_lahir', 'tmp lahir', 'trim|required');
        $this->form_validation->set_rules('tgl_lahir', 'tgl lahir', 'trim|required');
        $this->form_validation->set_rules('jk_pemilik', 'jk pemilik', 'trim|required');
        $this->form_validation->set_rules('alamat_pemilik', 'alamat pemilik', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required|callback_reg_pass');
        
        $this->form_validation->set_rules('email_pemilik', 'email pemilik', 'trim|required|callback_reg_email|is_unique[pemilik.email_pemilik]');
        $this->form_validation->set_rules('NIK', 'NIK', 'trim|required|is_unique[pemilik.NIK]');

        $this->form_validation->set_rules('notelp_pemilik', 'notelp pemilik', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        if (empty($_FILES['file_ktp']['name'])) {
            $this->form_validation->set_rules('file_ktp', 'file_ktp', 'required');
        }
        //$this->form_validation->set_rules('file_ktp', 'file ktp', 'trim|required');
        // $this->form_validation->set_rules('username', 'username', 'trim|required');
        // $this->form_validation->set_rules('password', 'password', 'trim|required');
        // $this->form_validation->set_rules('is_active', 'is active', 'trim|required');
    }

    public function reset_pass_rules(){
        $this->form_validation->set_rules('password', 'Password', 'required|callback_reg_pass');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}