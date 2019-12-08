<?php defined('BASEPATH') or exit('No direct script access allowed');

require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class presensi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('presensi_model');
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function list()
	{
		if (!is_petugas() || !is_siswa()) {
			$data['data'] = $this->presensi_model->kelas();
			$jurusan = [['nama' => 'RPL'], ['nama' => 'OTKP'], ['nama' => 'TBSM'], ['nama' => 'AKL'], ['nama' => 'BDP']];
			$this->load->view('index', ['data' => $data, 'jurusan' => $jurusan]);
		}else{
			$link = str_replace('/', '_', base_url());
			$id_u = $_SESSION[$link.'_logged_in']['id'];
			$this->db->select('kelas_id');
			$find_siswa = $this->db->get_where('siswa', ['user_id' => $id_u])->row_array();
			redirect('http://localhost/miss/presensi/edit?k=' . $find_siswa['kelas_id']);
		}
	}

	public function edit($id = 0)
	{
		$data = $this->presensi_model->save();
		$kelas = $this->presensi_model->kelas();
		$o_kelas = [];
		foreach ($kelas as $key => $value) {
			$o_kelas[$value['id']] = $value['nama'];
		}
		$k = $this->input->get('k');
		$data['data'] = $this->db->get_where('siswa', ['kelas_id' => $k,])->result_array();
		$presensi = $this->db->get_where('presensi', ['kelas_id' => $k, 'tanggal' => date('Y-m-d')])->result_array();
		$ket = [
			'0' => ['id' => '0', 'title' => '-', 'color' => 'btn-info'],
			'1' => ['id' => '1', 'title' => 'Berangkat', 'color' => 'btn-primary'],
			'2' => ['id' => '2', 'title' => 'Ijin', 'color' => 'btn-warning'],
			'3' => ['id' => '3', 'title' => 'Alasan', 'color' => 'btn-danger'],
		];
		$this->load->view('index', ['data' => $data, 'ket' => $ket, 'presensi' => $presensi, 'kelas' => $o_kelas]);
	}
	public function delete($id = 0)
	{
		if (!empty($id)) {
			$data = $this->presensi_model->delete($id);
			$this->load->view('index', ['data' => $data]);
		}
	}
}
