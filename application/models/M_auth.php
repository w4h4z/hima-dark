<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_auth extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function login()
	{
		$query = $this->db->select('NPM,nama,kelas,password,jabatan,departemen,puasa,ib,akses,piketjaga')
			->where('NPM', $this->input->post('npm'))
			/*->where('password', $this->PaswModify($this->input->post('password'),$this->input->post('npm')))*/
			->where('password', sha1($this->input->post('password')))
			->get('data');

		if ($this->db->affected_rows() > 0) {
			$data = $query->row();

			$array = array(
				'npm' 		=> $data->NPM,
				'nama'		=> $data->nama,
				'kelas'		=> $data->kelas,
				'password'	=> $data->password,
				'jabatan'	=> $data->jabatan,
				'departemen' => $data->departemen,
				'puasa'		=> $data->puasa,
				'ib'		=> $data->ib,
				'akses'		=> $data->akses,
				'piketjaga' => $data->piketjaga,
				'login'		=> true
			);

			$tanggal_puasa_ib = $this->db->where('id', '1')->get('tanggal_puasa_ib')->row();

			$z = array(
				'tanggal_puasa' => $tanggal_puasa_ib->puasa,
				'tanggal_ib'	   => $tanggal_puasa_ib->ib
			);


			if ($this->input->post('dari') == "Android") {
					echo json_encode($array);
				} else {
					$this->session->set_userdata($array);
					$this->session->set_userdata($z);
				}
			return true;
		} else {
			return false;
		}
	}

	public function insertEmail()
	{
		$object = array('email' => $this->input->post('email-act'));
		$this->db->where('NPM', $this->input->post('npm-act'))->update('data', $object);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function cekStatus($npm)
	{
		return $this->db->select('status')->where('NPM', $npm)->get('data')->row()->status;
	}

	private function PaswModify($value, $npm)
	{
		return sha1(sha1($value) . $this->db->select('nama')->where('npm', $npm)->get('data')->row()->nama);
	}

	public function updateToken()
	{
		$this->load->helper('string');
		$object = array('token' =>  random_string('alnum', 40));
		$this->db->where('NPM', $this->input->post('npm-act'))->update('data', $object);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getToken()
	{
		return $this->db->select('token')->where('NPM', $this->input->post('npm-act'))->get('data')->row()->token;
	}

	public function getTokenPass()
	{
		return $this->db->select('token')->where('NPM', $this->input->post('npm-act1'))->get('data')->row()->token;
	}

	public function sendToken()
	{
		$this->load->helper('string');
		$object = array('token' => random_string('alnum', 40));
		$this->db->where('NPM', $this->input->post('npm-act1'))->update('data', $object);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}


// 20 Juli 2019
	public function loginApi($npm,$password)
	{

		$where=array(
				'NPM' => $npm,
				'password' =>sha1($password)//$this->input->post('password'))
			) ;
		if ($this->db->get_where('data',$where)->num_rows() > 0) 
		{
			return true;
		} else {
			return false;
		}
	}

	public function deleteTokenApi($npm)
	{
		$where=array('NPM'=>$npm);
		//$this->db->where($where);
		$this->db->delete('tb_token',$where);
	}

	public function saveTokenApi($npm,$token)
	{
		$where=array(
			'NPM'=>$npm,
			'token'=>$token
		);
		$this->db->insert('tb_token',$where);
	}

	public function verifTokenApi($npm,$token)
	{

		$where=array(
				'NPM' => $npm,
				'token' =>$token//$this->input->post('password'))
			);
		if ($this->db->get_where('tb_token',$where)->num_rows() > 0) 
		{
			return true;
		} 
		else 
		{
			return false;
		}
	}

	public function getDataApi($npm,$token)
	{
		$query = $this->db->select('NPM,nama,kelas,password,jabatan,departemen,puasa,ib,akses,piketjaga')
			->where('NPM', $npm)
			->get('data');

		if ($this->db->affected_rows() > 0) {
			$data = $query->row();

			$array = array(
				'npm' 		=> $data->NPM,
				'nama'		=> $data->nama,
				'kelas'		=> $data->kelas,
				'password'	=> $data->password,
				'jabatan'	=> $data->jabatan,
				'departemen' => $data->departemen,
				'puasa'		=> $data->puasa,
				'ib'		=> $data->ib,
				'akses'		=> $data->akses,
				'piketjaga' => $data->piketjaga,
				'token'		=> sha1($token),
				'login'		=> true
			);
		} 
		else {
			$array=array(
				'npm'=>$npm,
				'login'=>false
			);
		}	
		return $array;	
	}

	public function isMahasiswa($npm)
	{
		$where=array(
				'NPM' => $npm
			);
		if ($this->db->get_where('data',$where)->num_rows() > 0) 
		{
			return true;
		} 
		else 
		{
			return false;
		}
	}

}

/* End of file m_auth.php */
/* Location: ./application/models/m_auth.php */
