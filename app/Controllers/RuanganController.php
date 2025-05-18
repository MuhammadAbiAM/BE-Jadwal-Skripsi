<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class RuanganController extends ResourceController
{
    protected $modelName = 'App\Models\RuanganModel';
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
    public function show($kode_ruangan = null)
    {
        $ruangan = $this->model->find($kode_ruangan);

        if (!$ruangan) {
            return $this->failNotFound('Data Ruangan tidak ditemukan.');
        }

        $response = [
            'message' => 'success',
            'data'    => $ruangan,
        ];
        return $this->respond($response, 200);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $rules = $this->validate([
            'kode_ruangan' => [
                'rules' => 'required|alpha_numeric_punct|min_length[3]|is_unique[ruangan.kode_ruangan]',
                'errors' => [
                    'required'              => 'Kode ruangan wajib diisi.',
                    'alpha_numeric_punct'   => 'Kode ruangan hanya boleh huruf, angka, spasi, dan tanda baca.',
                    'min_length'            => 'Kode ruangan minimal 3 karakter.',
                    'is_unique'             => 'Kode ruangan sudah terdaftar.',
                ]
            ],
            'nama_ruangan' => [
                'rules' => 'required',
                'errors' => [
                    'required'    => 'Nama ruangan wajib diisi.',
                ]
            ],
        ]);

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors(),
            ];
            return $this->failValidationErrors($response);
        }

        $this->model->insert([
            'kode_ruangan' => esc($this->request->getVar('kode_ruangan')),
            'nama_ruangan' => esc($this->request->getVar('nama_ruangan'))
        ]);

        $response = [
            'message' => 'Data Ruangan Berhasil Ditambahkan.',
        ];
        return $this->respondCreated($response);
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($kode_ruangan = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($kode_ruangan = null)
    {
        $ruangan = $this->model->find($kode_ruangan);

        if (!$ruangan) {
            return $this->failNotFound('Data Ruangan tidak ditemukan.');
        }

        $rules = $this->validate([
            'kode_ruangan' => [
                'rules' => 'required|alpha_numeric_punct|min_length[3]|is_unique[ruangan.kode_ruangan,kode_ruangan,' . $kode_ruangan . ']',
                'errors' => [
                    'required'              => 'Kode ruangan wajib diisi.',
                    'alpha_numeric_punct'   => 'Kode ruangan hanya boleh huruf, angka, spasi, dan tanda baca.',
                    'min_length'            => 'Kode ruangan minimal 3 karakter.',
                    'is_unique'             => 'Kode ruangan sudah terdaftar.',
                ]
            ],
            'nama_ruangan' => [
                'rules' => 'required|alpha_space|min_length[3]',
                'errors' => [
                    'required'    => 'Nama ruangan wajib diisi.',
                    'alpha_space' => 'Nama ruangan hanya boleh huruf dan spasi.',
                    'min_length'  => 'Nama ruangan minimal 3 karakter.',
                ]
            ],
        ]);

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors(),
            ];
            return $this->failValidationErrors($response);
        }

        $this->model->update($kode_ruangan, [
            'nama_ruangan' => esc($this->request->getVar('nama_ruangan'))
        ]);

        $response = [
            'message' => 'Data Ruangan Berhasil Diubah.',
        ];
        return $this->respondUpdated($response);
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($kode_ruangan = null)
    {
        $ruangan = $this->model->find($kode_ruangan);

        if (!$ruangan) {
            return $this->failNotFound('Data Ruangan tidak ditemukan.');
        }

        $this->model->delete($kode_ruangan);
        $response = [
            'message' => 'Data Ruangan Berhasil Dihapus.',
        ];
        return $this->respondDeleted($response);
    }
}
