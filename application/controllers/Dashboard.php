<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // $this->functions->check_session();
        $this->load->model('m_absen');
    }

    public function index()
    {
        $data = [
            'title' => "Presensi2",
            'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            'jumlahPegawai' => $this->db->get('user')->num_rows()
        ];

        $data['status_WFO'] = $this->db->get_where('presensi', ['status' => 1])->num_rows();

        $data['status_WFH'] = $this->db->get_where('presensi', ['status' => 2])->num_rows();

        $data['unit_kerja'] = $this->db->get_where('siap_m_unit_kerja', ['kode_jenis_unit' => 3])->result();

        // $data['tgl_sekarang'] = $this->db->get_where('presensi', ['tanggal' => 'CUREDATE()'])->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard/card-pegawai', $data);
        $this->load->view('dashboard/diagram', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/scripts');
    }
}
