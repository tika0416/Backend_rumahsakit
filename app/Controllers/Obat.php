<?php namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ObatModel; 

class Obat extends ResourceController {
    public function index()
{
    $obatModel = new ObatModel(); 
    $data = $obatModel->findAll();
    return $this->response->setJSON($data);
}

   public function create()
{
    $data = $this->request->getJSON();  
    
    if (!$data) {
        return $this->fail('Data JSON tidak valid', 400);
    }

    $obatModel = new \App\Models\ObatModel();

    $insertData = [
        'nama_obat' => $data->nama_obat,
        'kategori'  => $data->kategori,
        'stok'      => $data->stok,
        'harga'     => $data->harga,
    ];

    if ($obatModel->insert($insertData)) {
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

    $model = new \App\Models\ObatModel();

    $data = [
        'nama_obat' => $json->nama_obat,
        'kategori'  => $json->kategori,
        'stok'      => $json->stok,
        'harga'     => $json->harga,
    ];

    $model->update($id, $data);

    return $this->response->setJSON(['message' => 'Data berhasil diupdate']);
}
public function delete($id = null)
{
    $model = new \App\Models\ObatModel();

    if ($model->delete($id)) {
        return $this->respond(['status' => 200, 'message' => 'Data berhasil dihapus']);
    } else {
        return $this->failNotFound('Data tidak ditemukan atau gagal dihapus');
    }
}

    protected $modelName = 'App\\Models\\ObatModel';
    protected $format    = 'json';
}