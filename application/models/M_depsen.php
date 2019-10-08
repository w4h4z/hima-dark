<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_depsen extends CI_Model {


	public function cekDepsen($npm)
	{
		$where=array(
				'NPM' => $npm,
				'departemen'=>'Departemen Kesenian'
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

	public function setKelompok($kelompok)
	{
		$this->db->set("ket",$kelompok);
		$this->db->where("kegiatan","Pengiring");
		$this->db->update("keterangan");
		if ($this->db->affected_rows() > 0) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function updateTanggal()
	{
		$this->load->helper('date');	
		date_default_timezone_set('Asia/Jakarta');
		$datestring = '%d-%M-%Y';
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		$this->db->set("ket",$tanggal);
		$this->db->where("kegiatan","Tanggal Pengiring");
		$this->db->update("keterangan");
	}

	public function getKelompok()
	{
		$this->db->select('kegiatan,ket');
		$this->db->where('kegiatan','Pengiring');
		return $this->db->get('keterangan')->row();
	}	

    public function getPengiring($kelompok)
	{
        $this->db->select('npm,nama');
        $this->db->where('pengiring',$kelompok);
		$query = $this->db->get('data');
		
		return $query->result();	
	}

	public function getTanggalPengiring()
	{
        $this->db->select('kegiatan,ket');
        $this->db->where('kegiatan','Tanggal Pengiring');
		$query = $this->db->get('keterangan');
		
		return $query->row();	
	}

}
