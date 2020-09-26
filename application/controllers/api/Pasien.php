<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';



class Pasien extends REST_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model('Pasien_model', 'pasien');

		$this->methods['index_get']['limit'] = 300;
	}
	
	public function index_get(){
		$id = $this->get('id');

		if ($id === null) {
			$pasien = $this->pasien->getPasien();
		} else{
			$pasien = $this->pasien->getPasien($id);
		}

		if ($pasien) {
			$this->response([
	            'status' => true,
	            'data' => $pasien
	        ], REST_Controller::HTTP_OK);
		} else {
			$this->response([
	            'status' => false,
	            'message' => 'id not found!'
	        ], REST_Controller::HTTP_NOT_FOUND);
		}
		
	}

	public function index_delete(){
		$id = $this->delete('id');

		if ($id === null) {
			$this->response([
	            'status' => false,
	            'message' => 'provide an id!'
	        ], REST_Controller::HTTP_BAD_REQUEST);
		} else {
			
			if ($this->pasien->deletePasien($id) > 0 ) {
				$this->response([
		            'status' => true,
		            'id' => $id,
		            'message' => 'deleted.'
		        ], REST_Controller::HTTP_NO_CONTENT);

			} else {
				$this->response([
		            'status' => false,
		            'message' => 'id not found!'
		        ], REST_Controller::HTTP_BAD_REQUEST);
			}
		}
	}

	public function index_post(){
		$data = [
			'nama_pasien' => $this->post('nama_pasien'),
			'jenis_kelamin_pasien' => $this->post('jenis_kelamin_pasien'),
			'umur' => $this->post('umur'),
			'alamat' => $this->post('alamat'),
			'alergi' => $this->post('alergi'),
			'no_hp' => $this->post('no_hp')
		];

		if($this->pasien->createPasien($data) > 0) {
			$this->response([
	            'status' => true,
	            'message' => 'new pasien has been created.'
	        ], REST_Controller::HTTP_CREATED);
		} else {
			$this->response([
	            'status' => false,
	            'message' => 'failed to create new data!'
	        ], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function index_put(){

		$id = $this->put('id');
		$data = [
			'nama_pasien' => $this->put('nama_pasien'),
			'jenis_kelamin_pasien' => $this->put('jenis_kelamin_pasien'),
			'umur' => $this->put('umur'),
			'alamat' => $this->put('alamat'),
			'alergi' => $this->put('alergi'),
			'no_hp' => $this->put('no_hp')
		];

		if($this->pasien->updatePasien($data, $id) > 0) {
			$this->response([
	            'status' => true,
	            'message' => 'data pasien has been updated.'
	        ], REST_Controller::HTTP_NO_CONTENT);
		} else {
			$this->response([
	            'status' => false,
	            'message' => 'failed to update data!'
	        ], REST_Controller::HTTP_BAD_REQUEST);
		}
	}
}