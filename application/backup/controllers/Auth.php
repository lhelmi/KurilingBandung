<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
 	
 	function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
        $this->load->model('Pemilik_model');
        $this->load->library('encryption');
    }

    public function admin() {
        $data = array(
            'title' => 'Login Page',
            'action' => site_url('auth/adminlogin'),
            'username' => set_value('username'),
            'password' => set_value('password'),
            'button' => 'Login',
        );
        $this->load->view('login/adminlogin', $data);
    }
    
    public function adminlogin() {
        $this->login_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->admin();
        } else {
            $login = $this->Auth_model->login($this->input->post('username'), ($hash = sha1($this->input->post('password'))));
            if ($login==1) {
                $row = $this->Auth_model->data_login($this->input->post('username'), ($hash = sha1($this->input->post('password'))));
            $data = array(
                'logged' => TRUE,
                'username' => $row->username,
                'level'=>$row->level,
                'NIP'=>$row->NIP,
                'is_admin'=>TRUE,
            );
            $this->session->set_userdata($data);
            redirect(site_url('dashboard'));
             }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Username atau Password Salah.</div>');
                redirect(site_url('auth/adminlogin'));
            }
        } 
    }

    public function index() {
        $data = array(
            'title' => 'Login Page',
            'action' => site_url('auth/login'),
            'username' => set_value('username'),
            'password' => set_value('password'),
            'button' => 'Login',
        );
        $this->load->view('login/login', $data);
    }

    public function login() {
        $this->login_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
        	$login = $this->Auth_model->loginown($this->input->post('username'), ($hash = sha1($this->input->post('password'))));
            if ($login==1) {
                $row = $this->Auth_model->data_loginown($this->input->post('username'), ($hash = sha1($this->input->post('password'))));
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
                redirect(site_url('auth/login'));
            }    
        }
    }

    public function reg($error=null){
        $data = array(
            'button' => 'Register',
            'action' => site_url('auth/create_action'),
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

        $this->load->view('login/registration', $data);
    }

    public function forgotpassword(){
        $data = array(
            'button' => 'Send Me!',
            'action' => site_url('auth/forgotpassword_action'),
        'email_pemilik' => set_value('email_pemilik'),
        );

        $this->load->view('login/ForgotPassword', $data);
    }

    public function forgotpassword_action(){
        $this->form_validation->set_rules('email_pemilik', 'email pemilik', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        if ($this->form_validation->run() == FALSE) {
            $this->forgotpassword();
        } else {
            $this->ForgotPasswordmail();
            $this->session->set_flashdata('message', '<div class="alert alert-success">Email Reset Password Akan Segera Terkirim Ke Email Anda, Silahkan Perikasa Email Anda Untuk Melakukan Reset Password</div>');
            redirect(site_url('auth/login'));
        }
    }

    public function Reset($id){
        
        $row = $this->Pemilik_model->get_by_id($id);
        
        $data = array(
            'button' => 'Reset!',
            'action' => site_url('auth/Reset_action'),
            'NIK' => set_value('NIK', $row->NIK),
        'password' => set_value('password'),
        'confirm_password' => set_value('confirm_password'),
        
        );

        $this->load->view('login/ResetPassword', $data);
    }

    public function Reset_action(){
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        
        if ($this->form_validation->run() == FALSE) {
            $this->Reset($this->input->post('NIK', TRUE));
        } else {
            
            $data = array(
                'password' => $hash = sha1($this->input->post('password',TRUE)),    
            );
            
            $this->Pemilik_model->update($this->input->post('NIK', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Password Anda Berhasil diubah Silahkan Login</div>');
            
            redirect(site_url('auth/login'));
        }
    }

    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->reg();
        } else {
        
         // configurations from upload library
        $image = explode(".", $_FILES['file_ktp']['name']);
        $rename = $this->input->post('NIK',TRUE) . '.' . end($image);
        $config['upload_path']    ='./upload/owner/';
        $config['allowed_types'] = 'jpg|png|gif|bmp';
        $config['max_size']       =100; //ukuran masksimal
        $config['max_width']      =1024; //lebar maksimal
        $config['max_height']    =768; //tinggi maksimal
        $config['file_name']    = $rename;
        $this->load->library('upload',$config); //berfungsi untuk memanggil library ci
        if(!$this->upload->do_upload('file_ktp')){ //berfungsi untuk melakukan fungsi upload
            $error = array('error' => $this->upload->display_errors());
            $this->reg($error);
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
            $this->Pemilik_model->insert($data);
            $this->sendMail();
            $this->session->set_flashdata('message', '<div class="alert alert-success">Create Record Success.</div>');
            redirect(site_url('auth/login'));
        }

        
        }
    }

    public function Aktifasi($id){

        $Aktifasi = $this->Pemilik_model->registasi($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Email anda sudah teregistrasi, akun anda sendang dalam prosess aktifasi.</div>');
        redirect(site_url('auth/login'));
        

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
                                '. anchor(site_url('pemilik/Aktifasi/'.$NIK),'Aktifkan Akun')  .' <br>
                                Terima Kasih!
                                </body></html>');
        if ($this->email->send()) {
            
        } else {
            show_error($this->email->print_debugger());
        }
    }

    function ForgotPasswordmail() {
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
        $row = $this->Pemilik_model->get_by_email($ssemail);
        
        $NIKxx = $row->NIK;
        $ci->email->subject('Aktifasi akun anda di website wisata bandung');
        $ci->email->message('<!DOCTYPE html><html><head></head><body>
                                <p> Hai, <br> Anda Akan Melakukan Reset Password Silahkan Lanjutkan dengan mengklik tombol di bawah ini. <br>
                                '. anchor(site_url('Auth/Reset/'.$NIKxx),'Aktifkan Akun')  .' <br>
                                Terima Kasih!
                                </body></html>');
        if ($this->email->send()) {
            
        } else {
            show_error($this->email->print_debugger());
        }
    }

    public function login_rules(){
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    public function _rules() 
    {
    // $this->form_validation->set_rules('username', 'username', 'trim|required');
    // $this->form_validation->set_rules('password', 'password', 'trim|required');
    
    $this->form_validation->set_rules('NIK', 'NIK', 'trim|required');
    $this->form_validation->set_rules('nama_pemilik', 'nama pemilik', 'trim|required');
    $this->form_validation->set_rules('tmp_lahir', 'tmp lahir', 'trim|required');
    $this->form_validation->set_rules('tgl_lahir', 'tgl lahir', 'trim|required');
    $this->form_validation->set_rules('jk_pemilik', 'jk pemilik', 'trim|required');
    $this->form_validation->set_rules('alamat_pemilik', 'alamat pemilik', 'trim|required');
    $this->form_validation->set_rules('password', 'password', 'trim|required');
    $this->form_validation->set_rules('email_pemilik', 'email pemilik', 'trim|required');
    $this->form_validation->set_rules('notelp_pemilik', 'notelp pemilik', 'trim|required');
    //$this->form_validation->set_rules('file_ktp', 'file ktp', 'trim|required');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    if (empty($_FILES['file_ktp']['name'])) {
        $this->form_validation->set_rules('file_ktp', 'file_ktp', 'required');
    }
    // $this->form_validation->set_rules('is_active', 'is active', 'trim|required');
    }
 
    function adminlogout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-success">Berhasil Logout.</div>');
        redirect(site_url('auth/adminlogin'));
    }

    function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-success">Berhasil Logout.</div>');
        redirect(site_url('kurilingbandung/login'));
    }
 
}
 
/* End of file auth.php */
/* Location: ./application/controllers/auth.php */

?>