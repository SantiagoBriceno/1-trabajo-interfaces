<script setup>
import { Head, router, useForm } from "@inertiajs/vue3";
import SectionMain from "@/components/SectionMain.vue";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";

import { ref, computed, onMounted } from "vue";

const props = defineProps({
    colors: { type: Object },
    media: { type: Object },
});

let editData = useForm({
    file1: null,
    url1: null,
    file2: null,
    url2: null,
    file3: null,
    url3: null,
});

const catchImg = (event, nroFile) => {
    switch (nroFile) {
        case 1:
            files1 = event.target.files[0];
            break;
        case 2:
            files2 = event.target.files[0];
            break;
        case 3:
            files3 = event.target.files[0];
            break;
        default:
            break;
    }
};

function validarURL(miurl) {
    try {

        new URL(miurl);
        return true;

    } catch (err) {

        return false;

    }
}

//VERIFICAMOS LOS CAMPOS DEL FORMULARIO
// MEDIA 1 y URL 1 SON LOS UNICOS CAMPOS OBLIGATORIOS
const verifyField = (field) => {
    switch (field) {
        case "media1":
            if (editData.file1 == null) {
                return null;
            } else {
                return true;
            }
            break;
        case "url1":
            return validarURL(editData.url1);
            break;
        case "media2":
            if (editData.file2 == null && editData.url2 == null) {
                return true;
            } else if (editData.file2 == null && editData.url2 != null) {
                return null;
            } else if (editData.file2 != null && editData.url2 == null) {
                return null;
            } else {
                if (validarURL(editData.url2)) {
                    return true;
                }
            }
            break;

        case "url2":
            if (editData.url2 == null && editData.file2 == null) {
                return true;
            } else if (editData.url2 == null && editData.file2 != null) {
                return null;
            } else if (editData.url2 != null && editData.file2 == null) {
                return null;
            } else {
                if (validarURL(editData.url2)) {
                    return true;
                }
            }
            break;

        case "media3":
            if (editData.file3 == null && editData.url3 == null) {
                return true;
            } else if (editData.file3 == null && editData.url3 != null) {
                return null;
            } else if (editData.file3 != null && editData.url3 == null) {
                return null;
            } else {
                if (validarURL(editData.url3)) {
                    return true;
                }
            }
            break;

        case "url3":
            if (editData.url3 == null && editData.file3 == null) {
                return true;
            } else if (editData.url3 == null && editData.file3 != null) {
                return null;
            } else if (editData.url3 != null && editData.file3 == null) {
                return null;
            } else {
                if (validarURL(editData.url3)) {
                    return true;
                }
            }
            break;
        default:
            break;
    }
};

const registerValidator = () => {
    let valid = true;
    let fields = ["media1", "url1", "media2", "url2", "media3", "url3"];
    let errorFields = [];

    fields.forEach((field) => {
        if (verifyField(field) == null) {
            valid = false;
            errorFields.push(field);
        }
    });

    if (valid === false) {
        if (errorFields.length === 1) {
            alert(`El campo ${errorFields[0]} es obligatorio`);
        } else {
            alert(`Los campos ${errorFields.join(' y ')} son obligatorios`);
        }
        console.log(errorFields)
    }

    return valid;
}

let files1 = ref(null);
let files2 = ref(null);
let files3 = ref(null);

const registerMedia = (event) => {
    event.preventDefault();
    editData.file1 = files1;
    editData.file2 = files2;
    editData.file3 = files3;

    if (registerValidator() === false) {
        return;
    } else {
        router.post("/company/media", editData, {
            forceFormData: true,
            preserveScroll: true,
            onSuccess: () => {
                editData.status = true;
                //Aqui se refresca la pagina
                window.location.reload();
            },
        });
    }
};

const editValidator = () => {
    
}

const editMedia = (event) => {
    event.preventDefault();

    editData.file1 = files1;
    editData.file2 = files2;
    editData.file3 = files3;

    router.post("/company/media", editData, {
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
    <Head title="Mis Redes Sociales">
        <meta name="description" content="Mis colores" />
        <link v-if="colors" rel="icon" :href="`/images/${colors[0].file}`" />
    </Head>
    <LayoutAuthenticated :colors="colors[0]">
        <SectionMain>
            <div class="bg-white-400 flex justify-center items-center">
                <form class="flex flex-wrap">
                    <!-- IMAGEN 1 -->
                    <div class="flex flex-col justify-center items-center">
                        <div id="first-media-circle"
                            class="h-48 w-48 m-2 flex text-center justify-center items-center text-white">
                            <img v-if="media != null" class="w-full h-auto py-20" id="logo"
                                :src="`/images/media/${media[0].media1}`" alt="" />
                        </div>
                        <label class="block uppercase tracking-wide text-white-700 text-xs font-bold mb-2"
                            :style="{ color: colors ? colors.color4 : '#fff' }" for="first-color">
                            Red social 1
                        </label>
                        <input type="file" id="first-media" :v-model="editData.file1"
                            class="block w-full mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            accept=".jpg, .jpeg, .png, .ico" v-on:change="catchImg($event, 1)" />
                        <div class="text-center">
                            <label for="media1-url" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                :style="{ color: colors ? colors.color4 : '#fff' }">URL destino</label>
                            <input type="text" id="media1-url" v-model="editData.url1"
                                :placeholder="media != null ? media[0].url1 : ''"
                                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>

                    <!-- IMAGEN 2 -->
                    <div class="w-2/6 h-2/6 flex flex-col justify-center items-center">
                        <div id="second-media-circle"
                            class="h-48 w-48 m-2 flex text-center justify-center items-center text-white">
                            <img v-if="media != null && media[0].media2 != null" class="w-full h-auto py-20" id="logo"
                                :src="`/images/media/${media[0].media2}`" alt="" />
                        </div>
                        <label class="block uppercase tracking-wide text-white-700 text-xs font-bold mb-2"
                            :style="{ color: colors ? colors.color4 : '#fff' }" for="second-media">
                            Red social 2
                        </label>
                        <input type="file" id="second-media" :v-model="editData.file2"
                            class="block w-full mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            accept=".jpg, .jpeg, .png, .ico" v-on:change="catchImg($event, 2)" />
                        <div class="text-center">
                            <label for="media2-url" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                :style="{ color: colors ? colors.color4 : '#fff' }">URL destino</label>
                            <input type="text" id="media2-url" v-model="editData.url2"
                                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>
                    <!-- IMAGEN 3 -->
                    <div class="w-2/6 h-2/6 flex flex-col justify-center items-center">
                        <div id="third-media-circle"
                            class="h-48 w-48 m-2 flex text-center justify-center items-center text-white">
                            <img v-if="media != null && media[0].media3 != null" class="w-full h-auto py-20" id="logo"
                                :src="`/images/media/${media[0].media3}`" alt="" />
                        </div>
                        <label class="block uppercase tracking-wide text-white-700 text-xs font-bold mb-2"
                            :style="{ color: colors ? colors.color4 : '#fff' }" for="third-media">
                            Red social 3
                        </label>
                        <input type="file" id="third-media" :v-model="editData.file3"
                            class="block w-full mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            accept=".jpg, .jpeg, .png, .ico" v-on:change="catchImg($event, 3)" />
                        <div class="text-center">
                            <label for="media3-url" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                :style="{ color: colors ? colors.color4 : '#fff' }">URL destino</label>
                            <input type="text" id="media3-url" v-model="editData.url3"
                                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>

                    <div class="flex justify-center items-center">
                        <button v-if="media == undefined"
                            class="shadow hover:bg-purple-400 focus:shadow-outline focus:outline-none font-bold py-2 px-4 rounded"
                            type="submit" v-on:click="registerMedia" :style="{
                                backgroundColor: colors ? colors[0].color2 : '#fff',
                                color: colors ? colors[0].color4 : '#000',
                            }">
                            Registrar nueva/s red/es social/es
                        </button>

                        <button v-else
                            class="shadow hover:bg-purple-400 focus:shadow-outline focus:outline-none font-bold py-2 px-4 rounded"
                            type="submit" v-on:click="editMedia" :style="{
                                backgroundColor: colors ? colors[0].color2 : '#fff',
                                color: colors ? colors[0].color4 : '#000',
                            }">
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

form {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    gap: 40px;

}
</style>
