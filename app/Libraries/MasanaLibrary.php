<?php namespace App\Libraries;

// use Illuminate\Support\Facades\Facade;

class MasanaLibrary
{
   // protected $is_defferred = false;


    public static function hello()
    {
        return 'hello world';
    }

    public function foo($input)
    {
        return $input . ' append text';
    }
}
