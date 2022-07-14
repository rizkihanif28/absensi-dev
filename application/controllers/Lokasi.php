<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->functions->check_session();
		$this->load->model('user_model', 'm_user');
	}

	public function index()
	{
		$data['title'] = "Lokasi WFH";		
		
		$data['user']= $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('lokasi/lokasi',$data);
		$this->load->view('templates/footer');
		$this->load->view('templates/scripts');
	}
	
	public function editlokasi()
	{	
		$data = ['user'=>$this->db->get_where('user',['email'=>$this->session->email])->row_array()];

		$this->form_validation->set_rules('latitude','Latitude','required|trim');
    	$this->form_validation->set_rules('longitude','Longitude','required|trim');

		if ($this->form_validation->run() ==false) {
	       	$this->load->view('templates/header',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('lokasi/lokasi',$data);
			$this->load->view('templates/footer');
			$this->load->view('templates/scripts');
	     } else {
	       $latitude=$this->input->post('latitude');
	       $longitude=$this->input->post('longitude');

	       $this->db->set('latitude', $latitude);
	       $this->db->set('longitude',$longitude);
	       $this->db->where('email',$this->session->email);
	       $this->db->update('user');

		   $this->session->set_flashdata('success','Lokasi WFH berhasil tersimpan.');
			redirect('lokasi');
		}
	}
}
