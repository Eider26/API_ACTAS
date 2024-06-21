<?php

namespace modelos;

use Error;
use Exception;

class Jwt
{
    public function __construct(
        private string $key
    ) {
    }

    public function encode(array $data): string
    {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $header = self::base64UrlEncode($header);

        $payload = json_encode($data);
        $payload = self::base64UrlEncode($payload);

        $signature = hash_hmac('sha256', "$header.$payload", $this->key, true);
        $signature = self::base64UrlEncode($signature);

        return "$header.$payload.$signature";
    }

    public function decode(string $token): array
    {

        if (preg_match(
                "/^(?<header>.+)\.(?<payload>.+)\.(?<signature>.+)$/",
                $token,
                $matches
            ) !== 1
        ) {
            throw new Exception("invalid token format");
        }

        $signature = hash_hmac('sha256', "$matches[header].$matches[payload]", $this->key, true);

        if (!hash_equals($signature, $this->base64UrlDecode($matches['signature']))) {
            throw new Exception("invalid token");
        }

        $payload = json_decode($this->base64UrlDecode($matches['payload']), true);


        if($payload['exp'] < time()){
            throw new Exception('Token expired');
        }

        return $payload;
    }

    public function base64UrlDecode(string $data): string
    {
        $data = str_replace(['-', '_'], ['+', '/'], $data);
        $data = base64_decode($data);

        return $data;
    }

    private function base64UrlEncode(string $data): string
    {
        $data = base64_encode($data);
        $data = str_replace(['+', '/', '='], ['-', '_', ''], $data);

        return $data;
    }
}
