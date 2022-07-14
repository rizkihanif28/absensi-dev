<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absen extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->functions->check_session();
		$this->load->model('m_absen');
	}

	public function index()
	{
		// get data from user
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row();

		$data['title'] = "Presensi2";
		$ip = $this->input->ip_address();
		$ipad = explode(".",$ip);
		$data['stat_abs'] = "x";		
		if($ipad[0] == "10" && $ipad[1] == "2" && $ipad[2] == "110"){
			$data['stat_abs'] = "v";
		}elseif($ipad[0] == "10" && $ipad[1] == "5" && $ipad[2] == "3"){
			$data['stat_abs'] = "v";
		}
		
		// parsing lat and long data user
		$data['latitude'] = $userData->latitude;
		$data['longitude'] = $userData->longitude;

		$data['user']= $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$format_tang = "%d-%M-%Y";
		$data['tanggal'] = mdate($format_tang);
		$data['l_kondisi'] = $this->db->get('m_kondisi')->result_array();
		$data['l_sakit'] = $this->db->get('m_sakit')->result_array();
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('absen/absen',$data);
		$this->load->view('templates/footer');
		$this->load->view('templates/scripts');
	}
	
	public function save()
	{
		$format_tang = "%Y-%m-%d";
		$tanggal_abs = mdate($format_tang);
		$format_wkt = "%H:%i:%s";
		$wkt_abs = mdate($format_wkt);

		$tipe_abs = 1;
		$email = $this->session->userdata('email');
		$stat_k = $this->input->post('status_kerja');
		$kondisi = $this->input->post('kondisi'); 
		$keluhan = $this->input->post('keluhan'); 
		$lat = $this->input->post('lat');
		$long = $this->input->post('long');

		$cek_tipe = $this->m_absen->get_c($email,$tanggal_abs);

		// get data from user
		$userData = $this->db->get_where('user', ['email' => $email])->row();

		// cek latitude & longitude data from user
		if($stat_k == 2) {
			if(empty($userData->latitude) || $userData->longitude == '') {
				$result = [
					'success'   => "timeValidation",
					'title'		=> "Data Lokasi Belum Terisi",
					'message'   => 'Silahkan isi terlebih dahulu data lokasi anda di menu Lokasi WFH'
				];
	
				return $this->output
				->set_content_type('application/json')
				->set_output(json_encode($result));
			}
		}

		// time validation (attendance must start from 6AM)
		if ($cek_tipe == 0) {
			if ($wkt_abs >= "00:00:00" && $wkt_abs <= "06:00:00") {
				$result = [
					'success'   => false,
					'title'		=> "Presensi Belum Dapat Dilakukan",
					'message'   => 'Silahkan melakukan kembali presensi mulai Pukul 06:00 WIB'
				];
				return $this->output
				->set_content_type('application/json')
				->set_output(json_encode($result));
			}
		}
	
		if ($cek_tipe == 1){
			$tipe_abs = 2;
			if ($stat_k == 1){			
				$this->m_absen->set_status_masuk($email,$tanggal_abs);
			}else{
				$cek_absen_sebel = $this->m_absen->cek_absen_sebel($email,$tanggal_abs);
				if ($cek_absen_sebel > 0){
					$this->m_absen->set_status_pulang($email,$tanggal_abs);
					$stat_k = 1;
				}
			}
		}else if ($cek_tipe > 1){
			$tipe_abs = 2;
			if ($stat_k == 2){	
				$cek_absen_sebel = $this->m_absen->cek_absen_sebel($email,$tanggal_abs);
				if ($cek_absen_sebel > 0){
					$this->m_absen->set_status_pulang($email,$tanggal_abs);
					$stat_k = 1;
				}
			}
		}

		// init data for DB
		$data = [
			'email' => $email,
			'tanggal' => $tanggal_abs,
			'status'  => $stat_k,
			'tipe_absen' => $tipe_abs,
			'waktu_absen' => $wkt_abs,
			'keterangan' => $this->input->post('status_wfh')
		];	

		$presensi_id = $this->m_absen->simpan_absen('presensi',$data);

		$data2= array();
		if (!empty($kondisi)) {
			if (!empty($keluhan)) {
				foreach($kondisi as $kon) :
					foreach($keluhan as $kel) :
						array_push($data2, array(
							'email'			=> $email,
							'presensi_id' 	=> $presensi_id,
							'kondisi_id'	=> $kon,
							'sakit_id'   	=> $kel,
							'tanggal'		=> date('Y-m-d')
						));
					endforeach;
				endforeach;
			} else {
				foreach($kondisi as $k) :
					array_push($data2, array(
						'email'			=> $email,
						'presensi_id' 	=> $presensi_id,
						'kondisi_id'	=> $k,
						'tanggal'		=> date('Y-m-d')
					));		
				endforeach;	
			}
			$this->db->insert_batch('tr_kesehatan', $data2);
		}
		
		$this->session->set_flashdata('success','Presensi berhasil dilakukan.');
		
		$result = [
			'success'   => true,
			'title'		=> "Presensi Berhasil Dilakukan"
		];

		return $this->output
			->set_content_type('application/json')
			->set_output(json_encode($result));
	}
}
