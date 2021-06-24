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

    public function testSumSubstraction(): void
    {
        $response = $this->createClientWithCredentials()->request('POST', self::HOST_NAME.'/api/v1/compute', [
            'json' => [
                "expression" => "10+2+10-2-5",
            ]
        ]);

        $this->assertJsonContains(
            [
                "compute" => "15"
            ]     
        );
    }

    public function testSumSubstractionMult(): void
    {
        $response = $this->createClientWithCredentials()->request('POST', self::HOST_NAME.'/api/v1/compute', [
            'json' => [
                "expression" => "10+2+10-2-5*10*3*4",
            ]
        ]);

        $this->assertJsonContains(
            [
                "compute" => "-580"
            ]     
        );
    }

    public function testSumSubstractionMultDiv(): void
    {
        $response = $this->createClientWithCredentials()->request('POST', self::HOST_NAME.'/api/v1/compute', [
            'json' => [
                "expression" => "10+2+10-2-5*10*3*4/5/4/8",
            ]
        ]);

        $this->assertJsonContains(
            [
                "compute" => "16.25"
            ]     
        );
    }

    public function testSubstractSubSymbolFront(): void
    {
        $response = $this->createClientWithCredentials()->request('POST', self::HOST_NAME.'/api/v1/compute', [
            'json' => [
                "expression" => "-1-1",
            ]
        ]);

        $this->assertJsonContains(
            [
                "compute" => "-2"
            ]     
        );
    }

    public function testSubstractSubSymbolFrontSub(): void
    {
        $response = $this->createClientWithCredentials()->request('POST', self::HOST_NAME.'/api/v1/compute', [
            'json' => [
                "expression" => "-1-1-1",
            ]
        ]);

        $this->assertJsonContains(
            [
                "compute" => "-3"
            ]     
        );
    }

    public function testSumPlusSymbolFront(): void
    {
        $response = $this->createClientWithCredentials()->request('POST', self::HOST_NAME.'/api/v1/compute', [
            'json' => [
                "expression" => "+1+1",
            ]
        ]);

        $this->assertJsonContains(
            [
                "compute" => "2"
            ]     
        );
    }

    public function testSumPlusSymbolFrontSum(): void
    {
        $response = $this->createClientWithCredentials()->request('POST', self::HOST_NAME.'/api/v1/compute', [
            'json' => [
                "expression" => "+1+1+1",
            ]
        ]);

        $this->assertJsonContains(
            [
                "compute" => "3"
            ]     
        );
    }

    public function testDecimal(): void
    {
        $response = $this->createClientWithCredentials()->request('POST', self::HOST_NAME.'/api/v1/compute', [
            'json' => [
                "expression" => "-1.2+3.4-2.6/4.25*21.3",
            ]
        ]);

        $this->assertJsonContains(
            [
                "compute" => "-10.830588235294"
            ]     
        );
    }

    public function testDecimalMore(): void
    {
        $response = $this->createClientWithCredentials()->request('POST', self::HOST_NAME.'/api/v1/compute', [
            'json' => [
                "expression" => "-1.2+3.4-2.6/4.25*21.3/-12",
            ]
        ]);

        $this->assertJsonContains(
            [
                "compute" => "3.2858823529412"
            ]     
        );
    }

    public function testDecimalMoreComplicated(): void
    {
        $response = $this->createClientWithCredentials()->request('POST', self::HOST_NAME.'/api/v1/compute', [
            'json' => [
                "expression" => "-1.2+3.4-2.6/4.25*21.3/-12*-3+3/-25.8",
            ]
        ]);

        $this->assertJsonContains(
            [
                "compute" => "-1.173926128591"
            ]     
        );
    }

    public function testAvoidZero(): void
    {
        $response = $this->createClientWithCredentials()->request('POST', self::HOST_NAME.'/api/v1/compute', [
            'json' => [
                "expression" => ".21-.2",
            ]
        ]);

        $this->assertJsonContains(
            [
                "compute" => "0.01"
            ]     
        );
    }

    public function testAvoidZeroComplicated(): void
    {
        $response = $this->createClientWithCredentials()->request('POST', self::HOST_NAME.'/api/v1/compute', [
            'json' => [
                "expression" => ".21-.2/21.",
            ]
        ]);

        $this->assertJsonContains(
            [
                "compute" => "0.20047619047619"
            ]     
        );
    }

    public function testErrorCase(): void
    {
        $response = $this->createClientWithCredentials()->request('POST', self::HOST_NAME.'/api/v1/compute', [
            'json' => [
                "expression" => ".21.-.2/21.",
            ]
        ]);

        $this->assertJsonContains(
            [
                "compute" => "Operand malformed",
            ]     
        );
    }

    public function testErrorCase2(): void
    {
        $response = $this->createClientWithCredentials()->request('POST', self::HOST_NAME.'/api/v1/compute', [
            'json' => [
                "expression" => "123.21.234-.2/21.23.56",
            ]
        ]);

        $this->assertJsonContains(
            [
                "compute" => "Operand malformed",
            ]     
        );
    }
}