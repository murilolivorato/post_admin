import Login from 'layouts/Login'
import AdminLogin from 'pages/AdminLogin'
import ForgotPassword from 'pages/ForgotPassword'
import RecoverPassword from 'pages/RecoverPassword'

const web = [
  // ADMIN LOGIN
  {
    path: '/acesso-admin',
    component: Login,
    children: [{ path: '', component: AdminLogin, name: 'AdminLogin', meta: { template: 'login' } }]
  },
  // FORGOT PASSWORD
  {
    path: '/esqueceu-a-senha',
    component: Login,
    children: [{ path: '', component: ForgotPassword, name: 'ForgotPassword', meta: { template: 'login' } }]
  },

  // RECOVER PASSWORD
  {
    path: '/recuperar-senha/:token',
    component: Login,
    children: [{ path: '', component: RecoverPassword, name: 'RecoverPassword', meta: { template: 'login' } }]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '*',
    component: () => import('pages/Error404.vue')
  }
]
export default web
