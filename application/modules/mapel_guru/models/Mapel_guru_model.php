<?php defined('BASEPATH') or exit('No direct script access allowed');

class Mapel_guru_model extends CI_Model
{
	public function all()
	{
		return $this->db->get('guru_has_mapel')->result_array();
	}

	public function save($id = 0)
	{
		$msg = [];
		if (!empty($this->input->post())) {
			$msg = ['status' => 'danger', 'msg' => 'mapel gagal disimpan'];
			$data = $this->input->post();
			if (!empty($id)) {
				$this->db->select('id');
				$exist = $this->db->get_where('guru_has_mapel', ['id_kelas' => $data['id_kelas']])->row_array();
				$current_mapel = $this->db->get_where('guru_has_mapel', ['id' => $id])->row_array();
				if ($current_mapel['id'] == $exist['id'] || empty($exist)) {
					$this->db->where('id', $id);
					if ($this->db->update('guru_has_mapel', $data)) {
						$msg = ['status' => 'success', 'msg' => 'mapel guru berhasil disimpan'];
					}
				} else {
					$msg['msgs'][] = 'mapel guru sudah ada';
				}
			} else {
				// var_dump($data);
				// die;
				$this->db->select('id');
				$exist = $this->db->get_where('guru_has_mapel', ['id_guru' => $data['id_guru']])->row_array();
				$exist_kode = $this->db->get_where('guru_has_mapel', ['id_mapel' => $data['id_mapel']])->row_array();
				if ($exist_kode['id_mapel'] == $data['id_mapel']) {
					if ($exist_kode['id_kelas'] != $data['id_kelas']) {
						if ($this->db->insert('guru_has_mapel', $data)) {
							$msg = ['status' => 'success', 'msg' => 'guru berhasil disimpan'];
						}
					} else {
						$msg = ['status' => 'success', 'msg' => 'guru berhasil disimpan'];
					}
				} else {
					$msg['msgs'][] = 'guru sudah mengampu di kelas tersebut';
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
	public function guru()
	{
		$data = $this->db->get('guru')->result_array();
		return $data;
	}
	public function kelas()
	{
		$data = $this->db->get('kelas')->result_array();
		return $data;
	}
}
