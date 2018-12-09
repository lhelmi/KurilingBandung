<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kota extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged')<>1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Anda Belum Login, Silahkan Login Terlebih Dahulu.<br></div>');
            redirect(site_url('auth'));
        }
        if ($this->session->userdata('level')=='1') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Anda Tidak Memiliki Akses ke Halaman Tersebut.<br></div>');
            redirect(site_url('dashboard'));
        }
        if ($this->session->userdata('is_admin')==FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Anda Tidak Memiliki Akses ke Halaman Tersebut.<br></div>');
            redirect(site_url('wisata'));
            
        }
        $this->load->model('Kota_model');
        $this->load->library('form_validation');

    }

    public function index()
    {
        $data = array(
            'kota_data' => $this->Kota_model->get_all()
        );

        $this->load->view('kota/kota_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Kota_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kota' => $row->id_kota,
		'nama_kota' => $row->nama_kota,
		'NIP' => $row->NIP,
	    );
            $this->load->view('kota/kota_read', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Record Not Found.<br></div>');
            redirect(site_url('kota'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kota/create_action'),
	    'id_kota' => set_value('id_kota'),
	    'nama_kota' => set_value('nama_kota'),
        'gNIP' => set_value('NIP'),
	    'NIP' => $this->Kota_model->get_nip(),
	);
        $this->load->view('kota/kota_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();
        $this->form_validation->set_rules('nama_kota', 'nama kota', 'trim|required|is_unique[kota.nama_kota]|callback_reg_namakota');
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_kota' => $this->input->post('nama_kota',TRUE),
		'NIP' => $this->input->post('NIP',TRUE),
	    );

            $this->Kota_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><p><strong><i class="ace-icon fa fa-check"></i></strong> Create Record Success.</p></div>');
            redirect(site_url('kota'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kota_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kota/update_action'),
		'id_kota' => set_value('id_kota', $row->id_kota),
		'nama_kota' => set_value('nama_kota', $row->nama_kota),
        'gNIP' => set_value('NIP', $row->NIP),
        'NIP' => $this->Kota_model->get_nip(), $row->NIP,
        );
            $this->load->view('kota/kota_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Record Not Found.<br></div>');
            redirect(site_url('kota'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();
        $this->form_validation->set_rules('nama_kota', 'nama kota', 'trim|required|callback_reg_namakota');

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kota', TRUE));
        } else {
            $data = array(
		'nama_kota' => $this->input->post('nama_kota',TRUE),
		'NIP' => $this->input->post('NIP',TRUE),
	    );

            $this->Kota_model->update($this->input->post('id_kota', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><p><strong><i class="ace-icon fa fa-check"></i></strong> Update Record Success.</p></div>');
            redirect(site_url('kota'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kota_model->get_by_id($id);

        if ($row) {
            $this->Kota_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><p><strong><i class="ace-icon fa fa-check"></i></strong> Delete Record Success.</p></div>');
            redirect(site_url('kota'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Record Not Found.<br></div>');
            redirect(site_url('kota'));
        }
    }

    public function reg_namakota($str){
        if (!preg_match("/^[a-zA-Z\s-]*$/", $str)) {
            $this->form_validation->set_message('reg_namakota', 'Only Letters Are Allowed');
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function _rules() 
    {
	
    $this->form_validation->set_rules('NIP', 'nip', 'trim|required');

	$this->form_validation->set_rules('id_kota', 'id_kota', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

 //    public function excel()
 //    {
 //        $this->load->helper('exportexcel');
 //        $namaFile = "kota.xls";
 //        $judul = "kota";
 //        $tablehead = 0;
 //        $tablebody = 1;
 //        $nourut = 1;
 //        //penulisan header
 //        header("Pragma: public");
 //        header("Expires: 0");
 //        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
 //        header("Content-Type: application/force-download");
 //        header("Content-Type: application/octet-stream");
 //        header("Content-Type: application/download");
 //        header("Content-Disposition: attachment;filename=" . $namaFile . "");
 //        header("Content-Transfer-Encoding: binary ");

 //        xlsBOF();

 //        $kolomhead = 0;
 //        xlsWriteLabel($tablehead, $kolomhead++, "No");
	// xlsWriteLabel($tablehead, $kolomhead++, "Nama Kota");
	// xlsWriteLabel($tablehead, $kolomhead++, "NIP");

	// foreach ($this->Kota_model->get_all() as $data) {
 //            $kolombody = 0;

 //            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
 //            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	//     xlsWriteLabel($tablebody, $kolombody++, $data->nama_kota);
	//     xlsWriteLabel($tablebody, $kolombody++, $data->NIP);

	//     $tablebody++;
 //            $nourut++;
 //        }

 //        xlsEOF();
 //        exit();
 //    }

}

/* End of file Kota.php */
/* Location: ./application/controllers/Kota.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-31 14:20:54 */
/* http://harviacode.com */