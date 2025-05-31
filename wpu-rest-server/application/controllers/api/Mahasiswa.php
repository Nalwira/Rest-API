<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Mahasiswa extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mahasiswa_model', 'mahasiswa');

        // Validasi API Key
        $headers = $this->input->request_headers();
        $apiKey = null;
        foreach ($headers as $key => $value) {
            if (strtolower($key) === 'x-api-key') {
                $apiKey = $value;
                break;
            }
        }

        if ($apiKey !== 'Naura5') {
            $this->response([
                'status' => false,
                'error' => 'Invalid API key'
            ], REST_Controller::HTTP_UNAUTHORIZED);
            exit;
        }

        // Batas limit method
        $this->methods['index_get']['limit'] = 100;
    }

    private function validateMahasiswaData($data)
    {
        $errors = [];

        if (empty($data['nrp'])) {
            $errors['nrp'] = 'NRP wajib diisi';
        } elseif (!is_numeric($data['nrp'])) {
            $errors['nrp'] = 'NRP harus berupa angka';
        }

        if (empty($data['nama'])) {
            $errors['nama'] = 'Nama wajib diisi';
        }

        if (empty($data['email'])) {
            $errors['email'] = 'Email wajib diisi';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email tidak valid';
        }

        if (empty($data['jurusan'])) {
            $errors['jurusan'] = 'Jurusan wajib diisi';
        }

        return $errors;
    }

    public function index_get()
    {
        $id = $this->get('id');
        if ($id === null) {
            $mahasiswa = $this->mahasiswa->getMahasiswa();
        } else {
            $mahasiswa = $this->mahasiswa->getMahasiswa($id);
        }

        if ($mahasiswa) {
            $this->response([
                'status' => true,
                'data' => $mahasiswa
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'provide an id!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->mahasiswa->deleteMahasiswa($id) > 0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'deleted.'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'id not found!'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    public function index_post()
    {
        // Jika ada override method PUT, panggil index_put()
        if ($this->post('_method') === 'PUT') {
            return $this->index_put();
        }

        $data = [
            'nrp' => $this->post('nrp'),
            'nama' => $this->post('nama'),
            'email' => $this->post('email'),
            'jurusan' => $this->post('jurusan')
        ];

        $errors = $this->validateMahasiswaData($data);

        if (!empty($errors)) {
            return $this->response([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $errors,
                'input' => $data
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

        if ($this->mahasiswa->createMahasiswa($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'new mahasiswa has been created.'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to create new data!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id = $this->put('id') ?? $this->post('id'); // fallback jika data PUT dikirim via form_params
        $data = [
            'nrp' => $this->put('nrp') ?? $this->post('nrp'),
            'nama' => $this->put('nama') ?? $this->post('nama'),
            'email' => $this->put('email') ?? $this->post('email'),
            'jurusan' => $this->put('jurusan') ?? $this->post('jurusan')
        ];

        if ($id === null) {
            return $this->response([
                'status' => false,
                'message' => 'provide an id!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

        $errors = $this->validateMahasiswaData($data);

        if (!empty($errors)) {
            return $this->response([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $errors,
                'input' => $data
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

        if ($this->mahasiswa->updateMahasiswa($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'data mahasiswa has been updated.'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to update data.'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
