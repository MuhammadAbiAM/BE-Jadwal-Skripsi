<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class ViewPengujiSidangController extends ResourceController
{
    protected $modelName = 'App\Models\ViewPengujiSidangModel';
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
        $penguji = $this->model->find($id);

        if (!$penguji) {
            return $this->failNotFound('Data Penguji Sidang tidak ditemukan.');
        }

        $response = [
            'message' => 'success',
            'data'    => $penguji,
        ];
        return $this->respond($response, 200);
    }
}
