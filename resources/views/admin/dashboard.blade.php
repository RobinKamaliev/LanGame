@extends('layouts.app')

@section('content')
    <h1>Панель управления</h1>

    <h2>Подтверждённые пользователи</h2>
    <table border="1" cellpadding="5">
        <thead>
        <tr><th>ID</th><th>Имя</th><th>Email</th><th>Дата регистрации</th></tr>
        </thead>
        <tbody>
        @foreach($confirmedUsers as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('d.m.Y H:i') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $confirmedUsers->links() }}

    <h2>Неподтверждённые пользователи</h2>
    <table border="1" cellpadding="5">
        <thead>
        <tr><th>ID</th><th>Имя</th><th>Email</th><th>Дата регистрации</th></tr>
        </thead>
        <tbody>
        @foreach($unconfirmedUsers as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('d.m.Y H:i') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $unconfirmedUsers->links() }}

    <h2>Коды подтверждения</h2>
    <table border="1" cellpadding="5">
        <thead>
        <tr><th>ID</th><th>User ID</th><th>Код</th><th>Использован</th><th>Отправлен</th></tr>
        </thead>
        <tbody>
        @foreach($confirmationCodes as $code)
            <tr>
                <td>{{ $code->id }}</td>
                <td>{{ $code->user_id }}</td>
                <td>{{ $code->code }}</td>
                <td>{{ $code->is_used ? 'Да' : 'Нет' }}</td>
                <td>{{ optional($code->sent_at)->format('d.m.Y H:i') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $confirmationCodes->links() }}

@endsection
