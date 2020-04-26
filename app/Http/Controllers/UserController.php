<?php

namespace App;
use App\Http\Controllers\Controller;
use illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;

use App\Quote;
use config\QuoteList;

class UserController extends Controller
{
    public function show(Request $request)
    {
        include('App\Quote.php');
        $arr = array();
        $app = array(config(['config/QuoteList.php']));
        $Quote = $arr -> Quote($app);
        switch ($request -> input('action')) {
            case 'Quote Of The Day':
                $qotd = $Quote -> quotd(getdate());
                Route::get('/webpage', function($qotd) {
                    ['author' => $qotd[0]['author'],
                     'quote' => $qotd[0]['quote']];
                } );

            case 'Random':
                $randomQuote = Arr::pull($Quote, rand(0, 40));
                Route::get('/webpage', function($randomQuote) {
                    ['author' => $randomQuote[0]['author'],
                     'quote' => $randomQuote[0]['quote']];
                } );
        }
    }
}

?>
