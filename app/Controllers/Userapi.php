<?php 
namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class UserApi extends BaseController{
    use ResponseTrait;
    private $model;

    public function __construct()
    {
        $this->model = new UserModel;
    }

    public function index(){
        $data = $this->model->findAll();
        return $this->respond($data,200);
    }

    public function show($id){
        $data = $this->model->where('id_user', $id)->first();

        if (!$data) {
            return $this->failNotFound('Data tidak ditemukan');
        }

        return $this->respond($data, 200);
    }


    public function create(){
        $data = $this->request->getPost();
        
        if(!$this->model->insert($data)){
            return $this->fail($this->model->errors());
        }

        $response = [
            'status' => 200,
            'error' => null,
            'message' => [
            'success' => 'Berhasil Menambahkan Data'
            ]
        ];
        return $this->respond($response);
    }

    public function update($id)
{
    $data = $this->request->getRawInput();
    
    $existingData = $this->model->where('id_user', $id)->first();
    if (!$existingData) {
        return $this->failNotFound('Data tidak ditemukan');
    }

    if (!$this->model->update($id, $data)) {
        return $this->fail($this->model->errors());
    }

    $response = [
        'status' => 200,
        'error' => null,
        'message' => [
        'success' => 'Berhasil Memperbarui Data'
        ]
    ];
    
    return $this->respond($response);
}

    public function delete($id){
        if (!$this->model->where('id_user', $id)) {
            return $this->failNotFound('Data tidak ditemukan');
        }

        if (!$this->model->delete($id)) {
            return $this->fail('Gagal menghapus data');
        }

        $response = [
            'status' => 200,
            'error' => null,
            'message' => [
            'success' => 'Berhasil Menghapus Data'
            ]
        ];
        return $this->respondDeleted($response);
    }
}
?>