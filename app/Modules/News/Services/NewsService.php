<?php

declare(strict_types=1);

namespace App\Modules\News\Services;

use App\Modules\News\Dto\SearchNewsDto;
use App\Modules\News\Repositories\NewsRepositoryInterface;
use Illuminate\Support\Collection;

final readonly class NewsService
{
    private const PAGINATE_GET_NEWS = 10;
    private const TAKE = 10;

    public function __construct(private NewsRepositoryInterface $newsRepository)
    {
    }

    public function getNews(): Collection
    {
        return $this->newsRepository->getLatest(self::PAGINATE_GET_NEWS);
    }

    public function search(SearchNewsDto $dto): Collection
    {
        return $this->newsRepository->search($dto->getQuery(), self::TAKE);
    }
}
