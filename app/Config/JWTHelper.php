<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function generateJWT($user)
{
    $key = getenv('JWT_SECRET');
    $payload = [
        'iat' => time(),
        'exp' => time() + 3600,
        'data' => [
            'id' => $user['id_user'],
            'username' => $user['username'],
            'role' => $user['role'],
        ]
    ];
    return JWT::encode($payload, $key, 'HS256');
}

function validateJWT($token)
{
    $key = getenv('JWT_SECRET');
    return JWT::decode($token, new Key($key, 'HS256'));
}
