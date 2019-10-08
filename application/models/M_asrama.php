
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_asrama extends CI_Model {
public function __construct()
{
	parent::__construct();
}

	public function getWaktu()
	{
		$this->load->helper('date');	
		date_default_timezone_set('Asia/Jakarta');
		$datestring = '%d-%M-%Y %H:%i:%s';
		$time = time();
		return mdate($datestring, $time);
	}

	public function cekAstri($id,$oleh)
	{

		$data=array(
					'rak_handuk'=>$this->input->post('rak_handuk'),
					'kunci_smartcard'=>$this->input->post('kunci_smartcard'),
					'wrn_gantungan_baju'=>$this->input->post('wrn_gantungan_baju'),
					'jml_gantungan_baju'=>$this->input->post('jml_gantungan_baju'),
					'kerapihan_gantungan_baju'=>$this->input->post('kerapihan_gantungan_baju'),
					'wrn_lipatan_baju'=>$this->input->post('wrn_lipatan_baju'),
					'jml_lipatan_baju'=>$this->input->post('jml_gantungan_baju'),
					'kerapihan_lipatan_baju'=>$this->input->post('kerapihan_lipatan_baju'),
					'wrn_lipatan_celana'=>$this->input->post('wrn_lipatan_celana'),
					'jml_lipatan_celana'=>$this->input->post('jml_lipatan_celana'),
					'kerapihan_lipatan_celana'=>$this->input->post('kerapihan_lipatan_celana'),
					'kerapihan_tempat_tidur'=>$this->input->post('kerapihan_tempat_tidur'),
					'kebersihan_tempat_tidur'=>$this->input->post('kebersihan_tempat_tidur'),
					'kerapihan_buku'=>$this->input->post('kerapihan_buku'),
					'kebersihan_buku'=>$this->input->post('kebersihan_buku'),
					'keringkasan_buku'=>$this->input->post('keringkasan_buku'),
					'kebersihan_lemari'=>$this->input->post('kebersihan_lemari'),
					'kerapihan_alatmakeup'=>$this->input->post('kerapihan_alatmakeup'),
					'kerapihan_alat_cuci'=>$this->input->post('kerapihan_alat_cuci'),
					'kerapihan_tasjinjing'=>$this->input->post('kerapihan_tasjinjing'),
					'kesesuaian_tasjinjing'=>$this->input->post('kesesuaian_tasjinjing'),
					'keringkasan_tasjinjing'=>$this->input->post('keringkasan_tasjinjing'),
					'kerapihan_taspesiar'=>$this->input->post('kerapihan_taspesiar'),
					'kesesuaian_isi_taspesiar'=>$this->input->post('kesesuaian_isi_taspesiar'),
					'kerapihan_taskuliah'=>$this->input->post('kerapihan_taskuliah'),
					'kesesuaian_isitaskuliah'=>$this->input->post('kesesuaian_isitaskuliah'),
					'kaca_lemari'=>$this->input->post('kaca_lemari'),
					'kaca_balkon'=>$this->input->post('kaca_balkon'),
					'teralis_kacabalkon'=>$this->input->post('teralis_kacabalkon'),
					'pendingin_ruangan'=>$this->input->post('pendingin_ruangan'),
					'ventilasi_pintu'=>$this->input->post('ventilasi_pintu'),
					'pintu_km'=>$this->input->post('pintu_km'),
					'kloset_km'=>$this->input->post('kloset_km'),
					'cermin_km'=>$this->input->post('cermin_km'),
					'exhaustfan_km'=>$this->input->post('exhaustfan_km'),
					'lantai_km'=>$this->input->post('lantai_km'),
					'kaca_km'=>$this->input->post('kaca_km'),
					'gayung_km'=>$this->input->post('gayung_km'),
					'lantai'=>$this->input->post('lantai'),
					'sawang'=>$this->input->post('sawang'),
					'kebersihan_balkon'=>$this->input->post('kebersihan_balkon'),
					'jml_sepatu'=>$this->input->post('jml_sepatu'),
					'kerapihan_sepatu'=>$this->input->post('kerapihan_sepatu'),
					'oleh'=>$oleh,
					'pada'=>$this->getWaktu()		
		);
			$this->db->where('id', $id);
			$this->db->update('astri', $data);

			if ($this->db->affected_rows() > 0) 
			{
				return true;
			} 
			else 
			{
				return false;
			}

	}

	public function cekAstra($id,$oleh)
		{
			$data = array (
				'warna_gantungan_baju'=>$this->input->post('warna_gantungan_baju'),
				'jumlah_gantungan_baju'=>$this->input->post('jumlah_gantungan_baju'),
				'kerapihan_gantungan_baju'=>$this->input->post('kerapihan_gantungan_baju'),
				'warna_lipatan_baju'=>$this->input->post('warna_lipatan_baju'),
				'jumlah_lipatan_baju'=>$this->input->post('jumlah_lipatan_baju'),
				'kerapihan_lipatan_baju'=>$this->input->post('kerapihan_lipatan_baju'),
				'warna_lipatan_celana'=>$this->input->post('warna_lipatan_celana'),
				'jumlah_lipatan_celana'=>$this->input->post('jumlah_lipatan_celana'),
				'kerapihan_lipatan_celana'=>$this->input->post('kerapihan_lipatan_celana'),
				'kerapihan_tempat_tidur'=>$this->input->post('kerapihan_tempat_tidur'),
				'kebersihan_tempat_tidur'=>$this->input->post('kebersihan_tempat_tidur'),
				'kerapihan_buku'=>$this->input->post('kerapihan_buku'),
				'kebersihan_buku'=>$this->input->post('kebersihan_buku'),
				'keringkasan_buku'=>$this->input->post('keringkasan_buku'),
				'kebersihan_lemari'=>$this->input->post('kebersihan_lemari'),
				'kerapihan_lemari'=>$this->input->post('kerapihan_lemari'),
				'koper'=>$this->input->post('koper'),
				'tas_pesiar'=>$this->input->post('tas_pesiar'),
				'kerapihan_tas_kuliah'=>$this->input->post('kerapihan_tas_kuliah'),
				'keseuaian_tas_kuliah'=>$this->input->post('keseuaian_tas_kuliah'),
				'kaca_ventilasi'=>$this->input->post('kaca_ventilasi'),
				'kaca_jendela'=>$this->input->post('kaca_jendela'),
				'teralis_kaca_balkon'=>$this->input->post('teralis_kaca_balkon'),
				'pendingin_ruangan'=>$this->input->post('pendingin_ruangan'),
				'lantai'=>$this->input->post('lantai'),
				'langit_kamar'=>$this->input->post('langit_kamar'),
				'balkon'=>$this->input->post('balkon'),
				'laci'=>$this->input->post('laci'),
				'bawah_tempat_tidur'=>$this->input->post('bawah_tempat_tidur'),
				'bawah_meja_belajar'=>$this->input->post('bawah_meja_belajar'),
				'oleh'=>$oleh,
				'pada'=>$this->getWaktu()
			);
			
			$this->db->where('id', $id);
			$this->db->update('astra', $data);

			if ($this->db->affected_rows() > 0) 
			{
				return true;
			} 
			else 
			{
				return false;
			}

		}

	public function get_asrama($asrama)
	{
		$this->db->select("id");
		$this->db->where('status',"BELUM");
		return $this->db->get($asrama)->result();				
	}

	public function isAstra($kamar)
	{
		$where=array(
				'id'=>$kamar
			);
		if ($this->db->get_where('astra',$where)->num_rows() > 0) 
		{
			return true;
		} else {
			return false;
		}				
	}

	public function isAstri($kamar)
	{
		$where=array(
				'id'=>$kamar
			);
		if ($this->db->get_where('astri',$where)->num_rows() > 0) 
		{
			return true;
		} else {
			return false;
		}				
	}

	public function get_kamar($asrama,$kamar)
	{
		$this->db->select("*");
		$this->db->where('id',$kamar);
		return $this->db->get($asrama)->result();				
	}	

	public function getKamarBelumCek($pengecek,$asrama)
	{
		$this->db->select("kamar");
		$this->db->where('pengecek',$pengecek);
		$this->db->where('status','BELUM');
		$kamar = $this->db->get('tabel_asrama_pengecek')->result();
		$kamarfix = array();				
		foreach ($kamar as $key) {
			if ($asrama=='astri') 
			{
				if (strlen($key->kamar)==3) 
				{
				array_push($kamarfix, array('kamar' => $key->kamar ));
				}
			}
			else if ($asrama=='astra')
			{
				if (strlen($key->kamar)!=3) 
				{
				array_push($kamarfix, array('kamar' => $key->kamar ));
				}
			}
		}
		return $kamarfix;
	}

	public function setPengecek($data)
	{

		$data = array(
        'pengecek' => $data['pengecek'],
        'kamar' => $data['kamar'],
        'status' => 'BELUM'
		);
	
		$this->db->insert('tabel_asrama_pengecek', $data);
	
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}


	public function sudah_di_pilih($kamar,$asrama)
	{
		$this->db->set("status","SUDAH");
		$this->db->where("id",$kamar);
		$this->db->update($asrama);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}



	public function getPengecek()
	{
		$this->db->select("no,pengecek,kamar,status");
		$this->db->order_by('kamar', 'ASC');
		return $this->db->get('tabel_asrama_pengecek')->result();
	}

	public function sudahDicek($kamar)
	{
		$this->db->set("status","SUDAH");
		$this->db->where("kamar",$kamar);
		$this->db->update('tabel_asrama_pengecek');

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function isBelumDicek($kamar)
	{
		$where=array(
			'kamar' => $kamar,
			'status'=>'BELUM'
		);
		if ($this->db->get_where('tabel_asrama_pengecek',$where)->num_rows() > 0) 
		{
			return true;
		} 
		else 
		{
			return false;
		}
	}

	public function isPengecekValid($oleh,$kamar)
	{
		$where=array(
			'kamar' => $kamar,
			'pengecek'=>$oleh
		);
		if ($this->db->get_where('tabel_asrama_pengecek',$where)->num_rows() > 0) 
		{
			return true;
		} 
		else 
		{
			return false;
		}
	}

	public function resetPengecek()
	{
		$object = array('status' => 'BELUM');

		$this->db->update('astra', $object);
		$this->db->update('astri', $object);

		$this->db->empty_table('tabel_asrama_pengecek');

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function bolehPindahKamar()
	{
		$where=array(
			'kegiatan' => 'Pindah Kamar',
			'ket'=>'Boleh'
		);
		if ($this->db->get_where('tabel_asrama_pengecek',$where)->num_rows() > 0) 
		{
			return true;
		} 
		else 
		{
			return false;
		}		
	}

	public function pindahKamar($kamar)
	{
		$where=array(
			'kegiatan' => 'Pindah Kamar',
			'ket'=>'Boleh'
		);
		$this->db->where($where);
		$this->db->update('kamar', $kamar);
	}

}

/* End of file m_asrama.php */
/* Location: ./application/models/m_asrama.php */