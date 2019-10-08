<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }
	public function reset_password($npm)
	{
		$this->db->set("password",sha1($npm));
		$this->db->where("npm",$npm);
		$this->db->update("data");
	}

	public function gantiPass()
	{
		$data = array('password' => sha1($this->input->post('password')));
		$this->db->where('NPM', $this->session->userdata('npm'))->update('data', $data);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function gantiPassNew($token)
	{
		$data = array('password' => sha1($this->input->post('password')));
		$this->db->where('token', $token)->update('data', $data);

		$data1 = array('status' => 'Aktif');
		$this->db->where('token', $token)->update('data', $data1);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function lupaPassNew($token)
	{
		$data = array('password' => sha1($this->input->post('pass-act1')));
		$this->db->where('token', $token)->update('data', $data);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function cekToken($token)
	{
		return $this->db->select('token,status')->where('token', $token)->get('data')->row();
	}

	public function checkPass()
	{
		return $this->db->select('password')->where('npm', $this->session->userdata('npm'))->get('data')->row();
	}

/* End of file m_user.php */
/* Location: ./application/models/m_user.php */
}
?>