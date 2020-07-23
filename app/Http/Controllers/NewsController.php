<?php

namespace App\Http\Controllers;

use App\Jobs\NewsJob;
use App\News;
use Illuminate\View\View;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $news = News::take(15)->get();

        if ($news->isEmpty()){
            $this->dispatchNow(new NewsJob());
            $news = News::all();
        }

        return view('news.index')->with([
            'news' => $news,
        ]);
    }

    /**
     * Display the specified news.
     *
     * @param News $news
     *
     * @return View
     */
    public function show(News $news)
    {
        return view('news.show')->with([
            'news' => $news,
        ]);
    }

}
