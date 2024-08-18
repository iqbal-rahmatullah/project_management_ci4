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

    public function Store() {}
}
