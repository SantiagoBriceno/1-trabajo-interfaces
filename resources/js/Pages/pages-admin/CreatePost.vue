<script setup>
import { Head, router, useForm } from "@inertiajs/vue3";
import SectionMain from "@/components/SectionMain.vue";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";

import { ref, computed, onMounted } from "vue";

const props = defineProps({
  colors: { type: Object, required: false },
  post: { type: Array },
});

console.log(props.post);

const editData = useForm({
  type: "",
  url: "",
  position:null,
});

const submitForm = (e) => {
  e.preventDefault();
  router.post("/company/post", editData, {
    preserveScroll: true,
    onSuccess: () => {
      editData.type = "";
      editData.url = "";
    },
  });

};

const deleteItem = (index) => {
  editData.position = index;
  console.log(editData.position);
  router.post("/company/post", editData, {
    preserveScroll: true,
    onSuccess: () => {
      editData.type = "";
      editData.url = "";
    },
  });
  
};

</script>

<template>
  <Head title="Mis colores">
    <meta name="description" content="Mis colores" />
    <link v-if="colors[0] != null" rel="icon" :href="`/images/${colors[0].file}`" />
  </Head>
  <LayoutAuthenticated :colors="colors">
    <SectionMain>
      <form class="grid grid-cols-3 align-middle text-center" @submit.prevent="submitForm">
        <div class="m-10 text-center gap-10">
          <label class="mr-10" for="type">Tipo:</label>
          <select class="rounded-md" :style="{color: colors ? colors.color5 : '#fff'}" id="type" v-model="editData.type">
            <option value="youtube">Youtube</option>
            <option value="instagram">Instagram</option>
          </select>
        </div>
        <div class="m-10 text-center gap-10">
          <label class="mr-10" for="url">URL:</label>
          <input class="rounded-md w-2-3" type="text" id="url" :style="{color: colors ? colors.color5 : '#fff'}" v-model="editData.url" :class="{ valid: isValidUrl, inValid: !isValidUrl }" />
        </div>
        <button class="md:block px-8 py-3 text-white font-medium tracking-wider uppercase bg-secondary mt-10 h-fit lg:w-fit ml-14 rounded-md mx-2" type="submit"
          :style="{background: colors ? colors.color3 : '', color: colors ? colors.color4 : '#fff'}"
        >Enviar</button>
      </form>
        <table class="translate-x-20">
        <thead>
          <tr>
            <th>Tipo</th>
            <th>URL</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in $props.post" :key="index">
            <td>{{ item.type }}</td>
            <td>{{ item.url }}</td>
            <td>
              <button @click="deleteItem(index)">Borrar</button>
            </td>
          </tr>
        </tbody>
      </table>
      

    </SectionMain>
  </LayoutAuthenticated>
</template>
\
<style scoped>
.valid {
  border: 1px solid green;
}

.inValid {
  border: 1px solid red;
}
</style>
