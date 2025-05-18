<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class JadwalSidangController extends ResourceController
{
    protected $modelName = 'App\Models\JadwalSidangModel';
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
    public function show($id_jadwal = null)
    {
        $jadwal = $this->model->find($id_jadwal);

        if (!$jadwal) {
            return $this->failNotFound('Data Jadwal Sidang tidak ditemukan.');
        }

        $response = [
            'message' => 'success',
            'data'    => $jadwal,
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
            'npm' => [
                'rules' => 'required||is_unique[jadwal_sidang.npm]',
                'errors' => [
                    'required'  => 'NPM wajib diisi.',
                    'is_unique' => 'Mahasiswa dengan NPM tersebut sudah terdaftar.',
                ]
            ],
            'kode_ruangan' => [
                'rules' => 'required]',
                'errors' => [
                    'required'  => 'Kode ruangan wajib diisi.'
                ]
            ],
            'waktu_sidang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Waktu sidang wajib diisi.'
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
            'npm'           => esc($this->request->getVar('npm')),
            'kode_ruangan'  => esc($this->request->getVar('kode_ruangan')),
            'waktu_sidang'  => esc($this->request->getVar('waktu_sidang'))
        ]);

        $response = [
            'message' => 'Data Jadwal Sidang Berhasil Ditambahkan',
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
    public function update($id_jadwal = null)
    {
        $jadwal = $this->model->find($id_jadwal);

        if (!$jadwal) {
            return $this->failNotFound('Data Jadwal Sidang tidak ditemukan.');
        }

        $rules = $this->validate([
            'npm' => [
                'rules' => 'required|is_unique[jadwal_sidang.npm]',
                'errors' => [
                    'required'  => 'NPM wajib diisi.',
                    'is_unique' => 'Mahasiswa dengan NPM tersebut sudah terdaftar.',
                ]
            ],
            'kode_ruangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kode ruangan wajib diisi.',
                ]
            ],
            'waktu_sidang' => [
                'rules' => 'required',
                'errors' => [
                    'required'    => 'Waktu sidang wajib diisi.',

                ]
            ],
        ]);

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors(),
            ];
            return $this->failValidationErrors($response);
        }

        $this->model->update($id_jadwal, [
            'npm'           => esc($this->request->getVar('npm')),
            'kode_ruangan'  => esc($this->request->getVar('kode_ruangan')),
            'waktu_sidang'  => esc($this->request->getVar('waktu_sidang'))
        ]);

        $response = [
            'message' => 'Data Jadwal Sidang Berhasil Diupdate',
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
    public function delete($id_jadwal = null)
    {
        $this->model->delete($id_jadwal);
        $response = [
            'message' => 'Data Jadwal Sidang Berhasil Dihapus.',
        ];
        return $this->respondDeleted($response);
    }
}
