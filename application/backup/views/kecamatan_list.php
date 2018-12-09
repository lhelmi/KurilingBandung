<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('lib/head')?>
    <body class="no-skin">
        <?php $this->load->view('lib/navbar')?>
        <div class="main-container ace-save-state" id="main-container">
            <script type="text/javascript">
                try{ace.settings.loadState('main-container')}catch(e){}
            </script>
            <?php $this->load->view('lib/sidebar')?>
            <div class="main-content">
                <div class="main-content-inner">
                    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                        <ul class="breadcrumb">
                            <li>
                                <i class="ace-icon fa fa-home home-icon"></i>
                                <a href="#">Home</a>
                            </li>
                            <li class="active">Kecamatan</li>
                        </ul><!-- /.breadcrumb -->
                    </div>
                    <div class="page-header">
                        <h1>Tables<small><i class="ace-icon fa fa-angle-double-right"></i> Data Kecamatan</small></h1>  
                    </div><!-- /.page-header -->
                    <div class="container">
<!---------------------------------------------------------------------------------------------------------------------------------- --><!--                         <div class="row col-md-6">
                            <?php echo anchor(site_url('kecamatan/create'),'<i class=""></i>Tambah</a>', 'class="btn btn-primary"'); ?>
                        </div> -->
                        <div class="row col-md-6">
                            <a class="btn btn-primary" href="#modal-form" role="button" class="blue" data-toggle="modal"> Create</a>
                        </div>
<!---------------------------------------------------------------------------------------------------------------------------------- -->
                        <div class="col-md-4 text-center">
                            <div style="margin-top: 8px" id="message">
                                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <form action="<?php echo site_url('kecamatan/index'); ?>" class="form-inline" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                    <span class="input-group-btn">
                                    <?php if ($q <> ''){ ?>
                                        <a href="<?php echo site_url('kecamatan'); ?>" class="btn btn-default">Reset</a>
                                    <?php } ?>
                                    <button class="btn btn-primary" type="submit">Search</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <div class="row col-xs-12">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->
                                <div class="row">
                                    <div class="col-xs-12">
                                        <br>
<!---------------------------------------------------------------------------------------------------------------------------------- -->
                                        <table id="simple-table" class="table  table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kota</th>
                                                    <th>Kecamatan</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($kecamatan_data as $kecamatan){?>
                                                <tr>
                                                    <td width="80px"><?php echo ++$start ?></td>
                                                    <td><?php echo $kecamatan->nama_kota ?></td>
                                                    <td><?php echo $kecamatan->nama_kec ?></td>
                                                    <td style="text-align:center" width="200px">
                                                        <?php 
                                                        echo anchor(site_url('kecamatan/read/'.$kecamatan->id_kec),'Read'); 
                                                        echo ' | '; 
                                                        echo "<a href='#modal-form-edit/$kecamatan->id_kec' class='edit_kategori' role='button' data-toggle='modal'>Update</a>";
                                                        //echo anchor(site_url('kecamatan/update/'.$kecamatan->id_kec),'Update'); 
                                                        echo ' | '; 
                                                        echo anchor(site_url('kecamatan/delete/'.$kecamatan->id_kec),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                                                        ?>
                                                     </td>
                                                  </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
<!------------------------------------------------------------------------------------------------------------------------------------>                                        
                                <div id="modal-form" class="modal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="blue bigger">Tambah</h4>
                                                </div>
                                                
                                                    <div class="modal-body">
                                                        
                                                        <div class="row">
                                                            <form id="frminsrt">
                                                            <div class="form-group">
                                                                <label for="varchar">Nama Kecamatan</label>
                                                                <input type="text" class="form-control" name="nama_kec" id="nama_kec" placeholder="Nama Kec" value="<?php echo $nama_kec; ?>"/>
                                                                <span id="errornama_kec"></span>    
                                                            </div>
                                                                <input type="hidden" name="id_kec" /> 
                                                                <span id="erroridkec"></span>    
                                                                <input type="hidden" name="is_delete" value="0" /> 
                                                                
                                                                <select hidden="true" name="id_kota">
                                                                    <?php foreach ($id_kota as $key => $val) { ?>
                                                                        <option value="<?= $val->id_kota ?>" ><?php echo $val->nama_kota ?></option>

                                                                    <?php } ?>
                                                                </select>

                                                        </div>
                                                        <div class="modal-footer">
                                                                <button class="btn btn-sm" id="clear" data-dismiss="modal">
                                                                    <i class="ace-icon fa fa-times"></i>
                                                                    Cancel
                                                                </button>

                                                                <button type="submit" id="submit" name="submit" class="btn btn-sm btn-primary">
                                                                    <i class="ace-icon fa fa-check"></i>
                                                                    Save
                                                                </button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    
                                                </div>
                                            </div>
                                          </div>  
                                </div>
<!------------------------------------------------------------------------------------------------------------------------------------>
                                <div id="modal-form-edit" class="modal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="blue bigger">Tambah</h4>
                                                </div>
                                                
                                                    <div class="modal-body">
                                                        
                                                        <div class="row">
                                                            <form id="frminsrt">
                                                            <div class="form-group">
                                                                <label for="varchar">Nama Kecamatan</label>
                                                                <input type="text" class="form-control" name="nama_kec" id="nama_kec" placeholder="Nama Kec" value="<?php echo $nama_kec; ?>"/>
                                                                <span id="errornama_kec"></span>    
                                                            </div>
                                                                

                                                        </div>
                                                        <div class="modal-footer">
                                                                <button class="btn btn-sm" id="clear" data-dismiss="modal">
                                                                    <i class="ace-icon fa fa-times"></i>
                                                                    Cancel
                                                                </button>

                                                                <button type="submit" id="submit" name="submit" class="btn btn-sm btn-primary">
                                                                    <i class="ace-icon fa fa-check"></i>
                                                                    Save
                                                                </button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    
                                                </div>
                                            </div>
                                          </div>  
                                </div>
<!------------------------------------------------------------------------------------------------------------------------------------>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
                                                <?php echo anchor(site_url('kecamatan/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <?php echo $pagination ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php $this->load->view('lib/footer')?>
    </body> 
</html>
<script type="text/javascript">
    $(document).on("submit", "#frminsrt", function(){
        $frm = $(this);

        $.ajax({
            type: 'POST',
            //data: $frm.serialize(),
            url:"<?php echo site_url('kecamatan/create_action'); ?>", 
            data: $('#frminsrt').serialize(),
            dataType: "JSON",
            // success: function(res){
            //     var json = $.parseJSON(res);
            //     // if(res.code == 500){
            //     //     $.each(res.msg, function(k,v){
            //     //         $msg = "";
            //     //         console.log(k)
            //     //         $.each(v, function(vk,vv){
            //     //             $msg += vv
            //     //         })
            //     //          $frm.find("input[name='"+k+"']").parents(".form-group").addClass("error");
            //     //          $frm.find("input[name='"+k+"']").after("<br><span class=\"help-inline\">" + $msg + "</span>")
            //     //     })
            //     // }else{
            //     //     window.location.reload()
            //     // }
            // },
            error: function( jqXhr ) {
                if( jqXhr.status == 500 ) { //Validation error or other reason for Bad Request 400
                    $("#errornama_kec").html("<div class='alert alert-danger email-alert' style='margin-top:10px; '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>Field Tidak Boleh Kosong.</div>")
                }
            }

        })
      

    });
    $(function(){
        $(document).on('click','.edit_kategori',function(e){
            e.preventDefault();
            $("#modal-form-edit").modal('show');
            $.post("<?php echo site_url('kecamatan/update')?>",
                {id:$(this).attr('data-id')},
                function(html){
                    $(".modal-body").html(html);
                }   
            );
        });
    });
</script>



















<!-- <script type="text/javascript">
    $(document).on("submit", function(){
      $nama_kec = $(this).find("input[name='nama_kec']").val()
      $( '#errornama_kec' ).html( "" );

       // if($nama_kec == ""){
       //      $("#errornama_kec").html("<div class='alert alert-danger email-alert' style='margin-top:10px; '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>Field Tidak Boleh Kosong.</div>")
       //  }
        
        
//$frm.find("input[name='"+k+"']").parents(".control-group").addClass("error");
        $.ajax({
        type: 'POST',
        dataType: 'Json',
        url:"<?php echo site_url('kecamatan/create_action'); ?>", 
        data: $('#frminsrt').serialize(),
        success: function (res) {
            if (res.code == 500) {
                $.each(res.msg, function(k,v){

                }
            }

        }

        });
    });

   

    

</script> -->












<!-- <script type="text/javascript">
    $(document).ready(function(){
    $("#submit").click(function(e){
        e.preventDefault();

        var nama_kec = $("#nama_kec").val();
        var id_kota = $("#id_kota").val();
        var id_kec = $("#id_kec").val();
        var is_delete = $("#is_delete").val();

        var valid=true;
        if (nama_kec == "") {
            valid = false;
            $("#errornama_kec").html("<div class='alert alert-danger email-alert' style='margin-top:10px; '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>Firstname Cannot Be Blank and Must Be Between 7 and 15 Characters.</div>")
        }else{
            $("#errornama_kec").html("");
        }

        if (valid == true) {
            var form_data = {
                id_kec:id_kec,
                nama_kec:nama_kec,
                id_kota:id_kota,
                is_delete:is_delete
            };

            $.ajax({
                url:"<?php echo site_url('kecamatan/create_action'); ?>", 
                type:"POST",
                data: form_data,
                success: function(data){
                    
                }
            });
        }else{
            return false;
        }

    });
});

else if (!isNameValid($nama_kec)) {
            $("#errornama_kec").html("<div class='alert alert-danger email-alert' style='margin-top:10px; '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>Only Letters Are Allowed For Lastname and Must Be Between 7 and 15 Characters</div>")
                valid=false;
            }

            function isNameValid(name){
        return /^[a-zA-Z]*$/.test(name) && /\S{1,25}/.test(name);
    }
</script> -->