import { createApp } from 'vue'
import { createWebHistory, createRouter } from 'vue-router'
import main from './component/main.vue'
import manage from './route/manage'
import customer from './route/customer'
import Login from './component/login.vue'
import Register from './component/register.vue'

import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import '@mdi/font/css/materialdesignicons.css'

import store from './store'

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
    },
    {
        path: '/register',
        name: 'register',
        component: Register
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

createApp(main).use(store).use(router).use(vuetify).mount('#app')