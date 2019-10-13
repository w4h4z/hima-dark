<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');

class Senat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_puasa');	
		$this->load->model('m_ib');
		$this->load->model('m_jdih');	
		$this->load->model('m_depdik');	
		$this->load->model('m_user');
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

	public function puasa()
	{
		if ($this->session->userdata('login') == true) {
			if ($this->m_puasa->getPuasaNpm($this->session->userdata('npm')) == 'Ya') {
				$array = array(
					'puasa' => 'Ya'
				);
				
				$this->session->set_userdata( $array );
			} else {
				$array = array(
					'puasa' => 'Tidak'
				);
				
				$this->session->set_userdata( $array );
			}
			$data['tanggal_puasa'] = $this->m_puasa->get_tanggal_puasa();
			$data['status_puasa'] = $this->m_puasa->getStatusPuasa(); 
			$data['title'] = 'Data Mahasiswa Puasa';
			$data['main_view'] = 'v_puasa';
			$data['puasa'] = $this->m_puasa->get_puasa();
			$this->load->view('template', $data);
		} else {
			redirect('auth');
		}
	}

	public function reset_puasa()
	{
		if($this->m_puasa->resetpuasa() == true){
			$this->session->set_flashdata('notif', 'Reset');
			redirect('senat/puasa');
		} else {
			$this->session->set_flashdata('notif', 'Reset Gagal');
			redirect('senat/puasa');
		}
	}

	public function daftar_puasa()
	{
		$status = $this->m_puasa->getStatusPuasa();

		if ($status == 'Tidak') {
			$this->session->set_flashdata('notif', 'Pendaftaran Izin Bermalam ditutup');
			redirect('senat/puasa');
			return;
		} 

		if($this->m_puasa->daftarPuasa() == true){
			$notif = '';

			if ($this->input->post('switch_daftar_puasa') == 'Ya') {
				$notif = 'Pendaftaran Puasa Sukses';
			} else {
				$notif = 'Pembatalan Puasa Sukses';
			}

			$array = array(
				'puasa' => $this->input->post('switch_daftar_puasa')
			);
			
			$this->session->set_userdata( $array );

			$this->session->set_flashdata('notif', $notif);
			redirect('senat/puasa');
		} else {
			$this->session->set_flashdata('notif', 'Pendaftaran Puasa Gagal');
			redirect('senat/puasa');
		}
	}

	public function buka_tutup_puasa()
	{
		$status = $this->m_puasa->getStatuspuasa();

		if ($status == 'Tidak') {
			if($this->m_puasa->buka_puasa() == true){
				$this->session->set_flashdata('notif', 'Izin Bermalam Dibuka');
				redirect('senat/puasa');
			} else {
				$this->session->set_flashdata('notif', 'Gagal Membuka Izin Bermalam');
				redirect('senat/puasa');
			}
		} else {
			if($this->m_puasa->tutup_puasa() == true){
				$this->session->set_flashdata('notif', 'Izin Bermalam ditutup');
				redirect('senat/puasa');
			} else {
				$this->session->set_flashdata('notif', 'Gagal Menutup Izin Bermalam');
				redirect('senat/puasa');
			}
		}
	}

	public function tanggal_puasa()
	{
		if($this->m_puasa->tanggalpuasa($this->input->post('tanggal_puasa')) == true){
			$this->session->set_flashdata('notif', 'Tanggal diubah');
			redirect('senat/puasa');
		} else {
			$this->session->set_flashdata('notif', '');
			redirect('senat/puasa');
		}
	}


	public function jdih()
	{
		if ($this->session->userdata('login') == true) {
			$data['title'] = 'Data JDIH';
			$data['main_view'] = 'v_jdih';
			$data['jdih'] = $this->m_jdih->getJdih();
			$this->load->view('template', $data);
		} else {
			redirect('auth');
		}
	}

	public function upload_jdih()
	{
		if($this->session->userdata('akses') == "MPM" || $this->session->userdata('akses') == "ADMIN"){
			$config['upload_path'] = './jdih/';
			$config['allowed_types'] = 'pdf|doc|docx|excel';
			$config['max_size']  = '10000';
			
			$this->load->library('upload', $config);

			if ($this->input->post('judul_jdih') == '') {
				$this->session->set_flashdata('fail', 'Judul tidak boleh kosong');
				redirect('senat/jdih');
				return;
			}

			if ( ! $this->upload->do_upload('file_jdih')){
				$this->session->set_flashdata('fail', $this->upload->display_errors());
				redirect('senat/jdih');
			}
			else{
				if ($this->m_jdih->uploadFile($this->upload->data()) == true) {
					$this->session->set_flashdata('success', 'File berhasil diupload');
					redirect('senat/jdih');
				} else {
					$this->session->set_flashdata('fail', 'File gagal diupload');
					redirect('senat/jdih');
				}
			}
		}else{
			die("Tidak boleh!!!");
		}
	}

	public function deleteJdih($id)
	{
		if ($this->session->userdata('akses') == "MPM" || $this->session->userdata('akses') == "ADMIN") {
			if ($this->m_jdih->deleteJdih($id) == true) {
				$this->session->set_flashdata('success', 'File berhasil dihapus');
				redirect('senat/jdih');
			} else {
				$this->session->set_flashdata('fail', 'File gagal dihapus');
				redirect('senat/jdih');
			}
		} else {
			return;
		}
	}

	public function wajar()
	{
		if ($this->session->userdata('login') == true) {
			$data['title'] = 'Data Wajib belajar';
			$data['main_view'] = 'v_wajar';
			$data['active'] = 'Sudah';
			$data['absen'] = $this->m_depdik->getSudahAbsen();
			$this->load->view('template', $data);
		} else {
			redirect('auth');
		}
	}

	public function belum_wajar()
	{
		if ($this->session->userdata('login') == true) {
			$data['title'] = 'Data Wajib belajar';
			$data['main_view'] = 'v_wajar';
			$data['active'] = 'Belum';
			$data['absen'] = $this->m_depdik->getBelumAbsen();
			$this->load->view('template', $data);
		} else {
			redirect('auth');
		}
	}

	public function reset_wajar()
	{
		if ($this->session->userdata('login') == true) {
			if($this->m_depdik->resetAbsensi() == true){
				$this->session->set_flashdata('notif', 'Reset');
				redirect('senat/wajar');
			} else {
				$this->session->set_flashdata('notif', 'Reset Gagal');
				redirect('senat/wajar');
			}
		} else {
			redirect('auth');
		}
	}

	public function gantiPass()
	{
		if (!$this->checkPass()) {
			$this->session->set_flashdata('fail', 'Password lama tidak sama');
			redirect('senat');
		}

		if ($this->m_user->gantiPass() == true) {
			$this->session->set_flashdata('success', 'Ganti Password Berhasil');
			redirect('senat');
		} else {
			$this->session->set_flashdata('fail', 'Ganti Password Gagal');
			redirect('senat');
		}
	}

	public function checkPass()
	{
		$pass = $this->m_user->checkPass()->password;
		$passPost = sha1($this->input->post('pass-lama'));

		if($passPost != $pass){
			return false;
		}

		return true;
	}

}

/* End of file Senat.php */
/* Location: ./application/controllers/Senat.php */