<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ib extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }
	public function get_ib()
	{
		/*$this->db->select("nama,NPM,kelas");
		$this->db->where('ib','Ya');
		return $this->db->get('data');	*/

		$query = $this->db->query("
                SELECT (@row_number:=@row_number + 1) 
                AS num, nama,NPM,kelas 
                FROM data,(SELECT @row_number:=0) AS t 
                where ib='Ya' and NPM !='0192837465'
                order by kelas asc
			");	
		
		return $query->result();	
	}

	public function getIbNpm($npm)
	{
		return $this->db->select('ib')->where('NPM', $npm)->get('data')->row()->ib;
	}

	public function tanggalIb($tanggal)
	{
		$object = array('ib' => $tanggal );
		$this->db->where('id', '1')->update('tanggal_puasa_ib', $object);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function get_tidak_ib()
	{
		$this->db->select("nama,NPM,kelas");
		$this->db->where('ib','Tidak');
		return $this->db->get('data');		
	}

	public function buka_ib()
	{
		$this->db->set("ib","Ya");
		$this->db->where("NPM","0192837465");
		$this->db->update("data");

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function tutup_ib()
	{
		$this->db->set("ib","Tidak");
		$this->db->where("NPM","0192837465");
		$this->db->update("data");

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function get_tanggal_ib()
	{
		return $this->db->where('id', '1')->get('tanggal_puasa_ib')->row()->ib;
	}

	public function daftarIb()
	{
		$status = '';
		if ($this->input->post('switch_daftar_ib') == 'Ya') {
			$status = 'Ya';
		} else {
			$status = 'Tidak';
		}

		$object = array('ib' => $status);
		$this->db->where('npm', $this->session->userdata('npm'))->update('data', $object);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function daftarIbAPI()
	{
		$object = array('ib' => $this->input->post('ib'));
		$this->db->where('npm', $this->input->post('npm'))->update('data', $object);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}	
	}

	public function resetIb()
	{
		$object = array('ib' => 'Tidak');
		$this->db->where('npm !=','0192837465');
		$this->db->update('data', $object);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getStatusIb()
	{
		return $this->db->select('ib')->where('NPM','0192837465')->get('data')->row()->ib;
	}

}

/* End of file m_ib.php */
/* Location: ./application/models/m_ib.php */


?>