<script setup>
import  Table  from "@/components/front/Table.vue";

//Se puede importar y pasar como prop importandolo
const contenido = {
    title: "Contenido de la tabla",
    content:
        "En esta tabla encontraremos todos los clientes registrados en la aplicación",
};

defineProps({
    users: Array
   });


</script>

<template>
    <div class="content-center m-5 text-center white-400 mt-11">
        <h1
            class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white"
        >
            {{ contenido.title }}
            <span class="text-blue-600 dark:text-blue-500">USUARIOS</span>
        </h1>
        <p class="text-lg font-normal text-black lg:text-xl dark:text-gray-400">
            {{ contenido.content }}
        </p>
    </div>
    <section class="grid place-items-center mt-20 md:mt-10 overflow-hidden">
        <div class="content-center m-7">
            <Table :arrayList = 'users'/>
        </div>
    </section>
</template>
