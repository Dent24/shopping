import Home from '../component/manage/home.vue'
import Login from '../component/manage/login.vue'

export default [
    {
        path: '/manage',
        children: [
            {
                path: '',
                name: 'manage',
                component: Home
            },
            {
                path: 'login',
                name: 'manage.login',
                component: Login
            }
        ]
    }
]