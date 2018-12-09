<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged')<>1) {
            $this->session->set_flashdata('message', 'Anda Belum Login, Silahkan Login Terlebih Dahulu');
            redirect(site_url('auth'));
        }
        if ($this->session->userdata('is_admin')==FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Anda Tidak Memiliki Akses ke Halaman Tersebut.<br></div>');
            redirect(site_url('wisata'));
            
        }
        $this->load->model('Admin_model');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        
        $this->load->library('PHPExcel');
        $this->load->library('PHPExcel/IOFactory');

    }

    public function index()
    {

        if ($this->session->userdata('level')=='1') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Anda Tidak Memiliki Akses ke Halaman Tersebut.<br></div>');
            redirect(site_url('dashboard'));
        }
        $data = array(
            'admin_data' => $this->Admin_model->get_all()
        );
        $this->load->view('admin/admin_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Admin_model->get_by_id($id);
        if ($row) {
            $data = array(
		'NIP' => $row->NIP,
		'nama' => $row->nama,
		'username' => $row->username,
		'password' => $row->password,
		'alamat' => $row->alamat,
		'jk' => $row->jk,
		'email' => $row->email,
		'no_telp' => $row->no_telp,
		'level' => $row->level,
	    );
            $this->load->view('admin/admin_read', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Record Not Found.<br></div>');
            redirect(site_url('admin'));
        }
    }

    public function create() 
    {
        if ($this->session->userdata('level')=='1') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Anda Tidak Memiliki Akses ke Halaman Tersebut.<br></div>');
            redirect(site_url('dashboard'));
        }
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/create_action'),
	    'NIP' => set_value('NIP'),
	    'nama' => set_value('nama'),
	    'username' => set_value('username'),
	    'password' => set_value('password'),
	    'alamat' => set_value('alamat'),
	    'jk' => set_value('jk'),
	    'email' => set_value('email'),
	    'no_telp' => set_value('no_telp'),
	    'level' => set_value('level'),
	);
        $this->load->view('admin/admin_form', $data);
    }
    
    public function create_action() 
    {
        if ($this->session->userdata('level')=='1') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Anda Tidak Memiliki Akses ke Halaman Tersebut.<br></div>');
            redirect(site_url('dashboard'));
        }
        $this->form_validation->set_rules('username', 'username', 'trim|required|is_unique[admin.username]|callback_reg_username');
        $this->form_validation->set_rules('password', 'password', 'trim|required|callback_reg_pass');
        $this->form_validation->set_rules('NIP', 'NIP', 'trim|required|numeric|is_unique[admin.NIP]');
        $this->form_validation->set_rules('email', 'email', 'trim|required|callback_reg_email');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        'NIP' => $this->input->post('NIP',TRUE),                
		'nama' => $this->input->post('nama',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => $hash = sha1($this->input->post('password',TRUE)),
		'alamat' => $this->input->post('alamat',TRUE),
		'jk' => $this->input->post('jk',TRUE),
		'email' => $this->input->post('email',TRUE),
		'no_telp' => $this->input->post('no_telp',TRUE),
		'level' => $this->input->post('level',TRUE),
	    );

            $this->Admin_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><p><strong><i class="ace-icon fa fa-check"></i></strong> Create Record Success.</p></div>');
            redirect(site_url('admin'));
        }
    }
    
    public function update($id) 
    {
        if ($this->session->userdata('level')=='1' && $this->session->userdata('NIP') !== $id) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Anda Tidak Memiliki Akses ke Halaman Tersebut.<br></div>');
            redirect(site_url('dashboard'));
        }

        $row = $this->Admin_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/update_action'),
		'NIP' => set_value('NIP', $row->NIP),
		'nama' => set_value('nama', $row->nama),
		'username' => set_value('username', $row->username),
		'password' => set_value('password', $row->password),
		'alamat' => set_value('alamat', $row->alamat),
		'jk' => set_value('jk', $row->jk),
		'email' => set_value('email', $row->email),
		'no_telp' => set_value('no_telp', $row->no_telp),
		'level' => set_value('level', $row->level),
	    );
            $this->load->view('admin/admin_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Record Not Found.<br></div>');
            redirect(site_url('admin'));
        }
    }
    
    public function update_action() 
    {
        $row = $this->Admin_model->get_by_id($this->input->post('NIP', TRUE));

        if ($this->input->post('password',TRUE) == null) {
            $this->_rules();
            
            // if ($this->input->post('NIP', TRUE) !== $row->NIP) {
            //     $this->form_validation->set_rules('NIP', 'NIP', 'trim|required|numeric|is_unique[admin.NIP]');
            // }
            if ($this->input->post('email', TRUE) !== $row->email) {
                $this->form_validation->set_rules('email', 'email', 'trim|required|callback_reg_email');
            }
            
            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('NIP', TRUE));
            } else {
                $data = array(
            // 'NIP' => $this->input->post('NIP', TRUE),
            'nama' => $this->input->post('nama',TRUE),
            'alamat' => $this->input->post('alamat',TRUE),
            'jk' => $this->input->post('jk',TRUE),
            'email' => $this->input->post('email',TRUE),
            'no_telp' => $this->input->post('no_telp',TRUE),
            'level' => $this->input->post('level',TRUE),
            );

                $this->Admin_model->update($this->input->post('NIP', TRUE), $data);
                $this->session->set_flashdata('message', '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><p><strong><i class="ace-icon fa fa-check"></i></strong> Update Record Success.</p></div>');
                redirect(site_url('admin'));
            }
        }else{
            $this->_rules();
            // if ($this->input->post('NIP', TRUE) !== $row->NIP) {
            //     $this->form_validation->set_rules('NIP', 'NIP', 'trim|required|numeric|is_unique[admin.NIP]');
            // }
            if ($this->input->post('email', TRUE) !== $row->email) {
                $this->form_validation->set_rules('email', 'email', 'trim|required|callback_reg_email');
            }
            $this->form_validation->set_rules('password', 'password', 'trim|required|callback_reg_pass');
            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('NIP', TRUE));
            } else {
                $data = array(

            // 'NIP' => $this->input->post('NIP', TRUE),
            'nama' => $this->input->post('nama',TRUE),
            'password' => $hash = sha1($this->input->post('password',TRUE)),
            'alamat' => $this->input->post('alamat',TRUE),
            'jk' => $this->input->post('jk',TRUE),
            'email' => $this->input->post('email',TRUE),
            'no_telp' => $this->input->post('no_telp',TRUE),
            'level' => $this->input->post('level',TRUE),
            );

                $this->Admin_model->update($this->input->post('NIP', TRUE), $data);
                $this->session->set_flashdata('message', '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><p><strong><i class="ace-icon fa fa-check"></i></strong> Update Record Success.</p></div>');
                redirect(site_url('admin'));
            }
        }
        
    }
    
    public function delete($id) 
    {
        $row = $this->Admin_model->get_by_id($id);

        if ($row) {
            $this->Admin_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><p><strong><i class="ace-icon fa fa-check"></i></strong> Delete Record Success.</p></div>');
            redirect(site_url('admin'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times"></i></strong>Record Not Found.<br></div>');
            redirect(site_url('admin'));
        }
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

    public function reg_username($str){
        if (!preg_match("/^[a-zA-Z]*$/", $str)) {
            $this->form_validation->set_message('reg_username', 'Only Letters Are Allowed For Lastname');
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required|callback_reg_username');
    $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('jk', 'jk', 'trim|required');
	$this->form_validation->set_rules('no_telp', 'no telp', 'trim|required|numeric');
	$this->form_validation->set_rules('level', 'level', 'trim|required');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

//     public function excel(){
        
//          $query = $this->Admin_model->eksport_data();
        
//         // Buat sebuah file Excel baru.
//         $objPHPExcel = new PHPExcel();
//         $objPHPExcel->getProperties()->setTitle("Laporan Data Admin Kuriling Bandung");
//         $objPHPExcel->getProperties()->setDescription("Berisi data model Admin (NIP, Nama, Username, Alamat, Jenis Kelamin, Email, No Telp, Level, dan is_delete model.");
//         $objPHPExcel->setActiveSheetIndex(0);

//         // Header laporan
//         $objPHPExcel->getActiveSheet()->setCellValue('A1','Laporan Data Admin Kuriling Bandung');
//         $objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
//         $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
//         $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
//         $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
//         $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

//         // Tanggal laporan
//         $today = date("d-m-Y");
//         $objPHPExcel->getActiveSheet()->setCellValue('C3','Tanggal: '.$today);
//         $objPHPExcel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
//         $objPHPExcel->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);

//         // Header tabel produk
        
//         $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
//         $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
//         $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
//         $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
//         $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
//         $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
//         $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
//         $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
//         $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);

//         $objPHPExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(15);

        
//         $objPHPExcel->getActiveSheet()->setCellValue('B5','NIP');
//         $objPHPExcel->getActiveSheet()->setCellValue('C5','Nama');
//         $objPHPExcel->getActiveSheet()->setCellValue('D5','Username');
//         $objPHPExcel->getActiveSheet()->setCellValue('E5','Alamat');
//         $objPHPExcel->getActiveSheet()->setCellValue('F5','Jenis Kelamin');
//         $objPHPExcel->getActiveSheet()->setCellValue('G5','Email');
//         $objPHPExcel->getActiveSheet()->setCellValue('H5','No Telp');
//         $objPHPExcel->getActiveSheet()->setCellValue('I5','Level');
//         $objPHPExcel->getActiveSheet()->setCellValue('J5','is_delete');

//         $objPHPExcel->getActiveSheet()->getStyle('B5:J5')->getFont()->setBold(true);
//         $objPHPExcel->getActiveSheet()->getStyle('B5:J5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

//         // Border header tabel
//         $styleArray = array(
//                 'fill' => array(
//                         'type' => PHPExcel_Style_Fill::FILL_SOLID,
//                         'color' => array('rgb'=>'E1E0F7'),
//                     ),
//                 'borders' => array(
//                     'outline' => array(
//                             'style' => PHPExcel_Style_Border::BORDER_THIN,
//                     ),
//                 ),
//                 );
                
//                 $objPHPExcel->getActiveSheet()->getStyle('B5')->applyFromArray($styleArray);
//                 $objPHPExcel->getActiveSheet()->getStyle('C5')->applyFromArray($styleArray);
//                 $objPHPExcel->getActiveSheet()->getStyle('D5')->applyFromArray($styleArray);
//                 $objPHPExcel->getActiveSheet()->getStyle('E5')->applyFromArray($styleArray);
//                 $objPHPExcel->getActiveSheet()->getStyle('F5')->applyFromArray($styleArray);
//                 $objPHPExcel->getActiveSheet()->getStyle('G5')->applyFromArray($styleArray);
//                 $objPHPExcel->getActiveSheet()->getStyle('H5')->applyFromArray($styleArray);
//                 $objPHPExcel->getActiveSheet()->getStyle('I5')->applyFromArray($styleArray);
//                 $objPHPExcel->getActiveSheet()->getStyle('J5')->applyFromArray($styleArray);


//         // Isi tabel

        
//         $fields = $query->list_fields();
//         $row = 6;
//         foreach($query->result() as $data)
//         {
//             $col = 1;
//             foreach ($fields as $field)
//             {

//                 $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
//                                 $objPHPExcel->getActiveSheet()->getStyle("B".($row).":J".($row))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);              
//                         $col++;
//             }
//             $row++;
//         }

//         // Menuliskan skrip pada file yang telah dibuat.
//         $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');

//         // Mendefinisikan header dan melakukan unggah secara otomatis.
//         $filename='Laporan_Produk_Admin'.$today.'.xlsx';

//         header('Content-Type: application/vnd.ms-excel');
//         header('Content-Disposition: attachment;filename="'.$filename.'"');
//         header('Cache-Control: max-age=0');
        
//         $objWriter->save('php://output');



//     }    

//  //    public function excel()
//  //    {
//  //        $this->load->helper('exportexcel');
//  //        $namaFile = "admin.xls";
//  //        $judul = "admin";
//  //        $tablehead = 0;
//  //        $tablebody = 1;
//  //        $nourut = 1;
//  //        //penulisan header
//  //        header("Pragma: public");
//  //        header("Expires: 0");
//  //        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
//  //        header("Content-Type: application/force-download");
//  //        header("Content-Type: application/octet-stream");
//  //        header("Content-Type: application/download");
//  //        header("Content-Disposition: attachment;filename=" . $namaFile . "");
//  //        header("Content-Transfer-Encoding: binary ");

//  //        xlsBOF();

//  //        $kolomhead = 0;
//  //        xlsWriteLabel($tablehead, $kolomhead++, "hahhhhh");
//  //        xlsWriteLabel($tablehead, $kolomhead++, "No");
// 	// xlsWriteLabel($tablehead, $kolomhead++, "Nama");
// 	// xlsWriteLabel($tablehead, $kolomhead++, "Username");
// 	// xlsWriteLabel($tablehead, $kolomhead++, "Password");
// 	// xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
// 	// xlsWriteLabel($tablehead, $kolomhead++, "Jk");
// 	// xlsWriteLabel($tablehead, $kolomhead++, "Email");
// 	// xlsWriteLabel($tablehead, $kolomhead++, "No Telp");
// 	// xlsWriteLabel($tablehead, $kolomhead++, "Level");

// 	// foreach ($this->Admin_model->get_all() as $data) {
//  //            $kolombody = 0;

//  //            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
//  //            xlsWriteNumber($tablebody, $kolombody++, $nourut);
// 	//     xlsWriteLabel($tablebody, $kolombody++, $data->nama);
// 	//     xlsWriteLabel($tablebody, $kolombody++, $data->username);
// 	//     xlsWriteLabel($tablebody, $kolombody++, $data->password);
// 	//     xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
// 	//     xlsWriteLabel($tablebody, $kolombody++, $data->jk);
// 	//     xlsWriteLabel($tablebody, $kolombody++, $data->email);
// 	//     xlsWriteLabel($tablebody, $kolombody++, $data->no_telp);
// 	//     xlsWriteLabel($tablebody, $kolombody++, $data->level);

// 	//     $tablebody++;
//  //            $nourut++;
//  //        }

//  //        xlsEOF();
//  //        exit();
//  //    }

// }

// /* End of file Admin.php */
// /* Location: ./application/controllers/Admin.php */
// /* Please DO NOT modify this information : */
// /* Generated by Harviacode Codeigniter CRUD Generator 2018-05-31 14:24:22 */
// /* http://harviacode.com */