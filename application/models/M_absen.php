<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_absen extends CI_Model 
{

	public function Absen($npm,$ket,$tanggal)
	{
		$where=array(
				'NPM'=>$npm,
				'ket' => $ket,
				'tanggal'=>$tanggal
			);		
		$this->db->insert('tb_absen',$where);
		if ($this->db->affected_rows() > 0) 
		{
			return true;
		}
		else
		{
			return false;
		}				
	}

	public function cekAbsen($npm,$ket)
	{
		$where=array(
				'NPM'	=>$npm,
				'ket'  	=> $ket,
			);
		if ($this->db->get_where('tb_absen',$where)->num_rows() > 0) 
		{
			return true;
		} else {
			return false;
		}						
	}

	public function cekPengabsen($npm)
	{
		$where=array(
				'kegiatan'=>'Pengabsen',
				'ket' => $npm
			);
		if ($this->db->get_where('keterangan',$where)->num_rows() > 0) 
		{
			return true;
		} else {
			return false;
		}				
	}

	public function getPengabsen()
	{
		$this->db->select('kegiatan,ket');
		$this->db->where('kegiatan','Pengabsen');
		return $this->db->get('keterangan')->result();
	}

	public function tambahPengabsen($npm)
	{
		$where=array(
			'kegiatan'=>'Pengabsen',
			'ket'=>$npm
		);
		$this->db->insert('keterangan',$where);

		if ($this->db->affected_rows() > 0) 
		{
			return true;
		}
		else
		{
			return false;
		}		
	}

	public function hapusPengabsen($npm)
	{
		$where=array('ket'=>$npm);
		$this->db->delete('keterangan',$where);
		if ($this->db->affected_rows() > 0) 
		{
			return true;
		}
		else
		{
			return false;
		}		
	}

	public function cekKegiatanAbsen($ket)
	{
		$where=array(
				'kegiatan'=>'Absen',
				'ket' => $ket
			);
		if ($this->db->get_where('keterangan',$where)->num_rows() > 0) 
		{
			return true;
		} else {
			return false;
		}		
	}

	public function tambahKegiatanAbsen($ket)
	{
		$where=array(
			'kegiatan'=>'Absen',
			'ket'=>$ket
		);
		$this->db->insert('keterangan',$where);

		if ($this->db->affected_rows() > 0) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function getKegiatan()
	{
		$this->db->select('kegiatan,ket');
		$this->db->where('kegiatan','Absen');
		return $this->db->get('keterangan')->result();
	}

	public function resetKegiatan($ket)
	{
		$where=array('ket'=>$ket);
		$this->db->delete('tb_absen',$where);
		if ($this->db->affected_rows() > 0) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function hapusKegiatan($ket)
	{
		$where=array('ket'=>$ket);
		$this->db->delete('keterangan',$where);
		if ($this->db->affected_rows() > 0) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}


	public function resetPengabsen()
	{
		$where=array('ket'=>'Pengabsen');
		$this->db->delete('keterangan',$where);
		if ($this->db->affected_rows() > 0) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

}


?>