<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelurahan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged')<>1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Anda Belum Login, Silahkan Login Terlebih Dahulu.<br></div>
');
            redirect(site_url('auth'));
        }
        if ($this->session->userdata('is_admin')==FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Anda Tidak Memiliki Akses ke Halaman Tersebut.<br></div>');
            redirect(site_url('wisata'));
            
        }
        $this->load->model('Kelurahan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('level')=='0') {
                $data = array(
                'kelurahan_data' => $this->Kelurahan_model->get_all()
            );
            }elseif ($this->session->userdata('level')=='1') {
                $data = array( 
                'kelurahan_data' => $this->Kelurahan_model->get_all_admin()
            );
        }
        
        $this->load->view('kelurahan/kelurahan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Kelurahan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kel' => $row->id_kel,
		'id_kec' => $row->id_kec,
		'nama_kel' => $row->nama_kel,
	    );
            $this->load->view('kelurahan/kelurahan_read', $data);
        } else {
            $this->session->set_flashdata('message', ' <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Record Not Found.<br></div>
');
            redirect(site_url('kelurahan'));
        }
    }

    public function create() 
    {
        if ($this->session->userdata('level')=='0') {
            $data = array(
                'button' => 'Create',
                'action' => site_url('kelurahan/create_action'),
        	    'id_kel' => set_value('id_kel'),
                'gid_kota' => '',
                'gid_kec' => '',
                'id_kota' => $this->Kelurahan_model->get_kota(),
                'id_kec' => $this->Kelurahan_model->get_kec(),
        	    'nama_kel' => set_value('nama_kel'),
        	);
        }elseif ($this->session->userdata('level')=='1') {
            $data = array(
                'button' => 'Create',
                'action' => site_url('kelurahan/create_action'),
                'id_kel' => set_value('id_kel'),
                'gid_kota' => '',
                'gid_kec' => '',
                'id_kota' => $this->Kelurahan_model->get_kotaadmin(),
                'id_kec' => $this->Kelurahan_model->get_kec(),
                'nama_kel' => set_value('nama_kel'),
            );
        }
        $this->load->view('kelurahan/kelurahan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_kec' => $this->input->post('id_kec',TRUE),
		'nama_kel' => $this->input->post('nama_kel',TRUE),
	    );

            $this->Kelurahan_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><p><strong><i class="ace-icon fa fa-check"></i></strong> Create Record Success.</p></div>');
            redirect(site_url('kelurahan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kelurahan_model->get_by_id($id);
        $selected = $this->Kelurahan_model->get_selected_by_id_kec($row->id_kec);

        if ($row) {
            if ($this->session->userdata('level')=='0') {
                $data = array(
                'button' => 'Update',
                'action' => site_url('kelurahan/update_action'),
                'id_kel' => set_value('id_kel', $row->id_kel),
                'gid_kota' => $selected->id_kota,
                'gid_kec' => $selected->id_kec,
                'id_kota' => $this->Kelurahan_model->get_kota(),
                'id_kec' => $this->Kelurahan_model->get_kec(),
                'nama_kel' => set_value('nama_kel', $row->nama_kel),
                );    
            }elseif ($this->session->userdata('level')=='1') {
                $data = array(
                'button' => 'Update',
                'action' => site_url('kelurahan/update_action'),
                'id_kel' => set_value('id_kel', $row->id_kel),
                'gid_kota' => $selected->id_kota,
                'gid_kec' => $selected->id_kec,
                'id_kota' => $this->Kelurahan_model->get_kotaadmin(),
                'id_kec' => $this->Kelurahan_model->get_kec(),
                'nama_kel' => set_value('nama_kel', $row->nama_kel),
                );
            }
            
            $this->load->view('kelurahan/kelurahan_form', $data);
        } else {
            $this->session->set_flashdata('message', ' <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Record Not Found.<br></div>
');
            redirect(site_url('kelurahan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kel', TRUE));
        } else {
            $data = array(
		'id_kec' => $this->input->post('id_kec',TRUE),
		'nama_kel' => $this->input->post('nama_kel',TRUE),
	    );

            $this->Kelurahan_model->update($this->input->post('id_kel', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><p><strong><i class="ace-icon fa fa-check"></i></strong> Update Record Success.</p></div>');
            redirect(site_url('kelurahan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kelurahan_model->get_by_id($id);

        if ($row) {
            $this->Kelurahan_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><p><strong><i class="ace-icon fa fa-check"></i></strong> Delete Record Success.</p></div>');
            redirect(site_url('kelurahan'));
        } else {
            $this->session->set_flashdata('message', ' <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Record Not Found.<br></div>
');
            redirect(site_url('kelurahan'));
        }
    }

    public function reg_namakel($str){
        if (!preg_match("/^[a-zA-Z\s-]*$/", $str)) {
            $this->form_validation->set_message('reg_namakel', 'Only Letters Are Allowed');
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_kec', 'id kec', 'trim|required');
	$this->form_validation->set_rules('nama_kel', 'nama kel', 'trim|required|is_unique[kelurahan.nama_kel]|callback_reg_namakel');

	$this->form_validation->set_rules('id_kel', 'id_kel', 'trim');
    $this->form_validation->set_rules('id_kota', 'id_kota', 'trim|required');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

 //    public function excel()
 //    {
 //        $this->load->helper('exportexcel');
 //        $namaFile = "kelurahan.xls";
 //        $judul = "kelurahan";
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
	// xlsWriteLabel($tablehead, $kolomhead++, "Id Kec");
	// xlsWriteLabel($tablehead, $kolomhead++, "Nama Kel");

	// foreach ($this->Kelurahan_model->get_all() as $data) {
 //            $kolombody = 0;

 //            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
 //            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	//     xlsWriteNumber($tablebody, $kolombody++, $data->id_kec);
	//     xlsWriteLabel($tablebody, $kolombody++, $data->nama_kel);

	//     $tablebody++;
 //            $nourut++;
 //        }

 //        xlsEOF();
 //        exit();
 //    }

}

/* End of file Kelurahan.php */
/* Location: ./application/controllers/Kelurahan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-31 14:20:54 */
/* http://harviacode.com */