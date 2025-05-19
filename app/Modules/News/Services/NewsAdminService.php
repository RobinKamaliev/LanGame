<?php

declare(strict_types=1);

namespace App\Modules\News\Services;

use App\Modules\News\Models\News;
use App\Modules\News\Repositories\NewsRepositoryInterface;
use Illuminate\Support\Collection;

final readonly class NewsAdminService
{
    private const PAGINATE_GET_NEWS = 20;

    public function __construct(private NewsRepositoryInterface $newsRepository)
    {
    }

    public function getLatest(): Collection
    {
        return $this->newsRepository->getLatest(self::PAGINATE_GET_NEWS);
    }

    public function find(int $id): News
    {
        return $this->newsRepository->find($id);
    }
}
