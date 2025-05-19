@extends('layouts.app')

@section('content')
    <h1>Новости</h1>
    <table border="1" cellpadding="5" style="width: 100%;">
        <thead>
        <tr>
            <th>ID</th>
            <th>Заголовок</th>
            <th>Источник</th>
            <th>Дата публикации</th>
        </tr>
        </thead>
        <tbody>
        @foreach($news as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>
                    <a href="{{ route('admin.news.show', $item->id) }}">
                        {{ $item->title }}
                    </a>
                </td>
                <td>{{ $item->source }}</td>
                <td>{{ $item->published_at->format('d.m.Y H:i') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $news->links() }}
@endsection
