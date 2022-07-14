<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	public function __construct(){
        parent::__construct();
        
        // init model
        $this->load->model('general_model', 'm_general');
		$this->functions->check_session();
	}
    
    public function index() {
        $data = [
            'title' => "Profile",
            'user'  => $this->m_general->get_where('user', ['email' => $this->session->email])->row_array()
        ];

        $this->_view('user/v_profile', $data);
    }

	public function dt_profile(){
        if(!$this->input->is_ajax_request()) show_404();

        // $edit_priv      = $this->input->post('edit_priv', TRUE);
        // $delete_priv    = $this->input->post('delete_priv', TRUE);
        // $kode           = $this->input->post('kode', TRUE);

        $edit_button    = '<a class="dropdown-item has-icon edit" href="javascript:void(0)" data-id="$1"><i class="far fa-heart"></i> Edit</a>';
        $delete_button  = '<a class="dropdown-item has-icon hapus" href="javascript:void(0)" data-id="$1"><i class="far fa-heart"></i> Hapus</a>';

		$order = "DESC";
        $this->datatables->select('p.id, p.keterangan, p.tanggal, p.waktu_absen, sp.status, tp.tipe, kon.kondisi');
        $this->datatables->join('m_status_presensi sp', 'p.status = sp.id', 'left');
        $this->datatables->join('m_tipe_presensi tp', 'p.tipe_absen = tp.id', 'left');
        $this->datatables->join('tr_kesehatan tr', 'p.id = tr.presensi_id', 'left');
        $this->datatables->join('m_kondisi kon', 'tr.kondisi_id = kon.id', 'left');
        // $this->datatables->join('m_sakit s', 'tr.sakit_id = s.id');
        $this->datatables->where('p.email', $this->session->email);
        $this->datatables->from('presensi p');
		$this->datatables->order_by('p.id', $order);
		$this->datatables->group_by('p.id');

        $this->datatables->add_column('no', '');

        // $this->datatables->add_column('aksi', 
        // '<div class="dropdown d-inline">
        //     <button class="btn btn-primary" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        //     <i class="fa fa-bars"></i>
        //     </button>
        //     <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">'
        //     . $edit_button . $delete_button .
        //     '</div>
        // </div>', 'encode(id)');

        header('Content-Type: application/json');
        echo $this->datatables->generate();
    }

    public function dt_keluhan(){
        if(!$this->input->is_ajax_request()) show_404();
        
        $kode       = $this->input->post('kode', TRUE);

        $this->datatables->select('s.keluhan');
		$this->datatables->from('tr_kesehatan tr');
        $this->datatables->join('m_sakit s', 'tr.sakit_id = s.id');
        $this->datatables->where('tr.presensi_id', $kode);

        $this->datatables->add_column('no', '');

        // $this->datatables->add_column('aksi', $pilih_btn, 'id');

        header('Content-Type: application/json');
        echo $this->datatables->generate();
	}

    private function _view($view, $data) {
        $this->load->view('templates/header',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view($view, $data);
		$this->load->view('templates/footer');
		$this->load->view('templates/scripts');
    }
}
