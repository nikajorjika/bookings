<?php

namespace Jorjika\Bookings\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Jorjika\Bookings\Models\Booking;

trait Bookable
{
    public function bookings() : MorphMany
    {
        return $this->MorphMany(Booking::class, 'bookable');
    }

    /**
     * @param $booker
     * @param $from
     * @param $to
     * @param int $type
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function bookDate(Model $booker, $from, $to, $type = 0)
    {
        try {
            $result =  $this->bookings()->create([
                'bookable_id' => $this->getKey(),
                'bookable_type' => $this->getMorphClass(),
                'booker_id' => $booker->getKey(),
                'booker_type' => $booker->getMorphClass(),
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
