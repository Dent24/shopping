import Home from '../component/manage/home.vue'

export default [
    {
        path: '/manage',
        children: [
            {
                path: '',
                name: 'manage',
                component: Home
            }
        ]
    }
]