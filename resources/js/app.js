import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp,Head,Link } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .component('Link',Link)
            .component('Head',Head)
            .mount(el);
    },
    progress: {
    // The color of the progress bar...
    color: '#29d',
    // Whether the NProgress spinner will be shown...
    showSpinner: true,
    },
});
