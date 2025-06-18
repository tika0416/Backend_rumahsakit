<?php namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\PasienModel; 

class Pasien extends ResourceController {


public function index()
{
    $pasienModel = new PasienModel(); 
    $data = $pasienModel->findAll();
    return $this->response->setJSON($data);
}

   public function create()
{
    $data = $this->request->getJSON();  
    
    if (!$data) {
        return $this->fail('Data JSON tidak valid', 400);
    }

    $pasienModel = new \App\Models\PasienModel();

    $insertData = [
        'nama'          => $data->nama,
        'alamat'        => $data->alamat,
        'tanggal_lahir' => $data->tanggal_lahir,
        'jenis_kelamin' => $data->jenis_kelamin,
    ];

    if ($pasienModel->insert($insertData)) {
        return $this->respondCreated($insertData);
    } else {
        return $this->failServerError('Gagal menyimpan data.');
    }
}
public function update($id = null)
{
    $json = $this->request->getJSON();

    if (!$json || !$id) {
        return $this->response->setStatusCode(400)->setJSON(['error' => 'Data atau ID tidak valid']);
    }

    $model = new \App\Models\PasienModel();

    $data = [
        'nama' => $json->nama,
        'alamat' => $json->alamat,
        'tanggal_lahir' => $json->tanggal_lahir,
        'jenis_kelamin' => $json->jenis_kelamin
    ];

    $model->update($id, $data);

    return $this->response->setJSON(['message' => 'Data berhasil diupdate']);
}
public function delete($id = null)
{
    $model = new \App\Models\PasienModel();

    if ($model->delete($id)) {
        return $this->respond(['status' => 200, 'message' => 'Data berhasil dihapus']);
    } else {
        return $this->failNotFound('Data tidak ditemukan atau gagal dihapus');
    }
}

    protected $modelName = 'App\\Models\\PasienModel';
    protected $format    = 'json';
}

