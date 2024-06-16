import { createSSRApp, h } from "vue";
import { renderToString } from "@vue/server-renderer";
import { createInertiaApp } from "@inertiajs/vue3";
import createServer from "@inertiajs/vue3/server";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import { createPinia } from "pinia";

const pinia = createPinia();
const appName = import.meta.env.VITE_APP_NAME || 'Guitar World';

createServer((page) =>
    createInertiaApp({
        page,
        render: renderToString,
        title: (title) => `${title}`,
        resolve: (name) =>
            resolvePageComponent(
                `./Pages/${name}.vue`,
                import.meta.glob("./Pages/**/*.vue")
            ),
        setup({ App, props, plugin }) {
            return createSSRApp({ render: () => h("#main", props) })
                .use(plugin)
                .use(pinia)
                .use(ZiggyVue, {
                    ...page.props.ziggy,
                    location: new URL(page.props.ziggy.location),
                });
        },
    })
);
