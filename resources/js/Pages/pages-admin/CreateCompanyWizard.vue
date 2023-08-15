<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import SectionMain from "@/components/SectionMain.vue";
import { FormWizard, TabContent } from "vue3-form-wizard";
import "../../../css/index.css";
import { ref, computed } from "vue";

defineProps({
    empresa: {
        type: Array,
    },
});

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

let onCompleteCondition = ref(false);

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
                /^([VEJPGvejpg]{1})-([0-9]{8})-([0-9]{2}$)/.test(editData.rif)
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

        case "phone":
            if (editData.phone == null) {
                return null;
            } else if (
              /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/.test(editData.phone)
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
              /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/.test(editData.phone2)
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

const verifyStep = () => {
    if (editInput.value.length == 0) {
        return true;
    } else {
        for(let i = 0; i < editInput.value.length; i++){
            if(verifyField(editInput.value[i]) == false){
                return false
            }
        }

        return true;
    }
};

const nextStep = () => {
  console.log('alskjdlaksjd')
  return verifyStep();
}

const rifHelper = computed({
  
})

function onComplete() {
    switch (onCompleteCondition.value) {
      case true:
        console.log('aqui deberia registrar con estos datos', editData)
      
        break;

      default:
        console.log('aqui deberia actualizar con estos datos', editData)
        break;
    }
    alert("Yay. Done!");
}
</script>

<template>
    {{
        empresa == undefined ? onCompleteCondition = true : onCompleteCondition = false,
        (placeholder = {
            name: empresa == undefined ? "Example SA" : empresa[0].name,
            rif:
                empresa == undefined
                    ? "01234567-00"
                    : empresa[0].rif.substring(2),
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
    <Head title="Mi Empresa" />
    <LayoutAuthenticated>
        <SectionMain>
            <div class="flex flex-wrap mb-4 h-128">
                <div
                    class="w-1/3 ml-auto bg-white-400 flex justify-center items-center"
                >
                    <div class="flex flex-col justify-center">
                        <div
                            class="rounded-full h-48 w-48 flex bg-teal-400 m-2 flex text-center justify-center items-center text-white"
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
                    </div>
                </div>
            </div>

            <FormWizard @on-complete="onComplete" color="#094899">
                <TabContent title="Datos de la empresa" icon="fa fa-city" v-bind:beforeChange="nextStep">
                    <!-- FORMULARIO -->

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <!-- ESTE DIV CONTIENE EL INPUT DEL NOMBRE -->
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label
                                for="website-admin"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Nombre de la empresa</label
                            >
                            <div class="flex flex-col">
                                <div class="flex">
                                    <span
                                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-black-600 dark:text-gray-400 dark:border-gray-600"
                                    >
                                        <svg
                                            class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                            aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"
                                            />
                                        </svg>
                                    </span>
                                    <input
                                        v-on:change="editInput.push('name')"
                                        v-model="editData.name"
                                        type="text"
                                        id="website-admin"
                                        class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-white-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        :placeholder="placeholder.name"
                                        :class="{
                                            valid: verifyField('name') == true,
                                            inValid:
                                                verifyField('name') == false,
                                        }"
                                    />
                                </div>
                                <p
                                    v-if="verifyField('name') == false"
                                    class="text-red-600 text-xs italic"
                                >
                                    Por favor coloca un nombre válido
                                </p>
                            </div>
                        </div>

                        <!-- ESTE DIV CONTIENE EL INPUT DEL RIF -->
                        <div class="w-full md:w-1/2 px-3">
                            <label
                                for="website-admin"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                >Rif</label
                            >
                            <div class="flex flex-col">
                                <div class="flex">
                                    <span
                                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600"
                                    >
                                        J-
                                    </span>
                                    <input
                                        v-on:change="editInput.push('rif')"
                                        v-model="editData.rif"
                                        type="text"
                                        id="website-admin"
                                        class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        :placeholder="placeholder.rif"
                                        :class="{
                                            valid: verifyField('rif') == true,
                                            inValid:
                                                verifyField('rif') == false,
                                        }"
                                    />
                                </div>
                                <p
                                    v-if="verifyField('rif') == false"
                                    class="text-red-600 text-xs italic"
                                >
                                    El formato de rif es invalido (Ejemplo:
                                    J-12345678-90)
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <!-- ESTE DIV CONTIENE EL INPUT DEL EMAIL 1-->
                        <div class="w-full md:w-1/2 px-3">
                            <label
                                for="email-address-icon"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Email Nro. 1</label
                            >
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none"
                                >
                                    <svg
                                        class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor"
                                        viewBox="0 0 20 16"
                                    >
                                        <path
                                            d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"
                                        />
                                        <path
                                            d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"
                                        />
                                    </svg>
                                </div>
                                <input
                                    v-on:change="editInput.push('email')"
                                    v-model="editData.email"
                                    type="text"
                                    id="email-address-icon"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    :placeholder="placeholder.email"
                                    :class="{
                                        valid: verifyField('email') == true,
                                        inValid: verifyField('email') == false,
                                    }"
                                />
                            </div>
                            <p
                                v-if="verifyField('email') == false"
                                class="text-red-500 text-xs italic"
                            >
                                Por favor ingresa un email válido.
                            </p>
                        </div>

                        <!-- ESTE DIV CONTIENE EL EMAIL 2 -->
                        <div class="w-full md:w-1/2 px-3">
                            <label
                                for="email-address-icon"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Email Nro. 2</label
                            >
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none"
                                >
                                    <svg
                                        class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor"
                                        viewBox="0 0 20 16"
                                    >
                                        <path
                                            d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"
                                        />
                                        <path
                                            d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"
                                        />
                                    </svg>
                                </div>
                                <input
                                    v-on:change="editInput.push('email2')"
                                    v-model="editData.email2"
                                    type="text"
                                    id="email-address-icon"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    :placeholder="placeholder.email2"
                                    :class="{
                                        valid: verifyField('email2') == true,
                                        inValid: verifyField('email2') == false,
                                    }"
                                />
                            </div>
                            <p
                                v-if="verifyField('email2') == false"
                                class="text-red-500 text-xs italic"
                            >
                                Por favor ingresa un email válido.
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <!-- ESTE DIV CONTIENE EL INPUT DEL TLF 1-->
                        <div class="w-full md:w-1/2 px-3">
                            <label
                                for="email-address-icon"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Teléfono 1</label
                            >
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none"
                                >
                                    <svg
                                        class="w-6 h-6 text-gray-800 dark:text-white"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor"
                                        viewBox="0 0 19 18"
                                    >
                                        <path
                                            d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z"
                                        />
                                    </svg>
                                </div>
                                <input
                                    v-on:change="editInput.push('phone')"
                                    v-model="editData.phone"
                                    type="text"
                                    id="first-phone"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    :placeholder="placeholder.phone"
                                    :class="{
                                        valid: verifyField('phone') == true,
                                        inValid: verifyField('phone') == false,
                                    }"
                                />
                            </div>
                            <p
                                v-if="verifyField('phone') == false"
                                class="text-red-500 text-xs italic"
                            >
                                Asegurate de rellenar este campo.
                            </p>
                        </div>

                        <!-- ESTE DIV CONTIENE EL TLF 2 -->
                        <div class="w-full md:w-1/2 px-3">
                            <label
                                for="email-address-icon"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Teléfono</label
                            >
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none"
                                >
                                    <svg
                                        class="w-6 h-6 text-gray-800 dark:text-white"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor"
                                        viewBox="0 0 19 18"
                                    >
                                        <path
                                            d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z"
                                        />
                                    </svg>
                                </div>
                                <input
                                    v-on:change="editInput.push('phone2')"
                                    v-model="editData.phone2"
                                    type="text"
                                    id="second-phone"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    :placeholder="placeholder.phone2"
                                    :class="{
                                        valid: verifyField('phone2') == true,
                                        inValid: verifyField('phone2') == false,
                                    }"
                                />
                            </div>
                            <p
                                v-if="verifyField('phone2') == false"
                                class="text-red-500 text-xs italic"
                            >
                                Asegurate de rellenar este campo.
                            </p>
                        </div>
                    </div>
                </TabContent>
                <TabContent title="Dirección" icon="fa fa-map-marker">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <!-- ESTE DIV CONTIENE EL INPUT DEL PAIS -->
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label
                                for="countries"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Selecciona el país</label
                            >
                            <select
                                v-on:change="editInput.push('pais')"
                                v-model="editData.pais"
                                id="countries"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                :class="{
                                    valid: verifyField('pais') == true,
                                    inValid: verifyField('pais') == false,
                                }"
                            >
                                <option>United States</option>
                                <option>Canada</option>
                                <option>France</option>
                                <option>Germany</option>
                            </select>
                            <p
                                v-if="verifyField('pais') == false"
                                class="text-red-500 text-xs italic"
                            >
                                Escoge un pais.
                            </p>
                        </div>

                        <!-- ESTE DIV CONTIENE EL INPUT DE LA CIUDAD -->
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label
                                for="countries"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Selecciona el estado</label
                            >
                            <select
                                v-on:change="editInput.push('estado')"
                                v-model="editData.estado"
                                id="countries"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                :class="{
                                    valid: verifyField('estado') == true,
                                    inValid: verifyField('estado') == false,
                                }"
                            >
                                <option>United States</option>
                                <option>Canada</option>
                                <option>France</option>
                                <option>Germany</option>
                            </select>
                            <p
                                v-if="verifyField('estado') == false"
                                class="text-red-500 text-xs italic"
                            >
                                escoge un estado.
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-password"
                            >
                                DIRECCIÓN
                            </label>
                            <input
                                v-on:change="editInput.push('direccion')"
                                v-model="editData.direccion"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-password"
                                type="text"
                                :placeholder="placeholder.direccion"
                                :class="{
                                    valid: verifyField('direccion') == true,
                                    inValid: verifyField('direccion') == false,
                                }"
                            />
                            <p
                                    v-if="verifyField('direccion') == false"
                                    class="text-red-500 text-xs italic"
                                >
                                    Ingresa una dirección válida Por favor.
                                </p>
                        </div>
                    </div>
                </TabContent>
            </FormWizard>
        </SectionMain>
    </LayoutAuthenticated>
</template>

<style scoped>
@import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css");

.valid {
    border: 1px solid green;
}

.inValid {
    border: 1px solid rgb(235, 147, 147);
}
</style>
