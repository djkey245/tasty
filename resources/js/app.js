require('./bootstrap');
import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':8443'
});
