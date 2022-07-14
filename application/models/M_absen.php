<?php
class M_absen extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function simpan_absen($table, $data)
	{
		// $tabel = ($table == null) ? $this->table : $table;
		$this->db->insert($table, $data);

		return $this->db->insert_id();
	}

	// public function getDiagram()
	// {
	// 	$this->db->select('p.email, us.id, smp.id');
	// 	$this->db->join('presensi p', 'p.email = us.email', 'left');
	// 	$this->db->join('user us', 'us.id = smp.ldap_id', 'left');
	// 	$this->db->join('siap_m_pegawai smp', 'smp.unit_kerja_id = siap_m_unit_kerja_id.id', 'left');
	// 	$this->db->where('siap_m_unit_kerja . kode_jenis_unit = 3');
	// }

	public function get_c($email, $tanggal_abs)
	{
		$query = $this->db->get('m_dokumen');
		return $query->result();
		$this->db->where('email', $email);
		$this->db->where('tanggal', $tanggal_abs);
		$this->db->from('presensi');
		return $this->db->count_all_results();
	}

	public function cek_absen_sebel($email, $tanggal_abs)
	{
		$konsts = 1;
		$this->db->where('email', $email);
		$this->db->where('tanggal', $tanggal_abs);
		$this->db->where('status', $konsts);
		$this->db->from('presensi');
		return $this->db->count_all_results();
	}

	public function cek_status($tanggal_abs)
	{
		$status = 1;
		$this->db->where('tanggal', $tanggal_abs);
		$this->db->where('status', $status);
		$this->db->from('presensi');
		return $this->db->count_all_results();
	}

	public function set_status_masuk($email, $tanggal_abs)
	{
		$konsts = 1;
		$this->db->set('status', $konsts);
		$this->db->where('email', $email);
		$this->db->where('tanggal', $tanggal_abs);
		$this->db->where('tipe_absen', $konsts);
		$this->db->update('presensi');
	}

	public function set_status_pulang($email, $tanggal_abs)
	{
		$konsts = 1;
		$konstt = 2;
		$this->db->set('status', $konsts);
		$this->db->where('email', $email);
		$this->db->where('tanggal', $tanggal_abs);
		$this->db->where('tipe_absen', $konstt);
		$this->db->update('presensi');
	}
}
