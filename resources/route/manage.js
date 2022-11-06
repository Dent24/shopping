import ManageMain from '../component/manage/main.vue'
import Home from '../component/manage/home.vue'
import Login from '../component/manage/login.vue'

export default [
    {
        path: '/manage',
        name: 'manage',
        component: ManageMain,
        children: [
            {
                path: '',
                component: Home
            },
            {
                path: 'login',
                name: 'manage-login',
                component: Login
            }
        ]
    }
]