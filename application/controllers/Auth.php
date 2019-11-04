<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_auth');
	}

	public function index()
	{
		redirect('auth/login');
		//$this->load->view('v_beranda');
	}

	/*public function logFile($data)
	{
		$data=$data;
	    if (!write_file('./log_file.txt', $data)){
	        return true;
	    } else {
	        return false;
	    }
	}*/

	/*public function get_logFile()
	{
		echo file_get_contents("log_file.txt");
	}*/

	public function login()
	{
		if ($this->session->userdata('login') == true) {
			//$log = date("Y-m-d H:i:s").' '.$this->session->userdata('nama').' '.'Login';
			//$this->logFile($log);
			redirect('senat');
		} else {
			$this->load->view('v_login');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		log_message('error', $this->session->userdata('npm').' '.$this->session->userdata('nama').' telah logout');
		redirect('auth');
	}

	public function do_login()
	{
		if ($this->input->post('npm') == '' || $this->input->post('password') == '') {
			$this->session->set_flashdata('notif', 'NPM/Password tidak boleh kososng');
			redirect('auth/login');
		}

		if ($this->m_auth->login() == true) {
			log_message('error', $this->session->userdata('npm').' '.$this->session->userdata('nama').' telah login');
			if ($this->input->post('dari')!="Android") 
			{
				redirect('auth/login');
			}
		} else {
			$this->session->set_flashdata('info', 'Login gagal');
			redirect('auth/login');
		}
	}

}
