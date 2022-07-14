<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('auth_model', 'm_auth');
		$this->load->model('user_model', 'm_user');
	}
	public function index()
	{
		if(isset($this->session->logged_in)){
			return redirect('absen');
		}

		$this->form_validation->set_rules('email','Email','required|trim');
		$this->form_validation->set_rules('password','Password','required|trim');
		if($this->form_validation->run()==false){
		$data['title'] = "Login";
		$this->load->view('templates/header',$data);
		$this->load->view('auth/index',$data);
		$this->load->view('templates/auth_footer');
		$this->load->view('templates/scripts');
		}
		else{
			$this->_login();
		}
	}

	private function _login()
	{
	$email = $this->input->post('email');
	$password = $this->input->post('password');
	//$user = $this->db->get_where('user',['email' => $email])->row_array();

	$uid 			= trim($this->input->post('email', TRUE));
	$ldapserver 	= '10.1.1.2';
	$ldapuser 		= "bsn.local\\" . $uid;
	$ldappass     	= $this->input->post('password', TRUE);
	$ldaptree    	= "DC=BSN,DC=local";

	$ldapconn = ldap_connect($ldapserver);
			ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
			ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

	//Konek ke server LDAP
	if($ldapconn){
		//Jika Konek dengan username password LDAP
		if($ldapbind = ldap_bind($ldapconn, $ldapuser, $ldappass)){
				//Get Entries LDAP
				$filter = "(sAMAccountName=$uid)";
				$attr = array("cn", "mail","l","userPrincipalName");
				$result = ldap_search($ldapconn,$ldaptree,$filter, $attr) or die ("Error in search query: ".ldap_error($ldapconn));
				$data = ldap_get_entries($ldapconn, $result);
				//cek di DB
				$cekdata = $this->m_auth->cek_user($uid);
				if(!empty($cekdata)) :
					for ($i=0; $i<$data["count"]; $i++)
						{
						$dataldap['name'] 			= $cekdata['name'];
						$dataldap['email'] 	    	= $cekdata['email'];
						$dataldap['image']			= $cekdata['image'];
						$dataldap['role_id']       	= $cekdata['role_id'];
						}
					$this->session->set_userdata($dataldap);
				  	$this->session->logged_in = true;
				  	//$this->m_audit->simpan($dataaudit);
					if($cekdata['role_id'] == '1'){
						redirect('admin');
					}elseif($cekdata['role_id'] == '3'){
						redirect('admin/presensi_all');
					}else{
						redirect('absen');
					}

					else :

						$cekdata2 = $this->m_auth->cek_user($uid);
						for ($i=0; $i<$data["count"]; $i++)
						{
							$dataldap['name'] 			= $data[$i]["cn"][0];
							$dataldap['username'] 		= $uid;
							$dataldap['email']			= $data[$i]["mail"][0];
							$dataldap['image']        	= "default.jpg";
							$dataldap['role_id']   		= "2";
							$dataldap['is_active']   	= "1";
							$dataldap['date_created']   = time();
						}
						$this->m_user->simpan($dataldap);
						$this->session->set_userdata($dataldap);
						$this->session->set_flashdata('message', '<div class="alert alert-success" roles="alert">Selamat akun anda telah diaktifasi. Mohon login lagi untuk masuk.</div>');
						redirect('auth');
				endif;

		}else{


			$this->session->set_flashdata('message','<div class="alert alert-danger" roles="alert">Username/password salah. Silakan coba lagi.</div>');
			redirect('auth');
		}
	}else{
		$this->session->set_flashdata('message','<div class="alert alert-danger" roles="alert">Not connect to Server!</div>');
		redirect('auth');
	}
	}

	public function logout(){
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message','<div class="alert alert-success" roles="alert">Anda telah logout</div>');
		$this->session->sess_destroy();
		redirect('auth','reload');
	}

	public function test_info() {
		echo date('d-m-Y H:i:s');
	}


}
