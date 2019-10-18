<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_puasa extends CI_Model {

	    public function __construct()
    {
        parent::__construct();
    }

	public function get_puasa()
	{
		/*$this->db->select("nama,NPM,kelas");
		$this->db->where('puasa','Ya');
		$this->db->order_by("kelas", "asc");
		return $this->db->get('data');	
*/
		$query = $this->db->query("
                SELECT (@row_number:=@row_number + 1) 
                AS num, nama,NPM,kelas 
                FROM data,(SELECT @row_number:=0) AS t 
                where puasa='Ya' and NPM!='0192837465'
                order by kelas asc
			");	
		
		return $query->result();
	}

	public function getPuasaNpm($npm)
	{
		return $this->db->select('puasa')->where('NPM', $npm)->get('data')->row()->puasa;
	}

	public function tanggalPuasa($tanggal)
	{
		$object = array('puasa' => $tanggal );
		$this->db->where('id', '1')->update('tanggal_puasa_ib', $object);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function get_tanggal_puasa()
	{
		return $this->db->where('id', '1')->get('tanggal_puasa_ib')->row()->puasa;
	}

	public function get_tidak_puasa()
	{
		$this->db->select("nama,NPM,kelas");
		$this->db->where('puasa','Tidak');
		$this->db->order_by("kelas", "asc");
		return $this->db->get('data');		
	}

	public function get_puasa_tidak_tetap()
	{
		$this->db->select("nama,NPM,kelas");
		$this->db->where('puasa','Ya');
		$this->db->where('labelpuasa','Tidak');		
		$this->db->order_by("kelas", "asc");
		return $this->db->get('data');
	}

	public function get_tidak_puasa_tetap()
	{
		$this->db->select("nama,NPM,kelas");
		$this->db->where('puasa','Tidak');
		$this->db->where('labelpuasa','Ya');		
		$this->db->order_by("kelas", "asc");
		return $this->db->get('data');
	}

	public function get_status_tetap()
	{
		$this->db->select("nama,NPM,kelas");
		$this->db->where('labelpuasa','Ya');
		$this->db->order_by("kelas", "asc");
		return $this->db->get('data');		
	}

	public function get_status_tidaktetap()
	{
		$this->db->select("nama,NPM,kelas");
		$this->db->where('labelpuasa','Tidak');
		$this->db->order_by("kelas", "asc");
		return $this->db->get('data');		
	}

	public function ganti_tetap($npm)
	{
		$this->db->set("labelpuasa","Ya");
		$this->db->where("npm",$npm);
		$this->db->update("data");
	}

	public function ganti_tidak_tetap($npm)
	{
		$this->db->set("labelpuasa","Tidak");
		$this->db->where("npm",$npm);
		$this->db->update("data");
	}

	public function buka_puasa()
	{
		$this->db->set("puasa","Ya");
		$this->db->where("npm","0192837465");
		$this->db->update("data");

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function tutup_puasa()
	{
		$this->db->set("puasa","Tidak");
		$this->db->where("npm","0192837465");
		$this->db->update("data");

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function resetPuasa()
	{
		$object = array('puasa' => 'Tidak', );
		$this->db->where('puasa','Ya')->where('npm !=','0192837465')->update('data', $object);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function daftarPuasa()
	{
		$status = '';
		if ($this->input->post('switch_daftar_puasa') == 'Ya') {
			$status = 'Ya';
		} else {
			$status = 'Tidak';
		}

		$object = array('puasa' => $status);
		$this->db->where('npm', $this->session->userdata('npm'))->update('data', $object);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function daftarPuasaAPI()
	{
		$object = array('puasa' => $this->input->post('puasa'));
		$this->db->where('npm', $this->input->post('npm'))->update('data', $object);
		
		if ($this->db->affected_rows() > 0){
			return true;
		}
		else
		{
			return false;
		}
	}

	public function getStatusPuasa()
	{
		return $this->db->select('puasa')->where('NPM','0192837465')->get('data')->row()->puasa;
	}

}

/* End of file m_ib.php */
/* Location: ./application/models/m_ib.php */


?>