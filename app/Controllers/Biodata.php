<?php

namespace App\Controllers;

use App\Models\ModelBiodata;

class Biodata extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new ModelBiodata();
    }

    public function hapusData($id)
    {
        $this->model->deleteBiodata($id);
        return redirect()->to('/biodata');
    }

    public function edit($id)
    {
        return json_encode($this->model->find($id));
        // $data = $this->model->find($id);
        // return json_encode ($data);
    }



    public function simpan()
    {
        $id = $this->request->getPost('id');
        $validation = \Config\Services::validation();
        $rules = [
            'nama' => 'required|min_length[4]',
            'alamat' => 'required|min_length[5]',
            'umur' => 'required|integer|min_length[1]'
        ];

        if ($validation->setRules($rules)->withRequest($this->request)->run()) {
            $gambar = $this->request->getFile('gambar');

            
            if ($gambar->isValid() && !$gambar->hasMoved()) {
                $newName = $gambar->getRandomName();
                $gambar->move(ROOTPATH . 'public/uploads', $newName);

                $data['gambar'] = 'uploads/' . $newName;
            }

            $data['nama'] = $this->request->getPost('nama');
            $data['alamat'] = $this->request->getPost('alamat');
            $data['umur'] = $this->request->getPost('umur');
            $data['kelamin'] = $this->request->getPost('kelamin');
            $data['agama'] = $this->request->getPost('agama');
            $data['status'] = $this->request->getPost('status');

            // Jika ID tidak kosong, berarti ini adalah edit, bukan penambahan data baru
            if (!empty($id)) {
                $data['id'] = $id;
            }

            try {
                $this->model->save($data);
                $response['sukses'] = 'Berhasil menyimpan data';
                $response['error'] = false;
            } catch (\Exception $e) {
                $response['sukses'] = false;
                $response['error'] = $e->getMessage();
            }

            $response['sukses'] = 'Berhasil menyimpan data';
            $response['error'] = false;
        } else {
            $response['sukses'] = false;
            $response['error'] = $validation->listErrors();
        }

        return json_encode($response);
    }


    public function index()
    {
        $jumlahbaris = 5;
        $pager = \Config\Services::pager();
        $katakunci = $this->request->getGet('katakunci');

        if ($katakunci) {
            $pencarian = $this->model->cari($katakunci);
        } else {
            $pencarian = $this->model;
        }

        $data['katakunci'] = $katakunci;
        $data['datadatadiri'] = $pencarian->orderBy('id', 'desc')->paginate($jumlahbaris);
        $data['pager'] = $pager;
        $data['nomor'] = ($this->request->getVar('page')) ? ($jumlahbaris * ($this->request->getVar('page') - 1)) : 0;

        return view('Biodata_view', $data);
    }
}