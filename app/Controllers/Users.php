<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index()
    {
        // Contoh pengambilan data pengguna dari model
        $data['users'] = [
            ['id' => 1, 'username' => 'user1'],
            ['id' => 2, 'username' => 'user2'],
            // ...
        ];

        return view('users/index', $data);
    }
}
