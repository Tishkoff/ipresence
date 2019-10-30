<?php

namespace App\Http\Controllers;

use App\Contracts\QuotesProvider;
use Illuminate\Http\Request;

/**
 * Class QuotesController
 * @package App\Http\Controllers
 */
class QuotesController extends Controller
{
    /**
     * @var QuotesProvider
     */
    protected $quotesProvider;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(QuotesProvider $quotesProvider)
    {
        $this->quotesProvider = $quotesProvider;
    }

    /**
     * @param Request $request
     * @param $person
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function shout(Request $request, $person)
    {
        $this->validate($request, [
            'limit' => 'int|min:1|max:10',
        ]);

        $quotes = $this->quotesProvider->getShoutedQuotes($person, $request->input('limit', 10));

        return response()->json($quotes, 200, ['Content-Type' => 'application/json;charset=utf8']);
    }
}
