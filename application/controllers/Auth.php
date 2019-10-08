<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_auth');	
		$this->load->model('m_chart');
		$this->load->model('m_user');
	}

	public function index()
	{
		$this->load->view('v_beranda');
	}

	public function login()
	{
		if ($this->session->userdata('login') == true) {
			redirect('senat');
		} else {
			$this->load->view('v_login');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}

	public function do_login()
	{
		if ($this->input->post('npm') == '' || $this->input->post('password') == '') {
			$this->session->set_flashdata('notif', 'NPM/Password tidak boleh kososng');
			redirect('auth/login');
		}

		if ($this->m_auth->login() == true) {
			if ($this->input->post('dari')!="Android") 
			{
				redirect('auth/login');
			}
		} else {
			$this->session->set_flashdata('notif', 'Login gagal');
			redirect('auth/login');
		}
	}

}
