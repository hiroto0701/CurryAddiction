import { h, resolveComponent } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import { useAccountStore } from '@/stores/account';
import { useCommonStore } from '@/stores/common';

const routes = [
  {
    path: '/',
    component: () => import('@/views/templates/pages/UnAuthenticatedLayout.vue'),
    children: [
      {
        path: '',
        name: 'Welcome',
        meta: {
          title: '',
          disableScroll: true
        },
        component: () => import('@/views/pages/Welcome.vue')
      }
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
        component: () => import('@/views/pages/Signup.vue')
      }
    ]
  },
  {
    path: '/privacy-policy',
    component: () => import('@/views/templates/pages/UnAuthenticatedLayout.vue'),
    children: [
      {
        path: '',
        name: 'PrivacyPolicy',
        meta: {
          title: 'プライバシーポリシー'
        },
        component: () => import('@/views/pages/PrivacyPolicy.vue')
      }
    ]
  },
  {
    path: '/',
    component: () => import('@/views/templates/pages/AuthenticatedLayout.vue'),
    children: [
      {
        path: '',
        component: () => import('@/views/templates/pages/DefaultLayout.vue'),
        meta: { requiresAuth: true },
        children: [
          {
            path: '/home',
            name: 'Home',
            meta: {
              title: 'HOME',
              group: 'Home'
            },
            component: () => import('@/views/pages/Home.vue')
          },
          // 投稿関連
          {
            path: 'post',
            name: 'Post',
            redirect: { name: 'Home' },
            children: [
              {
                path: 'new',
                name: 'PostCreate',
                meta: {
                  title: '新規投稿',
                  group: 'Post'
                },
                component: () => import('@/views/pages/Post/Create.vue')
              },
              {
                path: 'view/:slug',
                name: 'PostViewer',
                meta: {
                  title: '投稿詳細',
                  group: 'Post'
                },
                component: () => import('@/views/pages/Post/Viewer.vue')
              }
            ]
          },
          // 検索
          {
            path: 'search',
            name: 'Search',
            meta: {
              title: '検索',
              group: 'Search'
            },
            component: () => import('@/views/pages/Search.vue')
          },
          // ユーザ毎の投稿一覧ページ
          {
            path: ':username?',
            name: 'UserPage',
            meta: {
              title: 'ユーザーページ',
              group: 'Account'
            },
            component: () => import('@/views/pages/Account/Profile.vue')
          },
          // error
          {
            path: '/:pathMatch(.*)*',
            name: 'ErrorNotFound',
            meta: {
              title: 'ページを表示できません'
            },
            component: () => import('@/views/pages/Error/NotFound.vue')
          }
        ]
      },
      // dashboard
      {
        path: '/dashboard',
        component: () => import('@/views/templates/pages/DashboardLayout.vue'),
        meta: { requiresAuth: true },
        children: [
          {
            path: '',
            name: 'Dashboard',
            redirect: { name: 'PostDashboard' },
            children: [
              {
                path: 'analytics',
                name: 'PostDashboard',
                meta: {
                  title: '投稿ダッシュボード',
                  group: 'Dashboard'
                },
                component: () => import('@/views/pages/Dashboard/Analytics/List.vue')
              },
              {
                path: 'liked',
                name: 'LikedPostDashboard',
                meta: {
                  title: 'いいねした投稿',
                  group: 'Dashboard'
                },
                component: () => import('@/views/pages/Dashboard/Like/List.vue')
              },
              {
                path: 'archived',
                name: 'ArchivedPostDashboard',
                meta: {
                  title: '保存した投稿',
                  group: 'Dashboard'
                },
                component: () => import('@/views/pages/Dashboard/Archive/List.vue')
              },
              {
                path: 'trash',
                name: 'TrashDashboard',
                meta: {
                  title: 'ごみ箱',
                  group: 'Dashboard'
                },
                component: () => import('@/views/pages/Dashboard/Trash/List.vue')
              },
              {
                path: 'setting',
                name: 'Setting',
                meta: {
                  title: '設定',
                  group: 'Dashboard'
                },
                component: () => import('@/views/pages/Dashboard/Setting/Setting.vue')
              }
            ]
          }
        ]
      }
    ]
  }
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
  scrollBehavior(to, from) {
    if (from.meta.disableScroll) {
      return false;
    }

    // ページ遷移のタイミングで一律最上部にスクロール
    return { top: 0 };
  }
});

router.beforeEach(async (to, from, next) => {
  const accountStore = useAccountStore();
  const commonStore = useCommonStore();

  if (to.name === 'UserPage' && to.params.username) {
    to.meta.title = to.params.username;
  }
  document.title = (to.meta.title ? to.meta.title + ' | ' : '') + 'Curry Addiction';

  // signupページへのダイレクトアクセス制限
  if (to.name === 'Signup' && !accountStore.state.isNewRegistration) {
    return next({ name: 'Welcome' });
  }

  // 認証が必要なページへのアクセス制限
  if (to.matched.some((record) => record.meta.requiresAuth)) {
    // リファラの設定
    commonStore.setOriginalRoute(from);

    // リロード時ユーザー情報取得を待つ
    if (accountStore.isLoadingUserData) {
      await accountStore.fetchUserData();
    }

    return accountStore.isAuthenticated ? next() : next({ name: 'Welcome' });
  }

  // ルートが見つからない場合の処理
  if (to.matched.length === 0) {
    next({ name: 'NotFound' });
    return;
  }

  next();
});

export default router;
