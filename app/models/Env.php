<?php
/**
 * Created by PhpStorm.
 * User: aneeshdash
 * Date: 27/11/14
 * Time: 10:41 AM
 */

class Env extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'env_vars';

    
}