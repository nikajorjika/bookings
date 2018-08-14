<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\DB;

class BookableTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nj-bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('from');
            $table->datetime('to');
            $table->morphs('bookable');
            $table->morphs('booker');
            $table->enum('booking_type', [0, 1])->default(0);
            $table->dateTime('canceled_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nj-bookings');
    }
    /**
     * Get jsonable column data type.
     *
     * @return string
     */
    protected function supportsJson()
    {
        return DB::connection()->getPdo()->getAttribute(PDO::ATTR_DRIVER_NAME) === 'mysql'
        && version_compare(DB::connection()->getPdo()->getAttribute(PDO::ATTR_SERVER_VERSION), '5.7.8', 'ge')
            ? 'json' : 'text';
    }
}
