<?php

declare(strict_types=1);

namespace App\Modules\News\Dto;

final class SearchNewsDto
{
    private string $query;

    public function getQuery(): string
    {
        return $this->query;
    }

    public function setQuery(string $query): self
    {
        $this->query = $query;
        return $this;
    }
}
