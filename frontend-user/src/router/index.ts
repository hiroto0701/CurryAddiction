import { h, resolveComponent } from 'vue';
import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  scrollBehavior() {
    // ページ遷移のタイミングで一律最上部にスクロール
    return { top: 0 };
  },
  routes: [
    {
      path: '/login',
      component: () => import('@/views/templates/pages/UnAuthenticatedLayout.vue'),
      children: [
        {
          path: '',
          name: 'Login',
          meta: {
            title: 'ログイン'
          },
          component: () => import('@/views/pages/Login.vue'),
        },
      ]
    },
    {
      path: '/signup',
      component: () => import('@/views/templates/pages/UnAuthenticatedLayout.vue'),
      children: [
        {
          path: '',
          name: 'Signup',
          meta: {
            title: '新規登録'
          },
          component: () => import('@/views/pages/Signup.vue'),
        },
      ]
    },
    {
      path: '/',
      component: () => import('@/views/templates/pages/DefaultLayout.vue'),
      children: [
        {
          path: '/',
          name: 'Home',
          meta: {
            title: 'HOME',
            group: 'Home',
          },
          component: () => import('@/views/pages/Home.vue'),
        },
        // 投稿関連
        {
          path: 'post',
          name: 'Post',
          component: {
            render() {
              return h(resolveComponent('router-view'))
            }
          },
          children: [
            {
              path: 'new',
              name: 'PostCreate',
              meta: {
                title: '新規投稿',
                group: 'Post',
              },
              component: () => import('@/views/pages/Post/Create.vue'),
            },
            {
              path: 'view/:id',
              name: 'PostViewer',
              meta: {
                title: '投稿詳細',
                group: 'Post',
              },
              component: () => import('@/views/pages/Post/Viewer.vue')
            },
            {
              path: 'edit/:id',
              name: 'PostEditor',
              meta: {
                title: '投稿編集',
                group: 'Post',
              },
              component: () => import('@/views/pages/Post/Editor.vue'),
            },
          ]
        },
        // 検索
        {
          path: 'search',
          name: 'Search',
          meta: {
            title: '検索',
            group: 'Search',
          },
          component: () => import('@/views/pages/Search.vue'),
        },
        // ユーザ毎の投稿一覧ページ
        {
          path: 'username',
          name: 'UserPage',
          meta: {
            title: 'username',
            group: 'Account',
          },
          component: () => import('@/views/pages/Account/List.vue'),
        },
      ],
    },
    // dashboard
    {
      path: '/dashboard',
      component: () => import('@/views/templates/pages/DashboardLayout.vue'),
      children: [
         {
          path: '',
          name: 'Dashboard',
          children: [
            {
              path: 'post',
              name: 'PostDashboard',
              meta: {
                title: '投稿ダッシュボード',
                group: 'Dashboard',
              },
              component: () => import('@/views/pages/Dashboard/Post.vue')
            },
            {
              path: 'liked',
              name: 'LikedPostDashboard',
              meta: {
                title: 'いいねした投稿',
                group: 'Dashboard',
              },
              component: () => import('@/views/pages/Dashboard/LikedPost.vue')
            },
            {
              path: 'archived',
              name: 'ArchivedPostDashboard',
              meta: {
                title: '保存した投稿',
                group: 'Dashboard',
              },
              component: () => import('@/views/pages/Dashboard/ArchivedPost.vue')
            },
            {
              path: 'trash',
              name: 'TrashDashboard',
              meta: {
                title: 'ごみ箱',
                group: 'Dashboard',
              },
              component: () => import('@/views/pages/Dashboard/Trash.vue')
            },
            {
              path: 'settings',
              name: 'Settings',
              meta: {
                title: '設定',
                group: 'Dashboard',
              },
              component: () => import('@/views/pages/Dashboard/Setting.vue')
            },
          ]
        }
      ]
    },
  ]
})

export default router