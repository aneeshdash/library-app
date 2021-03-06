<?php
/**
 * Created by PhpStorm.
 * User: aneeshdash
 * Date: 27/11/14
 * Time: 10:41 AM
 */

class Book extends Eloquent
{
    use SoftDeletingTrait;
    protected $table='books';

    function category() {
        return $this->belongsTo('Category');
    }

    function publication() {
        return $this->belongsTo('Publication');
    }

    function user() {
        return $this->belongsTo('User','issue');
    }

    function lostbook(){
        return $this->hasOne('LostBook');
    }

    function transaction(){
        return $this->hasMany('Transaction');
    }

}