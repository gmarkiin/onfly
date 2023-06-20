const routes = [
  {
    path: '/',
    component: () => import('layouts/LoginLayout.vue'),
    children: [
      { path: 'login', name: 'login', component: () => import('pages/LoginPage.vue') },
      { path: '/', name: 'register', component: () => import('pages/RegisterPage.vue') }
    ]
  },
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: 'index', name: 'index', component: () => import('pages/ExpensesPage.vue') },
      { path: 'form-expenses/:id?', name: 'form-expenses', component: () => import('pages/FormExpenses.vue') }
      // { path: '', component: () => import('pages/ExpensesPage.vue') }
    ]
  },
  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]
export default routes
