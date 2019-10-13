<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_depdik extends CI_Model {
    public function getKeterangan()
    {
        $this->db->select("nama,NPM");	
		$this->db->order_by('NPM', 'ASC');
		return $this->db->get('data')->result();
    }

    public function getBelumAbsen()
	{
		$this->db->select("nama,NPM,wajar,kelas");
        $this->db->order_by('kelas', 'ASC');
        $this->db->where('wajar',"TIDAK");
        $this->db->where("akses!=","ADMIN");
		return $this->db->get('data')->result();
    }

    public function getSudahAbsen()
	{
		$this->db->select("nama,NPM,wajar,kelas");
        $this->db->order_by('kelas', 'ASC');
        $this->db->where('wajar!=',"TIDAK");
        $this->db->where("akses!=","ADMIN");
		return $this->db->get('data')->result();
	}
	public function get_sudah()
	{
		/*$this->db->select("nama,NPM,kelas");
		$this->db->where('ib','Ya');
		return $this->db->get('data');	*/

		$query = $this->db->query("
                SELECT (@row_number:=@row_number + 1) 
                AS num, nama,NPM,kelas 
                FROM data,(SELECT @row_number:=0) AS t 
                where wajar='HADIR' and NPM !='123456'
                order by kelas asc
			");	
		
		return $query->result();	
	}

	public function scan($keterangan,$npmcek)
	{
		$object = array('wajar' => $keterangan);
		$this->db->where('NPM', $npmcek)->update('data', $object);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}	
	}

	public function resetAbsensi()
	{
		$object = array('wajar' => 'TIDAK');
		$this->db->where('wajar','HADIR')->where('npm !=','123456')->update('data', $object);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
    

	

}

/* End of file M_depdik.php */
/* Location: ./application/models/M_depdik.php */