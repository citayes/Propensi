<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
    <!-- Sidebar content-->
    <?php
        $pengguna = new pengguna();
        $pengguna->where('username', $_SESSION['drg'])->get();
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
				<h2 class="section-heading animated" data-animation="bounceInUp"><center>Edit Patient</center></h2><hr>
			</div>
		</div>
	</div>
	<div class="row">
		<table class="table">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="cform" id="contact-form">
								<form  method="post" action="">
									  <div class="form-group">
										<label for="nama">Name</label>
										<input type="text" class="form-control" name="Nama" value="<?php echo $nama;?>"" required autofocus>
									  </div>
									  <div class="form-group">
										<label for="tempat_lahir">Place of Birth</label>
										<input type="text" class="form-control" name="Tempat_Lahir" value="<?php echo $tempat_lahir;?>"" required autofocus>
									  </div>
									  <div class="form-group">
										<label for="tanggal_lahir">Date of Birth</label>
										<div class="input-group date form_date col-md-12" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
										<input class="form-control" type="text" name="Tanggal_Lahir" value="<?php echo $tanggal_lahir;?>">
							     		<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							     		</div>
									  	<input type="hidden" id="dtp_input2" value=""/>
									  </div>
									  <div class="form-group">
										<label for="alamat_rumah">Address</label>
										<input type="text" class="form-control" name="Alamat_Rumah" value="<?php echo $alamat_rumah;?>"" required autofocus>
									  </div>
									   <div class="form-group">
										<label for="age">Age</label>
										<input type="text" class="form-control" name="Umur" value="<?php echo $umur;?>"" required autofocus>
									  </div>
									   <div class="form-group">
										<label for="tinggi">Height</label>
										<input type="text" class="form-control" name="Tinggi" value="<?php echo $tinggi;?>"" required autofocus>
									  </div>
									   <div class="form-group">
										<label for="berat">Weight</label>
										<input type="text" class="form-control" name="Berat" value="<?php echo $berat;?>"" required autofocus>
									  </div>
									   <div class="form-group">
										<label for="warga_negara">Nationality</label>
										<input type="text" class="form-control" name="Warga_Negara" value="<?php echo $warga_negara;?>"" required autofocus>
									  </div>
									    <div class="form-group">
										<label for="agama">Religion</label>
										<input type="text" class="form-control" name="Agama" value="<?php echo $agama;?>"" required autofocus>
									  </div>
									  <div class="form-group">
									  <button type="submit" class="btn btn-primary pull-left">Update</button>
									  </div>
								</form>	
					</div>
				</div>
			</div>
		</table>
	</div>
                    
                </div>
            </div>
        </div>
    </div>


</div>