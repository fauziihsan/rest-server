<?php 

/**
* 
*/
class Pasien_model extends CI_Model
{

	// public function getPasien($id = null) {

	// 	$pasien = $this->db->get('pasien')->result_array();
	// 	var_dump($pasien);
	// }
	
	public function getPasien($id = null) {

		if ($id === null) {
			return $this->db->get('pasien')->result_array();
		} else{
			return $this->db->get_where('pasien', ['id_pasien' => $id])->result_array();
		}
	}

	public function deletePasien($id) {
		// return $this->db->delete('pasien', ['id_pasien' => $id->affected_rows()]) 	;
		// return $this->db->affected_rows();

		$this->db->delete('pasien', ['id_pasien' => $id]);
		return $this->db->affected_rows();
	}

	public function createPasien($data) {

		return $this->db->insert('pasien', $data);
		
	}

	public function updatePasien($data, $id) {

		return $this->db->update('pasien', $data, ['id_pasien' => $id]);
		
	}
}