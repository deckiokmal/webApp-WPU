<?php

namespace App\Controllers;

use App\Models\PelangganModel;
use phpDocumentor\Reflection\Types\ClassString;
use Stringable;

use function PHPUnit\Framework\stringContains;

class Pelanggan extends BaseController
{
    // properti model
    protected $pelangganModel;

    // untuk memanggil semua method (Add, Change, Detail, Delete)
    // supaya ketika class dipanggil Model langsung ikut ke panggil
    public function __construct()
    {
        $this->pelangganModel = new PelangganModel();
    }
    public function index()
    {
        // PAGES
        $currentPage = $this->request->getVar('page_pelanggan') ? $this->request->getVar('page_pelanggan') : 1;
        // d($this->request->getVar('keyword'));

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $pelanggan = $this->pelangganModel->Search($keyword);
        } else {
            $pelanggan = $this->pelangganModel;
            // echo 'data tidak ditemukan';
        }
        // Mengambil data Model / Instansiasi data model
        // $PelangganModel = new \App\Models\PelangganModel();
        // $pelangganModel = new PelangganModel();
        // $pelanggan = $this->pelangganModel->findAll();

        // Membuat variable data untuk view pelanggan
        $data = [
            'title' => 'List of Costumers',
            // 'pelanggan' => $this->pelangganModel->getPelanggan(),
            'pelanggan' => $pelanggan->paginate(10, 'pelanggan'),
            'pager' => $this->pelangganModel->pager,
            'currentPage' => $currentPage
        ];

        // dump data
        // dd($pelanggan);

        // fungsi return untuk menampilkan view folder pelanggan/index.php
        return view('pelanggan/index', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Pelanggan',
            'pelanggan' => $this->pelangganModel->getPelanggan($id)
        ];

        // jika pelanggan tidak dalam tabel atau error
        if (empty($data['pelanggan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Oopss!!! Maaf. Pelanggan ' . '"' . $id . '"' . ' belum ada.');
        }

        return view('pelanggan/detail', $data);
    }

    public function create()
    {
        // fungsi session untuk validasi data input
        // session(); = sudah ada dalam base controller

        $data = [
            'title' => 'Form Tambah Data Pelanggan',
            'validation' => \Config\Services::validation()
        ];

        return view('pelanggan/create', $data);
    }

    public function save()
    {
        // validasi data input
        if (!$this->validate(
            [
                'KTP' => [
                    'rules' => 'mime_in[KTP,image/jpg,image/jpeg,image/png,image/svg]|is_image[KTP]',
                    'errors' => [
                        'mime_in' => 'File harus gambar',
                        'is_image' => 'File harus gambar'
                    ]
                ],
                'nojar' => [
                    'rules' => 'required|max_length[8]|min_length[8]|is_unique[pelanggan.nojar]',
                    'errors' => [
                        'required' => 'No Jaringan harus diisi.',
                        'max_length' => 'No Jaringan Maksimal 8 angka.',
                        'min_length' => 'No Jaringan Minimal 8 angka.',
                        'is_unique' => 'No Jaringan sudah terdaftar, silahkan masukkan yang lain.'
                    ]
                ],
                'nama' => [
                    'rules' => 'required|alpha_space',
                    'errors' => [
                        'required' => 'Nama harus diisi.',
                        'alpha_space' => 'Nama hanya mengandung karakter & spasi.'
                    ]
                ],
                'kontak' => [
                    'rules' => 'required|numeric|min_length[8]|max_length[14]|is_unique[pelanggan.kontak]',
                    'errors' => [
                        'required' => 'Kontak harus diisi.',
                        'max_length' => 'No Jaringan Maksimal 14 angka.',
                        'min_length' => 'No Jaringan Minimal 8 angka.',
                        'numeric' => 'Kontak hanya mengandung angka.',
                        'is_unique' => 'Kontak sudah terdaftar.'
                    ]
                ],
                // 'alamat' => '',
                // 'akses' => '',
                'ipwan' => [
                    'rules' => 'required|valid_ip|is_unique[pelanggan.ipwan]',
                    'errors' => [
                        'required' => 'IP Address harus diisi.',
                        'valid_ip' => 'Format IP Address salah.',
                        'is_unique' => 'IP Address sudah terdaftar.'
                    ]
                ],
                // 'status' => ''
            ]
        )) {
            //Tangkap Pesan kesalahan validation
            // $validation = \Config\Services::validation();

            // return redirect()->to('pelanggan/create')->withInput()->with('validation', $validation);
            return redirect()->to('pelanggan/create')->withInput();
        }

        // ambil gambar
        $filektp = $this->request->getFile('KTP');

        // apakah tidak ada gambar yg di upload
        if ($filektp->getError() == 4) {
            $namafile = 'customer.png';
        } else {
            // generate nama random
            $namafile = $filektp->getRandomName();
            // upload file ke folder public/img
            $filektp->move('img', $namafile);

            // pindahkan file ke folder public/img
            // $filektp->move('img');
            // ambil nama file
            // $namafile = $filektp->getName();
        }

        // Ambil data input User
        $this->pelangganModel->save(
            [
                'KTP' => $namafile,
                'nojar' => $this->request->getVar('nojar'),
                'nama' => $this->request->getVar('nama'),
                'kontak' => $this->request->getVar('kontak'),
                'alamat' => $this->request->getVar('alamat'),
                'akses' => $this->request->getVar('akses'),
                'ipwan' => $this->request->getVar('ipwan'),
                'status' => $this->request->getVar('status')
            ]
        );

        // Menampilkan popup pesan setelah data berhasil ditambahkan
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        // redirect ke halaman list pelanggan
        return redirect()->to('/pelanggan');
    }

    public function delete($id)
    {
        // Cari gambar berdasarkan id
        $filektp = $this->pelangganModel->find($id);

        // jika gambar tidak diganti
        if ($filektp['KTP'] != 'customer.png') {
            // hapus gambar
            unlink('img/' . $filektp['KTP']);
        }


        $this->pelangganModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/pelanggan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Form Edit Data Pelanggan',
            'validation' => \Config\Services::validation(),
            'pelanggan' => $this->pelangganModel->getPelanggan($id)
        ];

        return view('pelanggan/edit', $data);
    }

    public function update($id)
    {
        // cek data lama
        $pelangganLama = $this->pelangganModel->getPelanggan($id);

        // test dump data
        // dd($pelangganLama['nojar'], $this->request->getVar('nojar'));

        // cek validasi data nojar
        if ($pelangganLama['nojar'] == $this->request->getVar('nojar')) { //jika data lama sebanding dengan data baru, maka
            $rule_nojar = 'required';
        } else {
            $rule_nojar = 'required|min_length[8]|max_length[8]|is_unique[pelanggan.nojar]';
        }

        // cek validasi data kontak
        if ($pelangganLama['kontak'] == $this->request->getVar('kontak')) {
            $rule_kontak = 'required';
        } else {
            $rule_kontak = 'required|is_unique[pelanggan.kontak]|max_length[14]|min_length[8]|numeric';
        }

        // cek validasi data ipwan
        if ($pelangganLama['ipwan'] == $this->request->getVar('ipwan')) {
            $rule_ipwan = 'required';
        } else {
            $rule_ipwan = 'required|valid_ip|is_unique[pelanggan.ipwan]';
        }

        // validasi data edit
        if (!$this->validate(
            [
                'KTP' => [
                    'rules' => 'mime_in[KTP,image/jpg,image/jpeg,image/png,image/svg]|is_image[KTP]',
                    'errors' => [
                        'mime_in' => 'File harus gambar',
                        'is_image' => 'File harus gambar'
                    ]
                ],
                'nojar' => [
                    'rules' => $rule_nojar,
                    'errors' => [
                        'required' => 'No Jaringan harus diisi.',
                        'max_length' => 'No Jaringan Maksimal 8 angka.',
                        'min_length' => 'No Jaringan Minimal 8 angka.',
                        'is_unique' => 'No Jaringan sudah terdaftar, silahkan masukkan yang lain.'
                    ]
                ],
                'nama' => [
                    'rules' => 'required|alpha_space',
                    'errors' => [
                        'required' => 'Nama harus diisi.',
                        'alpha_space' => 'Nama hanya mengandung karakter & spasi.'
                    ]
                ],
                'kontak' => [
                    'rules' => $rule_kontak,
                    'errors' => [
                        'required' => 'Kontak harus diisi.',
                        'max_length' => 'No Jaringan Maksimal 14 angka.',
                        'min_length' => 'No Jaringan Minimal 8 angka.',
                        'numeric' => 'Kontak hanya mengandung angka.',
                        'is_unique' => 'Kontak sudah terdaftar.'
                    ]
                ],
                // 'alamat' => '',
                // 'akses' => '',
                'ipwan' => [
                    'rules' => $rule_ipwan,
                    'errors' => [
                        'required' => 'IP Address harus diisi.',
                        'valid_ip' => 'Format IP Address salah.',
                        'is_unique' => 'IP Address sudah terdaftar.'
                    ]
                ]
                // // 'status' => ''
            ]
        )) {
            //Tangkap Pesan kesalahan validation
            // $validation = \Config\Services::validation();
            // $pelanggan_id = $this->request->getVar('nama');
            $pelanggan_id = $this->pelangganModel->getPelanggan($id);
            // $get_id = $pelanggan_id['id'];
            // dd($get_id);

            return redirect()->to('/pelanggan/edit/' . $pelanggan_id['id'])->withInput();
        }

        // ambil file KTP
        $fileKTP_ = $this->request->getFile('KTP');
        $namafilektpbaru = $this->request->getVar('KTPLama');
        // cek gambar, apakah tetap gambar lama
        if ($fileKTP_->getError() == 4) {
            $namafilektp = $this->request->getVar('KTPLama');
        } else {
            // generate random name
            $namafilektp = $fileKTP_->getRandomName();
            // upload file
            $fileKTP_->move('img', $namafilektp);
            //hapus file lama
            // jika gambar tidak diganti
            if ($namafilektpbaru != 'customer.png') {
                // hapus gambar
                unlink('img/' . $this->request->getVar('KTPLama'));
            }
        }


        $this->pelangganModel->save(
            [
                'id' => $id,
                'KTP' => $namafilektp,
                'nojar' => $this->request->getVar('nojar'),
                'nama' => $this->request->getVar('nama'),
                'kontak' => $this->request->getVar('kontak'),
                'alamat' => $this->request->getVar('alamat'),
                'akses' => $this->request->getVar('akses'),
                'ipwan' => $this->request->getVar('ipwan'),
                'status' => $this->request->getVar('status')
            ]
        );
        // Menampilkan popup pesan setelah data berhasil ditambahkan
        session()->setFlashdata('pesan', 'Data berhasil di update.');

        // redirect ke halaman list pelanggan
        return redirect()->to('/pelanggan');
    }
}
