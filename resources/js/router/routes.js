const routes = [
    {
        path: '/',
        component: () => import('pages/Home.vue'),
        name: 'home'
    },
    {
        path: '/client/list',
        component: () => import('pages/ClientList.vue'),
        name: 'client-list'
    },
    {
        path: '/project/list',
        component: () => import('pages/ProjectList.vue'),
        name: 'project-list'
    },
    {
        path: '/login',
        component: () => import('pages/Login.vue'),
        meta: {
            notAuthenticated: true, layout: "Login"
        },
        name: 'login'
    },
]

export default routes;