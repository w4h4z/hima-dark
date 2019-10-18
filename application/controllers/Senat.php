<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');

class Senat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_puasa');	
		$this->load->model('m_ib');
		$this->load->model('m_user');
		$this->load->model('m_jdih');
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
			$data['tema'] = $this->db->where('NPM', $this->session->userdata('npm'))->get('data')->row()->tema;
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
			$data['tema'] = $this->db->where('NPM', $this->session->userdata('npm'))->get('data')->row()->tema;
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
			$data['tema'] = $this->db->where('NPM', $this->session->userdata('npm'))->get('data')->row()->tema;
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
			$data['tema'] = $this->db->where('NPM', $this->session->userdata('npm'))->get('data')->row()->tema;
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
			$data['tema'] = $this->db->where('NPM', $this->session->userdata('npm'))->get('data')->row()->tema;
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
			$data['tema'] = $this->db->where('NPM', $this->session->userdata('npm'))->get('data')->row()->tema;
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

	public function admin()
	{
		if ($this->session->userdata('departemen') == 'Departemen Riset dan Teknologi' || $this->session->userdata('akses') == 'ADMIN'){
			$data['title'] = 'Admin';
			$data['main_view'] = 'v_admin';
			$data['tema'] = $this->db->where('NPM', $this->session->userdata('npm'))->get('data')->row()->tema;
			$this->load->view('template', $data);
		}
	}

	public function insert_mhs()
	{
		if ($this->session->userdata('departemen') == 'Departemen Riset dan Teknologi' || $this->session->userdata('akses') == 'ADMIN'){
			$this->form_validation->set_rules('npm','NPM','required|numeric|trim');
			$this->form_validation->set_rules('nama','Nama','required|trim');
			$this->form_validation->set_rules('kelas','Kelas','required|trim');
			$this->form_validation->set_rules('departemen','Departemen','trim');
			$this->form_validation->set_rules('jabatan','Jabatan','trim');
			$this->form_validation->set_rules('password','Password','required|trim');
	 
			if($this->form_validation->run() != false){
				if ($this->m_user->insert_mhs()) {
					$this->session->set_flashdata('success', 'Insert data berhasil');
					redirect('senat/admin');
				} else {
					$this->session->set_flashdata('fail', 'Insert data gagal');
					redirect('senat/admin');
				}
			}else{
				$this->session->set_flashdata('fail', validation_errors());
				redirect('senat/admin');
			}
		}
	}


	public function updateTema($tema)
	{
		$r = array('status' => true);
		if ($this->m_user->updateTema($tema)) {
			json_encode($r);
		} else {
			$r['status'] = false;
			json_encode($r);
		}
	}


	public function insert_mhs_csv()
	{

		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'csv';
		$config['max_size']  = '1000';
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('file-csv')){
			$this->session->set_flashdata('fail', $this->upload->display_errors());
			redirect('senat/admin');
		}
		else{
			$upload_data = $this->upload->data(); 
  			$file_name =   $upload_data['file_name'];

			$count=0;
	        $fp = fopen(base_url().'uploads/'.$file_name,'r') or die("can't open file");
	        while($csv_line = fgetcsv($fp,1024,";"))
	        {
	            $count++;
	            if($count == 1)
	            {
	                continue;
	            }//keep this if condition if you want to remove the first row
	            for($i = 0, $j = count($csv_line); $i < $j; $i++)
	            {
	                $insert_csv = array();
	                $insert_csv['nama'] = $csv_line[0];
	                $insert_csv['kelas'] = $csv_line[1];
	                $insert_csv['ket'] = $csv_line[2];

	            }
	            $i++;
	            $data = array(
	                'nama' => $insert_csv['nama'] ,
	                'kelas' => $insert_csv['kelas'],
	                'ket' => $insert_csv['ket']
	            );

	            $data['crane_features'] = $this->db->insert('tes_csv', $data);
	        	
	        }
	        fclose($fp) or die("can't close file");
	        
	        $this->session->set_flashdata('success', 'Insert data berhasil');
	        redirect('senat/admin');
        }
	}

	/* API KARYA BOSSSSSSSSS */

	public function getStatusPuasa()
	{
		$a=$this->m_puasa->getStatusPuasa();
		$b = array('statusPuasa' => $a);
		echo json_encode($b);
	}

	public function getPuasa()
	{
		$puasa = $this->m_puasa->get_puasa();
		echo json_encode($puasa);
	}

	public function getStatusIb()
	{
		$a=$this->m_ib->getStatusIb();
		$b = array('statusIb' => $a);
		echo json_encode($b);
	}

	public function getIb()
	{
		$ib = $this->m_ib->get_ib();
		echo json_encode($ib);
	}

		public function inputNotif()
	{
		$this->load->model('m_pengumuman');
		if($this->m_pengumuman->pushNotif())
		$data2=array("status"=>true);
		echo json_encode($data2);
	}

	public function getNotif()
	{
		$this->load->model('m_pengumuman');
		$notif = $this->m_pengumuman->get_notif();
		echo json_encode($notif);
	}

	public function deleteNotif($id='')
	{
		$this->load->model('m_pengumuman');

		if($id!='')
		{
			if($this->m_pengumuman->del_notif($id))
			{
				$data2=array("status"=>true);
		
			}
			else
			{
				$data2=array("status"=>false);		
			}
			echo json_encode($data2);			
		}

	}

	/* END OF API KARYA */

}

/* End of file Senat.php */
/* Location: ./application/controllers/Senat.php */