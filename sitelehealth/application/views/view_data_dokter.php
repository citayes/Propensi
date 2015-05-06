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
    <div class="row">
		<div class="col-md-offset-3 col-md-6">
			<div class="section-header">
				<h2 class="section-heading animated" data-animation="bounceInUp"><center>Data Dokter Gigi</center></h2><hr>
			</div>
		</div>
		<div class="col-md-8 col-md-offset-2">
			<div class="cform" id="contact-form">
				<table class="table table-hover">
				<?php if(isset($content)) echo $content; ?>			
				</table>
			</div>
		</div>
	</div>
</div>