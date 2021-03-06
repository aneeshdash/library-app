<?php
/**
 * Created by PhpStorm.
 * User: shivam
 * Date: 4/8/2015
 * Time: 3:21 PM
 */

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface {
    use UserTrait, RemindableTrait, SoftDeletingTrait;


    protected $hidden = array('password', 'remember_token');
    protected $table='users';

    function books() {
        return $this->hasMany('Book','issue');
    }

    function lost_books() {
        return $this->hasMany('LostBook');
    }
    function ratings() {
        return $this->hasMany('Rating');
    }
    function feedback() {
        return $this->hasOne('Feedback');
    }

}