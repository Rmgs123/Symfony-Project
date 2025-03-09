<?php

namespace App\Tests\Service;

use App\Service\BookingCsvService;
use PHPUnit\Framework\TestCase;

class BookingCsvServiceTest extends TestCase
{
    public function testCreateBooking(): void
    {
        // Create temporary csv-file
        $tempFile = tempnam(sys_get_temp_dir(), 'bookings');
        $service = new BookingCsvService($tempFile);

        $service->createBooking(1, '555-1234', 'Test comment');
        $bookings = $service->getAllBookings();

        $this->assertCount(1, $bookings);
        $this->assertSame(1, $bookings[0]['cottageId']);
        $this->assertSame('555-1234', $bookings[0]['phone']);
        $this->assertSame('Test comment', $bookings[0]['comment']);

        unlink($tempFile); // Delete temporary file
    }

}
