<div class="container">
	<div class="row mar-bot40">
		<div class="col-md-offset-3 col-md-6">
			<div class="section-header">
				<br><br><h2 class="section-heading animated" data-animation="bounceInUp"><center>Update Patient</center></h2><hr>
			</div>
		</div>
	</div>
	<div class="row">
		<table class="table">
			<tr>
				<td>Name</td>
			</tr>
				<?php $Pasien = new Pasien();
				$Pasien->get();//$Pasien->where('FVerifikasi','n')->get();
				$content ="";
				foreach($Pasien as $row){
					$content .= "<tr><td><a href='../orthodonti/pasien_update2_ortho/$row->id'>".$row->nama."</td></tr>";
				} echo $content;
				?>
		</table>
	</div>
</div>