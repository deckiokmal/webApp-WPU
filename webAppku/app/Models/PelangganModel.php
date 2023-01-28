<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    // Koneksi table pada database
    protected $table = 'pelanggan';
    protected $useTimestamps = True;
    protected  $allowedFields = ['KTP', 'nojar', 'nama', 'kontak', 'alamat', 'akses', 'ipwan', 'status'];

    public function getPelanggan($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }

    public function Search($keyword)
    {
        // $builder = $this->table('pelanggan');
        // $builder->like('nama', $keyword);
        // return $builder;
        return $this->table('pelanggan')->like('nama', $keyword)->orLike('akses', $keyword);
    }
}
