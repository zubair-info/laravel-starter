import '../css/app.css';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { route } from 'ziggy-js';
import type { DefineComponent } from 'vue';
import { usePage } from '@inertiajs/vue3';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: title => title ? `${title} - ${appName}` : appName,
    resolve: name =>
        resolvePageComponent(
            `./pages/${name}.vue`,
            import.meta.glob<DefineComponent>('./pages/**/*.vue')
        ),
    setup({ el, App, props, plugin }) {
        const vueApp = createApp({ render: () => h(App, props) });

        // Make route() available globally
        vueApp.config.globalProperties.$route = route;

        // 🌟 Global Role & Permission helpers
        vueApp.config.globalProperties.$hasRole = (role: string): boolean => {
            const user = (usePage().props.auth as any)?.user;
            return user?.roles?.includes(role);
        };

        vueApp.config.globalProperties.$hasAnyRole = (roles: string[]): boolean => {
            const user = (usePage().props.auth as any)?.user;
            return roles.some(r => user?.roles?.includes(r));
        };

        vueApp.config.globalProperties.$hasPermission = (permission: string): boolean => {
            const user = (usePage().props.auth as any)?.user;
            return user?.permissions?.includes(permission);
        };

        vueApp.use(plugin).mount(el);
    },
});
