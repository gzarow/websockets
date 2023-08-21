<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * Display the listing of the resource.
     */
    public function index(Request $request): View
    {
        $cahannelsIds = $request->user()->channels->pluck('id')->toArray();
        $news = News::getSubscribed($cahannelsIds);
        return view('news.index', [
            'news' => $news,
        ]);
    }
}
