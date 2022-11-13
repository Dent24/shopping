import { createApp } from 'vue'
import { createWebHistory, createRouter } from 'vue-router'
import { Button, Form, Field, CellGroup, Tag, Row, Col, Dialog, Switch, Overlay, Loading } from 'vant';
import 'vant/lib/index.css';
import main from './component/main.vue'
import manage from './route/manage'
import customer from './route/customer'

const routes = [
    ...manage,
    ...customer
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

createApp(main).use(router).use(Button).use(Form).use(Field).use(CellGroup).use(Tag).use(Row).use(Col).use(Switch).use(Dialog).use(Overlay).use(Loading).mount('#app')