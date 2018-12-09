<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gambar extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Gambar_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'gambar/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'gambar/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'gambar/index.html';
            $config['first_url'] = base_url() . 'gambar/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Gambar_model->total_rows($q);
        $gambar = $this->Gambar_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'gambar_data' => $gambar,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('gambar/gambar_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Gambar_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_gambar' => $row->id_gambar,
		'nama_gambar' => $row->nama_gambar,
		'id_wisata' => $row->id_wisata,
		'is_delete' => $row->is_delete,
	    );
            $this->load->view('gambar/gambar_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gambar'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('gambar/create_action'),
	    'id_gambar' => set_value('id_gambar'),
	    'nama_gambar' => set_value('nama_gambar'),
	    'id_wisata' => set_value('id_wisata'),
	    'is_delete' => set_value('is_delete'),
	);
        $this->load->view('gambar/gambar_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_gambar' => $this->input->post('nama_gambar',TRUE),
		'id_wisata' => $this->input->post('id_wisata',TRUE),
		'is_delete' => $this->input->post('is_delete',TRUE),
	    );

            $this->Gambar_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('gambar'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Gambar_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('gambar/update_action'),
		'id_gambar' => set_value('id_gambar', $row->id_gambar),
		'nama_gambar' => set_value('nama_gambar', $row->nama_gambar),
		'id_wisata' => set_value('id_wisata', $row->id_wisata),
		'is_delete' => set_value('is_delete', $row->is_delete),
	    );
            $this->load->view('gambar/gambar_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gambar'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_gambar', TRUE));
        } else {
            $data = array(
		'nama_gambar' => $this->input->post('nama_gambar',TRUE),
		'id_wisata' => $this->input->post('id_wisata',TRUE),
		'is_delete' => $this->input->post('is_delete',TRUE),
	    );

            $this->Gambar_model->update($this->input->post('id_gambar', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('gambar'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Gambar_model->get_by_id($id);

        if ($row) {
            $this->Gambar_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('wisata/update/'. $row->id_wisata));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wisata'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_gambar', 'nama gambar', 'trim|required');
	$this->form_validation->set_rules('id_wisata', 'id wisata', 'trim|required');
	$this->form_validation->set_rules('is_delete', 'is delete', 'trim|required');

	$this->form_validation->set_rules('id_gambar', 'id_gambar', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

 //    public function excel()
 //    {
 //        $this->load->helper('exportexcel');
 //        $namaFile = "gambar.xls";
 //        $judul = "gambar";
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
	// xlsWriteLabel($tablehead, $kolomhead++, "Nama Gambar");
	// xlsWriteLabel($tablehead, $kolomhead++, "Id Wisata");
	// xlsWriteLabel($tablehead, $kolomhead++, "Is Delete");

	// foreach ($this->Gambar_model->get_all() as $data) {
 //            $kolombody = 0;

 //            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
 //            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	//     xlsWriteLabel($tablebody, $kolombody++, $data->nama_gambar);
	//     xlsWriteNumber($tablebody, $kolombody++, $data->id_wisata);
	//     xlsWriteLabel($tablebody, $kolombody++, $data->is_delete);

	//     $tablebody++;
 //            $nourut++;
 //        }

 //        xlsEOF();
 //        exit();
 //    }

}

/* End of file Gambar.php */
/* Location: ./application/controllers/Gambar.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-07-07 12:39:13 */
/* http://harviacode.com */