<?php

namespace Jorjika\Bookings\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Jorjika\Bookings\Models\Booking;

trait CanBook
{
    public function bookings() : MorphMany
    {
        return $this->MorphMany(Booking::class,'booker');
    }

    public function bookDate(Model $bookable, $from, $to, $type = 0)
    {
        try {
            $result =  $this->bookings()->create([
                'bookable_id' => $bookable->getKey(),
                'bookable_type' => $bookable->getMorphClass(),
                'booker_id' => $this->getKey(),
                'booker_type' => $this->getMorphClass(),
                'booking_type' => $type,
                'from' => $from,
                'to' => $to,
            ]);
        } catch (\Exception $e) {
            print($e->getMessage());
            $result = false;
        }
        return $result;
    }
}
