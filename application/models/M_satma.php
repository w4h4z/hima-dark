<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_satma extends CI_Model 
{
	public function setPiket($npm,$jabatan)
	{
		$this->load->helper('date');	
		date_default_timezone_set('Asia/Jakarta');
		$datestring = '%Y-%m-%d';
		$waktu=mdate($datestring);
		$data = array(
        'NPM' => $npm,
        'periode' => $waktu,
		'status' => 'Aktif',
		'jabatan' => $jabatan,
		);
	
		$this->db->insert('piket_jaga', $data);
	
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}	

	public function scan($keterangan,$npmcek)
	{
		$this->load->helper('date');	
		date_default_timezone_set('Asia/Jakarta');
		$datestring = '%d-%M-%Y %H:%i:%s';
		$time = time();
		$tanggal = mdate($datestring, $time);

		$data = array('kode' => $keterangan,
		'NPM' => $npmcek,
		'Waktu' => $tanggal );

		$this->db->insert('pelanggaran', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}	
	}

	public function get_aktif()
	{
		$query = $this->db->query("
		SELECT piket_jaga.NPM, data.nama, piket_jaga.periode,piket_jaga.jabatan, piket_jaga.status
		FROM piket_jaga
		INNER JOIN data
		ON piket_jaga.NPM=data.NPM;
			");	
		
		return $query->result();	
	}
	function delPiket($npm){
		// $npm=$this->input->post('npm');
		$this->db->where('npm', $npm);
		$result=$this->db->delete('piket_jaga');
		return $result;
	}

	function getPelanggar(){
		$this->db->select("a.*,b.nama");
		$this->db->from("pelanggaran a");
		$this->db->join("data b","a.NPM=b.NPM",'left');
		return $this->db->get()->result();
	}

	public function insertHP($npm,$status,$tanggal)
	{
		$where=array(
			'NPM'=>$npm,
			'status'=>$status,
			'tanggal'=>$tanggal
		);
		$this->db->insert('tb_absenhp',$where);

		if ($this->db->affected_rows() > 0) 
		{
			$array=array(
				'status'=>$status.' Absen HP '.$npm.' Pada '.$tanggal
			);
		}
		else
		{
			$array=array(
				'status'=>'Gagal Absen HP'
			);
		}

		return $array;

	}

	public function deleteHP($npm)
	{
		$where=array('NPM'=>$npm);
		$this->db->delete('tb_absenhp',$where);
	}

	public function cekSatma($npm)
	{
		$where=array(
				'NPM' => $npm,
				'departemen'=>'Satuan Mahasiswa'
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

	public function cekPiket($npm)
	{
		$where=array(
				'NPM' => $npm,
				'piketjaga' =>'Ya'//$this->input->post('password'))
			) ;
		if ($this->db->get_where('data',$where)->num_rows() > 0) 
		{
			return true;
		} else {
			return false;
		}		
	}

	public function resetHP()
	{
		$data=$this->db->get('tb_absenhp');
		if($data->num_rows()>0)
		{
			foreach ($data->result() as $key) {
				$where=array(
					'NPM'=>$key->NPM
				);
				$this->db->delete('tb_absenhp',$where);
			}
		}
		if ($this->db->affected_rows() > 0) 
		{
			return true;
		} 
		else 
		{
			return false;
		}		
	}

	public function resetPelanggar()
	{
		$data=$this->db->get('pelanggaran');
		if($data->num_rows()>0)
		{
			foreach ($data->result() as $key) {
				$where=array(
					'NPM'=>$key->NPM
				);
				$this->db->delete('pelanggaran',$where);
			}
		}
		if ($this->db->affected_rows() > 0) 
		{
			return true;
		} 
		else 
		{
			return false;
		}		
	}

	public function delPelanggar($no)
	{
		$this->db->where('no', $no);
		$this->db->delete('pelanggaran');
		if ($this->db->affected_rows() > 0) 
		{
			return true;
		} 
		else 
		{
			return false;
		}						
	}

	public function getHP()
	{
		$this->db->select("a.*,b.nama");
		$this->db->from("tb_absenhp a");
		$this->db->join("data b","a.NPM=b.NPM",'left');
		return $this->db->get()->result();
	}

	public function getBelumHP()
	{
		$array1=$this->getHP();
		$array2=$this->db->select("NPM,nama");
		$array2->where("akses!=","ADMIN");
		foreach ($array1 as $key) 
		{
			$array2->where("NPM!=",$key->NPM);
		}
		return $array2->get("data")->result();	
	}

	public function getPiketJaga()
	{
		$this->db->select("nama,NPM");
		$this->db->where('piketjaga','Ya');
		return $this->db->get('data')->result();
	}

}

/* End of file M_ristek.php */
/* Location: .//C/Users/ardian/AppData/Local/Temp/fz3temp-2/M_ristek.php */
?>