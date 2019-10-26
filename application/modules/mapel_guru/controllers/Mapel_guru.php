<?php defined('BASEPATH') or exit('No direct script access allowed');

require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Mapel_guru extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mapel_guru_model');
		// $this->load->model('kelas/kelas_model');
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function delete($id = 0)
	{
		if (!empty($id)) {
			$data = $this->mapel_guru_model->delete($id);
			$this->load->view('index', ['data' => $data]);
		}
	}

	public function list()
	{
		$data = $this->mapel_guru_model->all();

		$guru = $this->mapel_guru_model->guru();
		$o_guru = [];
		foreach ($guru as $key => $value) {
			$o_guru[$value['id']] = $value['nama'];
		}
		$mapel = $this->mapel_guru_model->mapel();
		$o_mapel = [];
		foreach ($mapel as $key => $value) {
			$o_mapel[$value['id']] = $value['nama'];
		}
		$kelas = $this->mapel_guru_model->kelas();
		$o_kelas = [];
		foreach ($kelas as $key => $value) {
			$o_kelas[$value['id']] = $value['nama'];
		}
		$this->load->view('index', ['data' => $data, 'mapel' => $o_mapel, 'guru' => $o_guru, 'kelas' => $o_kelas]);
	}

	public function edit($id = 0)
	{
		$data = $this->mapel_guru_model->save($id);
		$this->load->view('index', ['data' => $data, 'mapel' => $this->mapel_guru_model->mapel(), 'guru' => $this->mapel_guru_model->guru(), 'kelas' => $this->mapel_guru_model->kelas()]);
	}
}
