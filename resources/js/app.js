require('./bootstrap');

import { createApp, h } from 'vue'
import { app, plugin } from '@inertiajs/inertia-vue3'

const el = document.getElementById('app')

createApp({
  render: () => h(app, {
    initialPage: JSON.parse(el.dataset.page),
    resolveComponent: name => import(`./pages/${name}`).then(module => module.default),
  })
}).use(plugin).mount(el)
