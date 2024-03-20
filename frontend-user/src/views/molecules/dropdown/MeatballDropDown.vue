<script setup lang="ts">
  import { onMounted, ref } from 'vue'
  import { Menu, MenuButton, MenuItems } from '@headlessui/vue'
  import MeatballMenuIcon from '@/views/atoms/icons/MeatballMenuIcon.vue'
  import DropDownMenuItem from '@/views/atoms/DropDownMenuItem.vue'
  import HomeIcon from '@/views/atoms/icons/HomeIcon.vue'
  import PlusIcon from '@/views/atoms/icons/PlusIcon.vue'
  import SearchIcon from '@/views/atoms/icons/SearchIcon.vue'
  import ProfileIcon from '@/views/atoms/icons/ProfileIcon.vue'
  import TopTooltip from '@/views/molecules/tooltips/TopTooltip.vue'
    
  const buttonActive = ref<boolean>(false);
  
  let scroll: number = 0;
  
  const scrollWindow = (): void => {
    const top: number = 100;
    scroll = window.scrollY;
    
    if (top <= scroll) {
      buttonActive.value = true;
    } else {
      buttonActive.value = false;
    }
  }

  onMounted(() => {
    window.addEventListener('scroll', scrollWindow);
  });
  </script>
  <template>
    <transition name="opacity">
      <Menu as="div" class="fixed left-14 bottom-9" v-show="buttonActive" v-slot="{ open }">
        <TopTooltip :open text="メニュー">
          <MenuButton 
            class="peer flex justify-center items-center w-16 h-16 border border-gray-200 rounded-full hover:bg-slate-100 duration-300"
            :class="[open ? 'w-24' : '']"
          >
            <MeatballMenuIcon class="w-7 text-sumi-900" v-show="!open" />
            <span class="font-body text-sm text-sumi-500" v-show="open">閉じる</span>
          </MenuButton>
        </TopTooltip>
        <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
          <MenuItems class="absolute top-[-11rem] z-10 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5">
            <DropDownMenuItem :to="{ name: 'Home' }" label="ホーム" :iconComponent="HomeIcon" />
            <DropDownMenuItem :to="{ name: 'PostRegister' }" label="投稿する" :iconComponent="PlusIcon" />
            <DropDownMenuItem :to="{ name: 'Search' }" label="検索する" :iconComponent="SearchIcon" />
            <DropDownMenuItem :to="{ name: 'UserPage' }" label="マイページ" :iconComponent="ProfileIcon" />
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