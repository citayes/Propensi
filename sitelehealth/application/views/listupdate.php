<div class="container">
	<div class="row mar-bot40">
		<div class="col-md-offset-3 col-md-6">
			<div class="section-header">
				<br><br><h2 class="section-heading animated" data-animation="bounceInUp"><center>Update Dokter</center></h2><hr>
			</div>
		</div>
	</div>
	<div class="row">
		<table class="table">
			<tr>
				<td>Username</td>
				<td>Nama</td>
				<td>Alamat Praktik</td>
			</tr>
				<?php 
				$pengguna = new Pengguna();
				$pengguna->where('role', "orthodonti")->get();
				$content = "";
				foreach($pengguna as $row){
							$content .= "<tr><td><a href='../admin/update/$row->Username'>$row->Username</a></td><td>$row->Nama</td><td>$row->Warga_Negara</td></tr>";
						
				}
				echo $content;
				?>
		</table>
	</div>
</div>