<?php namespace App\Http\Composers;

use Illuminate\Contracts\View\View;

class NavigationComposer
{
    // We dont need to specify the type of object that is getting passed through but it is best practise
    public function compose(View $view)
    {
        $view->with('latest', \App\Article::latest()->first() );
    }

}