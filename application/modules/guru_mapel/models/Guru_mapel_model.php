<?php defined('BASEPATH') or exit('No direct script access allowed');

class guru_mapel_model extends CI_Model
{
	public function all()
	{
		return $this->db->get('guru_has_mapel')->result_array();
	}
	
	public function save($id = 0)
	{
		$msg = [];
		if (!empty($this->input->post())) {
			$msg = ['status' => 'danger', 'msg' => 'guru_mapel gagal disimpan'];
			$data = $this->input->post();
			if (!empty($id)) {
				$this->db->select('id');
				$exist = $this->db->get_where('guru_has_mapel', ['title' => $data['title']])->row_array();
				$current_user = $this->db->get_where('guru_has_mapel', ['id' => $id])->row_array();
				if ($current_user['id'] == $exist['id'] || empty($exist)) {
					$this->db->where('id', $id);
					if ($this->db->update('guru_has_mapel', $data)) {
						$msg = ['status' => 'success', 'msg' => 'guru_mapel berhasil disimpan'];
					}
				} else {
					$msg['msgs'][] = 'title sudah ada';
				}
			} else {
				if ($this->db->insert('guru_has_mapel', $data)) {
					$msg = ['status' => 'success', 'msg' => 'guru mapel berhasil disimpan'];
				}
			}
		}
		if (!empty($id)) {
			$msg['data'] = $this->db->get_where('guru_has_mapel', ['id' => $id])->row_array();
		}
		return $msg;
	}
	public function delete($id = 0)
	{
		if (!empty($id)) {
			if ($this->db->delete('guru_has_mapel', ['id' => $id])) {
				return ['status' => 'success', 'msg' => 'data berhasil dihapus'];
			} else {
				return ['status' => 'danger', 'msg' => 'data gagal dihapus'];
			}
		}
	}
	public function mapel()
	{
		$data = $this->db->get('mapel')->result_array();
		return $data;
	}
	public function kelas()
	{
		$data = $this->db->get('kelas')->result_array();
		return $data;
	}
	public function th_ajaran()
	{
		$data = $this->db->get('th_ajaran')->result_array();
		return $data;
	}
}
