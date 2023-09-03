<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NewsAdded;
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
        $channels = $request->user()->channels->pluck('slug')->toArray();
        $news = News::getSubscribed($cahannelsIds);
        return view('news.index', [
            'news' => $news,
            'channels' => $channels
        ]);
    }

    /**
     * Metoda api do zapisu wiadomości
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function addNews(Request $request)
    {
        try 
        {
            $news = News::create($request->all());
            event(new NewsAdded($news));
        }
        catch (\Throwable $e) 
        {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
        return response()->json(['success' => true, 'message' => __('Wiadomość została zapisana poprawnie')]);
    }
}
