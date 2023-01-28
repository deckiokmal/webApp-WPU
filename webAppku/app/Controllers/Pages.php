<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home | SisDopnetindoApp'
        ];
        return view('pages/home', $data);
    }

    public function about()
    {

        $data = [
            'title' => 'AboutMe | SisDopnetindoApp'
        ];
        return view('pages/about', $data);
    }
    public function contact()
    {

        $data = [
            'title' => 'Contact | SisDopnetindoApp',
            'alamat' => [
                [
                    'tipe' => 'rumah',
                    'alamat' => 'Jl. Kuala Alam 01',
                    'kota' => 'Bengkulu'
                ],
                [
                    'tipe' => 'kantor',
                    'alamat' => 'Jl. pangeran Natadirja',
                    'kota' => 'Bengkulu'
                ]
            ]
        ];
        return view('pages/contact', $data);
    }
}
