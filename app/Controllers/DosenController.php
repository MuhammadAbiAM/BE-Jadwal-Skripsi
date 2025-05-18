<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class DosenController extends ResourceController
{
    protected $modelName = 'App\Models\DosenModel';
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
        $dosen = $this->model->find($id);

        if (!$dosen) {
            return $this->failNotFound('Data Dosen tidak ditemukan.');
        }

        $response = [
            'message' => 'success',
            'data'    => $dosen,
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
            'nidn' => [
                'rules' => 'required|numeric|min_length[10]|is_unique[dosen.nidn]',
                'errors' => [
                    'required'    => 'NIDN wajib diisi.',
                    'numeric'     => 'NIDN harus berupa angka.',
                    'min_length'  => 'NIDN minimal 10 karakter.',
                    'is_unique'   => 'NIDN sudah terdaftar.',
                ]
            ],
            'nama_dosen' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required'    => 'Nama dosen wajib diisi.',
                    'alpha_space' => 'Nama hanya boleh huruf dan spasi.',
                ]
            ],
            'program_studi' => [
                'rules' => 'required',
                'errors' => [
                    'required'    => 'Program studi wajib diisi.',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[dosen.email]',
                'errors' => [
                    'required'    => 'Email wajib diisi.',
                    'valid_email' => 'Email tidak valid.',
                    'is_unique'   => 'Email sudah terdaftar.',
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
            'nidn'          => esc($this->request->getVar('nidn')),
            'nama_dosen'    => esc($this->request->getVar('nama_dosen')),
            'program_studi' => esc($this->request->getVar('program_studi')),
            'email'         => esc($this->request->getVar('email'))
        ]);

        $response = [
            'message' => 'Data Dosen Berhasil Ditambahkan',
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
    public function update($nidn = null)
    {
        $dosen = $this->model->find($nidn);

        if (!$dosen) {
            return $this->failNotFound('Data dosen tidak ditemukan.');
        }

        $rules = $this->validate([
            'nama_dosen' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required'    => 'Nama dosen wajib diisi.',
                    'min_length'  => 'Nama minimal 3 karakter.',
                ]
            ],
            'program_studi' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required'    => 'Program studi wajib diisi.',
                    'min_length'  => 'Program studi minimal 3 karakter.',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required'    => 'Email wajib diisi.',
                    'valid_email' => 'Email tidak valid.',
                ]
            ],
        ]);

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors(),
            ];
            return $this->failValidationErrors($response);
        }

        $this->model->update($nidn, [
            'nama_dosen'    => esc($this->request->getVar('nama_dosen')),
            'program_studi' => esc($this->request->getVar('program_studi')),
            'email'         => esc($this->request->getVar('email'))
        ]);

        $response = [
            'message' => 'Data Dosen Berhasil Diubah',
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
    public function delete($nidn = null)
    {
        $dosen = $this->model->find($nidn);

        if (!$dosen) {
            return $this->failNotFound('Data dosen tidak ditemukan.');
        }

        $this->model->delete($nidn);
        $response = [
            'message' => 'Data Dosen Berhasil Dihapus',
        ];
        return $this->respondDeleted($response);
    }
}
