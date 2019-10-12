<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		if ($this->input->post('dari')!="Android") 
		{
			//die("tidak boleh");
		}
		$this->load->model('m_profil');
		$this->load->model('m_asrama');
		$this->load->model('m_depdik');
		$this->load->model('m_satma');
		$this->load->model('m_depsen');		
		$this->load->model('m_ristek');		
		$this->load->model('m_absen');		
		$this->load->model('m_auth');
	}


	public function getTanggal()
	{
		$this->load->helper('date');	
		date_default_timezone_set('Asia/Jakarta');
		$datestring = '%d-%M-%Y %H:%i:%s';
		$time = time();
		$tanggal = mdate($datestring, $time);
		return $tanggal;
	}

	public function getMahasiswa()
	{
		echo json_encode($this->m_profil->getMahasiswa($this->input->post('npm')));
	}

	public function getAll()
	{
		echo json_encode($this->m_profil->getAll());
	}

	public function gantiNama()
	{
		$nama=$this->input->post('nama');
		$npm=$this->input->post('npm');
		
		echo json_encode($this->m_profil->gantiNama($nama,$npm));
	}

	public function setPengecek()
	{	
		$data = array(
			'pengecek' => $this->input->post('pengecek'),
			'kamar' => $this->input->post('kamar') 
			//'pengecek' => $pengecek,
			//'kamar' => $kamar
		);
		if ($this->m_asrama->setPengecek($data)) {
			$array2 = array('status'=>'Sukses Mengecek Kamar');
		}
		else
		{
			$array2 = array('status'=>'Gagal Mengecek Kamar');	
		}
		echo json_encode($array2);
		
	}


	public function sudahDipilih($kamar)
	{
		if (strlen($kamar)==3) 
		{
			if($this->m_asrama->sudah_di_pilih($kamar,'astri'))
			{
				$array= array('status' => 'sukses');
			}
			else
			{
						$array= array('status' => 'gagal');	
			}
		}
		else
		{
			if($this->m_asrama->sudah_di_pilih($kamar,'astra'))
			{
				$array= array('status' => 'sukses');
			}
			else
			{
						$array= array('status' => 'gagal');	
			}
		}
		echo json_encode($array);
	//	$this->m_asrama->sudah_di_pilih_astri($kamar);
	}

	public function getPengecek($asrama)
	{
		$array1=$this->m_asrama->getPengecek();
		$array = array();
		foreach ($array1 as $key) {
			if ($asrama=='astri') {
				if (strlen($key->kamar)=='3') {
					$subarray = array(
					'no'=>$key->no,
					'npm'=>$key->pengecek,
					'nama'=>$this->m_profil->getNama($key->pengecek),
					'kamar'=>$key->kamar,
					'status'=>$key->status
					);
					array_push($array, $subarray);
				}
			}
			else
			{
				if (strlen($key->kamar)!=3) {
					$subarray = array(
					'no'=>$key->no,
					'npm'=>$key->pengecek,
					'nama'=>$this->m_profil->getNama($key->pengecek),
					'kamar'=>$key->kamar,
					'status'=>$key->status
					);
					array_push($array, $subarray);
				}

			}

		}
		echo json_encode($array);
	}

	public function getKamarBelumCek($asrama)
	{
		$array = $this->m_asrama->getKamarBelumCek($this->input->post('pengecek'),$asrama);
		
		echo json_encode($array);
	}

	public function getAllKamar()
	{
		$astri=$this->m_asrama->get_asrama('astri');
		$astra=$this->m_asrama->get_asrama('astra');
		
		$array = array();
		
		foreach ($astra as $key) 
		{
			array_push($array,array('id'=>$key->id));
		}
		
		foreach ($astri as $key) 
		{
			array_push($array,array('id'=>$key->id));
		}
		echo json_encode($array);
	}

	public function sudahDicek($kamar)
	{
		if($this->m_asrama->sudahDicek($kamar))
		{
			$array=array('status'=>'sukses');
		}
		else
		{
			$array=array('status'=>'gagal');	
		}
		echo json_encode($array);
	}

	public function waktu()
	{
		echo $this->m_asrama->getWaktu();
	}
	public function getBelumAbsen()
	{
		$belum_absen=$this->m_depdik->getBelumAbsen();
		echo json_encode($belum_absen);		
	}
	public function getSudahAbsen()
	{
		$sudah_absen=$this->m_depdik->getSudahAbsen();
		echo json_encode($sudah_absen);		
	}
	public function scanAbsen()
	{
		$npmPengecek=$this->input->post('npmPengecek');  
		
		$npmCek=$this->input->post('npmCek');
    	$keterangan=$this->input->post('Ket');
		if($this->m_depdik->scan($keterangan,$npmCek))
		{
			$array = array(
				'hasil' 		=> "SUKSES ABSEN ". $npmCek
			);
		}
		else{
			$array = array(
				'hasil' 		=> "GAGAL ABSEN"
			);
		}
		echo json_encode($array);

	}

	public function scanPelanggaran()
	{
		$npmPengecek=$this->input->post('npmPengecek');  
		
		$npmCek=$this->input->post('npmCek');
    	$keterangan=$this->input->post('Ket');
		if($this->m_satma->scan($keterangan,$npmCek))
		{
			$array = array(
				'hasil' 		=> "SUKSES INPUT PELANGGARAN ".$npmCek." ".$keterangan
			);
		}
		else{
			$array = array(
				'hasil' 		=> "GAGAL ABSEN"
			);
		}
		echo json_encode($array);

	}

	public function getPelanggar(){
		$pelanggar=$this->m_satma->getPelanggar();
		echo json_encode($pelanggar);	
	}

//Update tanggal 20 juli 2019
	public function login()//$npm,$password)
	{
		$npm=$this->input->post('npm');
		$password=$this->input->post('password');
		$this->load->helper('string');	

	if ($this->m_auth->loginApi($npm,$password)) {
		$token=sha1(random_string("alnum",10));
		$array = array(
				'npm' 		=> $npm,
				'Status' => "Sukses",
				'Token' => $token
			); 
		$this->m_auth->deleteTokenApi($npm);
		$this->m_auth->saveTokenApi($npm,$token);
		} else {
			$array = array(
				'npm' 		=> $npm,
				'Status' => "Gagal"
			); 
		}
		echo json_encode($array);
		//echo "Sukses";
	}

	public function getData()//$npm,$token)
	{
		$npm=$this->input->post('npm');
		$token=$this->input->post('token');
		if($this->m_auth->verifTokenApi($npm,$token))
		{
			$array=$this->m_auth->getDataApi($npm,$token);
			$this->m_auth->deleteTokenApi($npm);
			$this->m_auth->saveTokenApi($npm,$array['token']);
		}
		else
		{
			$array=array(
				'npm'=>$npm,
				'login'=>false,
				'pesan'=>'token salah'
			);
		}
		echo json_encode($array);
	}

	public function absenHP()//$piketjaga,$npm,$status)
	{
		$piketjaga=$this->input->post('piketjaga');
		$npm=$this->input->post('npm');
		$status=$this->input->post('status');
		if ($this->m_satma->cekPiket($piketjaga)) {
			if ($this->m_auth->isMahasiswa($npm)) {
				$this->m_satma->deleteHP($npm);
				$array=$this->m_satma->insertHP($npm,$status,$this->getTanggal());
			}
			else
			{
				$array=array(
					'status'=>$npm.' bukan data Mahasiswa Valid'
				);
			}
		}
		else
		{
			$array = array(
				'status' => 'Anda bukan Piket Jaga' 
			);
		}
		echo json_encode($array);
	}

	public function getHP()
	{
		$array=$this->m_satma->getHP();
		echo json_encode($array);
	}

	public function getBelumHP()
	{
		$array=$this->m_satma->getBelumHP();
		echo json_encode($array);
	}

	public function resetHP()//$piketjaga)
	{
		$piketjaga=$this->input->post('piketjaga');
		if ($this->m_satma->cekPiket($piketjaga)) 
		{
			if($this->m_satma->resetHP())
			{
				$array=array(
					'status'=>'Berhasil Mereset Absen HP'
				);
			}
			else
			{
				$array=array(
					'status'=>'Gagal Mereset Absen HP'
				);	
			}
		}
		else
		{
			$array=array(
				'status'=>'Anda bukan piket jaga'
			);
		}
		echo json_encode($array);
	}

	public function getPengiring()
	{
		$kelompok=$this->m_depsen->getKelompok()->ket;
		$array=$this->m_depsen->getPengiring($kelompok);
		echo json_encode($array);
	}

	public function getKelompokPengiring()
	{
		$array=$this->m_depsen->getKelompok();
		echo json_encode($array);
	}

	public function setPengiring()//$kelompok,$depsen)
	{
		$kelompok=$this->input->post('kelompok');
		$depsen=$this->input->post('depsen');
		if ($this->m_depsen->cekDepsen($depsen)) 
		{
			if($this->m_depsen->setKelompok($kelompok))
			{
				$this->m_depsen->updateTanggal();
				$array=array(
					'status'=>'sukses ganti pengiring kelompok '.$kelompok
				);
			}
			else
			{
				$array=array(
					'status'=>'gagal ganti pengiring kelompok'
				);	
			}
		}
		else
		{
			$array=array(
				'status'=>'Anda bukan Depsen'
			);
		}
		echo json_encode($array);
	}

	public function getTanggalPengiring()
	{
		$array=$this->m_depsen->getTanggalPengiring();
		echo json_encode($array);
	}

	public function getPiketJaga()
	{
		$array=$this->m_satma->getPiketJaga();
		echo json_encode($array);
	}

	public function tambahKegiatan()//$ristek,$ket)
	{
		$ristek=$this->input->post('ristek');
		$ket=$this->input->post('ket');
		if ($this->m_ristek->cekRistek($ristek)) 
		{
			if (!$this->m_absen->cekKegiatanAbsen($ket)) 
			{
				if ($this->m_absen->tambahKegiatanAbsen($ket)) 
				{
					$array=array(
						'status'=>'Sukses Menambah kegiatan '.$ket
					);			
				}
				else
				{
					$array=array(
						'status'=>'Gagal Menambah kegiatan '
					);			
				}
			}
			else
			{
				$array=array(
					'status'=>'Kegiatan '.$ket.' Sudah Ada'
				);			
			}
		}
		else
		{
			$array=array(
				'status'=>'Anda Bukan Depristek'
			);
		}
		echo json_encode($array);
	}

	public function getKegiatan()
	{
		$array=$this->m_absen->getKegiatan();
		echo json_encode($array);		
	}

	public function getPengabsen()
	{
		$array=$this->m_absen->getPengabsen();
		echo json_encode($array);		
	}

	public function tambahPengabsen()//$ristek,$npm)
	{
		$npm=$this->input->post('npm');
		$ristek=$this->input->post('ristek');
		if ($this->m_ristek->cekRistek($ristek)) 
		{
			if ($this->m_auth->isMahasiswa($npm)) 
			{
				if (!$this->m_absen->cekPengabsen($npm)) 
				{
					if ($this->m_absen->tambahPengabsen($npm)) 
					{
						$array=array(
							'status'=>'Sukses Menambah '.$npm.' Sebagai Pengabsen Kegiatan'
						);
					}
					else
					{
						$array=array(
							'status'=>'Gagal Menambah Pengabsen Kegiatan'
						);
					}		
				}
				else
				{
					$array=array(
						'status'=>$npm.' Sudah menjadi pengabsen'
					);
				}
			}
			else
			{
				$array=array(
					'status'=>$npm. ' Bukan Mahasiswa, Gagal menambah pengabsen'
				);

			}
		}
		else
		{
			$array=array(
				'status'=>'Anda Bukan Ristek'
			);
		}
		echo json_encode($array);
	}


	public function isPengabsen()//$npm)
	{
		$npm=$this->input->post('npm');
		if ($this->m_absen->cekPengabsen($npm)) 
		{
			$array=array(
				'status'=>$npm.' adalah Pengabsen'
			);			
		}
		else
		{
			$array=array(
				'status'=>'Anda Bukan Pengabsen'
			);
		}
		echo json_encode($array);
	}

	public function hapusPengabsen()//$ristek,$npm)
	{
		$npm=$this->input->post('npm');
		$ristek=$this->input->post('ristek');
		if ($this->m_ristek->cekRistek($ristek)) {
			if ($this->m_absen->hapusPengabsen($npm)) 
			{
				$array=array(
					'status'=>'Sukses Menghapus '.$npm.' Dari Pengabsen'
				);
			}
			else
			{
				$array=array(
					'status'=>'Gagal Menghapus Pengabsen'
				);	
			}
		}
		else
		{
			$array=array(
					'status'=>'Anda Bukan Depristek'
				);
		}
		echo json_encode($array);
	}

	
	public function Absen()//$pengabsen,$npm,$ket)
	{
		$pengabsen=$this->input->post('pengabsen');
		$npm=$this->input->post('npm');
		$ket=$this->input->post('ket');
		if ($this->m_absen->cekPengabsen($pengabsen)) 
		{
			if ($this->m_absen->cekKegiatanAbsen($ket)) 
			{
				if ($this->m_auth->isMahasiswa($npm)) 
				{
					if (!$this->m_absen->cekAbsen($npm,$ket)) 
					{
						$tanggal=$this->getTanggal();
						if($this->m_absen->Absen($npm,$ket,$tanggal))
						{
							$array=array(
								'status'=> 'Sukses Absen '.$npm.' Pada Kegiatan '.$ket.' Tanggal '.$tanggal
							);					
						}
						else
						{
							$array=array(
								'status'=>'Gagal Absen'
							);											
						}
					}
					else
					{
						$array=array(
							'status'=>$npm.' Sudah Absen Pada Kegiatan '.$npm
						);											

					}
				}
				else
				{
					$array=array(
						'status'=> $npm.' Bukan Mahasiswa'
					);					
				}
			}
			else
			{
				$array=array(
					'status'=>'Tidak ada Kegiatan '.$ket
				);
			}
		}
		else
		{
			$array=array(
				'status'=>'Anda Bukan Pengabsen'
			);
		}
		echo json_encode($array);
	}

	public function resetKegiatan()//$ristek,$ket)
	{
		$ristek=$this->input->post('ristek');
		$ket=$this->input->post('ket');
		if ($this->m_ristek->cekRistek($ristek)) 
		{
			if ($this->m_absen->resetKegiatan($ket)) 
			{
				$array=array(
					'status'=>'Sukses reset Kegiatan '.$ket
				);						
			}
			else
			{
				$array=array(
					'status'=>'Gagal reset kegiatan '.$ket
				);
			}
		}
		else
		{
			$array=array(
				'status'=>'Anda Bukan Depristek'
			);			
		}
		echo json_encode($array);
	}

	public function hapusKegiatan()//$ristek,$ket)
	{
		$ristek=$this->input->post('ristek');
		$ket=$this->input->post('ket');
		if ($this->m_ristek->cekRistek($ristek)) 
		{
			if ($this->m_absen->resetKegiatan($ket)) 
			{
				if ($this->m_absen->hapusKegiatan($ket)) 
				{
					$array=array(
						'status'=>'Berhasil Menghapus Kegiatan '.$ket
					);
				}
				else
				{
					$array=array(
						'status'=>'Gagal Menghapus Kegiatan '.$ket
					);					
				}
			}
			else
			{
				$array=array(
					'status'=>'Gagal reset Kegiatan'
				);				
			}
		}
		else
		{
			$array=array(
				'status'=>'Anda Bukan Depristek'
			);
		}
		echo json_encode($array);
	}

	public function deletePelanggaran()//$ristek,$ket)
	{
		$satma=$this->input->post('satma');
		$no=$this->input->post('no');
		if ($this->m_satma->cekSatma($satma)) 
		{
			if ($this->m_absen->delPelanggaran($no)) 
			{
				$array=array(
					'status'=>'Berhasil Menghapus Pelanggaran'
				);
			}
			else
			{
				$array=array(
					'status'=>'Gagal Menghapus Pelanggaran'
				);					
			}
		}
		else
		{
			$array=array(
				'status'=>'Anda Bukan Satma'
			);
		}
		echo json_encode($array);
	}

	public function asd()
	{
		$this->load->helper('date');	
		date_default_timezone_set('Asia/Jakarta');
		$datestring = '%d';
		$datestring2 = '-%M-%Y';
		$time = time();
		$tanggal1 = mdate($datestring, $time)+1;
		$tanggal2 = mdate($datestring2, $time);
		$tanggal=$tanggal1.$tanggal2;
		echo $tanggal;
	}

/*	public function cekKamar($asrama)
	{
		$kamar=$this->input->post('kamar');
		$oleh=$this->input->post('oleh');		
		if ($asrama=='astra') 
		{
			if ($this->m_asrama->isAstra($kamar)) 
			{
				if ($this->m_asrama->isBelumDicek($kamar)) 
				{
					if ($this->m_asrama->isPengecekValid($oleh,$kamar)) 
					{
						if ($this->m_asrama->cekAstra($kamar,$oleh)) 
						{
							$array=array(
								'status'=>'Sukses cek kamar '.$asrama.' nomer '.$kamar
							);				
						}
						else
						{
							$array=array(
								'status'=>'Gagal Cek Kamar '.$asrama
							);											
						}
					}
					else
					{
						$array=array(
							'status'=>$oleh.' Tidak berhak mengecek kamar '.$kamar
						);				
					}
				}
				else
				{
					$array=array(
						'status'=>'Kamar '.$kamar.' Sudah dicek'
					);				
				}
			}
			else
			{
				$array=array(
					'status'=>'Tidak ada Kamar nomer '.$kamar.' di '.$asrama
				);				
			}
		}
		elseif ($asrama=='astri') 
		{
			if ($this->m_asrama->isAstri($kamar)) 
			{
				if ($this->m_asrama->isBelumDicek($kamar)) 
				{
					if ($this->m_asrama->isPengecekValid($oleh,$kamar)) 
					{
						if ($this->m_asrama->cekAstri($kamar,$oleh)) 
						{
							$array=array(
								'status'=>'Sukses cek kamar '.$asrama.' nomer '.$kamar
							);				
						}
						else
						{
							$array=array(
								'status'=>'Gagal Cek Kamar '.$asrama
							);											
						}
					}
					else
					{
						$array=array(
							'status'=>$oleh.' Tidak berhak mengecek kamar '.$kamar
						);				
					}
				}
				else
				{
					$array=array(
						'status'=>'Kamar '.$kamar.' Sudah dicek'
					);				
				}
			}
			else
			{
				$array=array(
					'status'=>'Tidak ada Kamar nomer '.$kamar.' di '.$asrama
				);				
			}
		}
		else
		{
			$array=array(
				'status'=>'Asrama Salah'
			);
		}
		echo json_encode($array);
	}*/



}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */