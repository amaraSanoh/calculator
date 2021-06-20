<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\{ApiTestCase, Client};

abstract class AbstractTest extends ApiTestCase
{
    const HOST_NAME = "https://127.0.0.1:8000";
    const CONTENT_TYPE =  "application/ld+json";
    const ACCEPT = "application/ld+json";


    public function setUp(): void
    {
        self::bootKernel();
    }

    protected function createClientWithCredentials(?string $token = null): Client
    {
        $token = $token ?: "";

        return static::createClient([], ['headers' => [
            'X-AUTH-TOKEN' => $token, 
            'Content-Type' => self::CONTENT_TYPE,
            'Accept' => self::ACCEPT,
        ]]);
    }
}