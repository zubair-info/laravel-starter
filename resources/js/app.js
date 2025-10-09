import '../css/app.css'
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { route } from 'ziggy-js'
import { usePage } from '@inertiajs/vue3'
import { InertiaProgress } from '@inertiajs/progress'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

createInertiaApp({
    title: title => title ? `${title} - ${appName}` : appName,
    resolve: name =>
        resolvePageComponent(
            `./pages/${name}.vue`,
            import.meta.glob('./pages/**/*.vue')
        ),
    setup({ el, App, props, plugin }) {
        const vueApp = createApp({ render: () => h(App, props) })

        // global route
        vueApp.config.globalProperties.$route = route

        // auth helpers
        const user = usePage().props?.auth?.user || null
        vueApp.config.globalProperties.$hasRole = role => user?.roles?.includes(role)
        vueApp.config.globalProperties.$hasAnyRole = roles => roles.some(r => user?.roles?.includes(r))
        vueApp.config.globalProperties.$hasPermission = perm => user?.permissions?.includes(perm)

        vueApp.use(plugin).mount(el)
    },
})

InertiaProgress.init()
