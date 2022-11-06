import { createApp } from 'vue'
import { createWebHistory, createRouter } from "vue-router"
import main from './component/main.vue'
import Manage from './component/manage/main.vue'
import Customer from './component/customer/main.vue'

const routes = [
    {
        path: "/manage",
        name: "Manage",
        component: Manage
    },
    {
        path: "/customer",
        name: "Customer",
        component: Customer
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

createApp(main).use(router).mount('#app')