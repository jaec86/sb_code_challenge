<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {
    $collection = collect([]);
    
    $crawler = Goutte::request('GET', 'https://news.ycombinator.com/');
    $crawler->filter('.athing')->each(function ($node) use ($collection) {
        $collection->push(collect([
            'title' => $node->filter('.storylink')->text(),
            'rank' => (int) $node->filter('.rank')->text(),
            'points' => (int) $node->nextAll()->filter('.score')->text(),
            'comments' => (int) $node->nextAll()->filter('a[href^="item"]')->eq(1)->text()
        ]));
    });

    if ($request->filter === 'title_more_5_words_and_sort_by_comments') {
        $collection = $collection->filter(function ($item) {
            return str_word_count($item->get('title')) > 5;
        })->sortByDesc('comments');
    };

    if ($request->filter === 'title_less_or_equal_5_words_and_sort_by_points') {
        $collection = $collection->filter(function ($item) {
            return str_word_count($item->get('title')) <= 5;
        })->sortByDesc('points');
    };

    return view('welcome', ['entries' => $collection]);
});
