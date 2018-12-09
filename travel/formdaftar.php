<!DOCTYPE html>
<html lang="en">
<head>
	<title>Form Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/mainlogin.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				
				<form class="login100-form validate-form">
					<span class="login100-form-title p-b-34">
						Registrasi
					</span>
					
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 col-12">
						<input class="input100" type="text" name="nik" placeholder="NIK">
						<span class="focus-input100"></span>
					</div> 

					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 col-12">
						<input class="input100" type="text" name="nama" placeholder="Nama">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 col-12" data-validate="Type password">
						<input class="input100" type="text" name="lahir" placeholder="Tempat Lahir">
						<span class="focus-input100"></span>
					</div>

					<div class="form-group col-12">
    					<label for="exampleSelect1">Tanggal Lahir</label>
    					<div class="row">
    					

    					<select class="form-control col-4" id="tgl" name="tgll">
     						 <option selected="selected">Tanggal</option>
								<?php
									for($tgl=1; $tgl<=31; $tgl++){
    									echo"<option value=$tgl> $tgl </option>";
											}
								?>
    			    	</select>
    			    	

    			    	
    			    	<select name="bln" class="form-control col-4">
							<option selected="selected">Bulan</option>
								<?php
									$bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
									$jlh_bln=count($bulan);
									for($c=0; $c<$jlh_bln; $c+=1){
									    echo"<option value=$bulan[$c]> $bulan[$c] </option>";
									}
								?>
						</select>

						<select name="tahun" class="form-control col-4">
						<option selected="selected">Tahun</option>
							<?php
									for($tgl=2018; $tgl>=1945; $tgl--){
    									echo"<option value=$tgl> $tgl </option>";
											}
								?>
							
						</select>
												
						</div>
 					 </div>

					<div class="m-b-20 radio col-12">
						

						<label class="col-4 custom-control custom-radio">
						  <input id="radio1" name="jenkel" type="radio" class="custom-control-input">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Laki-Laki</span>
						</label>


						<label class="custom-control custom-radio">
						  <input id="radio2" name="jenkel" type="radio" class="custom-control-input">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Perempuan</span>
						</label>
					</div>


					


					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 col-12">
    					<label for="exampleFormControlTextarea1"></label>
   						 <textarea class="input100" id="exampleFormControlTextarea1" rows="5" placeholder="Tempat Lahir">
   						 	
   						 </textarea>

   						 <span class="focus-input100" ></span>
  					</div>

  					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 col-12" data-validate="Type password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 col-12" data-validate="Type email">
						<input class="input100" type="email" name="email" placeholder="Email">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 col-12">
						<input class="input100" type="tlp" name="tlp" placeholder="No. Tlp">
						<span class="focus-input100"></span>
					</div>

					<div class="form-group m-b-20 ">
					<label for="exampleInputFile">Silahkan Upload image scan KTP anda</label><br>
					<label for="exampleInputFile">Pilih File Gamabr :</label>
					<input type="file" class="form-control-file col-8 offset-2" id="exampleInputFile" >	
					</div>
					


					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Daftar
						</button>
					</div>

					

					<div class="w-full text-center" style="margin-top:60px">
						<a href="formlogin.php" class="txt3">
							Masuk
						</a>
					</div>
				</form>

				
			</div>
		</div>
	</div>
	
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>