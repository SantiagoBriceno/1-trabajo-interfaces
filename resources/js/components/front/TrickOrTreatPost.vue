<script setup>
import { defineProps, onMounted } from 'vue'	
  import tots from '../data/trickOrTreat.js'

  const props = defineProps({
    colors: {
      type: Object,
      required: false,
    },
    name: {
      type: String,
      required: false,
    },
    post: {
      type: Array,
      required: false,
    },	
    
  })

// post = [{
//  id = 1
//  type = youtube
//  url = https://www.youtube.com/watch?v=M7lc1UVf-VE
// }

  const separateId = (url) => {
  const urlSplit = url.split("=");
  return urlSplit[1];
  };

  const separateIdIg = (url) => {
    const urlSplit = url.split("/");
    return urlSplit[4];
  };

  onMounted(() => {
    console.log(props.post)
  })

</script>

<template>
  <section id="trick-or-treat" class="flex flex-col items-center pb-32">
    <h2 class="mt-10 mb-28 text-5xl md:text-6xl font-bold text-black" :style="{color: colors ? colors.color4 : '',}">{{name}}</h2>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 lg:gap-10">
      <div 
        v-for="(post, i) of post" 
        :key="post.id" 
        class="grid place-items-center text-center w-96 h-96 gap-5 p-8 rounded-md text-black bg-gradient-to-b from-primary-200/20 to-primary-200/10"
        :class="i === 1 && 'from-primary-200/50 to-primary-200/30 lg:-translate-y-10 '"
        :style="{background: colors ? `${colors.color2}` : '',}"
      >
      <iframe v-if="post.type === 'youtube'" class="w-full h-auto overflow-hidden" :src="`http://www.youtube.com/embed/${separateId(post.url)}?enablejsapi=1&origin=http://example.com`" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
      <iframe v-else class="w-full h-auto overflow-hidden" :src="`https://www.instagram.com/p/${separateIdIg(post.url)}/embed/`" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

      </div>
    </div>
  </section>
</template>


