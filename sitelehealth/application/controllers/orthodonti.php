<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orthodonti extends CI_Controller {
	public function index(){
		//session_start();
		session_start();
		if(!isset($_SESSION['orthodonti']))
			redirect ("homepage");
		
		$data['menu'] = array('home' => 'active', 'pasien' => '', 'inbox' => '', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('orthodonti');
		$this->load->view('footer');
	}

		public function edit_profile(){
		session_start();
		if(!isset($_SESSION['orthodonti']))
			redirect ("homepage");
		$pengguna = new pengguna();
		$pengguna->where('username', $_SESSION['orthodonti'])->get();
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
			$pengguna->where('username', $_SESSION['orthodonti'])->update('nama',$Nama);
			$pengguna->where('username', $_SESSION['orthodonti'])->update('tempat_lahir',$Tempat_Lahir);
			$pengguna->where('username', $_SESSION['orthodonti'])->update('tanggal_lahir',$Tanggal_Lahir);
			$pengguna->where('username', $_SESSION['orthodonti'])->update('warga_negara',$Warga_Negara);
			$pengguna->where('username', $_SESSION['orthodonti'])->update('agama',$Agama);
			$dokter_gigi = new dokter_gigi();
			$dokter_gigi->where('pengguna_id', $id)->update('kursus', $_POST['kursus']);
			$dokter_gigi->where('pengguna_id', $id)->update('pendidikan_dokter', $_POST['pendidikan']);
			$dokter_gigi->where('pengguna_id', $id)->update('alamat_prakitk', $_POST['alamat']);	
			$dokter_gigi->where('pengguna_id', $id)->update('kode_pos', $_POST['kodepos']);

			$pengguna->where('username', $_SESSION['orthodonti'])->get();
			$id = $pengguna->id;
			$dokter_gigi->where('pengguna_id', $id)->get();
			$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama, 'kursus' => $dokter_gigi->kursus,
			'pendidikan' => $dokter_gigi->pendidikan_dokter, 'alamat'=> $dokter_gigi->alamat_prakitk, 'kodepos'=> $dokter_gigi->kode_pos);
			$data['menu'] =array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Profile has been updated.
							</div>");
			$this->load->view('header-orthodonti', $data['menu']);
			$this->load->view('edit_profile-orthodonti', $data['array']);
			$this->load->view('footer');
		}else{
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('edit_profile-orthodonti', $data['array']);
		$this->load->view('footer');
		}
	}
		
	public function change(){
		session_start();
		if(!isset($_SESSION['orthodonti']))
			redirect ("homepage");

		 if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$OldPassword = $_POST['OldPassword'];
			$NewPassword = $_POST['NewPassword'];
			$RNewPassword = $_POST['RNewPassword'];

			$pengguna = new pengguna();
			$pengguna->where('username', $_SESSION['orthodonti'])->get();
			
			$isRegistered = $pengguna->result_count() == 0 ? false : true;
			if($isRegistered){
				if($pengguna->username==$_SESSION['orthodonti']){
					if($pengguna->password == $OldPassword){
						if($NewPassword==$RNewPassword){
							$pengguna->where('username', $_SESSION['orthodonti'])->update('password',$NewPassword);
							$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  					<strong>Well done!</strong> Password has been changed.
									</div>");	
							$this->load->view('header-orthodonti', $data['menu']);
							$this->load->view('changepassword-orthodonti');
							$this->load->view('footer');
						}else{
							$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  					<strong>Warning!</strong> Wrong new password.
									</div>");	
							$this->load->view('header-orthodonti', $data['menu']);
							$this->load->view('changepassword-orthodonti');
							$this->load->view('footer');
						}
						
					}else{
						$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Warning!</strong> Wrong password.
							</div>");	
						$this->load->view('header-orthodonti', $data['menu']);
						$this->load->view('changepassword-orthodonti');
						$this->load->view('footer');
					}
				}
			}

		}else{
			$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active');
			$this->load->view('header-orthodonti', $data['menu']);
			$this->load->view('changepassword-orthodonti');
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
		if(!isset($_SESSION['orthodonti']))
			redirect ("homepage");

		$config['upload_path'] = './uploads/images';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['max_size']	= '2000';
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
		$config['file_name'] = md5($_SESSION['orthodonti']);
		$config['overwrite'] = true;

 
		$this->load->library('upload', $config);
 
		if (!$this->upload->do_upload()){
			$status['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<strong>Warning !</strong> Upload failure.
				</div>");
			$status['array']=array('content' => '<a href="edit_profile">Back to profile.</a>');
			$this->load->view('header-orthodonti', $status['menu']);
			$this->load->view('result-orthodonti', $status['array']);
			$this->load->view('footer');		
		}
		else{
			$data = $this->upload->data();
			$temp ="uploads/images/";
			$temp .= $config['file_name'];
			$temp .= $data['file_ext'];
			$pengguna = new pengguna();
			$pengguna->where('username', $_SESSION['orthodonti'])->update('foto', $temp);

			$status['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<strong>Well done!</strong> Photo profile successfully changed.
				</div>");
			$status['array']=array('content' => '<a href="edit_profile">Back to profile.</a>');
			$this->load->view('header-orthodonti', $status['menu']);
			$this->load->view('result-orthodonti', $status['array']);
			$this->load->view('footer');
			//$this->load->vfprintf(handle, format, args)iew('admin', $data);
		}
	}

	public function list_reference(){
		session_start();
		if(!isset($_SESSION['orthodonti']))
			redirect ("homepage");
		$content="";
		$mengirim = new mengirim();
		$mengirim->get();

		$pengguna = new pengguna;
		$pengguna->where('username', $_SESSION['orthodonti'])->get();		
 		$lala = $pengguna->id;
		$content .= '<table class="table">
				<tr>
				<td><center><b>Id Analisa</center></b></td>
				<td><center><b>Id Dokter</center></b></td>
				<td><center><b>Nama Dokter</center></b></td>
				<td><center><b>Operation</center></b></td>
			</tr>';				
		foreach($mengirim as $row){
			if($row->orto_id==$lala){
				$nama_pusat = new pengguna();
				$nama_pusat->where('id', $row->pusat_id)->get();
				$content .= "<tr><td><center>".$row->analisis_id."</center></a></td>
								<td><center>".$row->orto_id."</center></td>
								<td><center>".$nama_pusat->nama."</center></td>
								<td><center><a class='btn btn-primary' href='../admin/read_diagnosa/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a></center></td></tr>";
			}
		}
		$content.='</table>';
		
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'setting' => '', 'content'=>$content);
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('list_reference');
		$this->load->view('footer');
	}

		public function pasien1(){
		//session_start();
		session_start();
		if(!isset($_SESSION['orthodonti']))
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

			$Pasien = new pasien();
			$pengguna = new pengguna();
			$pengguna->where('username', $_SESSION['orthodonti'])->get();
			$idDokter = $pengguna->id;

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
			$this->load->view('header-orthodonti', $data['menu']);
			$this->load->view('pasien1');
			$this->load->view('footer');
		}else{
			$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
			$this->load->view('header-orthodonti', $data['menu']);
			//$this->load->view('header-orthodonti');
			$this->load->view('pasien1');
			$this->load->view('footer');
		}
	}
	
	public function read($n){
		 session_start();
		 if(!isset($_SESSION['orthodonti']))
			redirect ("homepage");

		$Pasien = new pasien();
		$Merawat = new merawat();
		$Pasien->where('id', $n)->get();

		$data['array'] = array('content' => '<tr><td><b>Name</b></td><td>'.$Pasien->nama.'</td></tr>
			<tr><td><b>Date of Birth</b></td><td>'.$Pasien->tanggal_lahir.'</td></tr>
			<tr><td><b>Place of Birth</b></td><td>'.$Pasien->tempat_lahir.'</td></tr>
			<tr><td><b>Age</b></td><td>'.$Pasien->umur.'</td></tr>
			<tr><td><b>Religion</b></td><td>'.$Pasien->agama.'</td></tr>
			<tr><td><b>Height</b></td><td>'.$Pasien->tinggi.'</td></tr>
			<tr><td><b>Weight</b></td><td>'.$Pasien->berat.'</td></tr>
			<tr><td><b>Gender</b></td><td>'.$Pasien->jenis_kelamin.'</td></tr>
			<tr><td><b>Address</b></td><td>'.$Pasien->alamat_rumah.'</td></tr>
			<tr><td><b>Nationality</b></td><td>'.$Pasien->warga_negara.'</td></tr>
			<tr><td><form method="post" action="../medical_record1/'.$n.'"><button type="submit" class="btn btn-primary pull-right">Create Medical Record</button></form></td>
			<td><form method="post" action="../send_data/'.$n.'"><button type="submit" class="btn btn-primary">Send to FKG UI</button></form>
			</td></tr>');

		//$this->load->view('header-orthodonti');
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('read_ortho', $data['array']); 
		$this->load->view('footer');
	}

	public function pasien_read_ortho(){
		 session_start();
		 if(!isset($_SESSION['orthodonti']))
		 	redirect ("homepage");
			
		$pasien = new pasien();
		$pasien->get();
		$pengguna = new pengguna();
		$pengguna->where('username', $_SESSION['orthodonti'])->get();
		$idDokter=$pengguna->id;

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
				if($row->doktergigi_id==$idDokter){	
					$content .= "<tr>
							<td><center>".$row->nama."</center></td>
							<td><center>".$row->umur."</center></td>
							<td><center>".$row->tinggi."</center></td>
							<td><center>".$row->berat."</center></td>
							<td><center>".$row->jenis_kelamin."</center></td>
							<td><center><a class='btn btn-primary' href='../orthodonti/read/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a> 
								<a class='btn btn-warning' href='../orthodonti/pasien_update2_ortho/".$row->id."'><span class='glyphicon glyphicon-pencil' aria-hidden='false'></span></a>
								<a class='btn btn-danger' href='../orthodonti/delete1/".$row->id."'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
							</center></td></tr>";
				}
			}
			$content .= "</table>";
			$data['array']=array('content'=> $content);
		}
		//$this->load->view('header-orthodonti');
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('pasien_read_ortho', $data['array']);
		$this->load->view('footer');
	}

	
	
	public function pasien_update(){
		// session_start();
		//  if(!isset($_SESSION['orthodonti']))
		//  	redirect ("homepage");
		$this->load->view('header-orthodonti');
		$this->load->view('pasien_update_ortho');
		$this->load->view('footer');
	}

	public function medical_record1($n){
		//session_start();
		session_start();
		if(!isset($_SESSION['orthodonti']))
			redirect ("../homepage");

		$data['array'] = array('n' => $n);
		
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('medical_record1', $data['array']);
		$this->load->view('footer');
	}	

	public function simpan_medical_record1($n){
		//session_start();
		session_start();
		if(!isset($_SESSION['orthodonti']))
			redirect ("../homepage");

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$tanggal = $_POST['tanggal'];
			$jam = $_POST['jam'];
			$deskripsi = $_POST['deskripsi'];

			$pengguna = new pengguna();
			$medical_record = new medical_record();

			$pengguna->where('username', $_SESSION['orthodonti'])->get();		
		 	$medical_record->umum_id= $pengguna->id;
			$medical_record->tanggal=$tanggal;
			$medical_record->jam=$jam;
			$medical_record->deskripsi=$deskripsi;
			$medical_record->pasien_id=$n;

			$medical_record->save();
			$data['array']= array('content' => '<a href ="../pasien_read_ortho">Back to Patient List.</a>');
			$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Patient data has been saved.
							</div>");
			$this->load->view('header-orthodonti', $data['menu']);
			$this->load->view('result-orthodonti', $data['array']);
			$this->load->view('footer');
		}
	}

			public function send_diagnose_to_admin($n){
		//session_start();
		session_start();
		if(!isset($_SESSION['orthodonti']))
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

		 		$pengguna->where('username', $_SESSION['orthodonti'])->get();		
		 		$analisi->orto_id= $pengguna->id;
		 		$analisi->flag_menerima= '1';
		 		$analisi->flag_mengirim= '1';

		 		$analisi->save();

					//redirect('admin/send_diagnose_to_admin');							
			}
			$data['array'] = array('n' => $n);
		
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('send_diagnose_to_admin', $data['array']);
		$this->load->view('footer');

		}

	public function list_reference_drg(){
		session_start();
		if(!isset($_SESSION['orthodonti']))
			redirect ("homepage");
		
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('list_reference_drg');
		$this->load->view('footer');
	}

	public function send_data($n){
		session_start();
		if(!isset($_SESSION['orthodonti']))
		redirect ("homepage");
		
		 if($_SERVER['REQUEST_METHOD'] == 'POST'){
			
					 	$pengguna = new pengguna();
		 	$merawat = new merawat();

		 		$pengguna->where('username', $_SESSION['orthodonti'])->get();
		 		$id = $pengguna->id;
		 		$merawat->pasien_id=$n;
		 		$merawat->orto_id= $id;
		 		$merawat->save();

			}
			$data['array'] = array('n' => $n);
		$data['array']= array('content' => '<a href ="../pasien_read_ortho">Back to Patient List.</a>');
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Patient data has been sent.
							</div>");
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('result-orthodonti', $data['array']);
		$this->load->view('footer');

	}

		public function pasien_update2_ortho($n){
		session_start();
		if(!isset($_SESSION['orthodonti']))
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
			$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '');	
			$this->load->view('header-orthodonti', $data['menu']);
			$this->load->view('pasien_update2_ortho', $data['array']);
			$this->load->view('footer');
		}else{
		$data['array'] = array('nama' => $pasien->nama, 'tempat_lahir' => $pasien->tempat_lahir, 'tanggal_lahir' => $pasien->tanggal_lahir, 'umur'=>$pasien->umur,
			'alamat_rumah'=>$pasien->alamat_rumah, 'tinggi'=>$pasien->tinggi, 'berat'=>$pasien->berat, 'warga_negara' => $pasien->warga_negara, 'agama' => $pasien->agama);
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '');	
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('pasien_update2_ortho', $data['array']);
		$this->load->view('footer');
		}
	}


	public function delete1($id){
		session_start();
		if(!isset($_SESSION['orthodonti']))
			redirect ("homepage");

		$this->load->model('penggunas');
		$status = $this->penggunas->deletePasien($id);
		if($status)
			redirect("orthodonti/pasien_read_ortho");
	}
}
?>