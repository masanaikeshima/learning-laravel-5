<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PagesController extends Controller {

	//



	public function about()
	{
		// View with Array - CodeIgniter way
		$data = array();
		$data['first'] = 'Masa';
		$data['last']  = 'Ike';

		$data['people_FALSE'] = array();

		$data['people'] = array();
		$data['people'][] = 'Dave';
		$data['people'][] = 'trader_stoch';
		$data['people'][] = 'B0b';
		$data['people'][] = 'Fish';

		return view('pages.about', $data);

		// Array value
		//return view('pages.about')->with([ 'first' => 'Masana', 'last'  => 'Ikeshima' ]);


		// $name = 'Masana <span style="color:red;">Ikeshima</span>';

		// Single value
		// return view('pages.about')->with('name', $name);


		// Just the view
		// return view('pages.about');
	}

	public function contact()
	{
		return view('pages.contact');
	}
}
