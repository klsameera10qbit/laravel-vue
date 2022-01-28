import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home';
import About from '../pages/About';
import Register from '../pages/Register';
import Login from '../pages/Login';
import Dashboard from '../pages/Dashboard';

import products from '../components/Products';
import Addproduct from '../components/AddProduct';
import Editproduct from '../components/EditProduct';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'about',
        path: '/about',
        component: About
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'products',
        path: '/products',
        component: products
    },
    {
        name: 'addproduct',
        path: '/products/add',
        component: Addproduct
    },
    {
        name: 'editproduct',
        path: '/products/edit/:id',
        component: Editproduct
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
