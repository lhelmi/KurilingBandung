<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wisata extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged')<>1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Anda Belum Login, Silahkan Login Terlebih Dahulu.<br></div>');
            redirect(site_url('Kurilingbandung/login'));
        }
        $this->load->library('PHPExcel');
        $this->load->library('PHPExcel/IOFactory');

        $this->load->helper('file');
        $this->load->model('Wisata_model');
        $this->load->model('Fasilitas_model');
        $this->load->model('Gambar_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('level')=='1') {
            $data = array(
                'wisata_data' => $this->Wisata_model->get_all_admin(),
            );
        }elseif ($this->session->userdata('level')=='0') {
            $data = array(
                'wisata_data' => $this->Wisata_model->get_all(),
            );
        }elseif ($this->session->userdata('is_admin')==FALSE) {
            $data = array(
                'wisata_data' => $this->Wisata_model->get_all_owner(),
            );
            
        }

        $this->load->view('wisata/wisata_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Wisata_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_wisata' => $row->id_wisata,
		'nama_wisata' => $row->nama_wisata,
		'id_kota' => $row->nama_kota,
		'id_kec' => $row->nama_kec,
		'id_kel' => $row->nama_kel,
		'lat' => $row->lat,
		'lng' => $row->lng,
		'alamat_wisata' => $row->alamat_wisata,
		'tiket_dewasa' => $row->tiket_dewasa,
		'tiket_anak' => $row->tiket_anak,
		'NIK' => $row->NIK,
        'gambar' => $this->Wisata_model->get_gambar(),
        'fasilitas' => $this->Wisata_model->get_fasilitas(),
	    );
            $this->load->view('wisata/wisata_read', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Record Not Found.<br></div>');
            redirect(site_url('wisata'));
        }
    }

    public function create($error = null) 
    {
        if ($this->session->userdata('is_admin')!==FALSE) {
            if ($this->session->userdata('level')==0) {
                $data = array(
                'button' => 'Create',
                'action' => site_url('wisata/create_action'),
                'id_wisata' => $this->Wisata_model->get_kode(),
                'nama_wisata' => set_value('nama_wisata'),
                'lat' => set_value('lat'),
                'lng' => set_value('lng'),
                'alamat_wisata' => set_value('alamat_wisata'),
                'deskripsi' => set_value('deskripsi'),
                'tiket_dewasa' => set_value('tiket_dewasa'),
                'tiket_anak' => set_value('tiket_anak'),
                'gNIK' => set_value('NIK'),
                'gambar' => $this->Wisata_model->get_gambar(),
                'fasilitas' => $this->Wisata_model->get_fasilitas(),
                'gid_kota' => '',
                'gid_kec' => '',
                'gid_kel' => '',
                'id_kota' => $this->Wisata_model->get_kota(),
                'id_kec' => $this->Wisata_model->get_kec(),
                'id_kel' => $this->Wisata_model->get_kel(),
                'NIK' => $this->Wisata_model->get_NIK(),
                'error' => $error['error']
                );
            }elseif ($this->session->userdata('level')==1) {
                $data = array(
                'button' => 'Create',
                'action' => site_url('wisata/create_action'),
                'id_wisata' => $this->Wisata_model->get_kode(),
                'nama_wisata' => set_value('nama_wisata'),
                'lat' => set_value('lat'),
                'lng' => set_value('lng'),
                'alamat_wisata' => set_value('alamat_wisata'),
                'deskripsi' => set_value('deskripsi'),
                'tiket_dewasa' => set_value('tiket_dewasa'),
                'tiket_anak' => set_value('tiket_anak'),
                'gNIK' => set_value('NIK'),
                'gambar' => $this->Wisata_model->get_gambar(),
                'fasilitas' => $this->Wisata_model->get_fasilitas(),
                'gid_kota' => '',
                'gid_kec' => '',
                'gid_kel' => '',
                'id_kota' => $this->Wisata_model->get_kotaadmin(),
                'id_kec' => $this->Wisata_model->get_kec(),
                'id_kel' => $this->Wisata_model->get_kel(),
                'NIK' => $this->Wisata_model->get_NIK(),
                'error' => $error['error']
                );
            }
        }elseif ($this->session->userdata('is_admin')==FALSE) {
        
            $data = array(
            'button' => 'Create',
            'action' => site_url('wisata/create_action'),
            'id_wisata' => $this->Wisata_model->get_kode(),
            'nama_wisata' => set_value('nama_wisata'),
            'lat' => set_value('lat'),
            'lng' => set_value('lng'),
            'alamat_wisata' => set_value('alamat_wisata'),
            'deskripsi' => set_value('deskripsi'),
            'tiket_dewasa' => set_value('tiket_dewasa'),
            'tiket_anak' => set_value('tiket_anak'),
            'gNIK' => set_value('NIK'),
            'gid_kota' => '',
            'gid_kec' => '',
            'gid_kel' => '',
            'gambar' => $this->Wisata_model->get_gambar(),
            'fasilitas' => $this->Wisata_model->get_fasilitas(),
            'id_kota' => $this->Wisata_model->get_kota(),
            'id_kec' => $this->Wisata_model->get_kec(),
            'id_kel' => $this->Wisata_model->get_kel(),
            'error' => $error['error']
            );        }
        
	   $this->load->view('wisata/wisata_form', $data);
    }

    public function create_action() 
    {
        
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $config = array();
            $config['upload_path']    ='./upload/wisata/'; 
            $config['allowed_types'] = 'gif|jpg|png';
            // $config['max_size']      = '0';
            $config['overwrite']     = TRUE;

            $this->load->library('upload');

            $gambar = array();

            $files = $_FILES;
            $postx = $this->input->post();
            $nama_gambar = $this->input->post('nama_gambar');
            if (count($_FILES['nama_gambar']['name'])<3) {
                $error = array('error' => '<span class="text-danger">Upload Foto Wisata Minimal 3</span>');
                $this->create($error);
            }else{
                for($i=0; $i< count($_FILES['nama_gambar']['name']); $i++)
                {           

                    $_FILES['userfile']['name']= $files['nama_gambar']['name'][$i];
                    $_FILES['userfile']['type']= $files['nama_gambar']['type'][$i];
                    $_FILES['userfile']['tmp_name']= $files['nama_gambar']['tmp_name'][$i];
                    $_FILES['userfile']['error']= $files['nama_gambar']['error'][$i];
                    $_FILES['userfile']['size']= $files['nama_gambar']['size'][$i];
                    
                    $image = explode(".", $_FILES['userfile']['name']);
                    $rename = $this->input->post('id_wisata',TRUE) . $i . '.' . end($image);
                    
                    //$rename = $this->input->post('id_wisata',TRUE) . ;
                    $config['file_name']    = $rename;
                    $this->upload->initialize($config);
                    $this->upload->do_upload();
                    
                    $fileData = $this->upload->data();
                    $gambar[$i]['nama_gambar'] = $fileData['file_name'];
                    $gambar[$i]['id_wisata'] = $this->input->post('id_wisata',TRUE);
                    
                }

            if(!$this->upload->do_upload('userfile')){ //berfungsi untuk melakukan fungsi upload
                $error = array('error' => $this->upload->display_errors());
                $this->create($error);
            }else{
                $data = array(
                'id_wisata' => $this->input->post('id_wisata',TRUE),
                'nama_wisata' => $this->input->post('nama_wisata',TRUE),
                'id_kota' => $this->input->post('id_kota',TRUE),
                'id_kec' => $this->input->post('id_kec',TRUE),
                'id_kel' => $this->input->post('id_kel',TRUE),
                'lat' => $this->input->post('lat',TRUE),
                'lng' => $this->input->post('lng',TRUE),
                'alamat_wisata' => $this->input->post('alamat_wisata',TRUE),
                'deskripsi' => $this->input->post('deskripsi',TRUE),
                'tiket_dewasa' => $this->input->post('tiket_dewasa',TRUE),
                'tiket_anak' => $this->input->post('tiket_anak',TRUE),
                'NIK' => set_value('NIK'),
                );
                
                $fasilitas = array();
                $total_post = count($postx['nama_fasilitas']);
                
                foreach($postx['nama_fasilitas'] AS $key => $val){
                    $fasilitas[] = array(
                        "nama_fasilitas" => $postx['nama_fasilitas'][$key],
                        "id_wisata" => $postx['id_wisata'],
                        "harga_fasilitas" => $postx['harga_fasilitas'][$key]
                    );
                }
                
                $this->Wisata_model->insert($data);
                $this->Gambar_model->insert($gambar);
                $this->Fasilitas_model->insert($fasilitas);
                $this->session->set_flashdata('message', '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><p><strong><i class="ace-icon fa fa-check"></i></strong> Create Record Success.</p></div>');
                redirect(site_url('wisata'));
            }
        }
        }
    }
    
    public function update($id, $error = null) 
    {
        $row = $this->Wisata_model->get_by_id($id);

        $selected = $this->Wisata_model->get_selected_by_id_kel($row->id_kel);
        if ($row) {
            if ($this->session->userdata('is_admin')!==FALSE) {
                if ($this->session->userdata('level')==0) {
                    $data = array(
                        'button' => 'Update',
                        'action' => site_url('wisata/update_action'),
                		'id_wisata' => set_value('id_wisata', $row->id_wisata),
                		'nama_wisata' => set_value('nama_wisata', $row->nama_wisata),
                		'lat' => set_value('lat', $row->lat),
                		'lng' => set_value('lng', $row->lng),
                		'alamat_wisata' => set_value('alamat_wisata', $row->alamat_wisata),
                        'deskripsi' => set_value('deskripsi', $row->deskripsi),
                		'tiket_dewasa' => set_value('tiket_dewasa', $row->tiket_dewasa),
                		'tiket_anak' => set_value('tiket_anak', $row->tiket_anak),
                        'fasilitas' => $this->Wisata_model->get_fasilitas(),
                        'gambar' => $this->Wisata_model->get_gambar(),
                		'gNIK' => set_value('NIK', $row->NIK),
                        //'gambardb' => $this->Wisata_model->get_gambardb($row->id_wisata),
                        'id_kota' => $this->Wisata_model->get_kota(),
                        'id_kec' => $this->Wisata_model->get_kec(),
                        'id_kel' => $this->Wisata_model->get_kel(),
                        'gid_kota' => $selected->id_kota, 
                        'gid_kec' => $selected->id_kec,
                        'gid_kel' => $selected->id_kel,
                        'NIK' => $this->Wisata_model->get_NIK(), $row->NIK,
                        'error' => $error['error']
                	    );
                }elseif ($this->session->userdata('level')==1) {
                        $data = array(
                        'button' => 'Update',
                        'action' => site_url('wisata/update_action'),
                        'id_wisata' => set_value('id_wisata', $row->id_wisata),
                        'nama_wisata' => set_value('nama_wisata', $row->nama_wisata),
                       
                        'lat' => set_value('lat', $row->lat),
                        'lng' => set_value('lng', $row->lng),
                        'alamat_wisata' => set_value('alamat_wisata', $row->alamat_wisata),
                        'deskripsi' => set_value('deskripsi', $row->deskripsi),
                        'tiket_dewasa' => set_value('tiket_dewasa', $row->tiket_dewasa),
                        'tiket_anak' => set_value('tiket_anak', $row->tiket_anak),
                        'fasilitas' => $this->Wisata_model->get_fasilitas(),
                        'gambar' => $this->Wisata_model->get_gambar(),
                        'gNIK' => set_value('NIK', $row->NIK),
                        'id_kota' => $this->Wisata_model->get_kota(),
                        'id_kec' => $this->Wisata_model->get_kec(),
                        'id_kel' => $this->Wisata_model->get_kel(),
                        'gid_kota' => $selected->id_kota, 
                        'gid_kec' => $selected->id_kec,
                        'gid_kel' => $selected->id_kel,
                        'NIK' => $this->Wisata_model->get_NIK(), $row->NIK,
                        'error' => $error['error']
                        );
                }
                
            }elseif ($this->session->userdata('is_admin')==false) {
                $data = array(
                'button' => 'Update',
                'action' => site_url('wisata/update_action'),
                'id_wisata' => set_value('id_wisata', $row->id_wisata),
                'nama_wisata' => set_value('nama_wisata', $row->nama_wisata),
                
                'lat' => set_value('lat', $row->lat),
                'lng' => set_value('lng', $row->lng),
                'alamat_wisata' => set_value('alamat_wisata', $row->alamat_wisata),
                'deskripsi' => set_value('deskripsi', $row->deskripsi),
                'tiket_dewasa' => set_value('tiket_dewasa', $row->tiket_dewasa),
                'tiket_anak' => set_value('tiket_anak', $row->tiket_anak),
                'fasilitas' => $this->Wisata_model->get_fasilitas(),
                'gambar' => $this->Wisata_model->get_gambar(),
                'gNIK' => set_value('NIK', $row->NIK),
                //'gambardb' => $this->Wisata_model->get_gambardb($row->id_wisata),
                'id_kota' => $this->Wisata_model->get_kota(),
                'id_kec' => $this->Wisata_model->get_kec(),
                'id_kel' => $this->Wisata_model->get_kel(),
                'gid_kota' => $selected->id_kota, 
                'gid_kec' => $selected->id_kec,
                'gid_kel' => $selected->id_kel,
                'NIK' => $this->Wisata_model->get_NIK(), $row->NIK,
                'error' => $error['error']
                );

            }
            $this->load->view('wisata/wisata_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Record Not Found.<br></div>');
            redirect(site_url('wisata'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_wisata', TRUE));
        } else {
            $post = $this->input->post();
            $config = array();
            $config['upload_path']    ='./upload/wisata/'; 
            $config['allowed_types'] = 'gif|jpg|png';
            $config['overwrite']     = TRUE;
            $this->load->library('upload');
            $gambar = array();
            $files = $_FILES;
            $nama_gambar = $this->input->post('nama_gambar');
            
            
            $xxxoo = $this->Wisata_model->get_gambardb($this->input->post('id_wisata',TRUE));
            $yy = count($xxxoo);
            for($i=0; $i< count($_FILES['nama_gambar']['name']); $i++){
                $xooii = $yy + $i;
                $_FILES['userfile']['name']= $files['nama_gambar']['name'][$i];
                $_FILES['userfile']['type']= $files['nama_gambar']['type'][$i];
                $_FILES['userfile']['tmp_name']= $files['nama_gambar']['tmp_name'][$i];
                $_FILES['userfile']['error']= $files['nama_gambar']['error'][$i];
                $_FILES['userfile']['size']= $files['nama_gambar']['size'][$i];
                $image = explode(".", $_FILES['userfile']['name']);
                $rename = $this->input->post('id_wisata',TRUE) . $xooii . '.' . end($image);
                $config['file_name']    = $rename;
                $this->upload->initialize($config);
                $this->upload->do_upload();
                
                $fileData = $this->upload->data();
                $gambar[$i]['nama_gambar'] = $fileData['file_name'];
                $gambar[$i]['id_wisata'] = $this->input->post('id_wisata',TRUE);
            }
            if(!$this->upload->do_upload('userfile')){ //berfungsi untuk melakukan fungsi upload
                $error = array('error' => $this->upload->display_errors());
                $this->update($this->input->post('id_wisata', TRUE), $error);
            }else{
                $this->Gambar_model->insert($gambar);
            }

            $fasilitasubah = array();
            foreach($post['nama_fasilitas1'] AS $key => $val){
                $fasilitasubah[] = array(
                    "id_fasilitas" => $post['id_fasilitas1'][$key],
                    "nama_fasilitas" => $post['nama_fasilitas1'][$key],
                    "harga_fasilitas" => $post['harga_fasilitas1'][$key]
                );
            }
            $this->Fasilitas_model->update($fasilitasubah, 'id_fasilitas');

            

            $fasilitas = array();
            foreach($post['nama_fasilitas'] AS $key => $val){
                $fasilitas[] = array(
                    "nama_fasilitas" => $post['nama_fasilitas'][$key],
                    "id_wisata" => $post['id_wisata'],
                    "harga_fasilitas" => $post['harga_fasilitas'][$key]
                );
                if ($post['nama_fasilitas'][$key] !== '' && $post['harga_fasilitas'][$key] !== '') {
                    $this->Fasilitas_model->insert($fasilitas);
                }
                    
            }

            if (!empty($_FILES['nama_gambar1']['name'])) {
                $config1 = array();
                $config1['upload_path']    ='./upload/wisata/'; 
                $config1['allowed_types'] = 'gif|jpg|png';
                $config1['overwrite']     = TRUE;
                $this->load->library('upload');
                $gambar1 = array();
                $files = $_FILES;
                $nama_gambar1 = $this->input->post('nama_gambar1');
                $post = $this->input->post();
                
                $xxxoo = $this->Wisata_model->get_gambardb($this->input->post('id_wisata',TRUE));
                $yy = count($xxxoo);
                for($i=0; $i< count($_FILES['nama_gambar1']['name']); $i++){
                    $xooii = $yy + $i;
                    $_FILES['userfile']['name']= $files['nama_gambar1']['name'][$i];
                    $_FILES['userfile']['type']= $files['nama_gambar1']['type'][$i];
                    $_FILES['userfile']['tmp_name']= $files['nama_gambar1']['tmp_name'][$i];
                    $_FILES['userfile']['error']= $files['nama_gambar1']['error'][$i];
                    $_FILES['userfile']['size']= $files['nama_gambar1']['size'][$i];
                    
                    $image = explode(".", $_FILES['userfile']['name']);
                    $rename1 = $this->input->post('id_wisata',TRUE) . $i . '.' . end($image);
                    
                    $config1['file_name']    = $rename1;
                    $this->upload->initialize($config1);
                    $this->upload->do_upload();
                    
                    $fileData = $this->upload->data();
                    $gambar1[$i]['id_gambar'] = $post['id_gambar1'][$i];
                    $gambar1[$i]['nama_gambar'] = $fileData['file_name'];
                    //$gambar[$i]['id_wisata'] = $this->input->post('id_wisata',TRUE);
                }
                if(!$this->upload->do_upload('userfile')){ //berfungsi untuk melakukan fungsi upload
                    $error = array('error' => $this->upload->display_errors());
                    $this->update($this->input->post('id_wisata', TRUE), $error);
                }else{
                    $this->Gambar_model->update($gambar1, 'id_gambar');
                }
            }


            $data = array(
            'nama_wisata' => $this->input->post('nama_wisata',TRUE),
            'id_kota' => $this->input->post('id_kota',TRUE),
            'id_kec' => $this->input->post('id_kec',TRUE),
            'id_kel' => $this->input->post('id_kel',TRUE),
            'lat' => $this->input->post('lat',TRUE),
            'lng' => $this->input->post('lng',TRUE),
            'alamat_wisata' => $this->input->post('alamat_wisata',TRUE),
            'deskripsi' => $this->input->post('deskripsi',TRUE),
            'tiket_dewasa' => $this->input->post('tiket_dewasa',TRUE),
            'tiket_anak' => $this->input->post('tiket_anak',TRUE),
            'NIK' => $this->input->post('NIK',TRUE),
            );
            
            
            $this->Wisata_model->update($this->input->post('id_wisata', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><p><strong><i class="ace-icon fa fa-check"></i></strong> Update Record Success.</p></div>');
            redirect(site_url('wisata'));                                
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Wisata_model->get_by_id($id);

        if ($row) {
            $this->Wisata_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><p><strong><i class="ace-icon fa fa-check"></i></strong> Delete Record Success.</p></div>');
            redirect(site_url('wisata'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Record Not Found.<br></div>');
            redirect(site_url('wisata'));
        }
    }

    

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_wisata', 'nama wisata', 'trim|required');
	$this->form_validation->set_rules('id_kota', 'id kota', 'trim|required');
	$this->form_validation->set_rules('id_kec', 'id kec', 'trim|required');
	$this->form_validation->set_rules('id_kel', 'id kel', 'trim|required');
	$this->form_validation->set_rules('lat', 'lat', 'trim|required');
	$this->form_validation->set_rules('lng', 'lng', 'trim|required');
	$this->form_validation->set_rules('alamat_wisata', 'alamat wisata', 'trim|required');
	$this->form_validation->set_rules('tiket_dewasa', 'tiket dewasa', 'trim|required');
	$this->form_validation->set_rules('tiket_anak', 'tiket anak', 'trim|required');
    $this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
    
	$this->form_validation->set_rules('NIK', 'nik', 'trim|required');

    

	$this->form_validation->set_rules('id_wisata', 'id_wisata', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {   
        

        if ($this->session->userdata('level')=='0') {
            $query = $this->Wisata_model->eksport_data();
        }elseif ($this->session->userdata('level')=='1') {
            $query = $this->Wisata_model->eksport_dataadmin();
        }
        
        // Buat sebuah file Excel baru.
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("Laporan Data Wisata Kuriling Bandung");
        $objPHPExcel->getProperties()->setDescription("Berisi data model Wisata (Nama Wisata, Alamat, Kota, Kecamatan, Kelurahan, latitude, longitude, Harga Tiket Dewasa dan Anak, NIK)");
        $objPHPExcel->setActiveSheetIndex(0);

        // Header laporan
        $objPHPExcel->getActiveSheet()->setCellValue('A1','Laporan Data Wisata Kuriling Bandung');
        $objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        // Tanggal laporan
        $today = date("d-m-Y");
        $objPHPExcel->getActiveSheet()->setCellValue('C3','Tanggal: '.$today);
        $objPHPExcel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);

        // Header tabel produk
        
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(35);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);

        $objPHPExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(15);

        
        $objPHPExcel->getActiveSheet()->setCellValue('B5','ID Wisata');
        $objPHPExcel->getActiveSheet()->setCellValue('C5','Nama');
        $objPHPExcel->getActiveSheet()->setCellValue('D5','Deskripsi');
        $objPHPExcel->getActiveSheet()->setCellValue('E5','Tanggal Daftar');
        $objPHPExcel->getActiveSheet()->setCellValue('F5','Kota');
        $objPHPExcel->getActiveSheet()->setCellValue('G5','Kecamatan');
        $objPHPExcel->getActiveSheet()->setCellValue('H5','Kelurahan');
        $objPHPExcel->getActiveSheet()->setCellValue('I5','Latitude');
        $objPHPExcel->getActiveSheet()->setCellValue('J5','Longitude');
        $objPHPExcel->getActiveSheet()->setCellValue('K5','Alamat');
        $objPHPExcel->getActiveSheet()->setCellValue('L5','Tiket Dewasa');
        $objPHPExcel->getActiveSheet()->setCellValue('M5','Tiket Anak');
        $objPHPExcel->getActiveSheet()->setCellValue('N5','NIK');

        $objPHPExcel->getActiveSheet()->getStyle('B5:N5')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B5:N5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        // Border header tabel
        $styleArray = array(
                'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb'=>'E1E0F7'),
                    ),
                'borders' => array(
                    'outline' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                    ),
                ),
                );
                
                $objPHPExcel->getActiveSheet()->getStyle('B5')->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('C5')->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('D5')->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('E5')->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('F5')->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('G5')->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('H5')->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('I5')->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('J5')->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('K5')->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('L5')->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('M5')->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('N5')->applyFromArray($styleArray);


        // Isi tabel
        // $row = 6;
        // foreach ($query as $value) {
        //     setCellValue($, 'Hello');
        // }
        $fields = $query->list_fields();
        $row = 6;
        foreach($query->result() as $data)
        {
            $col = 1;
            foreach ($fields as $field)
            {

                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                                $objPHPExcel->getActiveSheet()->getStyle("B".($row).":N".($row))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);              
                        $col++;
            }
            $row++;
        }



        // Menuliskan skrip pada file yang telah dibuat.
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');

        // Mendefinisikan header dan melakukan unggah secara otomatis.
        $filename='Laporan_Wisata'.$today.'.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        
        $objWriter->save('php://output');
    }

}


// $data4= array(
// 'nama_fasilitas' => set_value('nama_fasilitas1[]'),
// 'harga_fasilitas' => set_value('harga_fasilitas1[]'),
// 'id_wisata' => $this->Wisata_model->get_kode(),
// );
// $data2= array(
// 'nama_fasilitas' => set_value('nama_fasilitas[]'),
// 'harga_fasilitas' => set_value('harga_fasilitas[]'),
// 'id_wisata' => $this->Wisata_model->get_kode(),
// );
// $data3 = array(
// 'nama_gambar' => set_value('nama_gambar[]'),
// 'id_wisata' => $this->Wisata_model->get_kode(),
// );
// $data5 = array(
// 'nama_gambar' => set_value('nama_gambar1[]'),
// 'id_wisata' => $this->Wisata_model->get_kode(),
// );