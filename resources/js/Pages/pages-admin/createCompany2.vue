<script setup>
import { useMainStore } from "@/Stores/main";
import { Head, router, useForm } from "@inertiajs/vue3";
import SectionMain from "@/components/SectionMain.vue";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import BaseButton from "@/components/BaseButton.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import CardBoxModal from "@/components/CardBoxModal.vue";
import { countries, states } from "../../../countries";

import { ref, computed } from "vue";

const rifHelper = computed(() => {
    if (editData.rif.length == 10) {
        editData.rif = editData.rif + "-";
    }
});

const mainStore = useMainStore();

const isModalDangerActive = ref(false);

defineProps({
    empresa: {
        type: Array,
    },
    colors: {
        type: Object,
        required: false,
    },
});

let statesOptions = ref([]);

let countrieSelected = () => {
    const selectedCountrie = editData.pais;
    countries.forEach((countrie) => {
        if (countrie.name == selectedCountrie) {
            editData.phone = "+" + countrie.tlf;
        }
    });

    console.log(editData.phone);
    statesOptions = states[selectedCountrie];
    console.log(statesOptions);
};

let deleteCompanyCondition = ref(false);

let editData = useForm({
    name: null,
    rif: null,
    email: null,
    email2: null,
    phone: null,
    phone2: null,
    pais: null,
    estado: null,
    direccion: null,
    status: false,
});

let editInput = ref([]);

const verifyField = (field) => {
    switch (field) {
        case "name":
            if (editData.name == null) {
                return null;
            } else if (editData.name.length < 3) {
                return false;
            } else {
                return true;
            }
            break;
        case "rif":
            if (editData.rif == null) {
                return null;
            } else if (
                /^([VEJPGvejpg]{1})-([0-9]{8})-([0-9]{1}$)/.test(editData.rif)
            ) {
                return true;
            } else {
                return false;
            }
            break;

        case "email":
            if (editData.email == null) {
                return null;
            } else if (
                /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(
                    editData.email
                )
            ) {
                return true;
            } else {
                return false;
            }
            break;

        case "email2":
            if (editData.email2 == null) {
                return null;
            } else if (
                /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(
                    editData.email2
                )
            ) {
                return true;
            } else {
                return false;
            }
            break;
            break;

        case "phone":
            if (editData.phone == null) {
                return null;
            } else if (
                /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/.test(
                    editData.phone
                )
            ) {
                return true;
            } else {
                return false;
            }
            break;

        case "phone2":
            if (editData.phone2 == null) {
                return null;
            } else if (
                /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/.test(
                    editData.phone2
                )
            ) {
                return true;
            } else {
                return false;
            }
            break;

        case "pais":
            if (editData.pais == null) {
                return null;
            } else if (editData.pais.length < 3) {
                return false;
            } else {
                return true;
            }

            break;

        case "estado":
            if (editData.estado == null) {
                return null;
            } else if (editData.estado.length < 3) {
                return false;
            } else {
                return true;
            }
            break;

        case "direccion":
            if (editData.direccion == null) {
                return null;
            } else if (editData.direccion.length < 3) {
                return false;
            } else {
                return true;
            }
            break;

        default:
            break;
    }
};

const verifyFormRegister = () => {
    if (
        verifyField("name") == true &&
        verifyField("rif") == true &&
        verifyField("email") == true &&
        (editData.email2 ? verifyField("email2") : true) == true &&
        verifyField("phone") == true &&
        (editData.phone2 ? verifyField("phone2") : true) == true &&
        verifyField("pais") == true &&
        verifyField("estado") == true &&
        verifyField("direccion") == true
    ) {
        return true;
    } else {
        return false;
    }
};

const registerCompany = (event) => {
    event.preventDefault();

    if (verifyFormRegister()) {
        editData.put(route("company.create"), {
            preserveScroll: true,
            onSuccess: () => {
                editData.reset();
                editData.status = true;
            },
        });
    } else {
        alert("Invalid camps in form");
    }
};

const verifyFormEdit = () => {
    if (editInput.value.length == 0) {
        return false;
    } else {
        for (let i = 0; i < editInput.value.length; i++) {
            if (verifyField(editInput.value[i]) == false) {
                return false;
            }
        }
        return true;
    }
};

const editCompany = (event) => {
    event.preventDefault();

    if (verifyFormEdit()) {
        editData.patch(route("company.edit"), {
            preserveScroll: true,
            onSuccess: () => {
                editData.reset();
                editData.status = true;
            },
        });
    } else {
        console.log("invalid form Editing");
    }
};

const deleteCompany = (event) => {
    router.delete(route("company.delete"), {
        preserveScroll: true,
        onSuccess: () => {
            deleteCompanyCondition.value = true;
        },
    });
};
</script>

<template>
    <CardBoxModal
        @confirm="deleteCompany"
        v-model="isModalDangerActive"
        title="Por favor, confirma"
        button="danger"
        button-label="Eliminar"
        has-cancel
    >
        <p>Estas apunto de <b> Eliminar la empresa </b></p>
        <p>Por favor, confirma</p>
    </CardBoxModal>
    {{
        (placeholder = {
            name: empresa == undefined ? "Example SA" : empresa[0].name,
            rif: empresa == undefined ? "J-01234567-0" : empresa[0].rif,
            email: empresa == undefined ? "Example@ex.com" : empresa[0].email,
            email2:
                empresa == undefined
                    ? "Example@ex.com(No obligatorio)"
                    : empresa[0].email2,
            phone: empresa == undefined ? "412-123 4567 " : empresa[0].phone,
            phone2:
                empresa == undefined
                    ? "412-123 4567(No obligatorio)"
                    : empresa[0].phone2,
            pais: empresa == undefined ? "Venezuela" : empresa[0].pais,
            estado: empresa == undefined ? "Carabobo" : empresa[0].estado,
            direccion:
                empresa == undefined
                    ? "Una dirección válida"
                    : empresa[0].direccion,
        })
    }}
    <Head title="Mi Empresa">
        <meta name="description" content="Dashboard" />
        <link v-if="colors.file" rel="icon" :href="`/images/${colors.file}`" />
    </Head>
    <LayoutAuthenticated :colors="colors">
        <SectionMain>
            <div class="flex flex-wrap mb-4 h-128">
                <div
                    class="w-1/3 ml-auto bg-white-400 flex justify-center items-center"
                >
                    <div class="flex flex-col justify-center">
                        <div
                            class="rounded-full h-48 w-48 flex bg-teal-400 m-2 text-center justify-center items-center text-white"
                            :style="{
                                color: colors ? colors.color4 : '', backgroundColor: colors ? colors.color2 : ''
                            }"
                        >
                            <h1 class="text-7xl text-center">
                                {{
                                    editData.name
                                        ? editData.name.substr(0, 2)
                                        : placeholder.name.substr(0, 2)
                                }}
                            </h1>
                        </div>
                    </div>
                </div>

                <div
                    class="w-1/3 mr-auto bg-white-400 flex justify-center items-center"
                    :style="{
                        color: colors ? colors.color4 : ''
                    }"
                >
                    <div class="space-y-3 text-center md:text-left lg:mx-12">
                        <h1 class="text-4xl">
                            {{
                                editData.name ? editData.name : placeholder.name
                            }}
                        </h1>
                        <p>
                            <b>Rif:</b>
                            {{ editData.rif ? editData.rif : placeholder.rif }}
                        </p>
                        <p>
                            <b>Pais:</b>
                            {{
                                editData.pais ? editData.pais : placeholder.pais
                            }}
                        </p>
                        <p>
                            <b>direccion:</b>
                            {{
                                editData.direccion
                                    ? editData.direccion
                                    : placeholder.direccion
                            }}
                        </p>
                        <div
                            v-if="editData.status"
                            class="inline-flex items-center capitalize leading-none text-sm border rounded-full py-1.5 px-4 bg-blue-500 border-blue-500 text-white"
                            bis_skin_checked="1"
                            :style="{color: colors ? colors.color4 : '', backgroundColor: colors ? colors.color3 : ''}"
                        >
                            <span
                                class="inline-flex justify-center items-center w-4 h-4 mr-2"
                                ><svg
                                    viewBox="0 0 24 24"
                                    width="16"
                                    height="16"
                                    class="inline-block"
                                >
                                    <path
                                        fill="currentColor"
                                        d="M23,12L20.56,9.22L20.9,5.54L17.29,4.72L15.4,1.54L12,3L8.6,1.54L6.71,4.72L3.1,5.53L3.44,9.21L1,12L3.44,14.78L3.1,18.47L6.71,19.29L8.6,22.47L12,21L15.4,22.46L17.29,19.28L20.9,18.46L20.56,14.78L23,12M10,17L6,13L7.41,11.59L10,14.17L16.59,7.58L18,9L10,17Z"
                                    ></path></svg></span
                            ><span>Actualizado</span>
                        </div>
                        <div
                            v-else-if="deleteCompanyCondition"
                            class="inline-flex items-center capitalize leading-none text-sm border rounded-full py-1.5 px-4 bg-blue-500 border-blue-500 text-white"
                            bis_skin_checked="1"
                            :style="{color: colors ? colors.color4 : '', backgroundColor: colors ? colors.color3 : ''}"
                        >
                            <span
                                class="inline-flex justify-center items-center w-4 h-4 mr-2"
                                ><svg
                                    viewBox="0 0 24 24"
                                    width="16"
                                    height="16"
                                    class="inline-block"
                                >
                                    <path
                                        fill="currentColor"
                                        d="M23,12L20.56,9.22L20.9,5.54L17.29,4.72L15.4,1.54L12,3L8.6,1.54L6.71,4.72L3.1,5.53L3.44,9.21L1,12L3.44,14.78L3.1,18.47L6.71,19.29L8.6,22.47L12,21L15.4,22.46L17.29,19.28L20.9,18.46L20.56,14.78L23,12M10,17L6,13L7.41,11.59L10,14.17L16.59,7.58L18,9L10,17Z"
                                    ></path></svg></span
                            ><span>Eliminado</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center">
                <form class="w-full max-w-lg content-center">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="company-name"
                                :style="{color: colors ? colors.color4 : ''}"
                            >
                                Nombre de la empresa
                            </label>
                            <input
                                v-on:change="editInput.push('name')"
                                v-model="editData.name"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                :style="{color: colors ? colors.color5 : '', backgroundColor: colors ? colors.color4 : ''}"
                                :class="{
                                    valid: verifyField('name') == true,
                                    inValid: verifyField('name') == false,
                                }"
                                id="company-name"
                                type="text"
                                :placeholder="placeholder.name"
                            />
                            <p
                                v-if="verifyField('name') == false"
                                class="text-red-600 text-xs italic"
                                :style="{color: colors ? colors.color3 : ''}"
                            >
                                Por favor coloca un nombre válido
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="company-name"
                                :style="{color: colors ? colors.color4 : ''}"
                            >
                                Rif de la empresa
                            </label>
                            <input
                                v-on:change="editInput.push('rif')"
                                v-on:keyup="rifHelper"
                                v-on:focus="editData.rif = 'j-'"
                                v-model="editData.rif"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="company-name"
                                :style="{color: colors ? colors.color5 : '', backgroundColor: colors ? colors.color4 : ''}"
                                :class="{
                                    valid: verifyField('rif') == true,
                                    inValid: verifyField('rif') == false,
                                }"
                                type="text"
                                :placeholder="placeholder.rif"
                            />
                            <p
                                v-if="verifyField('rif') == false"
                                class="text-red-600 text-xs italic"
                            >
                                El formato de rif es invalido (Ejemplo:
                                J-12345678-90)
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="first-email"
                                :style="{color: colors ? colors.color4 : ''}"
                            >
                                1er Email
                            </label>
                            <input
                                v-on:change="editInput.push('email')"
                                v-model="editData.email"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                id="first-email"
                                :style="{color: colors ? colors.color5 : '', backgroundColor: colors ? colors.color4 : ''}"
                                :class="{
                                    valid: verifyField('email') == true,
                                    inValid: verifyField('email') == false,
                                }"
                                type="text"
                                :placeholder="placeholder.email"
                            />
                            <p
                                v-if="verifyField('email') == false"
                                class="text-red-500 text-xs italic"
                                :style="{color: colors ? colors.color3 : ''}"
                            >
                                Por favor ingresa un email válido.
                            </p>
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-last-name"
                                :style="{color: colors ? colors.color4 : ''}"
                            >
                                2do Email
                            </label>
                            <input
                                v-on:change="editInput.push('email2')"
                                v-model="editData.email2"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                :style="{color: colors ? colors.color5 : '', backgroundColor: colors ? colors.color4 : ''}"
                                :class="{
                                    valid: verifyField('email2') == true,
                                    inValid: verifyField('email2') == false,
                                }"
                                id="second-name"
                                type="text"
                                :placeholder="placeholder.email2"
                            />
                            <p
                                v-if="verifyField('email2') == false"
                                class="text-red-500 text-xs italic"
                            >
                                Por favor ingresa un email válido.
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="pais"
                                :style="{color: colors ? colors.color4 : ''}"
                            >
                                PAIS
                            </label>
                            <div class="relative">
                                <select
                                    v-on:change="
                                        editInput.push('pais'),
                                            countrieSelected()
                                    "
                                    v-model="editData.pais"
                                    id="countries"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    :class="{
                                        valid: verifyField('pais') == true,
                                        inValid: verifyField('pais') == false,
                                    }"
                                    :style="{color: colors ? colors.color5 : '', backgroundColor: colors ? colors.color4 : ''}"
                                >
                                    <option :value="null" selected>
                                        Escoge un Pais
                                    </option>
                                    <option
                                        v-for="countrie in countries"
                                        :value="countrie.name"
                                        :key="countrie"
                                    >
                                        {{ countrie.name }}
                                    </option>
                                </select>
                                <p
                                    v-if="verifyField('pais') == false"
                                    class="text-red-500 text-xs italic"
                                >
                                    Escoge un pais.
                                </p>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
                                >
                                    <svg
                                        class="fill-current h-4 w-4"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                    >
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="estado"
                                :style="{color: colors ? colors.color4 : ''}"
                            >
                                Estado
                            </label>
                            <div class="relative">
                                <select
                                    v-on:change="editInput.push('estado')"
                                    v-model="editData.estado"
                                    id="countries"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    :class="{
                                        valid: verifyField('estado') == true,
                                        inValid: verifyField('estado') == false,
                                    }"
                                    :style="{color: colors ? colors.color5 : '', backgroundColor: colors ? colors.color4 : ''}"
                                >
                                    <option :value="null" selected>
                                        Selecciona un estado
                                    </option>
                                    <option
                                        v-for="statesOption in statesOptions"
                                        :value="statesOption"
                                        :key="statesOption"
                                    >
                                        {{ statesOption }}
                                    </option>
                                </select>
                                <p
                                    v-if="verifyField('estado') == false"
                                    class="text-red-500 text-xs italic"
                                    :style="{color: colors ? colors.color3 : ''}"
                                >
                                    escoge un estado.
                                </p>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
                                >
                                    <svg
                                        class="fill-current h-4 w-4"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                    >
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="first-phone"
                                :style="{color: colors ? colors.color4 : ''}"
                            >
                                NRO. TLF 1
                            </label>
                            <input
                                v-on:change="editInput.push('phone')"
                                v-model="editData.phone"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                :class="{
                                    valid: verifyField('phone') == true,
                                    inValid: verifyField('phone') == false,
                                }"
                                :style="{color: colors ? colors.color5 : '', backgroundColor: colors ? colors.color4 : ''}"
                                id="first-phone"
                                type="text"
                                :placeholder="placeholder.phone"
                            />
                            <p
                                v-if="verifyField('phone') == false"
                                class="text-red-500 text-xs italic"
                                :style="{color: colors ? colors.color3 : ''}"
                            >
                                Asegurate de rellenar este campo.
                            </p>
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="second-phone"
                                :style="{color: colors ? colors.color4 : ''}"
                            >
                                NRO. TLF 2
                            </label>
                            <input
                                v-on:change="editInput.push('phone2')"
                                v-model="editData.phone2"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                :class="{
                                    valid: verifyField('phone2') == true,
                                    inValid: verifyField('phone2') == false,
                                }"
                                :style="{color: colors ? colors.color5 : '', backgroundColor: colors ? colors.color4 : ''}"
                                id="second-phone"
                                type="text"
                                :placeholder="placeholder.phone2"
                            />
                            <p
                                v-if="verifyField('phone2') == false"
                                class="text-red-500 text-xs italic"
                                :style="{color: colors ? colors.color3 : ''}"
                            >
                                Formato invalido.
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="direction"
                                :style="{color: colors ? colors.color4 : ''}"
                            >
                                DIRECCIÓN
                            </label>
                            <input
                                v-on:change="editInput.push('direccion')"
                                v-model="editData.direccion"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="direction"
                                type="text"
                                :style="{color: colors ? colors.color5 : '', backgroundColor: colors ? colors.color4 : ''}"
                                :placeholder="placeholder.direccion"
                                :class="{
                                    valid: verifyField('direccion') == true,
                                    inValid: verifyField('direccion') == false,
                                }"
                            />
                        </div>
                    </div>
                    <button
                        v-if="empresa == undefined"
                        class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                        type="submit"
                        v-on:click="registerCompany"
                        :style="{color: colors ? colors.color4 : '', backgroundColor: colors ? colors.color3 : ''}"
                    >
                        Registrar
                    </button>
                    <div v-else class="flex">
                        <button
                            class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                            type="submit"
                            :style="{color: colors ? colors.color4 : '', backgroundColor: colors ? colors.color3 : ''}"
                            v-on:click="editCompany"
                        >
                            Editar
                        </button>
                    </div>
                </form>
            </div>
            <BaseButtons
                v-if="(empresa == undefined) == false"
                type="justify-center lg:justify-start"
            >
                <BaseButton
                    label="Borrar empresa"
                    color="danger"
                    :icon="mdiTrashCan"
                    big
                    @click="isModalDangerActive = true"
                />
            </BaseButtons>
        </SectionMain>
    </LayoutAuthenticated>
</template>

<style scoped>
.valid {
    border: 2px solid green;
}

.inValid {
    border: 2px solid red;
}
</style>
