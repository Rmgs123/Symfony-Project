<?php

namespace App\Service;

class BookingCsvService
{
    private string $csvPath;

    public function __construct(string $csvPath)
    {
        $this->csvPath = $csvPath;
    }

    /**
     * Get all reservations from CSV
     */
    public function getAllBookings(): array
    {
        $bookings = [];
        if (!file_exists($this->csvPath)) {
            return $bookings;
        }

        if (($handle = fopen($this->csvPath, 'r')) !== false) {
            // id;cottageId;phone;comment
            while (($data = fgetcsv($handle, 1000, ';', '"', '\\')) !== false) {
                if (count($data) < 4) {
                    continue;
                }
                $bookings[] = [
                    'id'        => (int)$data[0],
                    'cottageId' => (int)$data[1],
                    'phone'     => $data[2],
                    'comment'   => $data[3],
                ];
            }
            fclose($handle);
        }

        return $bookings;
    }

    /**
     * Create new reservation
     */
    public function createBooking(int $cottageId, string $phone, string $comment): void
    {
        $bookings = $this->getAllBookings();
        $maxId = 0;
        foreach ($bookings as $b) {
            if ($b['id'] > $maxId) {
                $maxId = $b['id'];
            }
        }
        $newId = $maxId + 1;

        // Add new line
        $handle = fopen($this->csvPath, 'a');
        fputcsv($handle, [
            $newId,
            $cottageId,
            $phone,
            $comment
        ], ';', '"', '\\');
        fclose($handle);
    }

    public function updateBooking(int $id, ?string $newComment): void
    {
        $bookings = $this->getAllBookings();
        // Rewrite full file
        $handle = fopen($this->csvPath, 'w');
        foreach ($bookings as $b) {
            if ($b['id'] === $id) {
                // Updating comment
                $b['comment'] = $newComment ?? '';
            }
            fputcsv($handle, [
                $b['id'],
                $b['cottageId'],
                $b['phone'],
                $b['comment']
            ], ';', '"', '\\');
        }
        fclose($handle);
    }
}
