<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookingControllerTest extends WebTestCase
{
    public function testCreateBooking(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/bookings', [
            'phone' => '123456',
            'cottageId' => 2,
            'comment' => 'My first booking',
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(['status' => 'Booking created']);
    }

    public function testUpdateBooking(): void
    {
        $client = static::createClient();
        
        $client->request('POST', '/api/bookings', [
            'phone' => '777',
            'cottageId' => 1,
            'comment' => 'Old comment',
        ]);
        $this->assertResponseIsSuccessful();

        $client->request('PUT', '/api/bookings/1', [
            'comment' => 'New comment',
        ]);
        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(['status' => 'Booking updated']);
    }
}
