<?php

namespace App\Tests\Service;

use App\Service\CottageCsvService;
use PHPUnit\Framework\TestCase;

class CottageCsvServiceTest extends TestCase
{
    protected function setUp(): void
    {
        if (file_exists('test.csv')) {
            unlink('test.csv');
        }
    }

    public function testGetAllCottagesEmptyIfNoFile(): void
    {
        $service = new CottageCsvService('test.csv');
        $cottages = $service->getAllCottages();
        $this->assertCount(0, $cottages);
    }

}
