<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Senat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_puasa');	
		$this->load->model('m_ib');
		$this->load->model('m_user');
		$this->load->model('m_jdih');
		$this->load->model('m_chart');
		$this->load->model('m_pengumuman');
		$this->load->model('m_asrama');
		$this->load->model('m_depniag');	
		$this->load->model('m_depdik');	
		$this->load->model('m_satma');	
		$this->load->model('m_depsen');	
	}

	public function index()
	{
		if ($this->session->userdata('login') == true) {
			$data['title'] = 'Dashboard';
			$data['main_view'] = 'v_dashboard';
			$this->load->view('template', $data);
		} else {
			redirect('auth');
		}
	}

	public function ib()
	{
		if ($this->session->userdata('login') == true) {
			if ($this->m_ib->getIbNpm($this->session->userdata('npm')) == 'Ya') {
				$array = array(
					'ib' => 'Ya'
				);
				
				$this->session->set_userdata( $array );
			} else {
				$array = array(
					'ib' => 'Tidak'
				);
				
				$this->session->set_userdata( $array );
			}
			$data['tanggal_ib'] = $this->m_ib->get_tanggal_ib();
			$data['status_ib'] = $this->m_ib->getStatusIb(); 
			$data['title'] = 'Data Mahasiswa Izin Bermalam';
			$data['main_view'] = 'v_ib';
			$data['ib'] = $this->m_ib->get_ib();
			$this->load->view('template', $data);
		} else {
			redirect('auth');
		}
	}

	public function reset_ib()
	{
		if($this->m_ib->resetIb() == true){
			$this->session->set_flashdata('notif', 'Reset');
			redirect('senat/ib');
		} else {
			$this->session->set_flashdata('notif', 'Reset Gagal');
			redirect('senat/ib');
		}
	}

	public function daftar_ib()
	{
		$status = $this->m_ib->getStatusIb();

		if ($status == 'Tidak') {
			$this->session->set_flashdata('notif', 'Pendaftaran Izin Bermalam ditutup');
			redirect('senat/ib');
			return;
		} 

		if($this->m_ib->daftarIb() == true){
			$notif = '';

			if ($this->input->post('switch_daftar_ib') == 'Ya') {
				$notif = 'Pendaftaran Izin Bermalam Sukses';
			} else {
				$notif = 'Pembatalan Izin Bermalam Sukses';
			}

			$array = array(
				'ib' => $this->input->post('switch_daftar_ib')
			);
			
			$this->session->set_userdata( $array );

			$this->session->set_flashdata('notif', $notif);
			redirect('senat/ib');
		} else {
			$this->session->set_flashdata('notif', 'Pendaftaran Izin Bermalam Gagal');
			redirect('senat/ib');
		}
	}

	public function buka_tutup_ib()
	{
		$status = $this->m_ib->getStatusIb();

		if ($status == 'Tidak') {
			if($this->m_ib->buka_ib() == true){
				$this->session->set_flashdata('notif', 'Izin Bermalam dibuka');
				redirect('senat/ib');
			} else {
				$this->session->set_flashdata('notif', 'Gagal Membuka Izin Bermalam');
				redirect('senat/ib');
			}
		} else {
			if($this->m_ib->tutup_ib() == true){
				$this->session->set_flashdata('notif', 'Izin Bermalam ditutup');
				redirect('senat/ib');
			} else {
				$this->session->set_flashdata('notif', 'Gagal Menutup Izin Bermalam');
				redirect('senat/ib');
			}
		}
	}

	public function tanggal_ib()
	{
		if($this->m_ib->tanggalIb($this->input->post('tanggal_ib')) == true){
			$this->session->set_flashdata('notif', 'Tanggal diubah');
			redirect('senat/ib');
		} else {
			$this->session->set_flashdata('notif', '');
			redirect('senat/ib');
		}
	}

}

/* End of file Senat.php */
/* Location: ./application/controllers/Senat.php */