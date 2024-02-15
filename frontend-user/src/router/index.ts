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
        // 投稿関連
        {
          path: '/post/register',
          name: 'PostRegister',
          meta: {
            title: '新規投稿',
            group: 'Post',
          },
          component: () => import('@/views/pages/Post/Register.vue'),
        },
        {
          path: '/post/edit',
          name: 'PostEditor',
          meta: {
            title: '投稿編集',
            group: 'Post',
          },
          component: () => import('@/views/pages/Post/Editor.vue'),
        },
        // 検索
        {
          path: '/search',
          name: 'Search',
          meta: {
            title: '検索',
            group: 'Search',
          },
          component: () => import('@/views/pages/Search.vue'),
        },
        // ユーザ毎の投稿一覧ページ
        {
          path: '/username',
          name: 'UserPage',
          meta: {
            title: 'username',
            group: 'Account',
          },
          component: () => import('@/views/pages/Account/List.vue'),
        },
        // dashboard
      ],
    },
  ]
})

export default router