// resources/js/app.js
import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
// import axios from 'axios';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

// Setup Axios globally
// axios.defaults.baseURL = 'http://127.0.0.1:8000';  // Set your base URL for API requests
// axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// axios.defaults.headers.common['Accept'] = 'application/json';

// Optional: Add Bearer token if available
// if (localStorage.getItem('auth_token')) {
//     axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('auth_token')}`;
// }

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
