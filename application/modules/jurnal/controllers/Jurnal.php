<?php defined('BASEPATH') or exit('No direct script access allowed');

require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Jurnal extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('jurnal_model');
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function list()
	{
		$data = $this->jurnal_model->save();
		$data['data'] = $this->jurnal_model->all();
		$this->load->view('index', ['data' => $data]);
	}

	public function edit($id = 0)
	{
		$data = $this->jurnal_model->save($id);
		$this->load->view('index', ['data' => $data]);
	}
	public function delete($id = 0)
	{
		if (!empty($id)) {
			$data = $this->jurnal_model->delete($id);
			$this->load->view('index', ['data' => $data]);
		}
	}
}
