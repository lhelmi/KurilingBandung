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
	xlsWriteLabel($tablehead, $kolomhead++, "NIK");
    xlsWriteLabel($tablehead, $kolomhead++, "is_delete");
    if ($this->session->userdata('is_admin')=='0') {
        $wist = $this->Wisata_model->get_export();
    }elseif ($this->session->userdata('is_admin')=='1') {
        $wist = $this->Wisata_model->get_exportadmin();
    }
    foreach ($wist as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_wisata);
        xlsWriteLabel($tablebody, $kolombody++, $data->nama_kota);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_kec);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_kel);
	    xlsWriteLabel($tablebody, $kolombody++, $data->lat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->lng);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat_wisata);
	    xlsWriteNumber($tablebody, $kolombody++, $data->tiket_dewasa);
	    xlsWriteNumber($tablebody, $kolombody++, $data->tiket_anak);
	    xlsWriteLabel($tablebody, $kolombody++, $data->NIK);
        xlsWriteLabel($tablebody, $kolombody++, $data->is_delete == '0' ? 'Tidak' : 'ya');

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();