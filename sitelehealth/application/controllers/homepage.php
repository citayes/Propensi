<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homepage extends CI_Controller {

	public function index(){
		session_start();
		$data['menu'] = array('home' => 'active', 'signin' => '', 'signup' => '');
		$this->load->view('header-home', $data['menu']);
		$this->load->view('index');
		$this->load->view('footer');
	}
	public function signin(){
		 session_start();
		
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$Username = $_POST['Username'];
			$Password = $_POST['Password'];

			$pengguna = new Pengguna();
			$pengguna->where('username', $Username)->get();
			
			$isRegistered = $pengguna->result_count() == 0 ? false : true;

			if($isRegistered){
				if($pengguna->fverifikasi=="y"){
					if($pengguna->password==$Password){
						if($pengguna->role=="admin"){
							$_SESSION['admin'] = $Username;
							redirect('admin');
						}else if($pengguna->role=="umum"){
							$_SESSION['drg'] = $Username;
							redirect('drg');
						}else if($pengguna->role=="orthodonti"){
							$_SESSION['orthodonti'] = $Username;	
							redirect('orthodonti');
						}else if($pengguna->role=="pusat"){
							$_SESSION['pusat'] = $Username;
							redirect('pusat');
						}
					}else{
					$data['menu'] = array('home' => '', 'signin' => 'active', 'signup' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  					<strong>Warning!</strong> Wrong password.
					</div>");
					$this->load->view('header-home', $data['menu']);
					$this->load->view('signin');
					$this->load->view('footer');
					}
				}else{
					$data['menu'] = array('home' => '', 'signin' => 'active', 'signup' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
					  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					  <strong>Warning!</strong> Unverified member.
					</div>");
					$this->load->view('header-home', $data['menu']);
					$this->load->view('signin');
					$this->load->view('footer');
				}
			}else{	
				$data['menu'] = array('home' => '', 'signin' => 'active', 'signup' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
				  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  <strong>Warning!</strong> Member not registered.
				</div>");
				$this->load->view('header-home', $data['menu']);
				$this->load->view('signin');
				$this->load->view('footer');
			}

		}else{
			 $data['menu'] = array('home' => '', 'signin' => 'active', 'signup' => '');
			 $this->load->view('header-home', $data['menu']);
			 $this->load->view('signin');
			 $this->load->view('footer');
		}
	}
	public function signup(){		
		session_start();
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
				$Kode_pos = $_POST['Kodepos'];

				$Role = $_POST['Role'];

				$pengguna = new pengguna();
				$dokter_gigi = new dokter_gigi();
				$drg_ortodonti = new drg_ortodonti();
				$drg_lain = new drg_lain();

				$pengguna->where('username', $Username)->get();
				$isRegistered = $pengguna->result_count() == 0 ? false : true;
					if($isRegistered == false){
						$pengguna->username = $Username;
						$pengguna->password = $Password;
						$pengguna->nama = $Nama;
						$pengguna->tanggal_lahir = $Tanggal_Lahir;
						$pengguna->tempat_lahir = $Tempat_Lahir;
						$pengguna->warga_negara = $Warga_Negara;
						$pengguna->jenis_kelamin = $Jenis_Kelamin;
						$pengguna->agama = $Agama;
						$pengguna->foto = $Foto;
						$pengguna->fverifikasi = 'n';
						$pengguna->email = $Email;
						$pengguna->role = $Role;
						$pengguna->email = $Email;
						$pengguna->role = $Role;
						$pengguna->save();

						$pengguna->where('username', $Username)->get();
						$dokter_gigi->pengguna_id = $pengguna->id;
						$dokter_gigi->kursus = $Kursus;
						$dokter_gigi->pendidikan_dokter = $Pendidikan;
						$dokter_gigi->alamat_praktik = $Alamat;
						$dokter_gigi->kodepos = $Kode_pos;
						$dokter_gigi->save();

						if($Role=='umum'){
							$drg_lain->pengguna_id=$pengguna->id;
							$drg_lain->kursus_orthodonti=$Kursus;
							$drg_lain->jadwal_praktik='n';
							$drg_lain->save();
							$data['menu'] = array('home' => '', 'signin' => '', 'signup' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
	  						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
	  						<strong>Well done!</strong> You successfully registered. Please wait. Your account will be verified soon.
							</div>");
							$this->load->view('header-home', $data['menu']);
							$this->load->view('signup');
							$this->load->view('footer');
						}else{
							$drg_ortodonti->doktergigi_id=$pengguna->id;
							$drg_ortodonti->save();
							$data['menu'] = array('home' => '', 'signin' => '', 'signup' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
	  						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
	  						<strong>Well done!</strong> You successfully registered. Please wait. Your account will be verified soon.
							</div>");
							$this->load->view('header-home', $data['menu']);
							$this->load->view('signup');
							$this->load->view('footer');		
						}
					}else{
						$data['menu'] = array('home' => '', 'signin' => '', 'signup' => 'active', 'status'=> "<div class='alert alert-warning alert-dismissible' role='alert'>
	  					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
	  					<strong>Warning!</strong> Username is registered.
						</div>");
					$this->load->view('header-home', $data['menu']);
					$this->load->view('signup');
					$this->load->view('footer');		
					}
			
		}else{
		$data['menu'] = array('home' => '', 'signin' => '', 'signup' => 'active');
		$this->load->view('header-home', $data['menu']);
		$this->load->view('signup');
		$this->load->view('footer');
		}
	}

	public function forgetpassword(){
		session_start();

		 if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$username = $_POST['Username'];
			$email = $_POST['email'];

			$pengguna = new Pengguna();
			$pengguna->where('username', $username)->get();
	
			$isRegistered = $pengguna->result_count() == 0 ? false : true;
			if($isRegistered){
				if($pengguna->email==$email){
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
					$password1 = $pengguna->password;
					$message = $password1;
					$lala = $pengguna->email;
					$Email1 = $lala;
						$this->load->library('email', $config);
					  $this->email->set_newline("\r\n");
					  $this->email->from('cita.indraswari@gmail.com'); // change it to yours
					  $this->email->to($Email1);// change it to yours
					  $this->email->subject('Recovery Password Telehealth Orthodontist');
					  $this->email->message('Username : '.$username. '  , Password : ' .$message. '');
					  if($this->email->send())
						{
							$data['menu'] = array('home' => '', 'signin' => 'active', 'signup' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
							<strong>Well done!</strong> Your password successfully has been sent to your email.
							</div>");
							$this->load->view('header-home', $data['menu']);
							$this->load->view('signin');
							$this->load->view('footer');
						}
						else
						{
							$data['menu'] = array('home' => '', 'signin' => 'active', 'signup' => '', 'status'=> "<div class='alert alert-warning alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
							<strong>Warning!</strong> Email not sent.
							</div>");
							$this->load->view('header-home', $data['menu']);
							$this->load->view('signin');
							$this->load->view('footer');
						}

				}else{
					$data['menu'] = array('home' => '', 'signin' => 'active', 'signup' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<strong>Warning!</strong> Wrong Email for this account.
					</div>");
					$this->load->view('header-home', $data['menu']);
					$this->load->view('signin');
					$this->load->view('footer');
				}
			}else{
				$data['menu'] = array('home' => '', 'signin' => 'active', 'signup' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				<strong>Warning!</strong> Account not registered.
				</div>");
				$this->load->view('header-home', $data['menu']);
				$this->load->view('signin');
				$this->load->view('footer');
			}
		}else{
			$data['menu'] = array('home' => 'active', 'signin' => '', 'signup' => '');
			$this->load->view('header-home', $data['menu']);
			$this->load->view('forgetpassword');
			$this->load->view('footer');
		}
	}

}
?>