<?php defined('BASEPATH') or exit('No direct script access allowed');

require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class presensi_mapel extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('presensi_mapel_model');
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function list()
	{
		$data['data'] = $this->presensi_mapel_model->kelas();
		$jurusan = [['nama' => 'RPL'], ['nama' => 'OTKP'], ['nama' => 'TBSM'], ['nama' => 'AKL'], ['nama' => 'BDP']];
		$this->load->view('index', ['data' => $data, 'jurusan' => $jurusan]);
	}

	public function edit($id = 0)
	{
		$day = date ('D');
		$time = date('H:m');
		// $time = '07:30';

		switch($day){
			case 'Mon':			
			$hari_ini = 1;
			break;
			case 'Tue':
			$hari_ini = 2;
			break;
			case 'Wed':
			$hari_ini = 3;
			break;
			case 'Thu':
			$hari_ini = 4;
			break;
			case 'Fri':
			$hari_ini = 5;
			break;
			default:
			$hari_ini = "Tidak di ketahui";		
			break;
		}
		// $hari_ini = 1;


		if($day == 'Sat' || $day == 'Sun'){
			$data['data'] = 'Hari ini hari ' . $day . ' selamat libur.';
			$data['day'] = $day;
			$this->load->view('index', ['data' => $data]);
		}else{

			$username = get_user()['username'];
			$this->db->select('id');
			$exist = $this->db->get_where('guru', ['kode' => $username])->row_array();
			$find_mhp = $this->db->get_where('guru_has_mapel', ['guru_id' => $exist['id'], 'hari' => $hari_ini, 'jam_mulai <' => $time, 'jam_selesai >=' => $time])->row_array();

			if(!empty($find_mhp)){

				$data = $this->presensi_mapel_model->save();
				$kelas = $this->presensi_mapel_model->kelas();
				$o_kelas = [];
				foreach ($kelas as $key => $value) {
					$o_kelas[$value['id']] = $value['nama'];
				}
				$guru = $this->presensi_mapel_model->guru();
				$o_guru = [];
				foreach ($guru as $key => $value) {
					$o_guru[$value['id']] = $value['nama'];
				}
				$mapel = $this->presensi_mapel_model->mapel();
				$o_mapel = [];
				foreach ($mapel as $key => $value) {
					$o_mapel[$value['id']] = $value['nama'];
				}

				$k = $find_mhp['kelas_id'];
				$tanggal = date('Y-m-d');

				$kode = $find_mhp['guru_id'] . '_' . $find_mhp['mapel_id'] . '_' . $tanggal . '_' . $find_mhp['jam_mulai'] . '_' . $find_mhp['jam_selesai'];
				$data['data'] = $this->db->get_where('siswa', ['kelas_id' => $k,])->result_array();
				$presensi = $this->db->get_where('presensi_has_mapel', ['kelas_id' => $k, 'kode' => $kode])->result_array();
				$ket = [
					'0' => ['id' => '0', 'title' => '-', 'color' => 'btn-info'],
					'1' => ['id' => '1', 'title' => 'Berangkat', 'color' => 'btn-primary'],
					'2' => ['id' => '2', 'title' => 'Ijin', 'color' => 'btn-warning'],
					'3' => ['id' => '3', 'title' => 'Alasan', 'color' => 'btn-danger'],
				];

				$this->load->view('index', ['data' => $data, 'ket' => $ket, 'presensi' => $presensi, 'kelas' => $o_kelas, 'guru' => $o_guru, 'mapel' => $o_mapel, 'find_mhp' => $find_mhp]);

			}else{
				$data['data'] = 'presensi null';
				$this->load->view('index', ['data' => $data]);
			}
		}
	}
	public function delete($id = 0)
	{
		if (!empty($id)) {
			$data = $this->presensi_mapel_model->delete($id);
			$this->load->view('index', ['data' => $data]);
		}
	}
}
