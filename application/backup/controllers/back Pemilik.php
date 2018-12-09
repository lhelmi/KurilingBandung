<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pemilik extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        
        
        $this->load->model('Pemilik_model');
        $this->load->helper(array('email', 'url', 'form'));
        $this->load->library('form_validation');
        $this->load->helper('file');
    }

    public function index()
    {
        if ($this->session->userdata('logged')<>1) {
            $this->session->set_flashdata('message', 'Anda Belum Login, Silahkan Login Terlebih Dahulu');
            redirect(site_url('auth'));
        }

        if ($this->session->userdata('level')=='1') {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            
            if ($q <> '') {
                $config['base_url'] = base_url() . 'pemilik/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'pemilik/index.html?q=' . urlencode($q);
            } else {
                $config['base_url'] = base_url() . 'pemilik/index.html';
                $config['first_url'] = base_url() . 'pemilik/index.html';
            }

            $config['per_page'] = 10;
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->Pemilik_model->total_rows_admin($q);
            $pemilik_admin = $this->Pemilik_model->get_limit_data_admin($config['per_page'], $start, $q);

            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $data = array(
                'pemilik_data' => $pemilik_admin,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
            );    

        }elseif ($this->session->userdata('level')=='0') {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            
            if ($q <> '') {
                $config['base_url'] = base_url() . 'pemilik/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'pemilik/index.html?q=' . urlencode($q);
            } else {
                $config['base_url'] = base_url() . 'pemilik/index.html';
                $config['first_url'] = base_url() . 'pemilik/index.html';
            }

            $config['per_page'] = 10;
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->Pemilik_model->total_rows($q);
            $pemilik = $this->Pemilik_model->get_limit_data($config['per_page'], $start, $q);

            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $data = array(
                'pemilik_data' => $pemilik,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
            );
        }
        $this->load->view('pemilik/pemilik_list', $data);
    }

    public function read($id) 
    {
        if ($this->session->userdata('logged')<>1) {
            $this->session->set_flashdata('message', 'Anda Belum Login, Silahkan Login Terlebih Dahulu');
            redirect(site_url('auth'));
        }
        $row = $this->Pemilik_model->get_by_id($id);
        if ($row) {
            $data = array(
		'NIK' => $row->NIK,
		'nama_pemilik' => $row->nama_pemilik,
		'tmp_lahir' => $row->tmp_lahir,
		'tgl_lahir' => $row->tgl_lahir,
		'jk_pemilik' => $row->jk_pemilik,
		'alamat_pemilik' => $row->alamat_pemilik,
		'password' => $row->password,
		'email_pemilik' => $row->email_pemilik,
		'notelp_pemilik' => $row->notelp_pemilik,
		'file_ktp' => $row->file_ktp,
		'is_active' => $row->is_active,
	    );
            $this->load->view('pemilik/pemilik_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pemilik'));
        }
    }

    public function active($id) 
    {
        if ($this->session->userdata('logged')<>1) {
            $this->session->set_flashdata('message', 'Anda Belum Login, Silahkan Login Terlebih Dahulu');
            redirect(site_url('auth/adminlogin'));
        }
        $row = $this->Pemilik_model->get_by_id($id);
        
        $email = $row->email_pemilik;
        $nama_pemilik = $row->nama_pemilik;
        $is_active = $row->is_active;
        $NIK = $row->NIK;

        if ($is_active == '0') {
            $this->Pemilik_model->active($id);
            $this->activasisendMail($id);
            $this->session->set_flashdata('message', $NIK. ' aktif');
            redirect(site_url('pemilik'));
        }elseif ($is_active == '1') {
            $this->Pemilik_model->deactive($id);
            $this->deactivasisendMail($id);
            $this->session->set_flashdata('message', $NIK. ' non-aktif');
            redirect(site_url('pemilik'));     
        }
    }

    public function create($error=null) 
    {
        if ($this->session->userdata('logged')<>1) {
            $this->session->set_flashdata('message', 'Anda Belum Login, Silahkan Login Terlebih Dahulu');
            redirect(site_url('auth/adminlogin'));
        }
        $data = array(
            'button' => 'Create',
            'action' => site_url('pemilik/create_action'),
	    'NIK' => set_value('NIK'),
	    'nama_pemilik' => set_value('nama_pemilik'),
	    'tmp_lahir' => set_value('tmp_lahir'),
	    'tgl_lahir' => set_value('tgl_lahir'),
	    'jk_pemilik' => set_value('jk_pemilik'),
	    'alamat_pemilik' => set_value('alamat_pemilik'),
	    'password' => set_value('password'),
	    'email_pemilik' => set_value('email_pemilik'),
	    'notelp_pemilik' => set_value('notelp_pemilik'),
        'is_Reg' => set_value('is_Reg'),
	    'file_ktp' => set_value('file_ktp'),
        'error' => $error['error']
	);
        $this->load->view('pemilik/pemilik_form', $data, array('error'=>''));
    }
    
    public function create_action() 
    {
        if ($this->session->userdata('logged')<>1) {
            $this->session->set_flashdata('message', 'Anda Belum Login, Silahkan Login Terlebih Dahulu');
            redirect(site_url('auth/adminlogin'));
        }
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

        // configurations from upload library
        $image = explode(".", $_FILES['file_ktp']['name']);
        $rename = $this->input->post('NIK',TRUE) . '.' . end($image);
        $config['upload_path']    ='./upload/owner/'; 
        $config['allowed_types']  ='gif|jpg|png';
        $config['max_size']       =100; //ukuran masksimal
        $config['max_width']      =1024; //lebar maksimal
        $config['max_height']    =768; //tinggi maksimal
        $config['file_name']    = $rename;
        $this->load->library('upload',$config); //berfungsi untuk memanggil library ci
        if(!$this->upload->do_upload('file_ktp')){ //berfungsi untuk melakukan fungsi upload
            $error = array('error' => $this->upload->display_errors());
            $this->create($error);
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
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('pemilik'));
            }
        }
    }
    
    public function update($id, $error=null) 
    {
        if ($this->session->userdata('logged')<>1) {
            $this->session->set_flashdata('message', 'Anda Belum Login, Silahkan Login Terlebih Dahulu');
            redirect(site_url('auth/adminlogin'));
        }
        $row = $this->Pemilik_model->get_by_id($id);
        $x = $row->file_ktp;
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pemilik/update_action'),
		'NIK' => set_value('NIK', $row->NIK),
		'nama_pemilik' => set_value('nama_pemilik', $row->nama_pemilik),
		'tmp_lahir' => set_value('tmp_lahir', $row->tmp_lahir),
		'tgl_lahir' => set_value('tgl_lahir', $row->tgl_lahir),
		'jk_pemilik' => set_value('jk_pemilik', $row->jk_pemilik),
		'alamat_pemilik' => set_value('alamat_pemilik', $row->alamat_pemilik),
		'password' => set_value('password', $row->password),
		'email_pemilik' => set_value('email_pemilik', $row->email_pemilik),
		'notelp_pemilik' => set_value('notelp_pemilik', $row->notelp_pemilik),
		'file_ktp' => set_value('file_ktp', $row->file_ktp),
        'is_Reg' => set_value('is_Reg', $row->is_Reg),
        'is_active' => set_value('is_active', $row->is_active),
        'error' => $error['error']
	    );
            $this->load->view('pemilik/pemilik_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pemilik'));
        }
    }
    
    public function update_action() 
    {
        if ($this->session->userdata('logged')<>1) {
            $this->session->set_flashdata('message', 'Anda Belum Login, Silahkan Login Terlebih Dahulu');
            redirect(site_url('auth/adminlogin'));
        }
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('NIK', TRUE));
        } else {
            if (!empty($_FILES['file_ktp']['name'])) {
                $image = explode(".", $_FILES['file_ktp']['name']);
                $rename = $this->input->post('NIK',TRUE) . '.' . end($image);
                $config['upload_path']    ='./upload/owner/';
                $config['allowed_types']  ='gif|jpg|png';
                $config['max_size']       =100; //ukuran masksimal
                $config['max_width']      =1024; //lebar maksimal
                $config['max_height']    =768; //tinggi maksimal
                $config['file_name']    = $rename;
                $config['overwrite'] = TRUE;
                $this->load->library('upload',$config); //berfungsi untuk memanggil library ci
                if(!$this->upload->do_upload('file_ktp')){ //berfungsi untuk melakukan fungsi upload
                    $error = array('error' => $this->upload->display_errors());
                    $this->update($this->input->post('NIK', TRUE), $error);
                }else{
                        $data = array(
                    'nama_pemilik' => $this->input->post('nama_pemilik',TRUE),
                    'tmp_lahir' => $this->input->post('tmp_lahir',TRUE),
                    'tgl_lahir' => $this->input->post('tgl_lahir',TRUE),
                    'jk_pemilik' => $this->input->post('jk_pemilik',TRUE),
                    'alamat_pemilik' => $this->input->post('alamat_pemilik',TRUE),
                    'password' => $hash = sha1($this->input->post('password',TRUE)),
                    'email_pemilik' => $this->input->post('email_pemilik',TRUE),
                    'notelp_pemilik' => $this->input->post('notelp_pemilik',TRUE),
                    'file_ktp' => $rename,
                    'is_active' => $this->input->post('is_active',TRUE),
                    );

                        $this->Pemilik_model->update($this->input->post('NIK', TRUE), $data);
                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('pemilik'));
                    } 
            }else{
                $data = array(
                    'nama_pemilik' => $this->input->post('nama_pemilik',TRUE),
                    'tmp_lahir' => $this->input->post('tmp_lahir',TRUE),
                    'tgl_lahir' => $this->input->post('tgl_lahir',TRUE),
                    'jk_pemilik' => $this->input->post('jk_pemilik',TRUE),
                    'alamat_pemilik' => $this->input->post('alamat_pemilik',TRUE),
                    'password' => $hash = sha1($this->input->post('password',TRUE)),
                    'email_pemilik' => $this->input->post('email_pemilik',TRUE),
                    'notelp_pemilik' => $this->input->post('notelp_pemilik',TRUE),
                    //'file_ktp' => $rename,
                    'is_active' => $this->input->post('is_active',TRUE),
                    );

                        $this->Pemilik_model->update($this->input->post('NIK', TRUE), $data);
                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('pemilik'));
                } 
            }
        
        }
    
    public function delete($id) 
    {
        if ($this->session->userdata('logged')<>1) {
            $this->session->set_flashdata('message', 'Anda Belum Login, Silahkan Login Terlebih Dahulu');
            redirect(site_url('auth/adminlogin'));
        }
        $row = $this->Pemilik_model->get_by_id($id);

        if ($row) {
            $this->Pemilik_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pemilik'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pemilik'));
        }
    }

    public function Aktifasi($id){

        $Aktifasi = $this->Pemilik_model->registasi($id);
        $this->session->set_flashdata('message', 'Email anda sudah teregistrasi, akun anda sendang dalam prosess aktifasi');
        redirect(site_url('auth'));    
        

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

    public function activasisendMail($id) {
        $row = $this->Pemilik_model->get_by_id($id);
        
        $email_pemilik = $row->email_pemilik;
        $nama_pemilik = $row->nama_pemilik;
        $is_active = $row->is_active;
        

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
        $list = array($email_pemilik);
        $ci->email->to($list);
        $NIK = $row->NIK;
        $ci->email->subject('Aktifasi akun anda di website wisata bandung');
        $ci->email->message('<!DOCTYPE html><html><head></head><body>
                                <p> Hai, '.$nama_pemilik. '<br> Akun anda akan dengan NIK ' . $NIK .' telah  di non-aktifkan. <br>
                                Terima Kasih!
                                </body></html>');
        if ($this->email->send()) {
            
        } else {
            show_error($this->email->print_debugger());
        }
    }

    public function deactivasisendMail($id) {
        $row = $this->Pemilik_model->get_by_id($id);
        
        $email_pemilik = $row->email_pemilik;
        $nama_pemilik = $row->nama_pemilik;
        $is_active = $row->is_active;
        

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
        $list = array($email_pemilik);
        $ci->email->to($list);
        $NIK = $row->NIK;
        $ci->email->subject('Aktifasi akun anda di website wisata bandung');
        $ci->email->message('<!DOCTYPE html><html><head></head><body>
                                <p> Hai, '.$nama_pemilik. '<br> Akun anda akan dengan NIK ' . $NIK .' telah  di non-aktifkan. <br>
                                Terima Kasih!
                                </body></html>');
        if ($this->email->send()) {
            
        } else {
            show_error($this->email->print_debugger());
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_pemilik', 'nama pemilik', 'trim|required');
	$this->form_validation->set_rules('tmp_lahir', 'tmp lahir', 'trim|required');
	$this->form_validation->set_rules('tgl_lahir', 'tgl lahir', 'trim|required');
	$this->form_validation->set_rules('jk_pemilik', 'jk pemilik', 'trim|required');
	$this->form_validation->set_rules('alamat_pemilik', 'alamat pemilik', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('email_pemilik', 'email pemilik', 'trim|required');
	$this->form_validation->set_rules('notelp_pemilik', 'notelp pemilik', 'trim|required');
	
	// $this->form_validation->set_rules('is_active', 'is active', 'trim|required');

	$this->form_validation->set_rules('NIK', 'NIK', 'trim|required');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pemilik.xls";
        $judul = "pemilik";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Pemilik");
	xlsWriteLabel($tablehead, $kolomhead++, "Tmp Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Jk Pemilik");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat Pemilik");
	xlsWriteLabel($tablehead, $kolomhead++, "Password");
	xlsWriteLabel($tablehead, $kolomhead++, "Email Pemilik");
	xlsWriteLabel($tablehead, $kolomhead++, "Notelp Pemilik");
	xlsWriteLabel($tablehead, $kolomhead++, "File Ktp");
	xlsWriteLabel($tablehead, $kolomhead++, "Is Active");

	foreach ($this->Pemilik_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_pemilik);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tmp_lahir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_lahir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jk_pemilik);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat_pemilik);
	    xlsWriteLabel($tablebody, $kolombody++, $data->password);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email_pemilik);
	    xlsWriteLabel($tablebody, $kolombody++, $data->notelp_pemilik);
	    xlsWriteLabel($tablebody, $kolombody++, $data->file_ktp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->is_active);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Pemilik.php */
/* Location: ./application/controllers/Pemilik.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-31 14:20:54 */
/* http://harviacode.com */