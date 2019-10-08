<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_ristek extends CI_Model 
{
	public function reset($npm)
		{
			$this->db->set("password",sha1($npm));
			$this->db->where("NPM",$npm);
			$this->db->update("data");
		
			if ($this->db->affected_rows() > 0) 
			{
				return true;
			} 
			else 
			{
				return false;
			}
		}	

	public function getnama($npm)
	{
		$this->db->select("nama,kelas");
		$this->db->where('NPM',$npm);		
		return $this->db->get('data')->row();	}

	public function cekpassdef($npm)
	{
		$this->db->select("password");
		$this->db->where('NPM',$npm);		
		return $this->db->get('data')->row()->password;
	}

	public function cekRistek($npm)
	{
		$where=array(
				'NPM' => $npm,
				'departemen'=>'Departemen Riset dan Pengembangan Teknologi'
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

/* End of file M_ristek.php */
/* Location: .//C/Users/ardian/AppData/Local/Temp/fz3temp-2/M_ristek.php */
?>