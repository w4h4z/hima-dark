<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jdih extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }
	public function getJdih()
	{
		$query = $this->db->query("
                SELECT (@row_number:=@row_number + 1) 
                AS num, nama,tgl_upload,files ,nomor
                FROM nama_file,(SELECT @row_number:=0) AS t
                order by tgl_upload desc
			");	
		
		return $query->result();
	}

	public function uploadFile($data)
	{
		if($this->session->userdata('akses') != "MPM")
		{
			die("Anda Bukan MPM");
		}
		$a = array(
			'nama' 			=> $this->input->post('judul_jdih'),
			'npm'			=> $this->session->userdata('npm'),
			'files'			=> $data['file_name']
		);
		$this->db->insert('nama_file', $a);
		//chmod('./user/files/'.$data['file_name'].'',0777);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteJdih($id)
	{
		$jdih = $this->db->select('files')->where('nomor', $id)->get('nama_file')->row()->files;
		unlink('./jdih/'.$jdih.'');

		$this->db->where('nomor', $id)->delete('nama_file');

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

}

/* End of file m_jdih.php */
/* Location: ./application/models/m_jdih.php */