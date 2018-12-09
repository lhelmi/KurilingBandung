$(document).ready(function(){
	$("#submit").click(function(e){
		e.preventDefault();

		var nama_kec = $("#nama_kec").val();
		var valid=true;

		if (nama_kec == "") {
			valid = false;
			$("#errornama_kec").html("<div class='alert alert-danger email-alert' style='margin-top:10px; '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>Firstname Cannot Be Blank and Must Be Between 7 and 15 Characters.</div>")
		}else{
			$("#errornama_kec").html("");
			valid = true;
		}

		

	});
});