<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class MahasiswaController extends ResourceController
{
    protected $modelName = 'App\Models\MahasiswaModel';
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
        //
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
                'rules' => 'required|numeric|min_length[8]|is_unique[mahasiswa.npm]',
                'errors' => [
                    'required'    => 'NPM wajib diisi.',
                    'numeric'     => 'NPM harus berupa angka.',
                    'min_length'  => 'NPM minimal 8 karakter.',
                    'is_unique'   => 'NPM sudah terdaftar.',
                ]
            ],
            'nama_mahasiswa' => [
                'rules' => 'required|alpha_space|min_length[3]',
                'errors' => [
                    'required'    => 'Nama mahasiswa wajib diisi.',
                    'alpha_space' => 'Nama hanya boleh huruf dan spasi.',
                    'min_length'  => 'Nama minimal 3 karakter.',
                ]
            ],
            'program_studi' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required'   => 'Program studi wajib diisi.',
                    'min_length' => 'Program studi minimal 3 karakter.',
                ]
            ],
            'judul_skripsi' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required'   => 'Judul skripsi wajib diisi.',
                    'min_length' => 'Judul skripsi minimal 10 karakter.',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[mahasiswa.email]',
                'errors' => [
                    'required'     => 'Email wajib diisi.',
                    'valid_email'  => 'Format email tidak valid.',
                    'is_unique'    => 'Email sudah terdaftar.',
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
            'npm'            => esc($this->request->getVar('npm')),
            'nama_mahasiswa' => esc($this->request->getVar('nama_mahasiswa')),
            'program_studi'  => esc($this->request->getVar('program_studi')),
            'judul_skripsi'  => esc($this->request->getVar('judul_skripsi')),
            'email'          => esc($this->request->getVar('email')),
        ]);

        $response = [
            'message' => 'Data Mahasiswa Berhasil Ditambahkan',
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
    public function update($npm = null)
    {
        $rules = $this->validate([
            'nama_mahasiswa' => [
                'rules' => 'required|alpha_space|min_length[3]',
                'errors' => [
                    'required'    => 'Nama mahasiswa wajib diisi.',
                    'alpha_space' => 'Nama hanya boleh huruf dan spasi.',
                    'min_length'  => 'Nama minimal 3 karakter.',
                ]
            ],
            'program_studi' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required'   => 'Program studi wajib diisi.',
                    'min_length' => 'Program studi minimal 3 karakter.',
                ]
            ],
            'judul_skripsi' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required'   => 'Judul skripsi wajib diisi.',
                    'min_length' => 'Judul skripsi minimal 10 karakter.',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|',
                'errors' => [
                    'required'     => 'Email wajib diisi.',
                    'valid_email'  => 'Format email tidak valid.',
                ]
            ],
        ]);

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors(),
            ];
            return $this->failValidationErrors($response);
        }

        $this->model->update($npm, [
            'nama_mahasiswa' => esc($this->request->getVar('nama_mahasiswa')),
            'program_studi'  => esc($this->request->getVar('program_studi')),
            'judul_skripsi'  => esc($this->request->getVar('judul_skripsi')),
            'email'          => esc($this->request->getVar('email')),
        ]);

        $response = [
            'message' => 'Data Mahasiswa Berhasil Diubah',
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
    public function delete($npm = null)
    {
        $this->model->delete($npm);
        $response = [
            'message' => 'Data Mahasiswa Berhasil Dihapus',
        ];
        return $this->respondDeleted($response);
    }
}
