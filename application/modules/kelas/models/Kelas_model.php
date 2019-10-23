<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kelas_model extends CI_Model
{
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
			$msg = ['status' => 'danger', 'msg' => 'jurusan gagal disimpan'];
			$data = $this->input->post();
			if (!empty($id)) {
				$this->db->select('id');
				$exist = $this->db->get_where('jurusan', ['nama' => $data['nama']])->row_array();
				$current_user = $this->db->get_where('jurusan', ['id' => $id])->row_array();
				if ($current_user['id'] == $exist['id'] || empty($exist)) {
					$this->db->where('id', $id);
					if ($this->db->update('jurusan', $data)) {
						$msg = ['status' => 'success', 'msg' => 'jurusan berhasil disimpan'];
					}
				} else {
					$msg['msgs'][] = 'nama sudah ada';
				}
			} else {
				$this->db->select('id');
				$exist = $this->db->get_where('jurusan', ['nama' => $data['nama']])->row_array();
				if (empty($exist)) {
					if ($this->db->insert('jurusan', $data)) {
						$msg = ['status' => 'success', 'msg' => 'jurusan berhasil disimpan'];
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
	public function jurusan()
	{
		return $this->db->get('jurusan')->result_array();
	}
}
