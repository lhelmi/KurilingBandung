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
                                            		<th>Nama</th>
                                            		<th>Username</th>
                                            		<th>Alamat</th>
                                            		<th>Jk</th>
                                            		<th>Email</th>
                                            		<th>No Telp</th>
                                            		<th>Level</th>
                                            		<th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($admin_data as $admin){ ?>
                                                <tr>
                                                    <td width="80px"><?php echo ++$start ?></td>
                                                    <td><?php echo $admin->nama ?></td>
                                                    <td><?php echo $admin->username ?></td>
                                                    <td><?php echo $admin->alamat ?></td>
                                                    <td><?php echo $admin->jk ?></td>
                                                    <td><?php echo $admin->email ?></td>
                                                    <td><?php echo $admin->no_telp ?></td>
                                                    <td><?php echo $admin->level ?></td>
                                                    <td style="text-align:center" width="200px">
                                                        <?php 
                                                        echo anchor(site_url('admin/read/'.$admin->NIP),'Read'); 
                                                        echo ' | '; 
                                                        echo anchor(site_url('admin/update/'.$admin->NIP),'Update'); 
                                                        echo ' | '; 
                                                        echo anchor(site_url('admin/delete/'.$admin->NIP),'Delete',' class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
<!------------------------------------------------------------------------------------------------------------------------------------>                                          <div class="row">
                                            <div class="col-md-6">
                                                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <?php echo $pagination ?>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>