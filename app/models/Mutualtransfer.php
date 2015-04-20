<?php


class Mutualtransfer extends Eloquent{
    use SoftDeletingTrait;
    protected $table='mutualtransfers';
    function book()
    {
        return $this->belongsTo('Book');
    }
}

