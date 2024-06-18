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

const pinia = createPinia();
const appName = import.meta.env.VITE_APP_NAME || "Guitar World";

// Initialize Inertia progress with NProgress
InertiaProgress.init({
  color: "#4B5563",
  showSpinner: true,
});

// Function to determine if the user is on a mobile device
function isMobileDevice() {
  return window.innerWidth < 768;
}

const mobilePages = import.meta.glob("./Pages/mobile/**/*.vue");
const desktopPages = import.meta.glob("./Pages/desktop/**/*.vue");

const FooterAndNav = isMobileDevice() ? "mobile" : "desktop";

const components = {
  mobile: {
    Footer: () => import("./Pages/mobile/Partials/Footer.vue"),
    Navigation: () => import("./Pages/mobile/Partials/Navigation.vue"),
  },
  desktop: {
    Footer: () => import("./Pages/desktop/Partials/Footer.vue"),
    Navigation: () => import("./Pages/desktop/Partials/Navigation.vue"),
  },
};

createInertiaApp({
  title: (title) => `${title}`,
  resolve: (name) => {
    const pages = isMobileDevice() ? mobilePages : desktopPages;
    return resolvePageComponent(
      `./Pages/${isMobileDevice() ? "mobile" : "desktop"}/${name}.vue`,
      pages
    );
  },
  setup({ el, App, props, plugin }) {
    const mainEl = document.getElementById("main");

    const { Footer, Navigation } = components[FooterAndNav];

    Footer().then((FooterComponent) => {
      const footerEl = document.getElementById("footer");
      createApp(FooterComponent.default)
        .use(plugin)
        .use(pinia)
        .use(ZiggyVue)
        .use(PrimeVue)
        .mount(footerEl);
    });

    Navigation().then((NavComponent) => {
      const navigationEl = document.getElementById("navigation");
      createApp(NavComponent.default)
        .use(plugin)
        .use(pinia)
        .use(ZiggyVue)
        .use(PrimeVue)
        .mount(navigationEl);
    });

    const app = createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(pinia)
      .use(ZiggyVue)
      .use(PrimeVue)
      .mount(mainEl);

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
