<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class PengujiSidangController extends ResourceController
{
    protected $modelName = 'App\Models\PengujiSidangModel';
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
    public function show($id_penguji = null)
    {
        $penguji = $this->model->find($id_penguji);

        if (!$penguji) {
            return $this->failNotFound('Data Penguji Sidang tidak ditemukan.');
        }

        $response = [
            'message' => 'success',
            'data'    => $penguji,
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
            'id_jadwal' => [
                'rules' => 'required',
                'errors' => [
                    'required'  => 'ID Jadwal Sidang wajib diisi.',
                ],
            ],
            'nidn' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'NIDN wajib diisi.',
                ],
            ],
            'peran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Peran wajib diisi.',
                ],
            ],
        ]);

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors(),
            ];
            return $this->failValidationErrors($response);
        }

        $id_jadwal = $this->request->getVar('id_jadwal');
        $nidn = $this->request->getVar('nidn');
        $peran = $this->request->getVar('peran');

        // 1. Cek apakah kombinasi id_jadwal dan nidn sudah ada (dosen sudah terdaftar di jadwal ini)
        $alreadyExists = $this->model
            ->where('id_jadwal', $id_jadwal)
            ->where('nidn', $nidn)
            ->first();

        if ($alreadyExists) {
            return $this->failValidationErrors([
                'nidn' => 'Dosen ini sudah terdaftar pada jadwal sidang yang sama.'
            ]);
        }

        // 2. Cek jumlah penguji untuk id_jadwal ini
        $pengujiCount = $this->model->where('id_jadwal', $id_jadwal)->countAllResults();
        if ($pengujiCount >= 2) {
            return $this->failValidationErrors([
                'id_jadwal' => 'Maksimal 2 dosen penguji untuk satu jadwal sidang.'
            ]);
        }

        // 3. Cek apakah ada peran yang sama digunakan dosen lain pada id_jadwal ini
        $existingSamePeran = $this->model
            ->where('id_jadwal', $id_jadwal)
            ->where('peran', $peran)
            ->where('nidn !=', $nidn)
            ->first();

        if ($existingSamePeran) {
            return $this->failValidationErrors([
                'peran' => 'Peran ini sudah digunakan oleh dosen lain pada jadwal sidang yang sama.'
            ]);
        }

        $this->model->insert([
            'id_jadwal' => esc($this->request->getVar('id_jadwal')),
            'nidn'  => esc($this->request->getVar('nidn')),
            'peran' => esc($this->request->getVar('peran'))
        ]);

        $response = [
            'message' => 'Data Penguji Sidang Berhasil Ditambahkan',
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
    public function edit($id = null)
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
    public function update($id_penguji = null)
    {
        $penguji = $this->model->find($id_penguji);

        if (!$penguji) {
            return $this->failNotFound('Data Penguji Sidang tidak ditemukan.');
        }

        $rules = $this->validate([
            'id_jadwal' => [
                'rules' => 'required',
                'errors' => [
                    'required'  => 'ID Jadwal Sidang wajib diisi.',
                ],
            ],
            'nidn' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'NIDN wajib diisi.',
                ],
            ],
            'peran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Peran wajib diisi.',
                ],
            ],
        ]);

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors(),
            ];
            return $this->failValidationErrors($response);
        }

        $id_jadwal = $this->request->getVar('id_jadwal');
        $nidn = $this->request->getVar('nidn');
        $peran = $this->request->getVar('peran');

        // 1. Cek apakah kombinasi id_jadwal dan nidn sudah ada (dosen sudah terdaftar di jadwal ini)
        $alreadyExists = $this->model
            ->where('id_jadwal', $id_jadwal)
            ->where('nidn', $nidn)
            ->first();

        if ($alreadyExists) {
            return $this->failValidationErrors([
                'nidn' => 'Dosen ini sudah terdaftar pada jadwal sidang yang sama.'
            ]);
        }

        // 2. Cek jumlah penguji untuk id_jadwal ini
        $pengujiCount = $this->model->where('id_jadwal', $id_jadwal)->countAllResults();
        if ($pengujiCount >= 2) {
            return $this->failValidationErrors([
                'id_jadwal' => 'Maksimal 2 dosen penguji untuk satu jadwal sidang.'
            ]);
        }

        // 3. Cek apakah ada peran yang sama digunakan dosen lain pada id_jadwal ini
        $existingSamePeran = $this->model
            ->where('id_jadwal', $id_jadwal)
            ->where('peran', $peran)
            ->where('nidn !=', $nidn)
            ->first();

        if ($existingSamePeran) {
            return $this->failValidationErrors([
                'peran' => 'Peran ini sudah digunakan oleh dosen lain pada jadwal sidang yang sama.'
            ]);
        }

        $this->model->update($id_penguji, [
            'id_jadwal' => esc($this->request->getVar('id_jadwal')),
            'nidn'  => esc($this->request->getVar('nidn')),
            'peran' => esc($this->request->getVar('peran'))
        ]);

        $response = [
            'message' => 'Data Penguji Sidang Berhasil Diupdate',
        ];
        return $this->respond($response, 200);
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id_penguji = null)
    {
        $penguji = $this->model->find($id_penguji);

        if (!$penguji) {
            return $this->failNotFound('Data Penguji Sidang tidak ditemukan.');
        }

        $this->model->delete($id_penguji);

        $response = [
            'message' => 'Data Penguji Sidang Berhasil Dihapus',
        ];
        return $this->respondDeleted($response);
    }
}
