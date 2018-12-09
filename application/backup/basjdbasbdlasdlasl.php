<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wisata extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged')<>1) {
            $this->session->set_flashdata('message', 'Anda Belum Login, Silahkan Login Terlebih Dahulu');
            redirect(site_url('auth'));
        }
        $this->load->helper('file');
        $this->load->model('Wisata_model');
        $this->load->model('Kecamatan_model');
        $this->load->model('Kelurahan_model');
        $this->load->model('Fasilitas_model');
        $this->load->model('Gambar_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'wisata/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'wisata/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'wisata/index.html';
            $config['first_url'] = base_url() . 'wisata/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        if ($this->session->userdata('is_admin')!==FALSE) {
            $config['total_rows'] = $this->Wisata_model->total_rows($q);
            $wisata = $this->Wisata_model->get_limit_data($config['per_page'], $start, $q);
        }else{
            $config['total_rows'] = $this->Wisata_model->total_rowsown($q);
            $wisata = $this->Wisata_model->get_limit_dataown($config['per_page'], $start, $q);
        }
        

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'wisata_data' => $wisata,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('wisata/wisata_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Wisata_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_wisata' => $row->id_wisata,
		'nama_wisata' => $row->nama_wisata,
		'id_kota' => $row->id_kota,
		'id_kec' => $row->id_kec,
		'id_kel' => $row->id_kel,
		'lat' => $row->lat,
		'lng' => $row->lng,
		'alamat_wisata' => $row->alamat_wisata,
		'tiket_dewasa' => $row->tiket_dewasa,
		'tiket_anak' => $row->tiket_anak,
		'NIK' => $row->NIK,
	    );
            $this->load->view('wisata/wisata_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
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
                'gid_kota' => set_value('id_kota'),
                'gid_kec' => set_value('id_kec'),
                'gid_kel' => set_value('id_kel'),
                'lat' => set_value('lat'),
                'lng' => set_value('lng'),
                'alamat_wisata' => set_value('alamat_wisata'),
                'tiket_dewasa' => set_value('tiket_dewasa'),
                'tiket_anak' => set_value('tiket_anak'),
                'gNIK' => set_value('NIK'),
                'gambar' => $this->Wisata_model->get_gambar(),
                'fasilitas' => $this->Wisata_model->get_fasilitas(),
                'id_kota' => $this->Kecamatan_model->get_id_kotaow(),
                'id_kec' => $this->Kelurahan_model->get_id_kecow(),
                'id_kel' => $this->Wisata_model->get_id_kelow(),
                'NIK' => $this->Wisata_model->get_NIK(),
                'error' => $error['error']
                );
            }elseif ($this->session->userdata('level')==1) {
                $data = array(
                'button' => 'Create',
                'action' => site_url('wisata/create_action'),
                'id_wisata' => $this->Wisata_model->get_kode(),
                'nama_wisata' => set_value('nama_wisata'),
                'gid_kota' => set_value('id_kota'),
                'gid_kec' => set_value('id_kec'),
                'gid_kel' => set_value('id_kel'),
                'lat' => set_value('lat'),
                'lng' => set_value('lng'),
                'alamat_wisata' => set_value('alamat_wisata'),
                'tiket_dewasa' => set_value('tiket_dewasa'),
                'tiket_anak' => set_value('tiket_anak'),
                'gNIK' => set_value('NIK'),
                'gambar' => $this->Wisata_model->get_gambar(),
                'fasilitas' => $this->Wisata_model->get_fasilitas(),
                'id_kota' => $this->Kecamatan_model->get_id_kota(),
                'id_kec' => $this->Kelurahan_model->get_id_kec(),
                'id_kel' => $this->Wisata_model->get_id_kel(),
                'NIK' => $this->Wisata_model->get_NIK(),
                'error' => $error['error']
                );
            }
            
        $data2= array(
            'nama_fasilitas' => set_value('nama_fasilitas[]'),
            'harga_fasilitas' => set_value('harga_fasilitas[]'),
            'id_wisata' => $this->Wisata_model->get_kode(),
        );
        $data3 = array(
            'nama_gambar' => set_value('nama_gambar[]'),
            'id_wisata' => $this->Wisata_model->get_kode(),
        );
        }elseif ($this->session->userdata('is_admin')==FALSE) {
        
            $data = array(
            'button' => 'Create',
            'action' => site_url('wisata/create_action'),
            'id_wisata' => $this->Wisata_model->get_kode(),
            'nama_wisata' => set_value('nama_wisata'),
            'gid_kota' => set_value('id_kota'),
            'gid_kec' => set_value('id_kec'),
            'gid_kel' => set_value('id_kel'),
            'lat' => set_value('lat'),
            'lng' => set_value('lng'),
            'alamat_wisata' => set_value('alamat_wisata'),
            'tiket_dewasa' => set_value('tiket_dewasa'),
            'tiket_anak' => set_value('tiket_anak'),
            'gNIK' => set_value('NIK'),
            'gambar' => $this->Wisata_model->get_gambar(),
            'fasilitas' => $this->Wisata_model->get_fasilitas(),
            'id_kota' => $this->Kecamatan_model->get_id_kota(),
            'id_kec' => $this->Kelurahan_model->get_id_kec(),
            );
        }
        
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
                'tiket_dewasa' => $this->input->post('tiket_dewasa',TRUE),
                'tiket_anak' => $this->input->post('tiket_anak',TRUE),
                'NIK' => set_value('NIK'),
                );
                $post = $this->input->post();
                $fasilitas = array();
                $total_post = count($post['nama_fasilitas']);
         
                foreach($post['nama_fasilitas'] AS $key => $val){
                    $fasilitas[] = array(
                        "nama_fasilitas" => $post['nama_fasilitas'][$key],
                        "id_wisata" => $post['id_wisata'],
                        "harga_fasilitas" => $post['harga_fasilitas'][$key]
                    );
                }
                
                $this->Gambar_model->insert($gambar);
                $this->Fasilitas_model->insert($fasilitas);
                $this->Wisata_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('wisata'));
            }
        }
    }
    
    public function update($id, $error = null) 
    {
        $row = $this->Wisata_model->get_by_id($id);

        if ($row) {
            if ($this->session->userdata('is_admin')!==FALSE) {
                if ($this->session->userdata('level')==0) {
                    $data = array(
                        'button' => 'Update',
                        'action' => site_url('wisata/update_action'),
                		'id_wisata' => set_value('id_wisata', $row->id_wisata),
                		'nama_wisata' => set_value('nama_wisata', $row->nama_wisata),
                		'gid_kota' => set_value('id_kota', $row->id_kota),
                		'gid_kec' => set_value('id_kec', $row->id_kec),
                		'gid_kel' => set_value('id_kel', $row->id_kel),
                		'lat' => set_value('lat', $row->lat),
                		'lng' => set_value('lng', $row->lng),
                		'alamat_wisata' => set_value('alamat_wisata', $row->alamat_wisata),
                		'tiket_dewasa' => set_value('tiket_dewasa', $row->tiket_dewasa),
                		'tiket_anak' => set_value('tiket_anak', $row->tiket_anak),
                        'fasilitas' => $this->Wisata_model->get_fasilitas(),
                        'gambar' => $this->Wisata_model->get_gambar(),
                		'gNIK' => set_value('NIK', $row->NIK),
                        //'gambardb' => $this->Wisata_model->get_gambardb($row->id_wisata),
                        'id_kota' => $this->Kecamatan_model->get_id_kotaow(), $row->id_kota,
                        'id_kec' => $this->Kelurahan_model->get_id_kecow(), $row->id_kec,
                        'id_kel' => $this->Wisata_model->get_id_kelow(), $row->id_kel,
                        'NIK' => $this->Wisata_model->get_NIK(), $row->NIK,
                        'error' => $error['error']
                	    );
                }elseif ($this->session->userdata('level')==1) {
                        $data = array(
                        'button' => 'Update',
                        'action' => site_url('wisata/update_action'),
                        'id_wisata' => set_value('id_wisata', $row->id_wisata),
                        'nama_wisata' => set_value('nama_wisata', $row->nama_wisata),
                        'gid_kota' => set_value('id_kota', $row->id_kota),
                        'gid_kec' => set_value('id_kec', $row->id_kec),
                        'gid_kel' => set_value('id_kel', $row->id_kel),
                        'lat' => set_value('lat', $row->lat),
                        'lng' => set_value('lng', $row->lng),
                        'alamat_wisata' => set_value('alamat_wisata', $row->alamat_wisata),
                        'tiket_dewasa' => set_value('tiket_dewasa', $row->tiket_dewasa),
                        'tiket_anak' => set_value('tiket_anak', $row->tiket_anak),
                        'fasilitas' => $this->Wisata_model->get_fasilitas(),
                        'gambar' => $this->Wisata_model->get_gambar(),
                        'gNIK' => set_value('NIK', $row->NIK),
                        'id_kota' => $this->Kecamatan_model->get_id_kota(), $row->id_kota,
                        'id_kec' => $this->Kelurahan_model->get_id_kec(), $row->id_kec,
                        'id_kel' => $this->Wisata_model->get_id_kel(), $row->id_kel,
                        'NIK' => $this->Wisata_model->get_NIK(), $row->NIK,
                        'error' => $error['error']
                        );
                }
                $data4= array(
                    'nama_fasilitas' => set_value('nama_fasilitas1[]'),
                    'harga_fasilitas' => set_value('harga_fasilitas1[]'),
                    'id_wisata' => $this->Wisata_model->get_kode(),
                );
                $data2= array(
                    'nama_fasilitas' => set_value('nama_fasilitas[]'),
                    'harga_fasilitas' => set_value('harga_fasilitas[]'),
                    'id_wisata' => $this->Wisata_model->get_kode(),
                );
                $data3 = array(
                    'nama_gambar' => set_value('nama_gambar[]'),
                    'id_wisata' => $this->Wisata_model->get_kode(),
                );
                $data5 = array(
                    'nama_gambar' => set_value('nama_gambar1[]'),
                    'id_wisata' => $this->Wisata_model->get_kode(),
                );
                
            }
            $this->load->view('wisata/wisata_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
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

            $get_fasilitas1 = $this->Wisata_model->get_fasilitasdb($this->input->post('id_wisata', TRUE));
            $fasilitasubah = array();
            // for ($z=0; $z < count($post['nama_fasilitas1']); $z++) { 
                foreach ($get_fasilitas1 as $key => $value) {
                    if ($value->id_wisata==$this->input->post('id_wisata', TRUE)){
                        if ($post['nama_fasilitas1'][$key]!=='') {
                            $this->update($this->input->post('id_wisata', TRUE));    
                            if ($value->nama_fasilitas !== $post['nama_fasilitas1'][$key]) {
                                $fasilitasubah[] = array(
                                    "id_fasilitas" => $post['id_fasilitas1'][$key],
                                    "nama_fasilitas" => $post['nama_fasilitas1'][$key],
                                    "id_wisata" => $post['id_wisata'],
                                    "harga_fasilitas" => $post['harga_fasilitas1'][$key]
                                );    
                            }
                        }
                    }
                }
            //}
            $this->Fasilitas_model->update($fasilitasubah, 'id_fasilitas');

            //foreach($post['nama_fasilitas1'] AS $keyxx => $val){
              
            //}

            // $get_fasilitas1 = $this->Wisata_model->get_fasilitasdb($this->input->post('id_wisata', TRUE));
            // if (count($get_fasilitas1)>0) {
            //     foreach($post['nama_fasilitas1'] AS $keyxx => $val){
            //     //echo $total_post = count($post['nama_fasilitas1']);    
            //         foreach ($get_fasilitas1 as $key => $value) {
            //             if ($value->id_wisata==$this->input->post('id_wisata', TRUE)){
            //                    // echo "id_wisata sama<br>";
            //                 if ($post['nama_fasilitas1'][$keyxx]!=='') {
            //                    // echo "nama_fasilitas1 tidak kosang<br>";
            //                     $this->update($this->input->post('id_wisata', TRUE));
            //                     if ($value->nama_fasilitas !== $post['nama_fasilitas1'][$keyxx]) {
            //                         $fasilitasubah[] = array(
            //                         "id_fasilitas" => $post['id_fasilitas1'][$keyxx],
            //                         "nama_fasilitas" => $post['nama_fasilitas1'][$keyxx],
            //                         "id_wisata" => $post['id_wisata'],
            //                         "harga_fasilitas" => $post['harga_fasilitas1'][$keyxx]
            //                         );
            //                     }
            //                 }
            //             }
            //         }
            //     }
            //     $this->Fasilitas_model->update('id_wisata', $fasilitasubah, 'id_fasilitas');
            // }

            $fasilitas = array();
            foreach($post['nama_fasilitas'] AS $key => $val){
                $fasilitas[] = array(
                    "nama_fasilitas" => $post['nama_fasilitas'][$key],
                    "id_wisata" => $post['id_wisata'],
                    "harga_fasilitas" => $post['harga_fasilitas'][$key]
                    );    
                    $this->Fasilitas_model->insert($fasilitas);
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
            'tiket_dewasa' => $this->input->post('tiket_dewasa',TRUE),
            'tiket_anak' => $this->input->post('tiket_anak',TRUE),
            'NIK' => $this->input->post('NIK',TRUE),
            );
            
            
            $this->Wisata_model->update($this->input->post('NIK', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('wisata'));                                
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Wisata_model->get_by_id($id);

        if ($row) {
            $this->Wisata_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('wisata'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
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
	$this->form_validation->set_rules('NIK', 'nik', 'trim|required');
    // $this->form_validation->set_rules('nama_fasilitas', 'nama_fasilitas', 'trim|required');
    // $this->form_validation->set_rules('harga_fasilitas', 'harga_fasilitas', 'trim|required');
    // $this->form_validation->set_rules('nama_gambar', 'nama_gambar', 'trim|required');
    

	$this->form_validation->set_rules('id_wisata', 'id_wisata', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "wisata.xls";
        $judul = "wisata";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Wisata");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Kota");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Kec");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Kel");
	xlsWriteLabel($tablehead, $kolomhead++, "Lat");
	xlsWriteLabel($tablehead, $kolomhead++, "Lng");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat Wisata");
	xlsWriteLabel($tablehead, $kolomhead++, "Tiket Dewasa");
	xlsWriteLabel($tablehead, $kolomhead++, "Tiket Anak");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Fasilitas");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Gambar");
	xlsWriteLabel($tablehead, $kolomhead++, "NIK");

	foreach ($this->Wisata_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_wisata);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_kota);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_kec);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_kel);
	    xlsWriteLabel($tablebody, $kolombody++, $data->lat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->lng);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat_wisata);
	    xlsWriteNumber($tablebody, $kolombody++, $data->tiket_dewasa);
	    xlsWriteNumber($tablebody, $kolombody++, $data->tiket_anak);
	    xlsWriteLabel($tablebody, $kolombody++, $data->NIK);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Wisata.php */
/* Location: ./application/controllers/Wisata.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-31 14:20:54 */
/* http://harviacode.com */