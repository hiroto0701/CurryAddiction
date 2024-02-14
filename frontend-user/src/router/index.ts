import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  scrollBehavior() {
    // ページ遷移のタイミングで一律最上部にスクロール
    return { top: 0 };
  },
  routes: [
    {
      path: '/',
      component: () => import('@/views/templates/pages/DefaultLayout.vue'),
      children: [
        {
          path: '/',
          name: 'UserHome',
          meta: {
            title: 'HOME',
            group: 'Home',
          },
          component: () => import('@/views/pages/UserHome.vue'),
        },
      ],
    },
  ]
})

export default router