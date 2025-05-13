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
                'rules' => 'required|numeric|min_length[8]|is_unique[jadwal_sidang.npm]',
                'errors' => [
                    'required'    => 'NPM wajib diisi.',
                    'numeric'     => 'NPM harus berupa angka.',
                    'min_length'  => 'NPM minimal 8 karakter.',
                    'is_unique'   => 'Mahasiswa dengan NPM tersebut sudah terdaftar.',
                ]
            ],
            'kode_ruangan' => [
                'rules' => 'required|alpha_numeric_punct|min_length[3]',
                'errors' => [
                    'required'              => 'Kode ruangan wajib diisi.',
                    'alpha_numeric_punct'   => 'Kode hanya boleh huruf, angka, spasi, dan tanda baca.',
                    'min_length'            => 'Kode minimal 3 karakter.',
                ]
            ],
            'waktu_sidang' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required'    => 'Waktu sidang wajib diisi.',
                    'valid_date'  => 'Format waktu tidak valid.',
                ]
            ],
        ]);

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors(),
            ];
            return $this->failValidationErrors($response);
        }

        // Validasi apakah NPM ada di tabel mahasiswa
        $db = \Config\Database::connect();
        $builderMahasiswa = $db->table('mahasiswa');
        $npm = $this->request->getVar('npm');
        $cekMahasiswa = $builderMahasiswa->getWhere(['npm' => $npm])->getRow();

        if (!$cekMahasiswa) {
            return $this->failNotFound('Mahasiswa dengan NPM tersebut tidak ditemukan.');
        }

        // Validasi apakah kode ruangan ada di tabel ruangan
        $builderRuangan = $db->table('ruangan');
        $kode_ruangan = $this->request->getVar('kode_ruangan');
        $cekRuangan = $builderRuangan->getWhere(['kode_ruangan' => $kode_ruangan])->getRow();

        if (!$cekRuangan) {
            return $this->failNotFound('Kode ruangan tidak ditemukan.');
        }

        $this->model->insert([
            'npm'           => esc($npm),
            'kode_ruangan'  => esc($kode_ruangan),
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
    public function update($id = null)
    {
        //
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
