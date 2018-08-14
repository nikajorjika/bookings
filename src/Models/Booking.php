<?php

namespace Jorjika\Bookings\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;


class Booking extends Model
{
    protected $table = 'nj-bookings';

    protected $fillable = ['from', 'to', 'booking_type', 'booker_id', 'booker_type', 'bookable_id', 'bookable_type', 'canceled_at'];

    /**
     * Define relation to object which will become bookable
     *
     * @return MorphTo
     */
    public function bookable(): MorphTo
    {
        return $this->MorphTo();
    }

    /**
     * Define relation to object which will be able to make a booking
     *
     * @return MorphTo
     */
    public function booker(): MorphTo
    {
        return $this->MorphTo();
    }

    /**
     * Cancel the current booking
     *
     * @return String
     */
    public function cancel(): String
    {
        $this->canceled_at = Carbon::now();
        $this->save();
        return $this->canceled_at;
    }

    /**
     * Get Bookings which has not been canceled or is not in the past
     *
     * @param $query
     * @return String
     */
    public function scopeActiveBookings($query)
    {
        return $query->whereNull('canceled_at');
    }

    /**
     * Get all past bookings
     * Pass false for second argument if you want to get only active bookings
     *
     * @param $query
     * @param bool $include_canceled
     * @return mixed
     */
    public function scopeGetPastBookings($query, $include_canceled = true)
    {
        $now = Carbon::now();
        $query = $query->where('to', '<', $now);
        $query = $include_canceled ? $query->whereNull('canceled_at') : $query;
        return $query;
    }

    /**
     * Get all future bookings
     * Pass false for second argument if you want to get only active bookings
     *
     * @param $query
     * @param bool $include_canceled
     * @return mixed
     */
    public function scopeGetFutureBookings($query, $include_canceled = true)
    {
        $now = Carbon::now();
        $query = $query->where('to', '>', $now);
        $query = $include_canceled ? $query->whereNull('canceled_at') : $query;
        return $query;
    }

    /**
     * Get Bookings which are in progress at the moment of execution
     * Pass false for second argument if you want to get only active bookings
     *
     * @param $query
     * @param bool $include_canceled
     * @return mixed
     */
    public function scopeGetCurrentBookings($query, $include_canceled = true)
    {
        $now = Carbon::now();
        $query = $query->where('from', '>', $now)->where('to', '<', $now);
        $query = $include_canceled ? $query->whereNull('canceled_at') : $query;
        return $query;
    }

    /**
     * Get Bookings which have been canceled
     *
     * @param $query
     * @return mixed
     */
    public function scopeCanceled($query)
    {
        $query = $query->whereNotNull('canceled_at');
        return $query;
    }


}
