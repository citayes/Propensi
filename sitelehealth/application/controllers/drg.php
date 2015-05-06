<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DRG extends CI_Controller {
	public function index(){
		//session_start();
		session_start();
		if(!isset($_SESSION['drg']))
			redirect ("homepage");

		$data['menu'] = array('home' => 'active', 'pasien' => '', 'inbox' => '', 'setting' => '');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('drg');
		$this->load->view('footer');
	}
	public function pasien(){
		//session_start();
		session_start();
		if(!isset($_SESSION['drg']))
			redirect ("../homepage");		

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$Nama = $_POST['Name'];
			$Tempat_Lahir = $_POST['PlaceofBirth'];
			$Tanggal_Lahir = $_POST['DateofBirth'];
			$Umur = $_POST['Age'];
			$Alamat = $_POST['Address'];
			$Tinggi = $_POST['Height'];
			$Berat = $_POST['Weight'];
			$Jenis_Kelamin = $_POST['Gender'];
			$Warga_Negara = $_POST['Nationality'];
			$Agama = $_POST['Religion'];
			$Skor_PAR = $_POST['Par'];

			$pengguna = new pengguna();
			$pengguna->where('username', $_SESSION['drg'])->get();
			$idDokter = $pengguna->id;
			$Pasien = new pasien();
			
			$Pasien->nama=$Nama;
			$Pasien->tempat_lahir=$Tempat_Lahir;
			$Pasien->tanggal_lahir=$Tanggal_Lahir;
			$Pasien->umur=$Umur;
			$Pasien->alamat_rumah=$Alamat;
			$Pasien->tinggi=$Tinggi;
			$Pasien->berat=$Berat;
			$Pasien->jenis_kelamin=$Jenis_Kelamin;
			$Pasien->warga_negara=$Warga_Negara;
			$Pasien->agama=$Agama;
			$Pasien->doktergigi_id=$idDokter;
			$Pasien->save();

			$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  					<strong>Well done!</strong> Patient has been created.
									</div>");
			$this->load->view('header-drg', $data['menu']);
			$this->load->view('pasien');
			$this->load->view('footer');
		}else{
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('pasien');
		$this->load->view('footer');
		}
	}

		public function edit_profile(){
		session_start();
		if(!isset($_SESSION['drg']))
			redirect ("homepage");
		
		$pengguna = new pengguna();
		$pengguna->where('username', $_SESSION['drg'])->get();
		$id = $pengguna->id;
		$dokter_gigi = new dokter_gigi();
		$dokter_gigi->where('pengguna_id', $id)->get();
		$drg_lain = new drg_lain();
		$drg_lain->where('pengguna_id', $id)->get();
		//echo $drg_lain->where('pengguna_id', $id)->pengguna_id;

		$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama, 'kursus' => $dokter_gigi->kursus,
			'pendidikan' => $dokter_gigi->pendidikan_dokter, 'alamat'=> $dokter_gigi->alamat_prakitk, 'kodepos'=> $dokter_gigi->kode_pos,
			'kursus_orthodonti'=> $drg_lain->kursus_ortodonti, 'jadwal'=>$drg_lain->jadwal_praktik);

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$Nama = $_POST['Nama'];
			$Tempat_Lahir = $_POST['Tempat_Lahir'];
			$Tanggal_Lahir = $_POST['Tanggal_Lahir'];
			$Warga_Negara = $_POST['Warga_Negara'];
			$Agama = $_POST['Agama'];
			
			$pengguna = new pengguna();
			//$pengguna->where('username', $_SESSION['admin'])->get();
			$pengguna->where('username', $_SESSION['drg'])->update('nama',$Nama);
			$pengguna->where('username', $_SESSION['drg'])->update('tempat_lahir',$Tempat_Lahir);
			$pengguna->where('username', $_SESSION['drg'])->update('tanggal_lahir',$Tanggal_Lahir);
			$pengguna->where('username', $_SESSION['drg'])->update('warga_negara',$Warga_Negara);
			$pengguna->where('username', $_SESSION['drg'])->update('agama',$Agama);
			$dokter_gigi= new dokter_gigi();
			$dokter_gigi->where('pengguna_id', $id)->update('kursus', $_POST['kursus']);
			$dokter_gigi->where('pengguna_id', $id)->update('pendidikan_dokter', $_POST['pendidikan']);
			$dokter_gigi->where('pengguna_id', $id)->update('alamat_prakitk', $_POST['alamat']);	
			$dokter_gigi->where('pengguna_id', $id)->update('kode_pos', $_POST['kodepos']);
			$drg_lain = new drg_lain();
			$drg_lain->where('pengguna_id', $id)->update('kursus_ortodonti', $_POST['kursus_orthodonti']);
			$drg_lain->where('pengguna_id', $id)->update('jadwal_praktik', $_POST['jadwal']);

			$pengguna->where('username', $_SESSION['drg'])->get();
			$id = $pengguna->id;
			$dokter_gigi->where('pengguna_id', $id)->get();
			$drg_lain->where('pengguna_id', $id)->get();


			$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama, 'kursus' => $dokter_gigi->kursus,
			'pendidikan' => $dokter_gigi->pendidikan_dokter, 'alamat'=> $dokter_gigi->alamat_prakitk, 'kodepos'=> $dokter_gigi->kode_pos,
			'kursus_orthodonti'=> $drg_lain->kursus_ortodonti, 'jadwal'=>$drg_lain->jadwal_praktik);
			$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Profile has been updated.
							</div>");
			$this->load->view('header-drg', $data['menu']);
			$this->load->view('edit_profile-drg', $data['array']);
			$this->load->view('footer');
		}else{
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('edit_profile-drg', $data['array']);
		$this->load->view('footer');
		}

	
	}
	
	public function read($n){
		 session_start();
		 if(!isset($_SESSION['drg']))
			redirect ("homepage");

		$pasien = new pasien();
		//$pasien->get();
		$pasien->where('id', $n)->get();

		$data['array'] = array('content' => '<tr><td><b>Name</b></td><td>'.$pasien->nama.'</td></tr>
			<tr><td><b>Birth Date</b></td><td>'.$pasien->tanggal_lahir.'</td></tr>
			<tr><td><b>Place of Birth</b></td><td>'.$pasien->tempat_lahir.'</td></tr>
			<tr><td><b>Religion</b></td><td>'.$pasien->agama.'</td></tr>
			<tr><td><b>Age</b></td><td>'.$pasien->umur.'</td></tr>
			<tr><td><b>Height</b></td><td>'.$pasien->tinggi.'</td></tr>
			<tr><td><b>Weight</b></td><td>'.$pasien->berat.'</td></tr>
			<tr><td><b>Gender</b></td><td>'.$pasien->jenis_kelamin.'</td></tr>
			<tr><td><b>Address</b></td><td>'.$pasien->alamat_rumah.'</td></tr>
			<tr><td><b>Nationality</b></td><td>'.$pasien->warga_negara.'</td></tr>
			<tr><td><form method="post" action="../medical_record/'.$n.'"><button type="submit" class="btn btn-primary pull-right">Add Medical Record</button></form></td>
			<td><form method="post" action="../list_medical_record/'.$n.'"><button type="submit" class="btn btn-primary pull-right">View Medical Record</button></form></td>
			<td><form method="post" action="../send_data/'.$n.'"><button type="submit" class="btn btn-primary ">Send to FKG UI</button></form>
			</td></tr>');


		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('read', $data['array']); 
		$this->load->view('footer');
	}

	public function pasien_read(){
		  session_start();
		  if(!isset($_SESSION['drg']))
		  	redirect ("homepage");
		
		$pengguna = new pengguna();
		$pengguna->where('username', $_SESSION['drg'])->get();
		$idDokter = $pengguna->id;
		//echo $idDokter;
		$pasien = new pasien();
		$pasien->get();
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
			foreach($pasien as $row){
				if($row->doktergigi_id == $idDokter){
					//echo $row->doktergigi_id;
					//echo $idDokter;
					$content .= "<tr>
								<td><center>".$row->nama."</center></td>
								<td><center>".$row->umur."</center></td>
								<td><center>".$row->tinggi."</center></td>
								<td><center>".$row->berat."</center></td>
								<td><center>".$row->jenis_kelamin."</center></td>
								<td><center><a class='btn btn-primary' href='../drg/read/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a> 
									<a class='btn btn-warning' href='../drg/pasien_update2/".$row->id."'><span class='glyphicon glyphicon-pencil' aria-hidden='false'></span></a>
									<a class='btn btn-danger' href='../drg/delete1/".$row->id."'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
								</center></td></tr>";
				}
			}
			$content .= "</table>";
			$data['array']=array('content'=> $content);
		}

		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('pasien_read', $data['array']);
		$this->load->view('footer');
	}


	public function pasien_delete(){
		session_start();
		 if(!isset($_SESSION['drg']))
		 	redirect ("homepage");

		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('pasien_delete');
		$this->load->view('footer');
	}

	public function change(){
		session_start();
		 if(!isset($_SESSION['drg']))
		 	redirect ("homepage");

		 if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$OldPassword = $_POST['OldPassword'];
			$NewPassword = $_POST['NewPassword'];
			$RNewPassword = $_POST['RNewPassword'];

			$pengguna = new pengguna();
			$pengguna->where('username', $_SESSION['drg'])->get();
			
			$isRegistered = $pengguna->result_count() == 0 ? false : true;
			if($isRegistered){
				if($pengguna->username==$_SESSION['drg']){
					if($pengguna->password == $OldPassword){
						if($NewPassword==$RNewPassword){
							$pengguna->where('username', $_SESSION['drg'])->update('password',$NewPassword);
							$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  					<strong>Well done!</strong> Password has been changed.
									</div>");	
							$this->load->view('header-drg', $data['menu']);
							$this->load->view('changepassword-drg');
							$this->load->view('footer');
						}else{
						$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
										<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					  					<strong>Warning!</strong> Wrong new password.
										</div>");	
						$this->load->view('header-drg', $data['menu']);
						$this->load->view('changepassword-drg');
						$this->load->view('footer');
						}
					}else{
						$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Warning!</strong> Wrong password.
							</div>");	
					$this->load->view('header-drg', $data['menu']);
					$this->load->view('changepassword-drg');
					$this->load->view('footer');
					}
				}
			}
		}else{
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('changepassword-drg');
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
		if(!isset($_SESSION['drg']))
			redirect ("homepage");

		$config['upload_path'] = './uploads/images';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['max_size']	= '2000';
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
		$config['file_name'] = md5($_SESSION['drg']);
		$config['overwrite'] = true;

 
		$this->load->library('upload', $config);
 
		if (!$this->upload->do_upload()){
			$status['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<strong>Warning !</strong> Upload failure.
				</div>");
			$status['array']=array('content' => '<a href="edit_profile">Back to profile.</a>');
			$this->load->view('header-drg', $status['menu']);
			$this->load->view('result-drg', $status['array']);
			$this->load->view('footer');		
		}
		else{
			$data = $this->upload->data();
			$temp ="uploads/images/";
			$temp .= $config['file_name'];
			$temp .= $data['file_ext'];
			$pengguna = new pengguna();
			$pengguna->where('username', $_SESSION['drg'])->update('foto', $temp);

			$status['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<strong>Well done!</strong> Photo profile successfully changed.
				</div>");
			$status['array']=array('content' => '<a href="edit_profile">Back to profile.</a>');
			$this->load->view('header-drg', $status['menu']);
			$this->load->view('result-drg', $status['array']);
			$this->load->view('footer');
			//$this->load->vfprintf(handle, format, args)iew('admin', $data);
		}
	}

	public function medical_record($n){
		//session_start();
		session_start();
		if(!isset($_SESSION['drg']))
			redirect ("../homepage");

		$data['array'] = array('n' => $n);
		
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('medical_record', $data['array']);
		$this->load->view('footer');
	}	

	public function list_medical_record($n){
		  session_start();
		  if(!isset($_SESSION['drg']))
		  	redirect ("homepage");
		
		$medical_record = new medical_record();
		$pasien = new pasien();
		$medical_record->where('id', $n)->get();


		if($medical_record->result_count()!=0){
			echo("ets");
			$content = "<table class='table table-hover'>";
			$content .="<tr>
							<td><center><b><strong>ID Medical Record</strong></b></center></td>
							<td><center><b><strong>Tanggal</strong></b></center></td>
							</tr>";
			foreach($medical_record as $row){
				if($row->doktergigi_id == $idDokter){
					//echo $row->doktergigi_id;
					//echo $idDokter;
					$content .= "<tr>

								<td><center>".$row->id."</center></td>
								<td><center>".$row->tanggal."</center></td>
								<td><center><a class='btn btn-primary' href='../drg/view_medical_record/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a> 
								</center></td></tr>";
				}
			}
			$content .= "</table>";
			$data['array']=array('content'=> $content);
			$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
			$this->load->view('header-drg', $data['menu']);
			$this->load->view('list_medical_record', $data['array']);
			$this->load->view('footer');
		}
			$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
			$this->load->view('header-drg', $data['menu']);
			$this->load->view('list_medical_record');
			$this->load->view('footer');
	}


	public function view_medical_record($n){
		 session_start();
		 if(!isset($_SESSION['drg']))
			redirect ("homepage");

		$medical_record = new medical_record();
		$medical_record->where('id', $n)->get();

		$data['array'] = array('content' => '<tr><td><b>Name</b></td><td>'.$medical_record->id.'</td></tr>
			<tr><td><b>Birth Date</b></td><td>'.$medical_record->tanggal.'</td></tr>
			<tr><td><b>Place of Birth</b></td><td>'.$medical_record->jam.'</td></tr>
			<tr><td><b>Religion</b></td><td>'.$medical_record->deskripsi.'</td></tr>
			</td></tr>');


		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('view_medical_record', $data['array']); 
		$this->load->view('footer');
	}

	public function simpan_medical_record($n){
		//session_start();
		session_start();
		if(!isset($_SESSION['drg']))
			redirect ("../homepage");

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$tanggal = $_POST['tanggal'];
			$jam = $_POST['jam'];
			$deskripsi = $_POST['deskripsi'];

			$pengguna = new pengguna();
			$medical_record = new medical_record();

			$pengguna->where('username', $_SESSION['drg'])->get();		
		 		$medical_record->umum_id= $pengguna->id;
			$medical_record->tanggal=$tanggal;
			$medical_record->jam=$jam;
			$medical_record->deskripsi=$deskripsi;
			$medical_record->pasien_id=$n;
			$medical_record->save();

		$data['array']= array('content' => '<a href ="../pasien_read">Back to Patient List.</a>');
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Patient data has been saved.
							</div>");
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('result-drg', $data['array']);
		$this->load->view('footer');

		}

	}

			public function send_diagnose_to_admin($n){
		//session_start();
		session_start();
		if(!isset($_SESSION['drg']))
		redirect ("homepage");
		

		 if($_SERVER['REQUEST_METHOD'] == 'POST'){
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

		 		$pengguna->where('username', $_SESSION['drg'])->get();		
		 		$analisi->orto_id= $pengguna->id;
		 		$analisi->flag_menerima= '1';
		 		$analisi->flag_mengirim= '1';

		 		$analisi->save();

					//redirect('admin/send_diagnose_to_admin');							
			}
			$data['array'] = array('n' => $n);
		
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('send_diagnose_to_admin', $data['array']);
		$this->load->view('footer');

		}

	public function list_reference_drg(){
		session_start();
		if(!isset($_SESSION['drg']))
			redirect ("homepage");
		
		$content="";
		$mengirim = new mengirim();
		$mengirim->get();
		$pengguna = new pengguna;
		$pengguna->where('username', $_SESSION['drg'])->get();		
		$lala = $pengguna->id;
		$content.='<table class="table">
				<tr>
				<td><center><b>Id Analisa</center></b></td>
				<td><center><b>Id Dokter</center></b></td>
				<td><center><b>Nama Dokter</center></b></td>
				<td><center><b>Operation</center></b></td>
			</tr>';
		foreach($mengirim as $row){
			if($row->umum_id==$lala && $row->pusat_id!=null){
				$nama_pusat = new pengguna();
				$nama_pusat->where('id', $row->pusat_id)->get();
				$content .= "<tr><td><center>".$row->analisis_id."</center></a></td>
								<td><center>".$row->umum_id."</center></td>
								<td><center>".$nama_pusat->nama."</center></td>
								<td><center><a class='btn btn-primary' href='../drg/reference_drg/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a></center></td></tr>";
			}
		} 
				
		$content.='</table>';

		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'setting' => '', 'content'=>$content);
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('list_reference_drg');
		$this->load->view('footer');
	}

			public function send_data($n){
		//session_start();
		session_start();
		if(!isset($_SESSION['drg']))
		redirect ("homepage");
		
		 if($_SERVER['REQUEST_METHOD'] == 'POST'){
		 	$pengguna = new pengguna();
		 	$merawat = new merawat();

		 		$pengguna->where('username', $_SESSION['drg'])->get();
		 		$id = $pengguna->id;
		 		$merawat->pasien_id=$n;
		 		$merawat->umum_id= $id;
		 		$merawat->save();

					//redirect('admin/send_diagnose_to_admin');							
			}
		$data['array']= array('content' => '<a href ="../pasien_read">Back to Patient List.</a>');
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Patient data has been sent.
							</div>");
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('result-drg', $data['array']);
		$this->load->view('footer');
		}

		public function pasien_update2($n){
		session_start();
		if(!isset($_SESSION['drg']))
			redirect ("homepage");

		$pasien = new pasien();
		$pasien->where('id', $n)->get();
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$Nama = $_POST['Nama'];
			$Tempat_Lahir = $_POST['Tempat_Lahir'];
			$Tanggal_Lahir = $_POST['Tanggal_Lahir'];
			$Umur = $_POST['Umur'];
			$Alamat = $_POST['Alamat_Rumah'];
			$Tinggi = $_POST['Tinggi'];
			$Berat = $_POST['Berat'];
			$Warga_Negara = $_POST['Warga_Negara'];
			$Agama = $_POST['Agama'];
			
			$pasien = new pasien();
			//$pengguna->where('username', $_SESSION['admin'])->get();
			$pasien->where('id', $n)->update('nama',$Nama);
			$pasien->where('id', $n)->update('tempat_lahir',$Tempat_Lahir);
			$pasien->where('id', $n)->update('tanggal_lahir',$Tanggal_Lahir);
			$pasien->where('id', $n)->update('umur',$Umur);
			$pasien->where('id', $n)->update('alamat_rumah',$Alamat);
			$pasien->where('id', $n)->update('tinggi',$Tinggi);
			$pasien->where('id', $n)->update('berat',$Berat);
			$pasien->where('id', $n)->update('warga_negara',$Warga_Negara);
			$pasien->where('id', $n)->update('agama',$Agama);

			$pasien->where('id', $n)->get();
			$data['array'] = array('nama' => $pasien->nama, 'tempat_lahir' => $pasien->tempat_lahir, 'tanggal_lahir' => $pasien->tanggal_lahir, 'umur'=>$pasien->umur,
			'alamat_rumah'=>$pasien->alamat_rumah, 'tinggi'=>$pasien->tinggi, 'berat'=>$pasien->berat, 'warga_negara' => $pasien->warga_negara, 'agama' => $pasien->agama);
			$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Patient data has been updated.
							</div>");	
			$this->load->view('header-drg', $data['menu']);
			$this->load->view('pasien_update2', $data['array']);
			$this->load->view('footer');
		}else{
		$data['array'] = array('nama' => $pasien->nama, 'tempat_lahir' => $pasien->tempat_lahir, 'tanggal_lahir' => $pasien->tanggal_lahir, 'umur'=>$pasien->umur,
			'alamat_rumah'=>$pasien->alamat_rumah, 'tinggi'=>$pasien->tinggi, 'berat'=>$pasien->berat, 'warga_negara' => $pasien->warga_negara, 'agama' => $pasien->agama);
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '');	
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('pasien_update2', $data['array']);
		$this->load->view('footer');
		}
	}
	
	public function pasien_update(){
		// session_start();
		//  if(!isset($_session['Username']))
		//  	redirect ("homepage");
		$this->load->view('header-drg');
		$this->load->view('pasien_update');
		$this->load->view('footer');
	}

	public function delete1($id){
		session_start();
		if(!isset($_SESSION['drg']))
			redirect ("homepage");

		$this->load->model('penggunas');
		$status = $this->penggunas->deletePasien($id);
		if($status)
			redirect("drg/pasien_read");
	}


	public function reference_drg($n){
		  session_start();
		  if(!isset($_SESSION['drg']))
		  	redirect ("homepage");
		
		$pengguna = new pengguna();
		$pengguna->where('username', $_SESSION['drg'])->get();
		$mengirim = new mengirim();
		$mengirim->where('id', $n)->get();
		$analisis_id= $mengirim->analisis_id;
		$analisis = new analisi();
		$analisis->where('id', $analisis_id)->get();


		if($mengirim->result_count()!=0){
			$content = "<table class='table table-hover'>";
			$content .="<tr>
							<td><center><b><strong>Tanggal</strong></b></center></td>
							<td><center><b><strong>Admin</strong></b></center></td>
							<td><center><b><strong>Dokter FKG Pusat</strong></b></center></td>
							<td><center><b><strong>Pasien id</strong></b></center></td>
							<td><center><b><strong>Nama Pasien</strong></b></center></td>
							<td><center><b><strong>Skor PAR</strong></b></center></td>
							<td><center><b><strong>Maloklusi Menurut Angka</strong></b></center></td>
							<td><center><b><strong>Diagnosis</strong></b></center></td>
							<td><center><b><strong>Kandidat 1</strong></b></center></td>
							<td><center><b><strong>Kandidat 2</strong></b></center></td>
							<td><center><b><strong>Kandidat 3</strong></b></center></td>
							<td><center><b><strong>Kandidat 4</strong></b></center></td>
							<td><center><b><strong>Kandidat 5</strong></b></center></td>
							</tr>";
			foreach($mengirim as $row){
				foreach($analisis as $row1){
				$nama_pusat = new pengguna();
				$nama_pusat->where('id', $row->pusat_id)->get();
				$nama_admin = new pengguna();
				$nama_admin->where('id', $row->admin_id)->get();
				$nama_pasien = new pasien();
				$nama_pasien->where('id', $row1->pasien_id)->get();
					$content .= "<tr>
								<td><center>".$row->tanggal."</center></td>
								<td><center>".$nama_admin->nama."</center></td>
								<td><center>".$nama_pusat->nama."</center></td>
								<td><center>".$row1->pasien_id."</center></td>
								<td><center>".$nama_pasien->nama."</center></td>
								<td><center>".$row1->skor."</center></td>
								<td><center>".$row1->maloklusi_menurut_angka."</center></td>
								<td><center>".$row1->diagnosis_rekomendasi."</center></td>
								<td><center>".$row->kandidat1."</center></td>
								<td><center>".$row->kandidat2."</center></td>
								<td><center>".$row->kandidat3."</center></td>
								<td><center>".$row->kandidat4."</center></td>
								<td><center>".$row->kandidat5."</center></td>
								<td><center><a class='btn btn-primary' href='../drg/read/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a> 
									<a class='btn btn-warning' href='../drg/pasien_update2/".$row->id."'><span class='glyphicon glyphicon-pencil' aria-hidden='false'></span></a>
									<a class='btn btn-danger' href='../drg/delete1/".$row->id."'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
								</center></td></tr>";
				}
			}
			$content .= "</table>";
			$data['array']=array('content'=> $content);
		}



		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('pasien_read', $data['array']);
		$this->load->view('footer');
	}

}
?>