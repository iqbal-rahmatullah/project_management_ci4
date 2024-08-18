<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use http\Client;

class LokasiController extends BaseController
{
    public function index()
    {
        $client = Services::curlrequest();
        $apiUrl = env("API_BASE_URL") . "/lokasi";
        try {
            $response = $client->get($apiUrl);
            $data = json_decode($response->getBody(), true);

            return view('pages/lokasi',
            [
                'locations' => $data['data']
            ]);
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function create() {
        return view('pages/create_lokasi');
    }

    public function store() {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'namaLokasi' => 'required',
            'negara'     => 'required',
            'provinsi'   => 'required',
            'kota'       => 'required'
        ]);

        if (!$this->validate($validation->getRules())) {
            return view('pages/create_lokasi', [
                'validation' => $this->validator,
                'inputData'  => $this->request->getPost()
            ]);
        }

        $data = [
            'namaLokasi' => $this->request->getPost('namaLokasi'),
            'negara'     => $this->request->getPost('negara'),
            'provinsi'   => $this->request->getPost('provinsi'),
            'kota'       => $this->request->getPost('kota')
        ];

        $client = Services::curlrequest();;
        $apiUrl = env("API_BASE_URL") . "/lokasi";

        try {
            $response = $client->post($apiUrl, [
                'json' => $data
            ]);

            $statusCode = $response->getStatusCode();
            if ($statusCode == 201) {
                return redirect()->to('/lokasi')->with('message', 'Location added successfully');
            } else {
                return view('pages/create_lokasi', [
                    'validation' => $this->validator,
                    'inputData'  => $data,
                    'error'      => 'Failed to save location. API returned status code ' . $statusCode
                ]);
            }
        } catch (\Exception $e) {
            return view('pages/create_lokasi', [
                'validation' => $this->validator,
                'inputData'  => $data,
                'error'      => 'Failed to save location. ' . $e->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        $client = Services::curlrequest();
        $apiUrl = env("API_BASE_URL") . "/lokasi/" . $id;

        try {
            $response = $client->delete($apiUrl);

            $statusCode = $response->getStatusCode();
            if ($statusCode == 200) {
                return redirect()->to('/lokasi')->with('message', 'Location deleted successfully');
            } else {
                return redirect()->to('/lokasi')->with('error', 'Failed to delete location. API returned status code ' . $statusCode);
            }
        } catch (\Exception $e) {
            return redirect()->to('/lokasi')->with('error', 'Failed to delete location. ' . $e->getMessage());
        }
    }

    public function edit() {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'namaLokasi' => 'required',
            'negara'     => 'required',
            'provinsi'   => 'required',
            'kota'       => 'required'
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'id'        => $this->request->getPost('id'),
            'namaLokasi' => $this->request->getPost('namaLokasi'),
            'negara'    => $this->request->getPost('negara'),
            'provinsi'  => $this->request->getPost('provinsi'),
            'kota'      => $this->request->getPost('kota')
        ];

        $client = Services::curlrequest();
        $apiUrl = env("API_BASE_URL") . "/lokasi";

        try {
            $response = $client->put($apiUrl, [
                'json' => $data
            ]);

            $statusCode = $response->getStatusCode();
            if ($statusCode == 200) {
                return redirect()->to('/lokasi')->with('message', 'Location updated successfully');
            } else {
                return redirect()->back()->withInput()->with('error', 'Failed to save location. API returned status code ' . $statusCode);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to save location. ' . $e->getMessage());
        }
    }
}
