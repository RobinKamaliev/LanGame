<?php

declare(strict_types=1);

namespace App\Http\Requests\News;

use App\Modules\News\Dto\SearchNewsDto;
use Illuminate\Foundation\Http\FormRequest;

final class NewsSearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'query' => 'required|string',
        ];
    }

    public function toDto(): SearchNewsDto
    {
        return (new SearchNewsDto())
            ->setQuery($this->input('query'));
    }
}
