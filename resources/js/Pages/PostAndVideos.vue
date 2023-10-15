<script setup>
import NavbarPost from "@/components/front/NavbarPost.vue";
import TrickOrTreatPost from "@/components/front/TrickOrTreatPost.vue";
import Footer from "@/components/front/Footer.vue";
import { Head } from "@inertiajs/vue3";
import NewBanner from "@/components/front/NewBanner.vue";

let props = defineProps({
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
  colors: {
    type: Object,
    required: false,
  },
  company: {
    type: Object,
    required: false,
  },
  media: {
    type: Object,
    required: false,
  },
});

const redesSociales = [
  {
    image: props.media ? props.media.media1 : null,
    url: props.media ? props.media.url1 : null
  },
  {
    image: props.media ? props.media.media2 : null,
    url: props.media ? props.media.url2 : null
  },
  {
    image: props.media ? props.media.media3 : null,
    url: props.media ? props.media.url3 : null
  }
]

console.log(props.media);
</script>

<template>
  <!-- <Head title="Home">
    <meta name="description" content="Dashboard" />
    <link v-if="colors" rel="icon" alt="Foto logo" :href="`/images/${colors.file}`" />
  </Head> -->
  <div class="container overflow-x-hidden" :style="{ background: colors ? colors.color1 : '' }">
    <NavbarPost 
      :canLogin="canLogin"
      :canRegister="canRegister"
      :isAuth="$page.props.auth.user"
      :colors="colors"
      :company="company"
    />
    <a href="company/colors">
      <div class="flex flex-col" v-if="colors">
        <p :style="{ color: colors.color4 }"></p>
        <div class="w-60 h-12 flex">
          <div class="rounded-full border-solid border-2 border-black h-12 w-12 bg-[#722727]"
            :style="{ backgroundColor: colors.color1 }" :title="colors.color1"></div>
          <div class="rounded-full border-solid border-2 border-black h-12 w-12 bg-[#722727]"
            :style="{ backgroundColor: colors.color2 }" :title="colors.color2"></div>
          <div class="rounded-full border-solid border-2 border-black h-12 w-12 bg-[#722727]"
            :style="{ backgroundColor: colors.color3 }" :title="colors.color3"></div>
          <div class="rounded-full border-solid border-2 border-black h-12 w-12 bg-[#722727]"
            :style="{ backgroundColor: colors.color4 }" :title="colors.color4"></div>
          <div class="rounded-full border-solid border-2 border-black h-12 w-12 bg-[#722727]"
            :style="{ backgroundColor: colors.color5 }" :title="colors.color5"></div>
        </div>
      </div>
    </a>
    <TrickOrTreatPost :colors="colors" name="Youtube Posts" />
    <TrickOrTreatPost :colors="colors" name="Instagram Posts"/>
    <Footer :colors="colors" :company="company" />
    <NewBanner v-if="media != null" :colors="colors" :media="redesSociales" />
  </div>
</template>


<style>
@media (min-width: 768px) {
    .container {
        max-width: 100%;
        margin: 0;
    }

    @media (min-width: 1024px) {
        .container {
            max-width: 100%;
            margin: 0;
        }
    }

    @media (min-width: 1280px) {
        .container {
            max-width: 100%;
            margin: 0;
        }
    }

    @media (min-width: 1536px) {
        .container {
            max-width: 100%;
            margin: 0;
        }
    }
}
</style>