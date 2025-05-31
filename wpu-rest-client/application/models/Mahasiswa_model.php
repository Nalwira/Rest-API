<?php 
use GuzzleHttp\Client;

class Mahasiswa_model extends CI_model 
{
    private $_client;
    private $_api_key = 'Naura5';

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'http://localhost:8080/rest-api/wpu-rest-server/api/',
            'auth' => ['naura', '271003'] // kalau REST-nya pakai Basic Auth
        ]);
    }

    public function getAllMahasiswa()
    {
        $response = $this->_client->request('GET', 'mahasiswa', [
            'headers' => [
                'X-API-KEY' => $this->_api_key
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data'];
    }

    public function getMahasiswaById($id)
    {
        $response = $this->_client->request('GET', 'mahasiswa', [
            'headers' => [
                'X-API-KEY' => $this->_api_key
            ],
            'query' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data'][0];
    }

    public function tambahDataMahasiswa()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true)
        ];

        $response = $this->_client->request('POST', 'mahasiswa', [
            'headers' => [
                'X-API-KEY' => $this->_api_key
            ],
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function hapusDataMahasiswa($id)
    {
        $response = $this->_client->request('DELETE', 'mahasiswa', [
            'headers' => [
                'X-API-KEY' => $this->_api_key
            ],
            'form_params' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function ubahDataMahasiswa()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true),
            "id" => $this->input->post('id', true)
        ];

        $response = $this->_client->request('PUT', 'mahasiswa', [
            'headers' => [
                'X-API-KEY' => $this->_api_key
            ],
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function cariDataMahasiswa()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama', $keyword);
        $this->db->or_like('jurusan', $keyword);
        $this->db->or_like('nrp', $keyword);
        $this->db->or_like('email', $keyword);
        return $this->db->get('mahasiswa')->result_array();
    }
}
