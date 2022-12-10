import { createApp } from 'vue'
import { createWebHistory, createRouter } from 'vue-router'
import main from './component/main.vue'
import manage from './route/manage'
import customer from './route/customer'
import Login from './component/Login.vue'

import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import '@mdi/font/css/materialdesignicons.css'

const vuetify = createVuetify({
    components,
    directives,
    icons: {
        defaultSet: 'mdi'
    }
})

const routes = [
    ...manage,
    ...customer,
    {
        path: '/login',
        name: 'login',
        component: Login
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

createApp(main).use(router).use(vuetify).mount('#app')