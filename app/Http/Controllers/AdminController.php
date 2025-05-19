<?php

namespace App\Http\Controllers;

use App\Modules\News\Services\NewsAdminService;
use App\Modules\User\Services\GetUserService;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class AdminController extends Controller
{
    public function dashboard(NewsAdminService $newsService, GetUserService $getUserService): View|Application
    {
        $usersPresent = $getUserService->run();

        $confirmedUsers = $usersPresent->getUserIsConfirmedTrue();
        $unconfirmedUsers = $usersPresent->getUserIsConfirmedFalse();
        $confirmationCodes = $newsService->getLatest();

        return view('admin.dashboard', compact('confirmedUsers', 'unconfirmedUsers', 'confirmationCodes'));
    }

    public function news(NewsAdminService $newsService): View|Application
    {
        $news = $newsService->getLatest();

        return view('admin.news', compact('news'));
    }

    public function show(int $id, NewsAdminService $newsService): View|Application
    {
        $newsItem = $newsService->find($id);

        return view('admin.news_show', compact('newsItem'));
    }
}
