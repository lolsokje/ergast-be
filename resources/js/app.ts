import 'bootstrap';
import {h} from 'vue';
import Default from "./Layouts/Default.vue";
import {Link} from '@inertiajs/inertia-vue3';

const {createInertiaApp} = require('@inertiajs/inertia-vue3');
const {createApp} = require('vue');

createInertiaApp({
    resolve: (name: string) => {
        let page = require(`./Pages/${name}`).default;

        page.layout = Default;

        return page;
    },
    // @ts-ignore
    setup({el, App, props, plugin}) {
        createApp({render: () => h(App, props)})
            .use(plugin)
            .component('InertiaLink', Link)
            .mount(el);
    },
});
