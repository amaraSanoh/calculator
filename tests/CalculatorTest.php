<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Tests\AbstractTest;

class CalculatorTest extends AbstractTest
{
    public function testSum(): void
    {
        $response = $this->createClientWithCredentials()->request('POST', self::HOST_NAME.'/api/v1/compute', [
            'json' => [
                "expression" => "4+1+2",
            ]
        ]);

        $this->assertJsonContains(
            [
                "compute" => "7"
            ]     
        );
    }

    public function testSubstraction(): void
    {
        $response = $this->createClientWithCredentials()->request('POST', self::HOST_NAME.'/api/v1/compute', [
            'json' => [
                "expression" => "1-1-12",
            ]
        ]);

        $this->assertJsonContains(
            [
                "compute" => "-12"
            ]     
        );
    }

    public function testDivision(): void
    {
        $response = $this->createClientWithCredentials()->request('POST', self::HOST_NAME.'/api/v1/compute', [
            'json' => [
                "expression" => "10/2/5",
            ]
        ]);

        $this->assertJsonContains(
            [
                "compute" => "1"
            ]     
        );
    }

    public function testMultiplication(): void
    {
        $response = $this->createClientWithCredentials()->request('POST', self::HOST_NAME.'/api/v1/compute', [
            'json' => [
                "expression" => "10*2*10",
            ]
        ]);

        $this->assertJsonContains(
            [
                "compute" => "200"
            ]     
        );
    }
}