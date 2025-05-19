<?php

declare(strict_types=1);

namespace App\Modules\News\Repositories;

use App\Modules\News\Models\News;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

final class EloquentNewsRepository implements NewsRepositoryInterface
{
    public function getLatest(int $paginate): Collection
    {
        return News::query()->latest()->paginate($paginate)->collect();
    }

    public function find(int $id): News
    {
        return News::query()->findOrFail($id);
    }

    public function search(string $query, int $take): Collection
    {
        return News::query()
            ->where(static fn($q): Builder => $q
                ->where('title', 'like', '%' . $query . '%')
                ->orWhere('content', 'like', '%' . $query . '%'))
            ->latest()
            ->take($take)
            ->get();
    }

    public function updateOrCreate(array $item): void
    {
        try {
            News::query()->updateOrCreate(
                ['title' => $item['title']],
                [
                    'summary' => $item['url'] ?? '',
                    'content' => $item['url'] ?? '',
                    'source' => 'HackerNews',
                    'published_at' => now(),
                ]
            );
        } catch (\Exception $exception) {
            Log::error("Ошибка сохранения новостей с парсинга", [
                'item' => $item,
                'exception' => $exception
            ]);
        }
    }
}
