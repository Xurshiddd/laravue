import './bootstrap';
import '../css/app.css'
import { createApp, h} from 'vue'
import {createInertiaApp, Head, Link} from '@inertiajs/vue3'
import {ZiggyVue} from "../../vendor/tightenco/ziggy"
import Layout from "@/Layouts/Layout.vue";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";

createInertiaApp({
    title: (title) => `My app ${title}`,
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        let page = pages[`./Pages/${name}.vue`]
        page.default.layout = page.default.layout ? page.default.layout : Layout
        return page
    },
    progress: {
        color: '#fff',
        includeCSS: true,
        showSpinner: true

    },
    setup({ el, App, props, plugin }) {
        createApp({render: () => h(App, props)})
            .use(plugin)
            .use(ZiggyVue)
            .component('Head', Head)
            .component('Link', Link)
            .component('font-awesome-icon', FontAwesomeIcon)
            .mount(el);
    },
})
