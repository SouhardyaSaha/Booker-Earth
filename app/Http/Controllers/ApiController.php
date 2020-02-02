<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getUsers(Request $request) {
        $users = [];

        $tempUsers = User::recipients($request->get('q'), auth()->user())->get();
        foreach ($tempUsers as $user) {
            $users[] = ['id' => $user['id'], 'text' => $user['name'] ];
        }

        return response()->json($users);
    }


    function getBooksFromGoodReadsApi($keyValue)
    {

        $key = env('KEY_FOR_GOODREADS_API');

        // $url = 'https://www.goodreads.com/search/index.xml?key=NbGMrbxYqqzHRuLMlOFvLA&q=database';
        $url = 'https://www.goodreads.com/search/index.xml?key=' . $key . '&q=' . $keyValue;
        try {

            $handle = curl_init();
            curl_setopt_array($handle, array(

                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,

            ));

            $output = curl_exec($handle);

            curl_close($handle);

            $xml = simplexml_load_string($output);
            $json = json_encode($xml);
            $results = json_decode($json, TRUE);

            // dd($results['search']['results']['work']);
            $books = ['suggestions' => []];

            foreach ($results['search']['results']['work'] as $book) {
                $books['suggestions'][] = [

                    'value' => $book['best_book']['title'],
                    'data' => [
                        'author' => $book['best_book']['author']['name'],
                        'average_rating' => $book['average_rating'],
                        'image_url' => $book['best_book']['image_url'],
                    ]

                ];
            }
            // dd($books);
            return $books;
        } catch (\Exception $e) {
            $books = ['suggestions' => []];
            return $books;
        }
    }

    // Route::get('search-book-google', );
    function getBooksFromGoogleBooksApi($keyValue)
    {

        if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
            error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
        }
        // $keyValue = 'harry';
        try {

            $client = new \Google_Client();
            $client->setApplicationName("Booker-Earth");
            $client->setDeveloperKey(env('KEY_FOR_GOOGLE_BOOKS_API'));

            $service = new \Google_Service_Books($client);
            $optParams = [
                'orderBy' => 'relevance',
                'maxResults' => 20,
            ];
            $results = $service->volumes->listVolumes($keyValue, $optParams);

            // dd($results);

            $books = ['suggestions' => []];
            foreach ($results as $item) {
                $books['suggestions'][] = [
                    'value' => $item['volumeInfo']['title'],
                    'data' => [
                        'authors' => $item['volumeInfo']['authors'],
                        'image_url' => $item['volumeInfo']['imageLinks']['thumbnail'],
                    ]
                ];
            }
            return $books;
        } catch (\Exception $e) {
            $books = ['suggestions' => []];
            return $books;
        }
    }


    public function BookSearchByApi(Request $request) {

        $keyValue = $request->get('query');

        // $books = getBooksFromGoodReadsApi($keyValue);
        $books = $this->getBooksFromGoogleBooksApi($keyValue);
        // dd($books);
        return response()->json($books);
    }
}
