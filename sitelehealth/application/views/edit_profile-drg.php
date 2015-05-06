<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
    <!-- Sidebar content-->
    <?php
        $pengguna = new pengguna();
        $pengguna->where('username', $_SESSION['drg'])->get();
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
                <div class="col-lg-12">
                    <center><h1>Edit Profile</h1></center>
                    <div class='col-md-1'>
                    </div>
                    <div class="col-md-10">
                    	<div class="tabbable" id="tabs-112217">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#panel-346120" data-toggle="tab">Profile</a>
							</li>
							<li>
								<a href="#panel-486345" data-toggle="tab">Photo</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="panel-346120">
								<div class="cform" id="contact-form">
									<form  method="post" action="edit_profile">
									  <div class="form-group">
										<label for="nama">Name</label>
										<input type="text" class="form-control" name="Nama" value="<?php echo $nama;?>" required autofocus>
									  </div>
									  <div class="form-group">
										<label for="tempat_lahir">Place Of Birth</label>
										<input type="text" class="form-control" name="Tempat_Lahir" value="<?php echo $tempat_lahir;?>" required autofocus>
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
										<label for="warga_negara">Nationality</label>
										<input type="text" class="form-control" name="Warga_Negara" value="<?php echo $warga_negara;?>" required autofocus>
									  </div>
									  <div class="form-group">
										<label for="agama">Religion</label>
										<input type="text" class="form-control" name="Agama" value="<?php echo $agama;?>" required autofocus>
									  </div>
									  <div class="form-group">
										<label for="nama">Course</label>
										<input type="text" class="form-control" name="kursus" value="<?php echo $kursus;?>" required autofocus>
									  </div>
									  <div class="form-group">
										<label for="tempat_lahir">Education</label>
										<input type="text" class="form-control" name="pendidikan" value="<?php echo $pendidikan;?>" required autofocus>
									  </div>
									  <div class="form-group">
										<label for="warga_negara">Clinic Address</label>
										<input type="text" class="form-control" name="alamat" value="<?php echo $alamat;?>" required autofocus>
									  </div>
									  <div class="form-group">
										<label for="agama">Postal Code</label>
										<input type="text" class="form-control" name="kodepos" value="<?php echo $kodepos;?>" required autofocus>
									  </div>
									  <div class="form-group">
										<label for="agama">Orthodontist Course</label>
										<input type="text" class="form-control" name="kursus_orthodonti" value="<?php echo $kursus_orthodonti;?>" required autofocus>
									  </div>
									  <div class="form-group">
										<label for="agama">Schedule</label>
										<input type="text" class="form-control" name="jadwal" value="<?php echo $jadwal;?>" required autofocus>
									  </div>
									  <div class="form-group">
									  <button type="submit" class="btn btn-primary pull-left">Update</button>
									  </div>
									</form>	
								</div>
							</div>
							<div class="tab-pane" id="panel-486345">
								<!-- <?php echo $error;?>-->
							   <center> <?php echo form_open_multipart('drg/do_upload');?>
							    <img alt='140x140' src='../../<?php $pengguna = new pengguna();
        													$pengguna->where('username', $_SESSION['drg'])->get(); 
        													echo $pengguna->foto ?>' 
        													style='width:125px; height:125px;' class='img-circle'>
							    <input type="file" name="userfile"/>
							    <br /><br />
							    <input type="submit" class="btn btn-primary" value="upload" />

							    </form></center>
							</div>
						</div>
					</div>
                    </div>
                    <div class="col-md-1"></div>
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