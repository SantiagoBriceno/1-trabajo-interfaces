<script setup>
import { Head, router, useForm } from "@inertiajs/vue3";
import SectionMain from "@/components/SectionMain.vue";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";

import { ref, computed, onMounted } from "vue";

const props = defineProps({
    colors: { type: Object },
});

let editData = useForm({
    color1: null,
    color2: null,
    color3: null,
    color4: null,
    color5: null,
    file: null,
});

const catchImg = (event) => {
    img = event.target.files[0];
    console.log(img);
};

let img = ref(null);

let passData = ref({
    color1: null,
    color2: null,
    color3: null,
    color4: null,
    color5: null,
});

onMounted(() => {
    if (props.colors) {
        editData.color1 = props.colors[0].color1;
        editData.color2 = props.colors[0].color2;
        editData.color3 = props.colors[0].color3;
        editData.color4 = props.colors[0].color4;
        editData.color5 = props.colors[0].color5;

        document.getElementById("first-color-circle").style.backgroundColor =
            props.colors[0].color1;
        document.getElementById("second-color-circle").style.backgroundColor =
            props.colors[0].color2;
        document.getElementById("third-color-circle").style.backgroundColor =
            props.colors[0].color3;
        document.getElementById("four-color-circle").style.backgroundColor =
            props.colors[0].color4;
        document.getElementById("five-color-circle").style.backgroundColor =
            props.colors[0].color5;
    }
});

const registerColors = (event) => {
    event.preventDefault();

    editData.file = img;

    router.post("/company/colors", editData, {
        forceFormData: true,
        preserveScroll: true,
        onSuccess: () => {
            editData.status = true;
            //Aqui se refresca la pagina
            window.location.reload();
        },
    });

    // editData.post(route("colors.create"),{
    //     preserveScroll: true,
    //     onSuccess: () => {
    //         editData.reset();
    //         editData.status = true;
    //     },
    // });
};

const editColors = (event) => {
    event.preventDefault();

    editData.file = img;

    router.post("/company/colors", editData, {
        forceFormData: true,
        preserveScroll: true,
        onSuccess: () => {
            editData.status = true;
            //Aqui se refresca la pagina
            window.location.reload();
        },
    });
};
</script>

<template>
    {{ (passData.color1 = editData.color1) }}
    {{ (passData.color2 = editData.color2) }}
    {{ (passData.color3 = editData.color3) }}
    {{ (passData.color4 = editData.color4) }}
    {{ (passData.color5 = editData.color5) }}
    <Head title="Mis colores">
        <meta name="description" content="Mis colores" />
        <link v-if="colors" rel="icon" :href="`/images/${colors[0].file}`" />
    </Head>
    <LayoutAuthenticated :colors="passData">
        <SectionMain>
            <div class="bg-white-400 flex justify-center items-center">
                <form class="flex flex-col justify-center items-center gap-10">
                    <div class="flex justify-center items-center">
                        <div class="flex flex-col justify-center items-center">
                            <div
                                id="first-color-circle"
                                class="rounded-full border-solid border-8 border-black h-48 w-48 m-2 flex text-center justify-center items-center text-white"
                                :style="{
                                    backgroundColor: editData.color1,
                                    color: editData.color4,
                                }"
                            ></div>
                            <label
                                class="block uppercase tracking-wide text-white-700 text-xs font-bold mb-2"
                                for="first-color"
                            >
                                1er Color
                            </label>
                            <input
                                type="color"
                                id="first-color"
                                v-model="editData.color1"
                            />
                            <div
                                class="text-center"
                                :style="{ color: editData.color4 }"
                            >
                                <h2>Color primario</h2>
                                <p>Proporción del 60%</p>
                            </div>
                        </div>

                        <div class="flex flex-col justify-center items-center">
                            <div
                                id="second-color-circle"
                                class="rounded-full border-solid border-8 border-black h-48 w-48 bg-teal-400 m-2 flex text-center justify-center items-center text-white"
                                :style="`background-color: ${editData.color2};`"
                            ></div>
                            <label
                                class="block uppercase tracking-wide text-white-700 text-xs font-bold mb-2"
                                for="second-color"
                            >
                                2do Color
                            </label>
                            <input
                                type="color"
                                id="second-color"
                                v-model="editData.color2"
                                :style="`background-color: ${editData.color2};`"
                            />
                            <div class="text-center">
                                <h2>Color Secundario</h2>
                                <p>Proporción del 30%</p>
                            </div>
                        </div>

                        <div class="flex flex-col justify-center items-center">
                            <div
                                id="third-color-circle"
                                class="rounded-full border-solid border-8 border-black h-48 w-48 bg-[#722727] m-2 flex text-center justify-center items-center text-white"
                                :style="`background-color: ${editData.color3};`"
                            ></div>
                            <label
                                class="block uppercase tracking-wide text-white-700 text-xs font-bold mb-2"
                                for="third-color"
                            >
                                3er Color
                            </label>
                            <input
                                type="color"
                                id="third-color"
                                v-model="editData.color3"
                            />
                            <div class="text-center">
                                <h2>Color Terciario</h2>
                                <p>Proporción del 10%</p>
                            </div>
                        </div>

                        <div class="flex flex-col justify-center items-center">
                            <div
                                id="four-color-circle"
                                class="rounded-full border-solid border-8 border-black h-48 w-48 m-2 flex text-center justify-center items-center text-white"
                                :style="`background-color: ${editData.color4};`"
                            ></div>
                            <label
                                class="block uppercase tracking-wide text-white-700 text-xs font-bold mb-2"
                                for="four-color"
                            >
                                4to Color
                            </label>
                            <input
                                type="color"
                                id="four-color"
                                v-model="editData.color4"
                            />
                            <div class="text-center">
                                <h2>Color Complementario 1</h2>
                                <p>Color del texto</p>
                            </div>
                        </div>

                        <div class="flex flex-col justify-center items-center">
                            <div
                                id="five-color-circle"
                                class="rounded-full border-solid border-8 border-black h-48 w-48 bg-[#1c1c1c] m-2 flex text-center justify-center items-center text-white"
                                :style="`background-color: ${editData.color5};`"
                            ></div>
                            <label
                                class="block uppercase tracking-wide text-white-700 text-xs font-bold mb-2"
                                for="five-color"
                            >
                                5to Color
                            </label>
                            <input
                                type="color"
                                id="five-color"
                                v-model="editData.color5"
                            />
                            <div class="text-center">
                                <h2>Color Complementario 2</h2>
                                <p>Color de algo</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex flex-col justify-center items-center w-1/2"
                        :style="{ color: editData.color4 }"
                    >
                        <div
                            v-if="colors"
                            class="h-48 w-48 m-2 flex text-center justify-center items-center"
                        >
                            <img
                                class="w-full h-auto py-20"
                                id="logo"
                                :src="`/images/${colors[0].file}`"
                                alt=""
                            />
                        </div>

                        <label
                            class="mt-8 mb-4 text-sm font-medium"
                            for="file_input"
                            >Carga el logo de tu empresa</label
                        >
                        <input
                            class="block w-full text-sm border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-red-800"
                            id="file_input"
                            type="file"
                            :style="{
                                color: editData.color4,
                                backgroundColor: editData.color5,
                            }"
                            :v-model="editData.file"
                            accept=".jpg, .jpeg, .png, .ico"
                            v-on:change="catchImg($event)"
                        />
                    </div>

                    <div class="flex justify-center items-center">
                        <button
                            v-if="colors == undefined"
                            class="shadow hover:bg-purple-400 focus:shadow-outline focus:outline-none font-bold py-2 px-4 rounded"
                            type="submit"
                            v-on:click="registerColors"
                            :style="{
                                backgroundColor: editData.color2,
                                color: editData.color4,
                            }"
                        >
                            Registrar nueva paleta de colores
                        </button>

                        <button
                            v-else
                            class="shadow hover:bg-purple-400 focus:shadow-outline focus:outline-none font-bold py-2 px-4 rounded"
                            type="submit"
                            v-on:click="editColors"
                            :style="{
                                backgroundColor: editData.color2,
                                color: editData.color4,
                            }"
                        >
                            Guardar los cambios
                        </button>
                    </div>
                </form>
            </div>
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
