<?php
/**
 * Created by PhpStorm.
 * User: shivam
 * Date: 4/8/2015
 * Time: 3:47 PM
 */

class LostBook extends Eloquent {
    use SoftDeletingTrait;
    protected $table='lost_book';

    function book()
    {
        return $this->belongsTo('Book');
    }
    function user() {
        return $this->belongsTo('User');
    }
}