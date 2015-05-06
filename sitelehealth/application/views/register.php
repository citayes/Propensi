<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
    <!-- Sidebar content-->
    <?php
        $pengguna = new pengguna();
        $pengguna->where('username', $_SESSION['admin'])->get();
        $profile="";
        $profile .="<br><center><img alt='140x140' src='../../".$pengguna->foto."' style='width:125px; height:125px;' class='img-circle'>
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
                <div class="col-md-8 col-md-offset-2">
                    <div class="cform" id="contact-form">
				<div class="panel panel-default">
					    <div class="panel-heading">
					        <h4 class="section-heading animated" data-animation="bounceInUp"><span class="glyphicon glyphicon-user"></span>Create Orthodontist</h4></div>
					        <div class="panel-body">
					            <form class="form-horizontal" role="form" method="post" action="register">
									<div class="form-group">
										<label class="col-sm-3 control-label" for="username">Username</label>
										<div class="col-sm-9">
										<input type="input" name="Username" class="form-control" id="Username" placeholder="Your Username" required/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="Password">Password</label>
										<div class="col-sm-9">
											<input type="password" class="form-control" name="Password" id="Password" placeholder="Your Password" required/>
										</div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label" for="Email">Email</label>
										<div class="col-sm-9">
											<input type="email" class="form-control" name="Email" placeholder="someone@example.com" required>
										</div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label" for="nama">Nama</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="Nama" placeholder="Masukkan Nama Lengkap Anda" required autofocus>
										</div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label" for="tempat_lahir">Tempat Lahir</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="Tempat_Lahir" placeholder="Masukkan Tempat Lahir Anda" required autofocus>
										</div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label" for="tanggal_lahir">Tanggal Lahir</label>
										<div class="col-sm-9">
											<div class="input-group date form_date col-md-12" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
							                    <input class="form-control" type="text" name="Tanggal_Lahir" placeholder='Masukkan Tanggal Lahir'>
							     				<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							                </div>
							    			<input type="hidden" id="dtp_input2" value=""/>
										</div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label" for="warga_negara">Warga Negara</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="Warga_Negara" placeholder="Masukkan Kewarganegaraan Anda" required autofocus>
										</div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label" for="jenis_kelamin">Jenis Kelamin</label>
										<div class="col-sm-9">
											<input type='radio' name='Jenis_Kelamin' value='Laki-laki'>Laki - Laki 	</input>
											<input type='radio' name='Jenis_Kelamin' value='Perempuan'>Perempuan</input>											
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="agama">Agama</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="Agama" placeholder="Masukkan Agama Anda" required autofocus>
										</div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label" for="pendidikan">Pendidikan Terakhir</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="Pendidikan" placeholder="Pendidikan Terkahir" required autofocus>
										</div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label" for="kursus">Kursus</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="Kursus" placeholder="Kursus Orthodonti" required autofocus>
										</div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label" for="alamat">Alamat Praktik</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="Alamat" placeholder="Masukkan Alamat Praktik" required autofocus>
										</div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label" for="kodepos">Kode Pos</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="Kodepos" placeholder="Masukkan Kode Pos Alamat Praktik" required autofocus>
										</div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label" for="role">Daftar Sebagai</label>
										<div class="col-sm-9">
											<input type="radio" name="Role"  value='orthodonti' checked>Dokter Gigi Spesialis Orthodonti Pusat</input>
										</div>
									</div>
									<div class="form-group last">
										<div class="col-sm-offset-3 col-sm-9">
											<button type="submit" class="btn btn-primary btn-sm">Register</button>
										</div>
									</div>
								</form>
							</div>
							<div class="panel-footer">
									<br>
							</div>
						</div>
					</div>
				</div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
<script type="text/javascript">
 $('.form_date').datetimepicker({
        language:  'id',
        weekStart: 1,
        todayBtn:  1,
  autoclose: 1,
  todayHighlight: 1,
  startView: 2,
  minView: 2,
  forceParse: 0
    });
</script>