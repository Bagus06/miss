<?php defined('BASEPATH') or exit('No direct script access allowed');

require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class guru_mapel extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('guru_mapel_model');
	}

	public function upload()
	{
		$this->load->view('index');
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function list()
	{
		$data['data'] = $this->guru_mapel_model->all();

		$guru = $this->guru_mapel_model->guru();
		$o_guru = [];
		foreach ($guru as $key => $value) {
			$o_guru[$value['id']] = $value['nama'];
		}
		$mapel = $this->guru_mapel_model->mapel();
		$o_mapel = [];
		foreach ($mapel as $key => $value) {
			$o_mapel[$value['id']] = $value['nama'];
		}
		$kelas = $this->guru_mapel_model->kelas();
		$o_kelas = [];
		foreach ($kelas as $key => $value) {
			$o_kelas[$value['id']] = $value['nama'];
		}
		$th_ajaran = $this->guru_mapel_model->th_ajaran();
		$o_th_ajaran = [];
		foreach ($th_ajaran as $key => $value) {
			$o_th_ajaran[$value['id']] = $value['title'];
		}

		$this->load->view('index', ['data' => $data, 'mapel' => $o_mapel, 'guru' => $o_guru, 'kelas' => $o_kelas, 'th_ajaran' => $o_th_ajaran]);
	}

	public function edit($id = 0)
	{
		$data = $this->guru_mapel_model->save($id);
		$id = $_GET['id'];
		$data_guru = $this->db->get_where('guru_has_mapel', ['guru_id' => $id])->result_array();
		$guru = $this->db->get_where('guru', ['id' => $id])->result_array();
		$hari = [
			'0' => ['id' => '0', 'nama' => 'Senin'],
			'1' => ['id' => '1', 'nama' => 'Selasa'],
			'2' => ['id' => '2', 'nama' => 'Rabu'],
			'3' => ['id' => '3', 'nama' => 'Kamis'],
			'4' => ['id' => '4', 'nama' => 'Jumat'],
		];
		$o_hari = [
			'Senin',
			'Selasa',
			'Rabu',
			'Kamis',
			'jumat',
		];
		$mapel = $this->guru_mapel_model->mapel();
		$o_mapel = [];
		foreach ($mapel as $key => $value) {
			$o_mapel[$value['id']] = $value['nama'];
		}
		$kelas = $this->guru_mapel_model->kelas();
		$o_kelas = [];
		foreach ($kelas as $key => $value) {
			$o_kelas[$value['id']] = $value['nama'];
		}
		$th_ajaran = $this->guru_mapel_model->th_ajaran();
		$o_th_ajaran = [];
		foreach ($th_ajaran as $key => $value) {
			$o_th_ajaran[$value['id']] = $value['title'];
		}
		$this->load->view(
			'index',
			[
				'data' => $data,
				'data_guru' => $data_guru,
				'mapel' => $mapel,
				'o_mapel' => $o_mapel,
				'th_ajaran' => $th_ajaran,
				'o_th_ajaran' => $o_th_ajaran,
				'guru' => $guru,
				'kelas' => $kelas,
				'o_kelas' => $o_kelas,
				'hari' => $hari,
				'o_hari' => $o_hari,
				'id' => $id
			]
		);
	}
	public function delete($id = 0)
	{
		if (!empty($id)) {
			$data = $this->guru_mapel_model->delete($id);
			$this->load->view('index', ['data' => $data]);
		}
	}
}
