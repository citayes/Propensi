<div class="container">
	<div class="row mar-bot40">
		<div class="col-md-offset-3 col-md-6">
			<div class="section-header">
				<br><br><h2 class="section-heading animated" data-animation="bounceInUp"><center>Delete Patient</center></h2><hr>
			</div>
		</div>
	</div>
	<div class="row">
		<table class="table">
			<tr>
				<td>Name</td>
				<td>Operation</td>
			</tr>
				<?php $Pasien = new Pasien();
				$Pasien->get();//$Pasien->where('FVerifikasi','n')->get();
				$content ="";
				foreach($Pasien as $row){
					$content .= "<tr><td><a href='../drg/pasien_update2/$row->ID_B'>".$row->Nama."</td><td><button onclick='myFunction()'>Hapus</button></td></tr>";
				} echo $content;
				?>
		</table>
	</div>
</div>

<script>
function myFunction() {
    var x;
    if (confirm("Are you sure?") == true) {
        x = "The data have already been erase";
    } else {
        x = "You have cancelled";
    }
    document.getElementById("demo").innerHTML = x;
}
</script>