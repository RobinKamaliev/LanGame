<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LanGame Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">LanGame</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Панель управления</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.news') }}">Новости</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item">
                        <span class="nav-link">Привет, {{ auth()->user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-outline-light">Выйти</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

<div id="ws-messages" style="
    position: fixed;
    top: 10px;
    right: 10px;
    background: rgba(0,0,0,0.7);
    color: #fff;
    padding: 10px 15px;
    border-radius: 5px;
    font-family: monospace;
    z-index: 9999;
    display: none;
    max-width: 300px;
    word-wrap: break-word;
"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const ws = new WebSocket('ws://127.0.0.1:6001/app/local?protocol=7&client=js&version=5.0.3&flash=false');
    const msgBox = document.getElementById('ws-messages');
    let timeoutId;

    function showMessage(text) {
        msgBox.textContent = text;
        msgBox.style.display = 'block';
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => {
            msgBox.style.display = 'none';
        }, 5000);
    }

    ws.onopen = () => {
        console.log('WebSocket соединение открыто');
        showMessage('Соединение открыто');
        ws.send(JSON.stringify({ event: 'start', data: 'Hello server' }));
    };

    ws.onmessage = (event) => {
        const message = JSON.parse(event.data);
        console.log('Сообщение от WS:', message);

        if (message.event === 'pusher:connection_established') {
            const data = JSON.parse(message.data);
            showMessage(`Подключение установлено, socket_id: ${data.socket_id}`);

            ws.send(JSON.stringify({
                event: 'pusher:subscribe',
                data: { channel: 'notifications' }
            }));
        }

        if (
            message.event === 'user.registered' &&
            message.channel === 'notifications'
        ) {
            showMessage(`Зарегистрировался новый пользователь`);
        }
    };

    ws.onclose = () => {
        console.log('WebSocket соединение закрыто');
        showMessage('Соединение закрыто');
    };

    ws.onerror = (error) => {
        console.error('Ошибка WebSocket:', error);
        showMessage('Ошибка WebSocket');
    };
</script>

@yield('scripts') {{-- подключаем доп. скрипты --}}
</body>
</html>
