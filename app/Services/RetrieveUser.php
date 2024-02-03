<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RetrieveUser
{
    public function getUserData($token)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => $token,
        ])->get('http://127.0.0.1:9000/api/user');

        return $response['response'];
    }
}
