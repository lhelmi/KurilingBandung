<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fasilitas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged')<>1) {
            $this->session->set_flashdata('message', 'Anda Belum Login, Silahkan Login Terlebih Dahulu');
            redirect(site_url('auth'));
        }
        if ($this->session->userdata('is_admin')==FALSE) {
            $this->session->set_flashdata('message', 'Anda Tidak Memiliki Akses ke Halaman Tersebut');
            redirect(site_url('wisata'));
            
        }
        $this->load->model('Fasilitas_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'fasilitas/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'fasilitas/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'fasilitas/index.html';
            $config['first_url'] = base_url() . 'fasilitas/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Fasilitas_model->total_rows($q);
        $fasilitas = $this->Fasilitas_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'fasilitas_data' => $fasilitas,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('fasilitas/fasilitas_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Fasilitas_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_fasilitas' => $row->id_fasilitas,
		'nama_fasilitas' => $row->nama_fasilitas,
		'harga_fasilitas' => $row->harga_fasilitas,
		'id_wisata' => $row->id_wisata,
	    );
            $this->load->view('fasilitas/fasilitas_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('fasilitas'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('fasilitas/create_action'),
	    'id_fasilitas' => set_value('id_fasilitas'),
	    'nama_fasilitas' => set_value('nama_fasilitas'),
	    'harga_fasilitas' => set_value('harga_fasilitas'),
	    'id_wisata' => set_value('id_wisata'),
	);
        $this->load->view('fasilitas/fasilitas_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array();
            $nama_fasilitas = $this->input->post('nama_fasilitas');
            $harga_fasilitas = $this->input->post('harga_fasilitas');
            for ($i = 0; $i < count($this->input->post('nama_fasilitas')); $i++){
         $data[$i] = array(

        'nama_fasilitas' => $nama_fasilitas[$i],
        'harga_fasilitas' => $harga_fasilitas[$i],
        'id_wisata' => $this->input->post('id_wisata',TRUE),
        );
        }
            $this->Fasilitas_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('fasilitas'));
        
        }
    }
    
    public function update($id) 
    {
        $row = $this->Fasilitas_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('fasilitas/update_action'),
		'id_fasilitas' => set_value('id_fasilitas', $row->id_fasilitas),
		'nama_fasilitas' => set_value('nama_fasilitas', $row->nama_fasilitas),
		'harga_fasilitas' => set_value('harga_fasilitas', $row->harga_fasilitas),
		'id_wisata' => set_value('id_wisata', $row->id_wisata),
	    );
            $this->load->view('fasilitas/fasilitas_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('fasilitas'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_fasilitas', TRUE));
        } else {
            $data = array(
		'nama_fasilitas' => $this->input->post('nama_fasilitas',TRUE),
		'harga_fasilitas' => $this->input->post('harga_fasilitas',TRUE),
		'id_wisata' => $this->input->post('id_wisata',TRUE),
	    );

            $this->Fasilitas_model->update($this->input->post('id_fasilitas', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('fasilitas'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Fasilitas_model->get_by_id($id);

        if ($row) {
            $this->Fasilitas_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('wisata/update/'. $row->id_wisata));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wisata'));
        }
    }

    public function _rules() 
    {
	// $this->form_validation->set_rules('nama_fasilitas', 'nama fasilitas', 'trim|required');
	$this->form_validation->set_rules('harga_fasilitas', 'harga fasilitas', 'trim|required');
	$this->form_validation->set_rules('id_wisata', 'id wisata', 'trim|required');

	$this->form_validation->set_rules('id_fasilitas', 'id_fasilitas', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

 //    public function excel()
 //    {
 //        $this->load->helper('exportexcel');
 //        $namaFile = "fasilitas.xls";
 //        $judul = "fasilitas";
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
	// xlsWriteLabel($tablehead, $kolomhead++, "Nama Fasilitas");
	// xlsWriteLabel($tablehead, $kolomhead++, "Harga Fasilitas");
	// xlsWriteLabel($tablehead, $kolomhead++, "Id Wisata");

	// foreach ($this->Fasilitas_model->get_all() as $data) {
 //            $kolombody = 0;

 //            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
 //            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	//     xlsWriteLabel($tablebody, $kolombody++, $data->nama_fasilitas);
	//     xlsWriteNumber($tablebody, $kolombody++, $data->harga_fasilitas);
	//     xlsWriteNumber($tablebody, $kolombody++, $data->id_wisata);

	//     $tablebody++;
 //            $nourut++;
 //        }

 //        xlsEOF();
 //        exit();
 //    }

}

/* End of file Fasilitas.php */
/* Location: ./application/controllers/Fasilitas.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-06-12 00:02:23 */
/* http://harviacode.com */