<?php defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		// $this->check_login();
	}
	public function download_template()
	{
		$data = $this->db->list_fields('kelas');
		unset($data[0]);
		$alp = alphabet();
		$tot = count($data);
		$spreadsheet = new Spreadsheet();

		// Set document properties
		$spreadsheet->getProperties()->setCreator('esoftgreat - software development')
			->setLastModifiedBy('esoftgreat - software development')
			->setTitle('Office 2007 XLSX Test Document')
			->setSubject('Office 2007 XLSX Test Document')
			->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
			->setKeywords('office 2007 openxml php')
			->setCategory('Test result file');

		// Add some data
		$i = 0;
		$str = '$spreadsheet->setActiveSheetIndex(0)';
		foreach ($data as $key => $value) {
			$j = $i + 1;
			$str .= '->setCellValue("' . $alp[$i] . '1","' . strtoupper($value) . '")';
			$i++;
		}
		$str .= ';';
		eval($str);
		$spreadsheet->getActiveSheet()->setTitle('template ' . date('d-m-Y H'));

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="kelas.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
		exit;
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function check_login()
	{
		$this->user_model->check_login();
	}

	public function login()
	{
		$this->load->view('user/login', ['data' => $this->user_model->login()]);
	}

	public function logout()
	{
		session_destroy();
		redirect(base_url());
	}

	public function edit($id = 0)
	{
		$data = $this->user_model->save($id);

		$this->load->library('upload');
		$this->upload->do_upload('photo');
		$this->upload;
		$this->upload->display_errors('<p>', '</p>');
		$data['photo'] = $this->upload->data('photo');
		$this->load->view('index', ['data' => $data, 'role' => $this->user_model->role_all()]);
	}
	public function list()
	{
		$data = $this->user_model->all();
		$this->load->view('index', ['data' => $data]);
	}

	public function role()
	{
		$data = $this->user_model->role_save();
		$data['data'] = $this->user_model->role_all();
		$this->load->view('index', ['data' => $data]);
	}

	public function role_edit($id = 0)
	{
		if (!empty($id)) {
			$data = $this->user_model->role_save($id);
			$this->load->view('index', ['data' => $data]);
		}
	}

	public function role_delete($id = 0)
	{
		if (!empty($id)) {
			$data = $this->user_model->role_delete($id);
			$this->load->view('index', ['data' => $data]);
		}
	}

	public function delete($id = 0)
	{
		if (!empty($id)) {
			$data = $this->user_model->delete($id);
			$this->load->view('index', ['data' => $data]);
		}
	}
}
