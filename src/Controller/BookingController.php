<?php

namespace App\Controller;

use App\Service\BookingCsvService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{
    // POST /api/bookings
    #[Route('/api/bookings', name: 'api_booking_create', methods: ['POST'])]
    public function create(Request $request, BookingCsvService $bookingService): JsonResponse
    {
        $phone = $request->get('phone');
        $cottageId = (int)$request->get('cottageId');
        $comment = $request->get('comment', '');

        // Create booking
        $bookingService->createBooking($cottageId, $phone, $comment);

        return $this->json(['status' => 'Booking created']);
    }

    // PUT /api/bookings/{id}
    #[Route('/api/bookings/{id}', name: 'api_booking_update', methods: ['PUT'])]
    public function update(int $id, Request $request, BookingCsvService $bookingService): JsonResponse
    {
        // Decode the JSON body
        $data = json_decode($request->getContent(), true);
        $newComment = $data['comment'] ?? '';
        
        $bookingService->updateBooking($id, $newComment);

        return $this->json(['status' => 'Booking updated']);
    }

    #[Route('/api/bookings', name: 'api_bookings_list', methods: ['GET'])]
    public function list(BookingCsvService $bookingService): JsonResponse
    {
        $bookings = $bookingService->getAllBookings();
        return $this->json($bookings);
    }
}