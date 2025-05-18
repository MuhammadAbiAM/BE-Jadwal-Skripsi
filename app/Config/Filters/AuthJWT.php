<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;
use Config\Services;

class AuthJWT implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $authHeader = $request->getHeaderLine('Authorization');

        if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            return Services::response()
                ->setJSON(['error' => 'Token tidak ditemukan'])
                ->setStatusCode(401);
        }

        $token = $matches[1];

        try {
            $decoded = validateJWT($token);
            // Opsional: bisa disimpan di session atau request
            $request->user = $decoded->data;
        } catch (Exception $e) {
            return Services::response()
                ->setJSON(['error' => 'Token tidak valid', 'message' => $e->getMessage()])
                ->setStatusCode(401);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}
