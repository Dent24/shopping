import Home from '../component/manage/home.vue'
import Login from '../component/manage/login.vue'

export default [
    {
        path: '/manage',
        name: 'manage',
        children: [
            {
                path: '',
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