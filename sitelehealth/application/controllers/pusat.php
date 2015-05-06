<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pusat extends CI_Controller {
	public function index(){
		//session_start();
		session_start();
		if(!isset($_SESSION['pusat']))
		redirect ("homepage");


		$data['menu'] = array('home' => 'active', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('pusat');
		$this->load->view('footer');
	}

	public function edit_profile(){
		session_start();
		if(!isset($_SESSION['pusat']))
			redirect ("homepage");

		$pengguna = new pengguna();
		$pengguna->where('username', $_SESSION['pusat'])->get();
		$id = $pengguna->id;
		$dokter_gigi = new dokter_gigi();
		$dokter_gigi->where('pengguna_id', $id)->get();

		$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama, 'kursus' => $dokter_gigi->kursus,
			'pendidikan' => $dokter_gigi->pendidikan_dokter, 'alamat'=> $dokter_gigi->alamat_prakitk, 'kodepos'=> $dokter_gigi->kode_pos);

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$Nama = $_POST['Nama'];
			$Tempat_Lahir = $_POST['Tempat_Lahir'];
			$Tanggal_Lahir = $_POST['Tanggal_Lahir'];
			$Warga_Negara = $_POST['Warga_Negara'];
			$Agama = $_POST['Agama'];
			
			$pengguna = new pengguna();
			//$pengguna->where('username', $_SESSION['admin'])->get();
			$pengguna->where('username', $_SESSION['pusat'])->update('nama',$Nama);
			$pengguna->where('username', $_SESSION['pusat'])->update('tempat_lahir',$Tempat_Lahir);
			$pengguna->where('username', $_SESSION['pusat'])->update('tanggal_lahir',$Tanggal_Lahir);
			$pengguna->where('username', $_SESSION['pusat'])->update('warga_negara',$Warga_Negara);
			$pengguna->where('username', $_SESSION['pusat'])->update('agama',$Agama);

			$dokter_gigi->where('pengguna_id', $id)->update('kursus', $_POST['kursus']);
			$dokter_gigi->where('pengguna_id', $id)->update('pendidikan_dokter', $_POST['pendidikan']);
			$dokter_gigi->where('pengguna_id', $id)->update('alamat_prakitk', $_POST['alamat']);	
			$dokter_gigi->where('pengguna_id', $id)->update('kode_pos', $_POST['kodepos']);

			$pengguna->where('username', $_SESSION['pusat'])->get();
			$dokter_gigi->where('pengguna_id', $id)->get();
			$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama, 'kursus' => $dokter_gigi->kursus,
			'pendidikan' => $dokter_gigi->pendidikan_dokter, 'alamat'=> $dokter_gigi->alamat_prakitk, 'kodepos'=> $dokter_gigi->kode_pos);
			$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Profile has been updated.
							</div>");
			$this->load->view('header-pusat', $data['menu']);
			$this->load->view('edit_profile-pusat', $data['array']);
			$this->load->view('footer');
		
		}else{
			$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active');
			$this->load->view('header-pusat', $data['menu']);
			$this->load->view('edit_profile-pusat', $data['array']);
			$this->load->view('footer');
		}
		
	}
	
	public function read2($n){
		session_start();
		if(!isset($_session['Username']))
			//redirect ("homepage");
		
		$Pasien = new pasien();
		$Merawat = new merawat();
		$Pasien->where('id', $n)->get();

		$data['array'] = array('content' => '<tr><td><b>Name</b></td><td>'.$Pasien->nama.'</td></tr>
			<tr><td><b>Tanggal_Lahir</b></td><td>'.$Pasien->tanggal_lahir.'</td`></tr>
			<tr><td><b>Tempat_Lahir</b></td><td>'.$Pasien->tempat_lahir.'</td></tr>
			<tr><td><b>Agama</b></td><td>'.$Pasien->agama.'</td></tr>
			<tr><td><b>Umur</b></td><td>'.$Pasien->umur.'</td></tr>
			<tr><td><b>Tinggi</b></td><td>'.$Pasien->tinggi.'</td></tr>
			<tr><td><b>Berat</b></td><td>'.$Pasien->berat.'</td></tr>
			<tr><td><b>Jenis_Kelamin</b></td><td>'.$Pasien->jenis_kelamin.'</td></tr>
			<tr><td><b>Alamat_Rumah</b></td><td>'.$Pasien->alamat_rumah.'</td></tr>
			<tr><td><b>Warga_Negara</b></td><td>'.$Pasien->warga_negara.'</td></tr>
			<tr><td><form method="post" action="../send_diagnose_to_admin/'.$n.'"><button type="submit" class="btn btn-primary pull-right">Send Diagnose to Admin</button></form></td>
			<td><form method="post" action="../create_diagnose/'.$n.'"><button type="submit" class="btn btn-primary">Send Reference</button></form>
			</td></tr>');

		$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal'=> '', 'inbox' => '', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('read2', $data['array']); 
		$this->load->view('footer');
	}


	public function read_data_citra(){
		 session_start();
		 if(!isset($_SESSION['pusat']))
		 	redirect ("homepage");
			
		$pasien = new pasien();
		$pasien->get();


		$merawat = new merawat();
		$merawat->get();
		if($pasien->result_count()!=0){
			$content = "<table class='table table-hover'>";
			$content .="<tr>
							<td><center><b><strong>Name</strong></b></center></td>
							<td><center><b><strong>Age</strong></b></center></td>
							<td><center><b><strong>Height</strong></b></center></td>
							<td><center><b><strong>Weight</strong></b></center></td>
							<td><center><b><strong>Gender</strong></b></center></td>
							<td><center><b><strong>Action</strong></b></center></td>
							</tr>";
			foreach($merawat as $row){
			$content .= "<tr>
							<td><center>".$pasien->where('id',$row->pasien_id)->get()->nama."</center></td>
							<td><center>".$pasien->where('id',$row->pasien_id)->get()->umur."</center></td>
							<td><center>".$pasien->where('id',$row->pasien_id)->get()->tinggi."</center></td>
							<td><center>".$pasien->where('id',$row->pasien_id)->get()->berat."</center></td>
							<td><center>".$pasien->where('id',$row->pasien_id)->get()->jenis_kelamin."</center></td>
							<td><center><a class='btn btn-primary' href='../pusat/read2/".$pasien->where('id',$row->pasien_id)->get()->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'> Detail</span></a> 
								
							</center></td></tr>";
			}
			$content .= "</table>";
			$data['array']=array('content'=> $content);
		}

		//$this->load->view('header-orthodonti');
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal'=> '', 'inbox' => '', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('read_data_citra', $data['array']);
		$this->load->view('footer');
	}

	public function change(){
		session_start();
		if(!isset($_SESSION['pusat']))
		redirect ("pusat");
		 if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$OldPassword = $_POST['OldPassword'];
			$NewPassword = $_POST['NewPassword'];
			$RNewPassword = $_POST['RNewPassword'];

			$pengguna = new pengguna();
			$pengguna->where('username', $_SESSION['pusat'])->get();
			
			$isRegistered = $pengguna->result_count() == 0 ? false : true;
			if($isRegistered){
				if($pengguna->username==$_SESSION['pusat']){
					if($pengguna->password == $OldPassword){
						if($NewPassword==$RNewPassword){
							$pengguna->where('username', $_SESSION['pusat'])->update('password',$NewPassword);
							$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  					<strong>Well done!</strong> Password has been changed.
									</div>");
							$this->load->view('header-pusat', $data['menu']);
							$this->load->view('changepassword-pusat');
							$this->load->view('footer');
						}else{
							$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Warning!</strong> Wrong new password.
							</div>");	
							$this->load->view('header-pusat', $data['menu']);
							$this->load->view('changepassword-pusat');
							$this->load->view('footer');
						}
					}else{
						$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
	  					<strong>Warning!</strong> Wrong password.
						</div>");
						$this->load->view('header-pusat', $data['menu']);
						$this->load->view('changepassword-pusat');
						$this->load->view('footer');
					}
				}
			}

		}else{
		$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('changepassword-pusat');
		$this->load->view('footer');
		}	
	}
	public function logout(){
			session_start();
			//hapus session
			session_destroy();
			//alihkan kehalaman login (index.php)
			redirect('homepage');
		}

function do_upload(){
		session_start();
		if(!isset($_SESSION['pusat']))
			redirect ("homepage");

		$config['upload_path'] = './uploads/images';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['max_size']	= '200';
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
		$config['file_name'] = md5($_SESSION['pusat']);
		$config['overwrite'] = true;

 
		$this->load->library('upload', $config);
 
		if (!$this->upload->do_upload()){
			$status['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<strong>Warning !</strong> Upload failure.
				</div>");
			$status['array']=array('content' => '<a href="edit_profile">Back to profile.</a>');
			$this->load->view('header-pusat', $status['menu']);
			$this->load->view('result-pusat', $status['array']);
			$this->load->view('footer');		
		}
		else{
			$data = $this->upload->data();
			$temp ="uploads/images/";
			$temp .= $config['file_name'];
			$temp .= $data['file_ext'];
			$pengguna = new pengguna();
			$pengguna->where('username', $_SESSION['pusat'])->update('foto', $temp);

			$status['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<strong>Well done!</strong> Photo profile successfully changed.
				</div>");
			$status['array']=array('content' => '<a href="edit_profile">Back to profile.</a>');
			$this->load->view('header-pusat', $status['menu']);
			$this->load->view('result-pusat', $status['array']);
			$this->load->view('footer');
			//$this->load->vfprintf(handle, format, args)iew('admin', $data);
		}
	}

	public function send_diagnose_to_admin($n){
		//session_start();
		session_start();
		if(!isset($_SESSION['pusat']))
		redirect ("homepage");
		
			$data['array'] = array('n' => $n);
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal'=> '', 'inbox' => '', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('send_diagnose_to_admin', $data['array']);
		$this->load->view('footer');

		}


		public function send_diagnose_to_admin_lagi($n){
		//session_start();
		session_start();
		if(!isset($_SESSION['pusat']))
		redirect ("homepage");
		
		 	$skor = $_POST['skor'];
		 	$maloklusi_menurut_angka = $_POST['maloklusi_menurut_angka'];
		 	$diagnosis_rekomendasi = $_POST['diagnosis_rekomendasi'];
			
		 	$analisi = new analisi();
		 	$dokter_gigi = new dokter_gigi();
		 	$pengguna = new pengguna();

		 		$analisi->pasien_id=$n;
		 		$analisi->skor = $skor;
		 		$analisi->maloklusi_menurut_angka = $maloklusi_menurut_angka;
		 		$analisi->diagnosis_rekomendasi = $diagnosis_rekomendasi;

		 		$pengguna->where('username', $_SESSION['pusat'])->get();		
		 		$analisi->orto_id= $pengguna->id;
		 		$analisi->flag_menerima= '1';
		 		$analisi->flag_mengirim= '1';

		 		$analisi->save();

									
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal'=> '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Diagnose has been sent.
							</div>", 'content' => '<a href="../read_data_citra">Back to patient list.</a>');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('result-pusat');
		$this->load->view('footer');

		}
	
		public function listrujukan(){
		session_start();
		if(!isset($_SESSION['pusat']))
			redirect ("homepage");
		
		$content ="";
		$merawat = new merawat();
		$merawat->get();
		$pasien= new pasien();
        $pengguna = new pengguna();
		if($merawat->result_count!==0){
			$content .='<table class="table">
						<tr>
							<td><center><b>Id Pasien</b></center></td>
			                <td><center><b>Nama Pasien</b></center></td>
			                <td><center><b>Nama Dokter Umum/Spesialis Lain</b></center></td>
			                <td><center><b>Nama Dokter Spesialis Orthodontist Selain Pusat</b></center></td>
			                <td><center><b>Operation</b></center></td>
						</tr>';
			foreach($merawat as $row){
				$content .= "<tr><td><center>".$row->pasien_id."</center></td>
                                <td><center>".$pasien->where('id', $row->pasien_id)->get()->nama."</center></td>
                                <td><center>".$pengguna->where('id', $row->umum_id)->get()->nama."</center></td>
                                <td><center>".$pengguna->where('id', $row->orto_id)->get()->nama."</center></td>
                                <td><center><a class='btn btn-primary' href='show_rujukan/".$row->pasien_id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'> Detail</span></a></center></td>
                                </tr>";
            }
			$content .= '</table>';
		}
		
		$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => 'active', 'setting' => '', 'content'=>$content);
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('listrujukan');
		$this->load->view('footer');
	}	
	public function show_rujukan($n){
		session_start();
		if(!isset($_session['pusat']))
			//redirect ("homepage");
		
		$pasien = new pasien();
		$pasien->where('id', $n)->get();

		$data['array'] = array('content' => '<tr><td><b>Id pasien</b></td><td>'.$pasien->id.'</td></tr>
			<tr><td><b>Nama</b></td><td>'.$pasien->nama.'</td`></tr>
			<tr><td><b>Tanggal Lahir</b></td><td>'.$pasien->tanggal_lahir.'</td></tr>
			<tr><td><b>Tempatlahir</b></td><td>'.$pasien->tempat_lahir.'</td></tr>
			<tr><td><b>Agama</b></td><td>'.$pasien->agama.'</td></tr>
			<tr><td><b>Umur</b></td><td>'.$pasien->umur.'</td></tr>
			<tr><td><b>Alamat Rumah</b></td><td>'.$pasien->alamat_rumah.'</td></tr>
			<tr><td><b>Tinggi</b></td><td>'.$pasien->tinggi.'</td></tr>
			<tr><td><b>Berat</b></td><td>'.$pasien->berat.'</td></tr>
			<tr><td><b>Jenis Kelamin</b></td><td>'.$pasien->jenis_kelamin.'</td></tr>
			<tr><td><b>Warga_Negara</b></td><td>'.$pasien->warga_negara.'</td></tr>

			</td></tr>');

		$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => 'active', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('show_rujukan', $data['array']); 
		$this->load->view('footer');
	}

	public function create_diagnose($n){
		session_start();
		
		if(!isset($_SESSION['pusat']))
			redirect ("homepage");
		
		$data['array']=array('n'=>$n);
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal'=> '', 'inbox' => '', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);

		//$this->load->view('header-pusat');
		$this->load->view('create_diagnose', $data['array']);
		$this->load->view('footer');
		
	}

public function save_diagnose($n){
		session_start();
				
		if(!isset($_SESSION['pusat']))
			redirect ("homepage");		

			$tanggal = $_POST['tanggal'];
			$skor = $_POST['Skor'];
			$maloklusi= $_POST['Maloklusi'];
			$diagnose = $_POST['Diagnose'];
			$foto = $_POST['Foto'];

			$analisi = new analisi();
			$rujukan = new rujukan();
			$pengguna = new pengguna();
			$merawat = new merawat();
			$mengirim = new mengirim();

			$analisi->tanggal=$tanggal;
			$analisi->pasien_id=$n;
			$analisi->skor=$skor;
			$analisi->maloklusi_menurut_angka=$maloklusi;
			$analisi->diagnosis_rekomendasi=$diagnose;
			$pengguna->where('username', $_SESSION['pusat'])->get();
			$analisi->orto_id=$pengguna->id;
			$analisi->foto=$foto;

			$merawat->where('pasien_id', $n)->get();
			$mengirim->umum_id=$merawat->umum_id;
			$mengirim->pusat_id=$merawat->pusat_id;

			$analisi->flag_mengirim='2';

			$analisi->save();
			redirect("pusat/send_reference/$n");
	}
		public function send_reference($n){
		session_start();
			
		if(!isset($_SESSION['pusat']))
			redirect ("homepage");
							
		$option="";
		
		$pengguna = new pengguna();
		$pengguna->get();
		foreach ($pengguna as $row) {
			if($row->role == 'orthodonti')
				$option .= "<option value='".$row->nama."'>".$row->nama."</option>";
		}		 

		//$data['array'] = array('n' => $n);
		$data['array'] = array('content' => $option, 'n'=> $n);	
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal'=> '', 'inbox' => '', 'setting' => '');				
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('send_reference', $data['array']);
		$this->load->view('footer');
	}

	public function save_reference($n){
		session_start();
			
		if(!isset($_SESSION['pusat']))
			redirect ("homepage");

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
		 	$kandidat1 = $_POST['nama'];

			$pengguna = new pengguna();
		 	$mengirim = new mengirim();
		 	$merawat = new merawat();
		 	$analisi = new analisi();
		 	$pusat = new pusat();

		 	$mengirim->kandidat1=$kandidat1;

		 	$pengguna->where('username', $_SESSION['pusat'])->get();		
		 	$mengirim->pusat_id= $pengguna->id;
		 	$analisi->where('pasien_id', $n);
		 	$analisi->order_by('id', 'desc')->get();

		 	$mengirim->analisis_id=$analisi->id;
	 	
	 		$merawat->where('pasien_id', $analisi->pasien_id)->get();
		 	$mengirim->umum_id=$merawat->umum_id;
			 	
		 	$mengirim->orto_id=$merawat->orto_id;
		 	$mengirim->pusat_id=$analisi->orto_id;
		 	$mengirim->save();

			$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal'=> '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		 	 				<strong>Well done!</strong> Diagnose has been sent.
							</div>", 'content' => '<a href="../read_data_citra">Back to patient list.</a>');
			$this->load->view('header-pusat', $data['menu']);
			$this->load->view('result-pusat');
			$this->load->view('footer');								
		}
		
	}

}
?>