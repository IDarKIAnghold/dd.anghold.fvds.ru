import "../css/app.css";
import "../sass/app.scss";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import { createPinia } from "pinia";
import PrimeVue from "primevue/config";

import NProgress from "nprogress";
import { InertiaProgress } from "@inertiajs/progress";
import "nprogress/nprogress.css";

import Footer from "./Pages/Partials/Footer.vue";
import Nav from "./Pages/Partials/Navigation.vue";

const pinia = createPinia();
const appName = import.meta.env.VITE_APP_NAME || "Guitar World";

// Initialize Inertia progress with NProgress
InertiaProgress.init({
  color: "#4B5563",
  showSpinner: true,
});

createInertiaApp({
  title: (title) => `${title}`,
  resolve: (name) =>
    resolvePageComponent(
      `./Pages/${name}.vue`,
      import.meta.glob("./Pages/**/*.vue")
    ),
  setup({ el, App, props, plugin }) {
    const mainEl = document.getElementById("main");
    const app = createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(pinia)
      .use(ZiggyVue)
      .use(PrimeVue)
      .mount(mainEl);

    const navigationEl = document.getElementById("navigation");
    createApp(Nav)
      .use(plugin)
      .use(pinia)
      .use(ZiggyVue)
      .use(PrimeVue)
      .mount(navigationEl);

    const footerEl = document.getElementById("footer");
    createApp(Footer)
      .use(plugin)
      .use(pinia)
      .use(ZiggyVue)
      .use(PrimeVue)
      .mount(footerEl);

    // Event listeners for Inertia navigation to control NProgress
    document.addEventListener("inertia:start", () => {
      NProgress.start();
    });
    document.addEventListener("inertia:finish", (event) => {
      if (
        event.detail.visit.completed ||
        event.detail.visit.interrupted ||
        event.detail.visit.cancelled
      ) {
        NProgress.done();
      }
    });
  },
  progress: {
    color: "#4B5563",
  },
});
