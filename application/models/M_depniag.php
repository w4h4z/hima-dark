<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_depniag extends CI_Model {

	public function insertBarang($foto)
	{
		$object = array('nama' => $this->input->post('nama'), 
						'harga' => $this->input->post('harga'),
						'foto'	=> $foto['file_name']
					);

		$this->db->insert('barang', $object);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
 			return false;
		}
	}

	public function getBarang()
	{
		return $this->db->get('barang')->result();
	}

	public function deleteBarang($id)
	{
		$this->db->where('id', $id)->delete('barang');

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function aktifbarang($id,$status)
	{
		$object = array('status' => $status, );
		$this->db->where('id',$id)->update('barang', $object);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function beli()
	{
		$object = array('npm' => $this->session->userdata('npm'),
						'id_barang'	=> $this->input->post('id_barang'),
						'jumlah' => $this->input->post('jumlah')
					);

		$this->db->insert('pesanan', $object);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getCart()
	{
		$npm = $this->session->userdata('npm');
		return $this->db->query("
			SELECT pesanan.id,nama, sum(jumlah) as jml, (sum(jumlah)*harga) as total, harga
			from pesanan
			join barang on barang.id=pesanan.id_barang  
			where npm='".$npm."'  
			group by id_barang
			")->result();

		/*return $this->db->select_sum('jumlah')
						->select('nama,(jumlah*harga) as total')
						->group_by('id_barang')
						->where('npm', '1817101455')
						->join('barang','barang.id=pesanan.id_barang')
						->get('pesanan')->result();*/
	}

	public function pembeli()
	{/*SELECT *,pesanan.id,barang.nama as namabarang, sum(jumlah) as jml, (sum(jumlah)*harga) as total, harga
			from pesanan
			join barang on barang.id=pesanan.id_barang
			join data on data.npm=pesanan.npm   
			group by id_barang*/
		return $this->db->query("
			SELECT data.nama,kelas,barang.nama as namabarang, harga, jumlah, (jumlah*harga) as total, bayar
			from pesanan
			join barang on barang.id=pesanan.id_barang
			join data on data.npm=pesanan.npm   

			")->result();
	}

	public function bayar($npm, $nominal)
	{	
		$data= array(
			'bayar'=>$nominal
		);
		$this->db->where('npm', $npm);
		$this->db->update('pesanan', $data);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

}

/* End of file M_depniag.php */
/* Location: ./application/models/M_depniag.php */