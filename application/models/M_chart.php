<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_chart extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }
	public function insertLogIb1()
	{
		$this->db->select("NPM");
		$this->db->where('ib','Ya');
		$this->db->where('NPM !=','123456');
		$ib = $this->db->get('data')->result();	

		foreach ($ib as $data) {
			$object = array(
				'npm' 		=> $data->NPM,
				'action' 	=> '1',
				'tanggal' 	=> date('Y-m-d'),
				'ket'		=> '',
			);
			
			$this->db->insert('log', $object);	
		}

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function insertLogPuasa()
	{
		$this->db->select("NPM");
		$this->db->where('puasa','Ya');
		$this->db->where('NPM !=','123456');
		$ib = $this->db->get('data')->result();	

		foreach ($ib as $data) {
			$object = array(
				'npm' 		=> $data->NPM,
				'action' 	=> '2',
				'tanggal' 	=> date('Y-m-d'),
				'ket'		=> '',
			);
			
			$this->db->insert('log', $object);	
		}

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getLogIb()
	{
		return $this->db->select('tanggal,count(*) as jumlah')->where('action','1')->group_by('tanggal')->get('log')->result();
	}


	public function getLogPuasa()
	{
		return $this->db->select('tanggal,count(*) as jumlah')->where('action','2')->group_by('tanggal')->get('log')->result();
	}

}

/* End of file m_chart.php */
/* Location: ./application/models/m_chart.php */