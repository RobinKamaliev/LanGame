import axios from 'axios';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import Reverb from '@reverb-js/client';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Pusher = Pusher;


window.Reverb = Reverb;

window.Echo = new Echo({
    broadcaster: 'reverb',
    client: new Reverb({
        host: import.meta.env.VITE_REVERB_HOST || '127.0.0.1',
        port: import.meta.env.VITE_REVERB_PORT || 6001,
        secure: false,
    }),
});

window.Echo.channel('notifications')
    .listen('.user.registered', e => {
        alert(`Новый пользователь зарегистрировался: ${e.username}`);
    })
    .listen('.user.loggedin', e => {
        alert(`Пользователь авторизовался: ${e.username}`);
    })
    .listen('.portal.newdata', e => {
        alert(`Новые данные: ${e.data}`);
    });

