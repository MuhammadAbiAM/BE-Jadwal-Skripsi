<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class ViewPenjadwalanController extends ResourceController
{
    protected $modelName = 'App\Models\ViewPenjadwalanModel';
    protected $format    = 'json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = [
            'message' => 'success',
            'data'    => $this->model->findAll(),
        ];
        return $this->respond($data, 200);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $penjadwalan = $this->model->find($id);

        if (!$penjadwalan) {
            return $this->failNotFound('Data Penjadwalan tidak ditemukan.');
        }

        $response = [
            'message' => 'success',
            'data'    => $penjadwalan,
        ];
        return $this->respond($response, 200);
    }
}
