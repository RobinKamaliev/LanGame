@extends('layouts.app')

@section('content')
    <h1>Поиск новостей</h1>

    <input type="text" id="search" placeholder="Поиск по заголовку или содержанию" style="width: 100%; padding: 8px; margin-bottom: 20px;">

    <div id="results">
        <h2>Последние новости</h2>
        <ul>
            @foreach($latestNews as $news)
                <li>
                    <strong>{{ $news->title }}</strong><br>
                    <small>{{ $news->published_at->format('d.m.Y H:i') }}</small><br>
                    {{ \Illuminate\Support\Str::limit($news->content, 100) }}
                </li>
            @endforeach
        </ul>
    </div>
@endsection

@section('scripts')
    <script>
        const searchInput = document.getElementById('search');
        const resultsDiv = document.getElementById('results');

        let timeout = null;

        searchInput.addEventListener('input', function () {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                const query = searchInput.value.trim();

                if (query === '') {
                    location.reload(); // или вернуть к 10 последним
                    return;
                }

                fetch(`/news/search?query=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        let html = '<h2>Результаты поиска</h2><ul>';

                        if (data.length === 0) {
                            html += '<li>Ничего не найдено</li>';
                        } else {
                            data.forEach(news => {
                                html += `
                                <li>
                                    <strong>${news.title}</strong><br>
                                    <small>${new Date(news.published_at).toLocaleString()}</small><br>
                                    ${news.content.slice(0, 100)}...
                                </li>
                            `;
                            });
                        }

                        html += '</ul>';
                        resultsDiv.innerHTML = html;
                    });
            }, 300); // задержка ввода (debounce)
        });
    </script>
@endsection
