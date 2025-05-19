<?php

declare(strict_types=1);

namespace App\Modules\News\Repositories;

use App\Modules\News\Models\News;
use Illuminate\Support\Collection;

interface NewsRepositoryInterface
{
    public function getLatest(int $paginate): Collection;
    public function find(int $id): News;
    public function search(string $query, int $take): Collection;
    public function updateOrCreate(array $item): void;
}
