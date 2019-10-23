<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kelas_model extends CI_Model
{
	public function all()
	{
		$this->db->select('jurusan.*, kelas.level');
		$this->db->from('jurusan');
		$this->db->join('kelas', 'kelas.id = jurusan.kelas_id');
		$query = $this->db->get()->result_array();;
		return $query;
	}
	public function upload($file = '', $mode = '')
	{
		if (!empty($file['tmp_name'])) {
			$dir = FCPATH . 'assets/images/modules/kelas/';
			if (!is_dir($dir)) {
				mkdir($dir, 0777);
			}
			if (copy($file['tmp_name'], $dir . $_SESSION[str_replace('/', '_', base_url() . '_logged_in')]['username'] . $mode . '.xlsx')) {
				return $_SESSION[str_replace('/', '_', base_url() . '_logged_in')]['username'] . '.xlsx';
			}
		}
	}
	public function save($id = 0)
	{
		$msg = [];
		if (!empty($this->input->post())) {
			$msg = ['status' => 'danger', 'msg' => 'kelas gagal disimpan'];
			$data = $this->input->post();
			if (!empty($id)) {
				$exist = $this->db->get_where('jurusan', ['kelas_id' => $data['kelas_id']])->result_array();
				foreach ($exist as $key => $value) {
					if ($value['nama'] == $data['nama']) {
						$exist = [$exist];
					} else {
						$exist = [];
					}
				}
				if (empty($exist)) {
					$this->db->where('id', $id);
					if ($this->db->update('jurusan', $data)) {
						$msg = ['status' => 'success', 'msg' => 'kelas berhasil disimpan'];
					}
				} else {
					$msg['msgs'][] = 'nama sudah ada';
				}
			} else {
				$exist = $this->db->get_where('jurusan', ['kelas_id' => $data['kelas_id']])->result_array();
				foreach ($exist as $key => $value) {
					if ($value['nama'] == $data['nama']) {
						$exist = [$exist];
					} else {
						$exist = [];
					}
				}
				if (empty($exist)) {
					if ($this->db->insert('jurusan', $data)) {
						$msg = ['status' => 'success', 'msg' => 'kelas berhasil disimpan'];
					}
				} else {
					$msg['msgs'][] = 'nama sudah ada';
				}
			}
		}
		if (!empty($id)) {
			$msg['data'] = $this->db->get_where('jurusan', ['id' => $id])->row_array();
		}
		return $msg;
	}
	public function delete($id = 0)
	{
		if (!empty($id)) {
			if ($this->db->delete('jurusan', ['id' => $id])) {
				return ['status' => 'success', 'msg' => 'data berhasil dihapus'];
			} else {
				return ['status' => 'danger', 'msg' => 'data gagal dihapus'];
			}
		}
	}
	public function kelas()
	{
		return $this->db->get('kelas')->result_array();
	}
}
