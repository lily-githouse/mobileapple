import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store'


Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'index',
        component: () => import('../views/content/Index.vue'),
        meta: {title: '苹果生鲜系统首页'},
    },
    {
        path: '/list1',
        name: 'list1',
        component: () => import('../views/content/List1.vue'),
        meta: {title: '优选水果分类页'},
    },
    {
        path: '/detail',
        name: 'detail',
        component: () => import('../views/content/Detail.vue'),
        meta: {title: '优选水果详情页'},
    },
    {
        path: '/category',
        name: 'category',
        component: () => import('../views/content/Category.vue'),
        meta: {title: '苹果生鲜系统分类页'}
    },
    {
        path: '/cart',
        name: 'cart',
        component: () => import('../views/shop/Cart.vue'),
        meta: {title: '苹果生鲜系统购物车', auth: true}
    },
    {
        path: '/orders',
        name: 'orders',
        component: () => import('../views/shop/Orders.vue'),
        meta: {title: '苹果生鲜系统订单页', auth: true}
    },
    {
        path: '/pay',
        name: 'pay',
        component: () => import('../views/shop/Pay.vue'),
        meta: {title: '苹果生鲜系统支付页', auth: true}
    },
    {
        path: '/login',
        name: 'login',
        component: () => import ('../views/info/Login.vue'),
        meta: {title: '苹果生鲜系统用户登录'}
    },
    {
        path: '/register',
        name: 'register',
        component: () => import ('../views/info/Register.vue'),
        meta: {title: '苹果生鲜系统用户注册'}
    },
    {
        path: '/demo1',
        name: 'demo1',
        component: () => import ('../views/demo/demo1.vue'),
        meta: {title: 'Vuex-demo1'}
    },
    {
        path: '/demo2',
        name: 'demo2',
        component: () => import ('../views/demo/demo2.vue'),
        meta: {title: 'Vuex-demo2'}
    },
    {
        path: '/self',
        name: 'self',
        component: () => import ('../views/info/self.vue'),
        meta: {title: '个人中心', auth: true}
    }
]

const router = new VueRouter({
    routes
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title || '苹果生鲜系统';
    if (to.meta.auth) {
        if (store.state.token.trim()) {
            next()
        } else {
            next({name: 'login', query: {redirect: to.name}})
        }
    } else {
        next();
    }
})


export default router
