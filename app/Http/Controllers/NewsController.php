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
        $news = News::get();
        return view('news.index', [
            'news' => $news,
        ]);
    }
}
