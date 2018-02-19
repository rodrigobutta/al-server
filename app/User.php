<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password', 'password',
    // ];
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];




    public function encodeJsonNodes(){

        $this->address = new \stdClass();

        $this->address->street = $this->address_street;
        unset($this->address_street);

        $this->address->city = $this->address_city;
        unset($this->address_city);

        $this->address->suite = $this->address_suite;
        unset($this->address_suite);

        $this->address->zipcode = $this->address_zipcode;
        unset($this->address_zipcode);

        return true;

    }


}
