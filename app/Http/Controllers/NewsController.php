<?php

namespace App\Http\Controllers;

use App\Http\Requests\News\NewsSearchRequest;
use App\Modules\News\Services\NewsService;
use App\Services\Parser;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class NewsController extends Controller
{
    public function index(NewsService $newsService): View|Application
    {
        $latestNews = $newsService->getNews();

        return view('news.index', compact('latestNews'));
    }

    public function search(NewsSearchRequest $request, NewsService $newsService): JsonResponse
    {
        $results = $newsService->search($request->toDto());

        return response()->json($results);
    }

    public function parser(Parser $parser): JsonResponse
    {
        $parser->parse();

        return response()->json(['success' => true]);
    }
}
