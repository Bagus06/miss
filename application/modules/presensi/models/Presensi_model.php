<?php defined('BASEPATH') or exit('No direct script access allowed');

class presensi_model extends CI_Model
{
	public function all()
	{
		return $this->db->get('presensi')->result_array();
	}
	public function upload($file = '', $mode = '')
	{
		if (!empty($file['tmp_name'])) {
			$dir = FCPATH . 'assets/images/modules/presensi/';
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
			$id_s = $this->input->post('siswa_id');
			$tanggal = $this->input->post('tanggal');
			$this->db->select('id');
			$id = $this->db->get_where('presensi', ['siswa_id' => $id_s, 'tanggal' => $tanggal])->row_array();
			$id = $id['id'];
			$msg = ['status' => 'danger', 'msg' => 'presensi gagal disimpan'];
			$data = $this->input->post();
			if (!empty($id)) {
				$this->db->select('id');
				$exist = $this->db->get_where('presensi', ['siswa_id' => $id_s, 'tanggal' => $tanggal])->row_array();
				$current_user = $this->db->get_where('presensi', ['id' => $id])->row_array();
				if ($current_user['id'] == $exist['id'] || empty($exist)) {
					$this->db->where('id', $id);
					if ($this->db->update('presensi', $data)) {
						$msg = ['status' => 'success', 'msg' => 'presensi berhasil disimpan'];
					}
				} else {
					$msg['msgs'][] = 'Gagal edit presensi u';
				}
			} else {
				$this->db->select('id');
				$exist =  $this->db->get_where('presensi', ['siswa_id' => $id_s, 'tanggal' => $tanggal])->row_array();
				if (empty($exist)) {
					if ($this->db->insert('presensi', $data)) {
						$msg = ['status' => 'success', 'msg' => 'presensi berhasil disimpan'];
					}
				} else {
					$msg['msgs'][] = 'Gagal tambah presensi siswa t';
				}
			}
		}
		if (!empty($id)) {
			$msg['data'] = $this->db->get_where('presensi', ['id' => $id])->row_array();
		}
		return $msg;
	}
	public function delete($id = 0)
	{
		if (!empty($id)) {
			if ($this->db->delete('presensi', ['id' => $id])) {
				return ['status' => 'success', 'msg' => 'data berhasil dihapus'];
			} else {
				return ['status' => 'danger', 'msg' => 'data gagal dihapus'];
			}
		}
	}
	public function kelas()
	{
		$data = $this->db->get('kelas')->result_array();
		return $data;
	}
}
