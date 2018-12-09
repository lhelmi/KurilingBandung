<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kecamatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged')<>1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Anda Belum Login, Silahkan Login Terlebih Dahulu.<br></div>');
            redirect(site_url('auth'));
        }
        if ($this->session->userdata('is_admin')==FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Anda Tidak Memiliki Akses ke Halaman Tersebut.<br></div>');
            redirect(site_url('wisata'));
            
        }
        $this->load->model('Kecamatan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('level')=='0') {
                $data = array(
                'kecamatan_data' => $this->Kecamatan_model->get_all()
            );
            }elseif ($this->session->userdata('level')=='1') {
                $data = array( 
                'kecamatan_data' => $this->Kecamatan_model->get_all_admin()
            );
        }
        
        $this->load->view('kecamatan/kecamatan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Kecamatan_model->get_by_id($id);
        if ($row) {
            $data = array(
        'id_kec' => $row->id_kec,
        'id_kota' => $row->id_kota,
        'nama_kec' => $row->nama_kec,
        );
            $this->load->view('kecamatan/kecamatan_read', $data);
        } else {
            $this->session->set_flashdata('message', ' <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Record Not Found.<br></div>');
            redirect(site_url('kecamatan'));
        }
    }

    public function create() 
    {   
        if ($this->session->userdata('level')=='1') {
            $data = array(
            'button' => 'Create',
            'action' => site_url('kecamatan/create_action'),
        'id_kec' => set_value('id_kec'),
        'gid_kota' => '',
        'id_kota' => $this->Kecamatan_model->get_kotaadmin(),
        'nama_kec' => set_value('nama_kec'),
        'is_delete' => set_value('is_delete'),
        );
        }elseif ($this->session->userdata('level')=='0') {
            $data = array(
            'button' => 'Create',
            'action' => site_url('kecamatan/create_action'),
        'id_kec' => set_value('id_kec'),
        'gid_kota' => '',
        'id_kota' => $this->Kecamatan_model->get_kota(),
        'nama_kec' => set_value('nama_kec'),
        'is_delete' => set_value('is_delete'),
        );
        }
        
    
        $this->load->view('kecamatan/kecamatan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        'id_kota' => $this->input->post('id_kota',TRUE),
        'nama_kec' => $this->input->post('nama_kec',TRUE),
        'is_delete' => $this->input->post('is_delete',TRUE),
        );

            $this->Kecamatan_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><p><strong><i class="ace-icon fa fa-check"></i></strong> Create Record Success.</p></div>');
            redirect(site_url('kecamatan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kecamatan_model->get_by_id($id);
        $selected = $this->Kecamatan_model->get_selected($row->id_kota);

        if ($row) {
            if ($this->session->userdata('level')=='0') {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('kecamatan/update_action'),
                    'id_kec' => set_value('id_kec', $row->id_kec),
                    'gid_kota' => $selected->id_kota, 
                    'id_kota' => $this->Kecamatan_model->get_kota(),
                    'nama_kec' => set_value('nama_kec', $row->nama_kec),
                    );
            }elseif ($this->session->userdata('level')=='1') {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('kecamatan/update_action'),
                    'id_kec' => set_value('id_kec', $row->id_kec),
                    'gid_kota' => $selected->id_kota, 
                    'id_kota' => $this->Kecamatan_model->get_kotaadmin(),
                    'nama_kec' => set_value('nama_kec', $row->nama_kec),
                    );
            }
            $this->load->view('kecamatan/kecamatan_form', $data);
        } else {
            $this->session->set_flashdata('message', ' <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Record Not Found.<br></div>');
            redirect(site_url('kecamatan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kec', TRUE));
        } else {
            $data = array(
        'id_kota' => $this->input->post('id_kota',TRUE),
        'nama_kec' => $this->input->post('nama_kec',TRUE),
        );

            $this->Kecamatan_model->update($this->input->post('id_kec', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><p><strong><i class="ace-icon fa fa-check"></i></strong> Update Record Success.</p></div>');
            redirect(site_url('kecamatan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kecamatan_model->get_by_id($id);

        if ($row) {
            $this->Kecamatan_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><p><strong><i class="ace-icon fa fa-check"></i></strong> Delete Record Success.</p></div>');
            redirect(site_url('kecamatan'));
        } else {
            $this->session->set_flashdata('message', ' <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Record Not Found.<br></div>');
            redirect(site_url('kecamatan'));
        }
    }

    public function reg_namakec($str){
        if (!preg_match("/^[a-zA-Z\s-]*$/", $str)) {
            $this->form_validation->set_message('reg_namakec', 'Only Letters Are Allowed');
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function _rules() 
    {
    $this->form_validation->set_rules('id_kota', 'id kota', 'trim|required');
    $this->form_validation->set_rules('nama_kec', 'nama kec', 'trim|required|is_unique[kecamatan.nama_kec]|callback_reg_namakec');

    $this->form_validation->set_rules('id_kec', 'id_kec', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    // public function excel()
    // {
    //     $this->load->helper('exportexcel');
    //     $tgl = date("Y-m-d");
    //     $namaFile = "Laporan_Data_kecamatan_". $tgl .".xls";
    //     $judul = "kecamatan";
    //     $tablehead = 2;
    //     $tablebody = 3;
    //     $nourut = 1;
        
    //     //penulisan header
    //     header("Pragma: public");
    //     header("Expires: 0");
    //     header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
    //     header("Content-Type: application/force-download");
    //     header("Content-Type: application/octet-stream");
    //     header("Content-Type: application/download");
    //     header("Content-Disposition: attachment;filename=" . $namaFile . "");
    //     header("Content-Transfer-Encoding: binary ");

    //     xlsBOF();

    //     $kolomhead = 2;
    //     xlsWriteLabel(1, 1, "Data Kecamatan");
    //     xlsWriteLabel($tablehead, $kolomhead++, "No");
    // xlsWriteLabel($tablehead, $kolomhead++, "Id Kota");
    // xlsWriteLabel($tablehead, $kolomhead++, "Nama Kec");

    // foreach ($this->Kecamatan_model->get_all() as $data) {
    //         $kolombody = 2;

    //         //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
    //         xlsWriteNumber($tablebody, $kolombody++, $nourut);
    //     xlsWriteNumber($tablebody, $kolombody++, $data->id_kota);
    //     xlsWriteLabel($tablebody, $kolombody++, $data->nama_kec);

    //     $tablebody++;
    //         $nourut++;
    //     }

    //     xlsEOF();
    //     exit();
    // }

}

/* End of file Kecamatan.php */
/* Location: ./application/controllers/Kecamatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-31 14:20:53 */
/* http://harviacode.com */