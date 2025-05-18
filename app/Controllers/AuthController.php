<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;

class AuthController extends ResourceController
{
    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return $this->failUnauthorized('Username atau password salah');
        }

        $payload = [
            'iss' => 'localhost',
            'aud' => 'localhost',
            'iat' => time(),
            'exp' => time() + 3600,
            'data' => [
                'id' => $user['id_user'],
                'username' => $user['username'],
                'role' => $user['role'],
            ]
        ];

        $key = getenv('JWT_SECRET') ?: 'supersecretkey123';
        $token = JWT::encode($payload, $key, 'HS256');

        return $this->respond([
            'message' => 'Login berhasil',
            'token' => $token,
        ]);
    }
}
