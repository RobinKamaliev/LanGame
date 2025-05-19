<?php

namespace App\Services;

use App\Modules\News\Repositories\NewsRepositoryInterface;
use Illuminate\Support\Facades\Http;

readonly class Parser
{
    private const URL_ALGOLIA = 'https://hn.algolia.com/api/v1/search_by_date?tags=story';

    public function __construct(private NewsRepositoryInterface $newsRepository)
    {
    }

    public function parse(): void
    {
        $response = Http::get(self::URL_ALGOLIA);

        if ($response->successful()) {
            foreach ($response->json('hits') as $item) {
                $this->newsRepository->updateOrCreate($item);
            }
        }
    }
}
