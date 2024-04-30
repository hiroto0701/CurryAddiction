<script setup lang="ts">
  import { onMounted, ref } from 'vue'
  import { useRouter } from 'vue-router'
  import { Menu, MenuButton, MenuItems } from '@headlessui/vue'
  import MeatballMenuIcon from '@/views/atoms/icons/MeatballMenuIcon.vue'
  import DropDownMenuItem from '@/views/atoms/DropDownMenuItem.vue'
  import HomeIcon from '@/views/atoms/icons/HomeIcon.vue'
  import PlusIcon from '@/views/atoms/icons/PlusIcon.vue'
  import SearchIcon from '@/views/atoms/icons/SearchIcon.vue'
  import ProfileIcon from '@/views/atoms/icons/ProfileIcon.vue'
  import TopTooltip from '@/views/molecules/tooltips/TopTooltip.vue'
  
  const buttonVisibility = ref<boolean>(false)
  const router = useRouter()

  let scroll: number = 0
  
  const scrollWindow = (): void => {
    const top: number = 100
    scroll = window.scrollY
    
    buttonVisibility.value = top <= scroll;
  }

const handleRouting = (routeName: string): void => {
  router.push({ name: routeName })
}

  onMounted(() => {
    window.addEventListener('scroll', scrollWindow)
  })
  </script>
  <template>
    <transition name="opacity">
      <Menu as="div" class="fixed left-14 max-sm:left-3 bottom-9" v-show="buttonVisibility" v-slot="{ open }">
        <TopTooltip :open text="メニュー">
          <MenuButton 
            class="peer flex justify-center items-center w-16 h-16 max-sm:w-14 max-sm:h-14 border border-gray-300 shadow-sm rounded-full bg-white opacity-70 hover:bg-slate-100 hover:opacity-100 duration-300"
            :class="[open ? 'max-sm:w-20 w-24' : '']"
          >
            <MeatballMenuIcon class="w-7 text-sumi-900" v-show="!open" />
            <span class="font-body text-sm text-sumi-500" v-show="open">閉じる</span>
          </MenuButton>
        </TopTooltip>
        <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
          <MenuItems class="absolute top-[-11rem] z-10 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5">
            <DropDownMenuItem @click="handleRouting('Home')" label="ホーム" :iconComponent="HomeIcon" />
            <DropDownMenuItem @click="handleRouting('PostCreate')" label="投稿する" :iconComponent="PlusIcon" />
            <DropDownMenuItem @click="handleRouting('Search')" label="検索する" :iconComponent="SearchIcon" />
            <DropDownMenuItem @click="handleRouting('UserPage')" label="マイページ" :iconComponent="ProfileIcon" />
          </MenuItems>
        </transition>
      </Menu>
    </transition>
  </template>
  <style scoped>
  .opacity-enter{
    opacity: 0;
  }
  .opacity-enter-active{
    transition: opacity 1s;
  }
  .opacity-enter-to{
    opacity: 1;
  }
  .opacity-leave{
    opacity: 1;
  }
  .opacity-leave-active{
    transition: opacity .3s;
  }
  .opacity-leave-to{
    opacity: 0;
  }
  </style>
  