<div class="container">
	<div class="row mar-bot40">
		<div class="col-md-offset-3 col-md-6">
			<div class="section-header">
				<br><br><h2 class="section-heading animated" data-animation="bounceInUp"><center>List Doctor</center></h2><hr>
			</div>
		</div>
	</div>
	<div class="row">
		<table class="table">
			<tr>
				<td>Username</td>
				<td>Nama</td>
				<td>Role</td>
				<td>Operation</td>
			</tr>
				<?php 
				$pengguna = new Pengguna();
				$pengguna->get();
				$content = "";
				foreach($pengguna as $row){
							$content .= "<tr><td>$row->Username</td><td>$row->Nama</td><td>$row->role</td><td><button onclick='myFunction()'>Hapus</button></td></tr>";	
				}
				echo $content;
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