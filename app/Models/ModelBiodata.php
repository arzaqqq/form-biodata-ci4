<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBiodata extends Model
{
    protected $table = "datadiri";
    protected $primaryKey = "id";
    protected $allowedFields = ["nama", "alamat", "umur", "kelamin", "agama", "status", "gambar"];

    function cari($katakunci)
    {
        $builder = $this->table("datadiri");
        $arr_katakunci = explode(" ", $katakunci);
        for ($x = 0; $x < count($arr_katakunci); $x++) {
            $builder->orLike('nama', $arr_katakunci[$x]);
            $builder->orLike('alamat', $arr_katakunci[$x]);
            $builder->orLike('umur', $arr_katakunci[$x]);
            $builder->orLike('kelamin', $arr_katakunci[$x]);
            $builder->orLike('agama', $arr_katakunci[$x]);
            $builder->orLike('status', $arr_katakunci[$x]);
        }
        return $builder;
    }

    public function deleteBiodata($id)
    {
        return $this->delete($id);
    }
}
