import Vue from 'vue'
import VueRouter, { RouteConfig } from 'vue-router'


import Home from '../components/Home.vue'
import Login from '../components/users/Login.vue'
import Register from '../components/users/Register.vue'
import UploadFile from '../components/users/UploadFile.vue'
import ProductList from '../components/users/ProductList.vue'
import Logout from '../components/users/Logout'

Vue.use(VueRouter)

const routes: Array<RouteConfig> = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/register',
    name: 'Register',
    component: Register
  },
  {
    path: '/upload-file',
    name: 'UploadFile',
    component: UploadFile
  },
  {
    path: '/products',
    name: 'ProductList',
    component: ProductList
  },
  {
    path: '/logout',
    name: 'Logout',
    component: Logout
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
