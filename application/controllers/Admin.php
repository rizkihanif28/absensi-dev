<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        // init model
        $this->load->model('general_model', 'm_general');
        $this->functions->check_session();
    }

    public function index()
    {
        redirect('admin/presensi_all');
    }

    public function presensi_all()
    {
        if ($this->session->role_id == 2) redirect('absen');
        $data = [
            'title' => "Presensi All",
            'user'  => $this->m_general->get_where('user', ['email' => $this->session->email])->row_array(),
            'l_tgl_start'   => $this->m_general->get_orderlimit('tanggal', 'asc', 1, 'presensi')->row_array(),
            'l_tgl_end'     => $this->m_general->get_orderlimit('tanggal', 'desc', 1, 'presensi')->row_array()
        ];

        // echo date('Y-M-d', strtotime($data['l_tgl_start']['tanggal']));
        // die;

        $this->_view('user/v_presensi_all', $data);
    }

    public function dt_presensi_all()
    {
        if (!$this->input->is_ajax_request()) show_404();

        // $edit_priv      = $this->input->post('edit_priv', TRUE);
        // $delete_priv    = $this->input->post('delete_priv', TRUE);
        $start = $this->input->post('start', TRUE);
        $end   = $this->input->post('end', TRUE);

        // $edit_button    = '<a class="dropdown-item has-icon edit" href="javascript:void(0)" data-id="$1"><i class="far fa-heart"></i> Edit</a>';
        // $delete_button  = '<a class="dropdown-item has-icon hapus" href="javascript:void(0)" data-id="$1"><i class="far fa-heart"></i> Hapus</a>';

        $this->datatables->select('p.id, p.tanggal, p.waktu_absen, sp.status, tp.tipe, u.name, kon.kondisi');
        $this->datatables->from('presensi p');
        $this->datatables->join('m_status_presensi sp', 'p.status = sp.id', 'left');
        $this->datatables->join('m_tipe_presensi tp', 'p.tipe_absen = tp.id', 'left');
        $this->datatables->join('user u', 'p.email = u.email', 'left');
        $this->datatables->join('tr_kesehatan tr', 'p.id = tr.presensi_id', 'left');
        $this->datatables->join('m_kondisi kon', 'tr.kondisi_id = kon.id', 'left');

        if ($start !== '' or $end !== '') :
            $this->datatables->where('p.tanggal >=', date('Y-m-d', strtotime($start)));
            $this->datatables->where('p.tanggal <=', date('Y-m-d', strtotime($end)));
        endif;

        $this->datatables->group_by('p.id');
        $this->datatables->add_column('no', '');


        header('Content-Type: application/json');
        echo $this->datatables->generate();
    }

    private function _view($view, $data)
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view($view, $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/scripts');
    }
}
