@extends('layouts.app')

@section('content')
    <h1>{{ $newsItem->title }}</h1>
    <div>{!! nl2br(e($newsItem->content)) !!}</div>
@endsection
