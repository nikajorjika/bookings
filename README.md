#This Package is still in dev mode so don't use it in active projects

# Bookings

This is small lightheight package for creating bookings functionality on any two models

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

PHP 7.*
laravel ^5.6

### Installing

A step by step series of examples that tell you how to get a development env running

First you need to install the package on your laravel project
```
composer require jorjika/bookings
```
Then get publish the migrations

```
php artisan migrate
```

Now all you need to do is use ```Bookable``` and ```CanBook``` traits on your models. 

####Example
```
use Jorjika\Bookings\Traits\CanBook;

class User extends Authenticatable
{
    use CanBook;
}
```
```
use Jorjika\Bookings\Traits\Bookable;

class Ticket extends Model
{
    use Bookable;

    protected $fillable = ['name'];


}
```
That's it now you can use all the features of booking package on those two models.


End with an example of getting some data out of the system or using it for a little demo

## Running the tests

Explain how to run the automated tests for this system

### Break down into end to end tests

Explain what these tests test and why

```
Give an example
```

### And coding style tests

Explain what these tests test and why

```
Give an example
```

## Authors

* **Nika Jorjoliani**

See also the list of [contributors] (https://github.com/nikajorjika/bookings/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

