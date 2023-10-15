<script setup>
import { Head, router, useForm } from "@inertiajs/vue3";
import SectionMain from "@/components/SectionMain.vue";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";

import { ref, computed, onMounted } from "vue";

const props = defineProps({
  colors: { type: Object },
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
  <LayoutAuthenticated :colors="passData">
    <SectionMain>
      <form @submit.prevent="submitForm">
        <div>
          <label for="type">Tipo:</label>
          <select id="type" v-model="editData.type">
            <option value="youtube">Youtube</option>
            <option value="instagram">Instagram</option>
          </select>
        </div>
        <div>
          <label for="url">URL:</label>
          <input type="text" id="url" v-model="editData.url" :class="{ valid: isValidUrl, inValid: !isValidUrl }" />
        </div>
        <button type="submit">Enviar</button>
      </form>
      <table>
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
