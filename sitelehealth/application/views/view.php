<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
    <!-- Sidebar content-->
    <?php
        $pengguna = new pengguna();
        $pengguna->where('username', $_SESSION['admin'])->get();
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
					<div class="col-md-8 col-md-offset-2">
					<div class="cform" id="contact-form">
						<div class="panel panel-default">
						    <div class="panel-heading">
						        <h4 class="section-heading animated" data-animation="bounceInUp"><span class="glyphicon glyphicon-user"></span><?php $pengguna = new pengguna();
        						$pengguna->where('username', $_SESSION['admin'])->get(); echo $pengguna->nama; ?>'s Profile</h4></div>
						        <div class="panel-body">
						        <center><img class='img-circle' style="width:125px; height:125px;" src="../../../<?php echo $foto; ?>"></center><br>
						        <table class="table table-hover">
						        	<tr>
						        		<td><b>Nama</b></td>
						        		<td><?php echo $nama?></td>
						        	</tr>
						        	<tr>
						        		<td><b>Email</b></td>
						        		<td><?php echo $email?></td>
						        	</tr>
						        	<tr>
						        		<td><b>Tanggal Lahir</b></td>
						        		<td><?php echo $tanggallahir?></td>
						        	</tr>
						        	<tr>
						        		<td><b>Tempat Lahir</b></td>
						        		<td><?php echo $tempatlahir?></td>
						        	</tr>
						        	<tr>
						        		<td><b>Jenis Kelamin</b></td>
						        		<td><?php echo $jeniskelamin?></td>
						        	</tr>
						        	<tr>
						        		<td><b>Agama</b></td>
						        		<td><?php echo $agama?></td>
						        	</tr>
						        	<tr>
						        		<td><b>Kursus</b></td>
						        		<td><?php echo $kursus?></td>
						        	</tr>
						        	<tr>
						        		<td><b>Pendidikan</b></td>
						        		<td><?php echo $pendidikan?></td>
						        	</tr>
						        	<tr>
						        		<td><b>Alamat</b></td>
						        		<td><?php echo $alamat?></td>
						        	</tr>
						        	<tr>
						        		<td colspan="2">
						        		<a href="../retrieve"><button type="submit" class="btn btn-primary pull-left">Back</button></a></td>
						        		</td>
						        	</tr>
						        </table>
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
