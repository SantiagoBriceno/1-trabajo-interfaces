<script setup>
import { onMounted, ref } from "vue";
import { Link, router } from "@inertiajs/vue3";


const navbar = ref('')
const showMenu = ref(false)

onMounted(() => {
  window.onscroll = () => {
  if(window.scrollY === 0) {
    navbar.value.classList.remove('bg-primary-200')
  } else {
    navbar.value.classList.add('bg-primary-200')
  }
}
})

const splitName = (name) => {
  if(name.split(' ').length > 1) {
    return name.split(' ')
  }else{
    
    const limit = Math.floor(name.length / 3) * 2
    const first = name.slice(0, limit)
    const second = name.slice(limit, name.length)
    return [first, second]
  }
  
}

defineProps({
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
  isAuth: {
    type: Boolean,
  }, 
  colors:{
    type: Object,
    required: false,
  },
  company: {
    type: Object,
    required: false,
  },
});
</script>

<template>
  {{  }}
  <nav ref="navbar" class="fixed top-0 left-0 w-full bg-primary-200 z-20 transition duration-200" :style="{backgroundColor: colors ? colors.color1 : '',}">
    <div class="container flex items-center justify-between h-20">
      <div class="relative z-30 flex items-center gap-2 mb-2 lg:mb-0">
        <h1 class="text-white font-bold text-lg lg:text-2xl" :style="{color: colors ? colors.color4 : '',}">{{ company ? `${splitName(company.name)[0]} ` : 'Hallow' }}<span class="text-secondary" :style="{color: colors ? colors.color5 : '',}">{{ company ? splitName(company.name)[1] : 'eed' }}</span ></h1>
          <svg  class="w-7 lg:w-9" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M19.071 4.929a9.936 9.936 0 0 0-7.07-2.938 9.943 9.943 0 0 0-7.072 2.938c-3.899 3.898-3.899 10.243 0 14.142a9.94 9.94 0 0 0 7.073 2.938 9.936 9.936 0 0 0 7.07-2.937c3.899-3.898 3.899-10.243-.001-14.143zM12.181 4h-.359c.061-.001.119-.009.18-.009s.118.008.179.009zm6.062 13H16l-1.258 2.516a7.956 7.956 0 0 1-2.741.493 7.96 7.96 0 0 1-2.746-.494L8 17.01H5.765a7.96 7.96 0 0 1-1.623-3.532L6 11 4.784 8.567a7.936 7.936 0 0 1 1.559-2.224 7.994 7.994 0 0 1 3.22-1.969L12 6l2.438-1.625a8.01 8.01 0 0 1 3.22 1.968 7.94 7.94 0 0 1 1.558 2.221L18 11l1.858 2.478A7.952 7.952 0 0 1 18.243 17z"></path><path d="m8.5 11 1.5 4h4l1.5-4L12 8.5z"></path></svg>
      </div>
      <div class="flex lg:hidden items-center gap-2">
        <button @click="showMenu = !showMenu" class="relative z-30 text-white -mt-2 p-2" :style="{color: colors ? colors.color4 : '',}">
          <svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 12H17C17.55 12 18 11.55 18 11C18 10.45 17.55 10 17 10H1C0.45 10 0 10.45 0 11C0 11.55 0.45 12 1 12ZM1 7H17C17.55 7 18 6.55 18 6C18 5.45 17.55 5 17 5H1C0.45 5 0 5.45 0 6C0 6.55 0.45 7 1 7ZM0 1C0 1.55 0.45 2 1 2H17C17.55 2 18 1.55 18 1C18 0.45 17.55 0 17 0H1C0.45 0 0 0.45 0 1Z" fill="white"/>
          </svg>
        </button>
      </div>
      <!-- CONTENEDOR DE PALETA DE COLORES -->
    
      <div
        class="
          absolute lg:static top-20 inset-x-0
          flex flex-col lg:flex-row items-center gap-5 lg:gap-10
          bg-primary-200 lg:bg-transparent pt-5 pb-10 px-5 lg:p-0
          transition duration-500 lg:duration-200 lg:-translate-y-0
        "
        :class="!showMenu ? 'translate-y-[-150%]' : '-translate-y-0'"
      >
        <a @click="showMenu = false" class="text-white font-medium" href="#home" :style="{color: colors ? colors.color4 : '',}">Home</a>
        <a @click="showMenu = false" class="text-white font-medium" href="#category" :style="{color: colors ? colors.color4 : '',}">Categorías</a>
        <a @click="showMenu = false" class="text-white font-medium" href="#trick-or-treat" :style="{color: colors ? colors.color4 : '',}">Clubes</a>
        <a @click="showMenu = false" class="text-white font-medium" href="#footer" :style="{color: colors ? colors.color4 : '',}">Footer</a>
        <a @click="showMenu = false" class="text-white font-medium" href="index/post" :style="{color: colors ? colors.color4 : '',}">Post</a>


        <div v-if= "canLogin" class = "flex gap-1.5">
          
          <Link v-if="isAuth" class="hidden md:block px-8 py-3 rounded-full text-white font-medium tracking-wider uppercase bg-secondary w-full lg:w-auto"
          :href="route('index')"
          :style="{background: colors ? colors.color3 : '',}"
          >Home
          </Link>

          <Link v-if="isAuth" class="hidden md:block px-8 py-3 rounded-full text-white font-medium tracking-wider uppercase bg-secondary w-full lg:w-auto"
          v-on:click="router.post(route('logout'))"
          :style="{background: colors ? colors.color3 : '',}"
          >Logout
          </Link>
          
          <template v-else>
            <Link class="hidden md:block px-8 py-3 rounded-full text-white font-medium tracking-wider uppercase bg-secondary w-full lg:w-auto" 
            :href= "route('login')"
            >Login</Link>

            <Link v-if="canRegister" class="hidden md:block px-8 py-3 rounded-full text-white font-medium tracking-wider uppercase bg-secondary w-full lg:w-auto" 
            :href="route('register')"
            >Register</Link>
          </template>
         </div> 
      </div>
    </div>
  </nav>
</template>