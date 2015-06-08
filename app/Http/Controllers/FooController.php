<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\FooRepository;
use Illuminate\Http\Request;

class FooController extends Controller {

    /*
     *
    private $repository;

    // Constructor injection
    // Request an instance of the FooRepository class
    public function __construct(FooRepository $repository)
    {
        $this->repository = $repository;
    }

    */

    // Method injection
    // Similar to Constructor injection - ideal if this is the only method requires the FooRepository instance
    public function foo(FooRepository $repository)
    {
        // Works but is deemed bad practise as it is difficult to test and review the code, and know the dependencies this class requires
        // $repository = new \App\Repositories\FooRepository();
        // return $repository->get();

        //return 'foo';

        return $repository->get(); //this->repository->get();
    }

}
