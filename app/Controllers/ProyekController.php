<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class ProyekController extends BaseController
{
    public function index()
    {
        $client = Services::curlrequest();
        $apiUrl = env("API_BASE_URL") . "/proyek";

        try {
            $response = $client->get($apiUrl);
            $data = json_decode($response->getBody(), true);

            return view('pages/proyek', [
                'projects'=> $data['data']
            ]);
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function create() {
        $client = Services::curlrequest();
        $apiUrl = env("API_BASE_URL") . "/lokasi";

        try {
            $response = $client->get($apiUrl);
            $data = json_decode($response->getBody(), true);

            return view('pages/create_proyek', [
                'locations' => $data['data']
            ]);
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function Store() {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'namaProyek'       => 'required',
            'client'           => 'required',
            'tanggalMulai'     => 'required',
            'tanggalSelesai'   => 'required',
            'pimpinanProyek'   => 'required',
            'lokasiId'         => 'required'
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->with('error', 'Please fill in all required fields')->withInput();
        }

        $data = [
            'namaProyek'       => $this->request->getPost('namaProyek'),
            'client'           => $this->request->getPost('client'),
            'tanggalMulai'     => $this->request->getPost('tanggalMulai'),
            'tanggalSelesai'   => $this->request->getPost('tanggalSelesai'),
            'pimpinanProyek'   => $this->request->getPost('pimpinanProyek'),
            'keterangan'       => $this->request->getPost('keterangan'),
            'lokasiId'         => $this->request->getPost('lokasiId'),
        ];

        $client = Services::curlrequest();
        $apiUrl = env("API_BASE_URL") . "/proyek";

        try {
            $response = $client->post($apiUrl, [
                'json' => $data,
                'allow_redirects' => false,
                'http_errors' => false
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode == 201) {
                return redirect()->to('/')->with('message', 'Project added successfully');
            } else {
                $responseBody = json_decode($response->getBody(), true);
                $errorMessage = $responseBody['message'] ?? 'Invalid request. Please check your input.';
                return redirect()->back()->with('error', $errorMessage)->withInput();
            }
        } catch (\Exception $e) {
            log_message('error', 'API request failed: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again later.')->withInput();
        }
    }

    public function delete($id)
    {
        $client = Services::curlrequest();
        $apiUrl = env("API_BASE_URL") . "/proyek/" . $id;

        try {
            $response = $client->delete($apiUrl);

            $statusCode = $response->getStatusCode();
            if ($statusCode == 200) {
                return redirect()->to('/')->with('message', 'Location deleted successfully');
            } else {
                return redirect()->to('/')->with('error', 'Failed to delete location. API returned status code ' . $statusCode);
            }
        } catch (\Exception $e) {
            return redirect()->to('/')->with('error', 'Failed to delete location. ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $client = Services::curlrequest();
        $apiUrl = env("API_BASE_URL") . "/proyek/" . $id;
        $apiLocationUrl = env("API_BASE_URL") . "/lokasi";

        try {
            $response = $client->get($apiUrl);
            $data = json_decode($response->getBody(), true);

            $responseLocation = $client->get($apiLocationUrl);
            $locations = json_decode($responseLocation->getBody(), true);

            return view('pages/edit_proyek', [
                'project' => $data['data'],
                'locations' => $locations['data'],
            ]);
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update() {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'namaProyek'       => 'required',
            'client'           => 'required',
            'tanggalMulai'     => 'required',
            'tanggalSelesai'   => 'required',
            'pimpinanProyek'   => 'required',
            'lokasiId'         => 'required'
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->with('error', 'Please fill in all required fields')->withInput();
        }

        $data = [
            'id' => $this->request->getPost('id'),
            'namaProyek'       => $this->request->getPost('namaProyek'),
            'client'           => $this->request->getPost('client'),
            'tanggalMulai'     => $this->request->getPost('tanggalMulai'),
            'tanggalSelesai'   => $this->request->getPost('tanggalSelesai'),
            'pimpinanProyek'   => $this->request->getPost('pimpinanProyek'),
            'keterangan'       => $this->request->getPost('keterangan'),
            'lokasiId'         => $this->request->getPost('lokasiId'),
        ];

        $client = Services::curlrequest();
        $apiUrl = env("API_BASE_URL") . "/proyek";

        try {
            $response = $client->put($apiUrl, [
                'json' => $data,
                'allow_redirects' => false,
                'http_errors' => false
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                return redirect()->to('/')->with('message', 'Project update successfully');
            } else {
                $responseBody = json_decode($response->getBody(), true);
                $errorMessage = $responseBody['message'] ?? 'Invalid request. Please check your input.';
                return redirect()->back()->with('error', $errorMessage)->withInput();
            }
        } catch (\Exception $e) {
            log_message('error', 'API request failed: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again later.')->withInput();
        }
    }
}
