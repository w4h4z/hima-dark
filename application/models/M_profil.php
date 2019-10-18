<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_profil extends CI_Model {
	public function getMahasiswa($npm)
	{
		$query = $this->db->select('NPM,nama,kelas,password,jabatan,departemen,puasa,ib,akses')
		->where('NPM',$npm)
		->get('data');

		if ($this->db->affected_rows() > 0) {
			$data = $query->row();

			$array = array(
				'npm' 		=> $data->NPM,
				'nama'		=> $data->nama,
				'kelas'		=> $data->kelas,
				'jabatan'	=> $data->jabatan,
				'departemen'=> $data->departemen,
				'puasa'		=> $data->puasa,
				'ib'		=> $data->ib,
				'akses'		=> $data->akses,
				'login'		=> true
			);
		}
		else {
			$array = array(
				'login'=> false
			);
		} 

		return $array;
	}

	public function getAll()
	{
		$this->db->select('nama,kelas,NPM,jabatan,departemen,akses')->where('akses !=','ADMIN');

		return $this->db->get('data')->result();
	}

	public function gantiNama($nama,$npm)
	{		
		$this->db->set("nama",$nama);
		$this->db->where("NPM",$npm);
		$this->db->update("data");

		if ($this->db->affected_rows() > 0) 
		{
			$array = array('status'=> true);
		}
		else
		{
			$array = array('status'=> false);	
		}
		return $array;

	}

	public function getNama($npm)
	{
		$this->db->select('nama')->where('NPM',$npm);
		return $this->db->get('data')->row()->nama;
	}

}

/* End of file M_profil.php */
/* Location: ./application/models/M_profil.php */