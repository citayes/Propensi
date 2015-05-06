<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	//lancar
	public function index(){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");
		$data['menu'] = array('home' => 'active', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => '');
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('admin');
		$this->load->view('footer');
	}

	//lancar
	public function verify(){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");
		
		$pengguna = new pengguna();
		$pengguna->where('fverifikasi', 'n')->get();
		$temp = "";
		foreach($pengguna as $row){
							$temp .= "
							<div class='col-md-4'>
								<div class='thumbnail'>
									<center><img alt='140x140' src='../../".$row->foto."' style='width:125px; height:125px;' class='img-circle'></center>
									<div class='caption'>
										<h4><center>".$row->username."</center></h4>
										<center>
										<p>".$row->nama."</p>
										<p>".$row->email."</p>
										<p>".$row->role."</p>
										<p>
											<a class='btn btn-primary' href='../admin/view_data_dokter/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'> Details</span></a> 
											<a class='btn btn-danger' href='../admin/decline/".$row->id."'><span class='glyphicon glyphicon-trash' aria-hidden='true'> Decline</span></a>
										</p>
										</center>
									</div>
								</div>
							</div>";
					$data['array']= array('content' => $temp);
		
		}
		$data['array']= array('content' => $temp);
		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('verify', $data['array']);
		$this->load->view('footer');	
	}


	public function view($m){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");

		$pengguna = new pengguna();
		$pengguna->where('id', $m)->get();
		$dokter_gigi = new dokter_gigi();
		$dokter_gigi->where('pengguna_id', $m)->get();

		$data['array'] = array('nama' => $pengguna->nama, 'email' =>  $pengguna->email, 'tanggallahir' => $pengguna->tanggal_lahir,
			'tempatlahir' => $pengguna->tempat_lahir, 'warganegara' => $pengguna->warga_negara, 'foto'=>$pengguna->foto, 'jeniskelamin' => $pengguna->jenis_kelamin,
			'agama' => $pengguna->agama, 'kursus' => $dokter_gigi->kursus, 'pendidikan' => $dokter_gigi->pendidikan_dokter, 'alamat' => $dokter_gigi->alamat_praktik);

		$data['menu'] = array('home' => '', 'manage' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('view', $data['array']);
		$this->load->view('footer');

	}

	//lancar
	public function verifyAcc($m){
	session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");

	$pengguna = new pengguna();
	$pengguna->where('id', $m)->update('fverifikasi', 'y');
	$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
	 		<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
	 			<strong>Well done!</strong> Account has been verified.
	 		</div>");
	$config = Array(
	  'protocol' => 'smtp',
	  'smtp_host' => 'ssl://smtp.googlemail.com',
	  'smtp_port' => 465,
	  'smtp_user' => 'cita.indraswari@gmail.com', // change it to yours
	  'smtp_pass' => 'jowoon151294', // change it to yours
	  'mailtype' => 'html',
	  'charset' => 'iso-8859-1',
	  'wordwrap' => TRUE
	);
		//$message = $Umur;
	$pengguna->where('id', $m)->get();
	$email = $pengguna->email;
	$username = $pengguna->username;
	$message = $pengguna->password;
		$this->load->library('email', $config);
	  $this->email->set_newline("\r\n");
	  $this->email->from('cita.indraswari@gmail.com'); // change it to yours
	  $this->email->to($email);// change it to yours
	  $this->email->subject('Account Telehealth Orthodontist has been verified');
	  $this->email->message('Username : '.$username. '  , Password : ' .$message. '');
	  $this->email->send();

	$data['array'] = array('content' => '<a href="../verify">Back to verify.</a>');
	$this->load->view('header-admin', $data['menu']);
	$this->load->view('result-admin', $data['array']);
	$this->load->view('footer');
			
	}
	public function decline($id){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");

		$this->load->model('penggunas');
		$status = $this->penggunas->delete($id);
		if($status)
			redirect("drg/pasien_read");
			// $status['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
			// 	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			// 		<strong>Well done!</strong> Account successfully deleted.
			// 	</div>");
			// $status['array']=array('content' => '<a href="verify">Back to verify.</a>');
			// $this->load->view('header-admin', $status['menu']);
			// $this->load->view('result-admin', $status['array']);
			// $this->load->view('footer');
		
	}

	public function change(){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");

		 if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$OldPassword = $_POST['OldPassword'];
			$NewPassword = $_POST['NewPassword'];
			$RNewPassword = $_POST['RNewPassword'];

			$pengguna = new Pengguna();
			$pengguna->where('username', $_SESSION['admin'])->get();

			$isRegistered = $pengguna->result_count() == 0 ? false : true;
			if($isRegistered){
				if($pengguna->username==$_SESSION['admin']){
					if($pengguna->password == $OldPassword){
						if($NewPassword==$RNewPassword){
							$pengguna->where('username', $_SESSION['admin'])->update('password',$NewPassword);
							$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  					<strong>Well done!</strong> Password has been changed.
									</div>");	
							$this->load->view('header-admin', $data['menu']);
							$this->load->view('changepassword-admin');
							$this->load->view('footer');
						}else{
							$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  					<strong>Warning!</strong> Wrong new password.
									</div>");	
							$this->load->view('header-admin', $data['menu']);
							$this->load->view('changepassword-admin');
							$this->load->view('footer');
						}
					}else{
					$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Warning!</strong> Wrong password.
							</div>");	
					$this->load->view('header-admin', $data['menu']);
					$this->load->view('changepassword-admin');
					$this->load->view('footer');
					}
				}
			}
		}else{
		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('changepassword-admin');
		$this->load->view('footer');
		}	
	}


	public function register(){
		//session_start();
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$Username = $_POST['Username'];
			$Password = $_POST['Password'];
			$Email = $_POST['Email'];
			$Nama = $_POST['Nama'];
			$Tempat_Lahir = $_POST['Tempat_Lahir'];
			$Tanggal_Lahir = $_POST['Tanggal_Lahir'];
			$Warga_Negara = $_POST['Warga_Negara'];
			$Jenis_Kelamin = $_POST['Jenis_Kelamin'];
			if($Jenis_Kelamin=='Laki-laki'){
				$Foto='uploads/images/man.png';
			}
			else{
				$Foto='uploads/images/woman.png';
			}
			$Agama = $_POST['Agama'];

			$Pendidikan = $_POST['Pendidikan'];
			$Kursus = $_POST['Kursus'];	
			$Alamat = $_POST['Alamat'];
			$Kodepos =$_POST['Kodepos'];
			$Role = $_POST['Role'];

			$pengguna = new pengguna();
			$dokter_gigi = new dokter_gigi();
			$drg_ortodonti = new drg_ortodonti();

			$pengguna->where('username', $Username)->get();
			
			$isRegistered = $pengguna->result_count() == 0 ? false : true;

			if($isRegistered==false){			
				   $pengguna->username =$Username;
				   $pengguna->password = $Password;
				   $pengguna->nama = $Nama;
				   $pengguna->tanggal_lahir = $Tanggal_Lahir;
				   $pengguna->tempat_lahir = $Tempat_Lahir;
				   $pengguna->warga_negara = $Warga_Negara;
				   $pengguna->jenis_kelamin = $Jenis_Kelamin;
				   $pengguna->agama = $Agama;
				   $pengguna->foto = $Foto;
				   $pengguna->fverifikasi = 'y';
				   $pengguna->email = $Email;
				   
				   $pengguna->role = $Role;
				   $pengguna->save();
				
					$pengguna->where('username', $Username)->get();
					
					$dokter_gigi->pengguna_id= $pengguna->id;
					$dokter_gigi->kursus = $Kursus;
					$dokter_gigi->pendidikan_dokter = $Pendidikan;
					$dokter_gigi->alamat_praktik = $Alamat;
					$dokter_gigi->kodepos = $Kodepos;
					$dokter_gigi->save(); 

					$drg_ortodonti->doktergigi_id=$pengguna->id;
					$drg_ortodonti->save();

					$config = Array(
					  'protocol' => 'smtp',
					  'smtp_host' => 'ssl://smtp.googlemail.com',
					  'smtp_port' => 465,
					  'smtp_user' => 'cita.indraswari@gmail.com', // change it to yours
					  'smtp_pass' => 'jowoon151294', // change it to yours
					  'mailtype' => 'html',
					  'charset' => 'iso-8859-1',
					  'wordwrap' => TRUE
					);

					$Email1 = $Email;
						$this->load->library('email', $config);
					  $this->email->set_newline("\r\n");
					  $this->email->from('cita.indraswari@gmail.com'); // change it to yours
					  $this->email->to($Email1);// change it to yours
					  $this->email->subject('Konfirmasi Pendaftaran Telehealth Orthodontist');
					  $this->email->message('Username : '.$Username. '  , Password : ' .$Password. '');
					  if($this->email->send())
						{
							$data['menu'] = array('home' => '', 'manage' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Account has been created. Email sent.
							</div>");	
							$this->load->view('header-admin', $data['menu']);
							$this->load->view('register');
							$this->load->view('footer');
						}
						else
						{
							$data['menu'] = array('home' => '', 'manage' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-warning alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			  					<strong>Warning!</strong> Email not sent.
								</div>");	
							$this->load->view('header-admin', $data['menu']);
							$this->load->view('register');
							$this->load->view('footer');
						}					
			}else{
				$data['menu'] = array('home' => '', 'manage' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Warning!</strong> Username has been registered.
							</div>");	
				$this->load->view('header-admin', $data['menu']);
				$this->load->view('register');
				$this->load->view('footer');
					
			}
	
		}else{
			$data['menu'] = array('home' => '', 'manage' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '');	
			$this->load->view('header-admin', $data['menu']);
			$this->load->view('register');
			$this->load->view('footer');
		}
	}

		//lancar
	public function retrieve(){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");
		
		$pengguna = new pengguna();
			$pengguna->get();
			$temp = "";
			foreach($pengguna as $row){
				if($row->role != "admin" && $row->fverifikasi == "y"){
						$temp .= "
						<div class='col-md-4'>
							<div class='thumbnail'>
								<center><img alt='140x140' src='../../".$row->foto."' style='width:125px; height:125px;' class='img-circle'></center>
								<div class='caption'>
									<h4><center>".$row->username."</center></h4>
									<center>
									<p>".$row->nama."</p>
									<p>".$row->email."</p>
									<p>".$row->role."</p>
									<p>
										<a class='btn btn-primary' href='../admin/view/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'> Details</span></a>
										<a class='btn btn-danger' href='../admin/delete1/".$row->id."'><span class='glyphicon glyphicon-trash' aria-hidden='true'> Delete </span></a> 
									</p>
									</center>
								</div>
							</div>
						</div>";
				$data['array']= array('content' => $temp);		
			}
			}
		$data['menu'] = array('home' => '', 'manage' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('retrieve', $data['array']);
		$this->load->view('footer');
	
	}

	public function view_data_dokter($m){
	
	session_start();
	if(!isset($_SESSION['admin']))
		redirect ("homepage");
	
	$pengguna = new Pengguna();
	$dokter_gigi = new dokter_gigi();
	$drg_ortodonti = new drg_ortodonti();
	$pengguna->where('id', $m)->get();
	$dokter_gigi->where('pengguna_id', $m)->get();


	$data['array']= array('content' => '<tr><td>Nama</td><td>' .$pengguna->nama.'</td><tr>
		<tr><td>Email</td><td>'.$pengguna->email.'</td></tr>
		<tr><td>Tanggal_Lahir</td><td>'.$pengguna->tanggal_lahir.'</td></tr>
		<tr><td>Tempat_Lahir</td><td>'.$pengguna->tempat_lahir.'</td></tr>
		<tr><td>Warga_Negara</td><td>'.$pengguna->warga_negara.'</td></tr>
		<tr><td>Jenis_kelamin</td><td>'.$pengguna->jenis_kelamin.'</td></tr>
		<tr><td>Agama</td><td>'.$pengguna->agama.'</td></tr>
		<tr><td>Foto</td><td>'.$pengguna->foto.'</td></tr>
		<tr><td>Kursus</td><td>'.$dokter_gigi->kursus.'</td></tr>
		<tr><td>Pendidikan_Dokter</td><td>'.$dokter_gigi->pendidikan_dokter.'</td></tr>
		<tr><td>Alamat_Praktik</td><td>'.$dokter_gigi->alamat_praktik.'</td></tr>
		<tr><td colspan="2"><a class="btn btn-primary" href="../verifyAcc/'.$m.'">Verify</a></td>'
		);
	
	$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '');	
	$this->load->view('header-admin', $data['menu']);
	$this->load->view('view_data_dokter', $data['array']);
	$this->load->view('footer');
	}


	public function logout(){	
		session_start();
		//hapus session
		session_destroy();
		//alihkan kehalaman login (index.php)
		redirect('homepage');
	}

	public function delete(){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");

		$data['menu'] = array('home' => '', 'manage' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('delete');
		$this->load->view('footer');

		$pengguna = new Pengguna();
	}
		
	public function update(){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");
		
		$data['menu'] = array('home' => '', 'manage' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('update');
		$this->load->view('footer');

		$pengguna = new Pengguna();
	}

	public function listupdate(){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");

		$data['menu'] = array('home' => '', 'manage' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('listupdate');
		$this->load->view('footer');

	}

	public function edit_profile(){
	session_start();
	if(!isset($_SESSION['admin']))
		redirect ("homepage");
	$pengguna = new pengguna();
	$pengguna->where('username', $_SESSION['admin'])->get();

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$Nama = $_POST['Nama'];
		$Tempat_Lahir = $_POST['Tempat_Lahir'];
		$Tanggal_Lahir = $_POST['Tanggal_Lahir'];
		$Warga_Negara = $_POST['Warga_Negara'];
		$Agama = $_POST['Agama'];
		
		$pengguna = new pengguna();
		//$pengguna->where('username', $_SESSION['admin'])->get();
		$pengguna->where('username', $_SESSION['admin'])->update('nama',$Nama);
		$pengguna->where('username', $_SESSION['admin'])->update('tempat_lahir',$Tempat_Lahir);
		$pengguna->where('username', $_SESSION['admin'])->update('tanggal_lahir',$Tanggal_Lahir);
		$pengguna->where('username', $_SESSION['admin'])->update('warga_negara',$Warga_Negara);
		$pengguna->where('username', $_SESSION['admin'])->update('agama',$Agama);
		$pengguna->where('username', $_SESSION['admin'])->get();
		$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama);
		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Profile has been updated.
							</div>");	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('edit_profile-admin', $data['array']);
		$this->load->view('footer');

	}else{
		$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama);
		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('edit_profile-admin', $data['array']);
		$this->load->view('footer');
	}
}

	//lancar
	function do_upload(){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");

		$config['upload_path'] = './uploads/images';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['max_size']	= '200';
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
		$config['file_name'] = md5($_SESSION['admin']);
		$config['overwrite'] = true;

 
		$this->load->library('upload', $config);
 
		if (!$this->upload->do_upload()){
			$status['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<strong>Warning !</strong> Upload failure.
				</div>");
			$status['array']=array('content' => '<a href="edit_profile">Back to profile.</a>');
			$this->load->view('header-admin', $status['menu']);
			$this->load->view('result-admin', $status['array']);
			$this->load->view('footer');		
		}
		else{
			$data = $this->upload->data();
			$temp ="uploads/images/";
			$temp .= $config['file_name'];
			$temp .= $data['file_ext'];
			$pengguna = new pengguna();
			$pengguna->where('username', $_SESSION['admin'])->update('foto', $temp);

			$status['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<strong>Well done!</strong> Photo profile successfully changed.
				</div>");
			$status['array']=array('content' => '<a href="edit_profile">Back to profile.</a>');
			$this->load->view('header-admin', $status['menu']);
			$this->load->view('result-admin', $status['array']);
			$this->load->view('footer');
			//$this->load->vfprintf(handle, format, args)iew('admin', $data);
		}
	}


		public function delete1($id){
			session_start();
			if(!isset($_SESSION['admin']))
				redirect ("homepage");

		$this->load->model('penggunas');
		$status = $this->penggunas->delete($id);
		if($status)
			redirect("admin/retrieve");
		
	}

		

	public function diagnosa(){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");

		$analisi = new analisi();
		$analisi-> get();
		$content="";
		if($analisi->result_count() != 0){
			$content = "<table class='table'>
						<tr>
							<td><center><b>Patient's id</b><center></td>
							<td><center><b>Patient's name</center></b></td>
							<td><center><b>FKG UI's Id</center></b></td>
							<td><center><b>Operation</center></b></td>
						</tr>";
			foreach($analisi as $row){
				if($row->flag_mengirim=='1'){
					$pasien = new pasien();
					$pasien->where('id', $row->pasien_id)->get();
					$content .= "<tr><td><center>".$row->pasien_id."</center></a></td>
								 <td><center>".$pasien->nama."</center></td>
								 <td><center>".$row->orto_id."</center></td>
								 <td><center><a class='btn btn-primary' href='../admin/read_diagnosa/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'> Detail</span></a></center></td></tr>";
				}
			}
			$content .=  "</table>";
			$data['array']=array('content'=>$content);
		}
		else{
			$data['array']=array();
		}
		
		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('diagnosa', $data['array']);
		$this->load->view('footer');
	}

	public function read_diagnosa($n){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");
		
		$analisi = new analisi();
		$analisi->where('id', $n)->get();

		$data['array'] = array('content' => '<tr><td><b>Id pasien</b></td><td>'.$analisi->pasien_id.'</td></tr>
			<tr><td><b>Id Ortho</b></td><td>'.$analisi->orto_id.'</td`></tr>
			<tr><td><b>Skor</b></td><td>'.$analisi->skor.'</td></tr>
			<tr><td><b>Maloklusi Menurut Angka</b></td><td>'.$analisi->maloklusi_menurut_angka.'</td></tr>
			<tr><td><b>Diagnosis Rekomendasi</b></td><td>'.$analisi->diagnosis_rekomendasi.'</td></tr>
			<tr><td colspan="2"><form method="post" action="../send_rujukan/'.$n.'"><center><button type="submit" class="btn btn-primary ">Send Reference</button></center></form>
			</td></tr>');

		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('read_diagnosa', $data['array']); 
		$this->load->view('footer');
	}

	public function send_rujukan($n){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");

		$option="";
		
		$pengguna = new pengguna();
		$pengguna->get();
		foreach ($pengguna as $row) {
			if($row->role == 'orthodonti' && $row->fverifikasi=='y')
				$option .= "<option value='".$row->nama."'>".$row->nama."</option>";
		}

		$data['array'] = array('n' => $n, 'option' =>$option);
		//$data['array'] = array('content' => $option, 'n'=> $n);					
		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('send_rujukan', $data['array']);
		$this->load->view('footer');
	}

	public function send_rujukan_lagi($n){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");
		
		 if($_SERVER['REQUEST_METHOD'] == 'POST'){
		 	$tanggal = $_POST['tanggal'];
		 	$kandidat1 = $_POST['nama'];
			
		 	$mengirim = new mengirim();
		 	$merawat = new merawat();
		 	$analisi = new analisi();
		 	$admin = new admin();
		 	$pengguna = new pengguna();

		 	$mengirim->tanggal=$tanggal;
	 		$mengirim->kandidat1=$kandidat1;
	 		$pengguna->where('username', $_SESSION['admin'])->get();		
	 		//echo ($pengguna->id);
	 		$mengirim->admin_id= $pengguna->id;
	 		$mengirim->analisis_id=$n;
	 		$analisi->where('id', $n)->get();
	 		$lala= $analisi->pasien_id;
	 		$merawat->where('pasien_id', $lala)->get();
	 		$mengirim->umum_id=$merawat->umum_id;
	 		$mengirim->orto_id=$merawat->orto_id;
	 		$mengirim->pusat_id=$analisi->orto_id;
	 		$mengirim->save();

	 		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Referral has been sent.
							</div>");	
	 		$data['array'] = array('content' => '<a href ="../diagnosa">Back to diagnosa.</a>');
			$this->load->view('header-admin', $data['menu']);
			$this->load->view('result-admin', $data['array']);
			$this->load->view('footer');
	 			 							
		}

	}
}
?>