<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengumuman extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }	
		public function pushNotif()
	{
			$this->load->helper('date');	
			date_default_timezone_set('Asia/Jakarta');
			$datestring = '%d-%M-%Y %H:%i:%s';
			$time = time();
			$tanggal = mdate($datestring, $time);
//			echo $tanggal;

		$data = array(

        'dari' => $this->input->post('dariSiapa'),
        'kepada' => $this->input->post('kepada'),
        'pesan' => $this->input->post('pesan'),
        'pengirim' => $this->input->post('pengirim'),
        'tanggal' => $tanggal
		);
	$this->db->insert('pengumuman', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function get_notif()
	{
		$this->db->select("dari,kepada,pesan,pengirim,tanggal,no");
		$this->db->order_by("no", "desc");
		return $this->db->get('pengumuman')->result();			
	}

	public function del_notif($id)
	{
		$this->db->where('no',$id);
		$this->db->delete("pengumuman");
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}



}

/* End of file m_pengumuman.php */
/* Location: ./application/models/m_pengumuman.php */