<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
    <!-- Sidebar content-->
    <?php
        $pengguna = new pengguna();
        $pengguna->where('username', $_SESSION['pusat'])->get();
        $profile="";
        $profile .="<br><center><img alt='140x140' src='../../../".$pengguna->foto."' style='width:125px; height:125px;' class='img-circle'>
        <p><b>".$pengguna->nama."</b><br>
        <p>".$pengguna->username."<br>
        <p>".$pengguna->email."<br>
        <p>".$pengguna->role."</p></center>";
        echo $profile;
    ?>
    </div>
    <!-- /#sidebar-wrapper -->
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mar-bot40">
		<div class="col-md-offset-3 col-md-6">
			<div class="section-header">
				<h2 class="section-heading animated" data-animation="bounceInUp"><center>Send Diagnose to Admin</center></h2><hr>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="cform" id="contact-form">
				<form  method="post" action="../send_diagnose_to_admin_lagi/<?php echo $n;?>">
				  <div class="form-group">
					<label for="skor">Skor PAR</label>
					<input type="text" class="form-control" id="skor" name="skor" placeholder="Masukkan PAR Index" required autofocus>
				  </div>
				  <div class="form-group">
					<label for="maloklusi_Menurut_Angka">Maloklusi Menurut Angka</label>
					<input type="text" class="form-control" id="maloklusi_menurut_angka" name="maloklusi_menurut_angka" placeholder="Masukkan Tingkat Keparahan Maloklusi" required autofocus>
				  </div>
				  <div class="form-group">
					<label for="diagnosis_rekomendasi">Diagnosis_Rekomendasi</label>
					<input type="text" class="form-control" id="diagnosis_rekomendasi" name="diagnosis_rekomendasi" placeholder="Masukkan Diagnosis Rekomendasi" required autofocus>
				  </div>
				  <button type="submit" class="btn btn-primary pull-left">Send Diagnose</button>
				</form>
			</div>
		</div>
	</div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>