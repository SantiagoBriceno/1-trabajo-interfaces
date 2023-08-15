<script setup>
import { useMainStore } from "@/Stores/main";
import { Head, router, useForm } from "@inertiajs/vue3";
import SectionMain from "@/components/SectionMain.vue";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";

import { ref, computed } from "vue";

const mainStore = useMainStore();

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

const validator = (input) => {
    switch (input) {
        case "name":
            return isValidName.value;
            break;
        case "rif":
            return isValidRif.value;
            break;
        case "email":
            return isValidEmail.value;
            break;
        case "email2":
            return isValidEmail2.value;
            break;
        case "phone":
            return isValidPhone.value;
            break;
        case "phone2":
            return isValidPhone2.value;
            break;
        case "pais":
            return isValidPais.value;
            break;
        case "estado":
            return isValidEstado.value;
            break;
        case "direccion":
            return isValidDireccion.value;
            break;
        default:
            return false;
            break;
    }
};

const startValidation = ref(false);

const isValidEmail = computed(() => {
    return startValidation.value
        ? /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(editData.email)
        : null;
});

const isValidEmail2 = computed(() => {
    return startValidation.value
        ? editData.email2 == null ||
              /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(
                  editData.email2
              )
        : null;
});

const isValidPhone = computed(() => {
    return startValidation.value
        ? /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/.test(
              editData.phone
          )
        : null;
});

const isValidPhone2 = computed(() => {
    return startValidation.value
        ? editData.phone2 == null ||
              /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/.test(
                  editData.phone2
              )
        : null;
});

const isValidRif = computed(() => {
    return startValidation.value
        ? /^([VEJPGvejpg]{1})-([0-9]{8})-([0-9]{2}$)/.test(editData.rif)
        : null;
});

const isValidName = computed(() => {
    return startValidation.value
        ? editData.name != null && editData.name.length > 3
        : null;
});

const isValidDireccion = computed(() => {
    return startValidation.value
        ? editData.direccion && editData.direccion.length >= 3
        : null;
});

const isValidPais = computed(() => {
    return startValidation.value ? editData.pais != null : null;
});

const isValidEstado = computed(() => {
    return startValidation.value ? editData.estado != null : null;
});

const isValidFormRegister = computed(() => {
    return (
        startValidation.value == true &&
        isValidEmail.value &&
        isValidEmail2.value &&
        isValidPhone.value &&
        isValidPhone2.value &&
        isValidRif.value &&
        isValidName.value &&
        isValidDireccion.value &&
        isValidPais.value &&
        isValidEstado.value
    );
});

const registerCompany = (event) => {
    event.preventDefault();
    startValidation.value = true;

    if (isValidFormRegister.value) {
        editData.put(route("company.create"), {
            preserveScroll: true,
            onSuccess: () => {
                editData.reset();
                editData.status = true;
                startValidation.value = false;
            },
        });
    } else {
        console.log(isValidPhone2.value);
        console.log("invalid form");
    }
};

const editInput = ref([]);

const verifyEditsInput = (editInput) => {
    
    for(field in editInput){
        if (validator(field) == false){
            return false
        }
    }

    return true
    
};

const editCompany = (event) => {
    event.preventDefault();
};

const deleteCompany = (event) => {
    event.preventDefault();
    startValidation.value = true;

    if (isValidForm.value) {
        editData.put(route("company.create"), {
            preserveScroll: true,
            onSuccess: () => {
                editData.reset();
                editData.status = true;
                startValidation.value = false;
            },
        });
    } else {
        console.log("invalid form");
    }
};

const countries = ["Germany", "Spain", "Norway", "England", "Venezuela"];
</script>

<template>
    {{
        (placeholder = {
            name: empresa == undefined ? "Example SA" : empresa[0].name,
            rif: empresa == undefined ? "J-01234567-00" : empresa[0].rif,
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

            <div class="flex justify-center">
                <form class="w-full max-w-lg content-center">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="company-name"
                            >
                                Nombre de la empresa
                            </label>
                            <input
                                v-on:change="editInput.push('name')"
                                v-model="editData.name"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                :class="{
                                    valid: isValidName == true,
                                    inValid: isValidName == false,
                                }"
                                id="company-name"
                                type="text"
                                :placeholder="placeholder.name"
                            />
                            <p
                                v-if="isValidName == false"
                                class="text-red-600 text-xs italic"
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
                            >
                                Rif de la empresa
                            </label>
                            <input
                                v-on:change="editInput.push('rif')"
                                v-model="editData.rif"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="company-name"
                                :class="{
                                    valid: isValidRif == true,
                                    inValid: isValidRif == false,
                                }"
                                type="text"
                                :placeholder="placeholder.rif"
                            />
                            <p
                                v-if="isValidRif == false"
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
                            >
                                1er Email
                            </label>
                            <input
                                v-on:change="editInput.push('email')"
                                v-model="editData.email"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                id="first-email"
                                :class="{
                                    valid: isValidEmail == true,
                                    inValid: isValidEmail == false,
                                }"
                                type="text"
                                :placeholder="placeholder.email"
                            />
                            <p
                                v-if="isValidEmail == false"
                                class="text-red-500 text-xs italic"
                            >
                                Asegurate de rellenar este campo.
                            </p>
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-last-name"
                            >
                                2do Email
                            </label>
                            <input
                                v-on:change="editInput.push('email2')"
                                v-model="editData.email2"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                :class="{
                                    valid: isValidEmail2 == true,
                                    inValid: isValidEmail2 == false,
                                }"
                                id="grid-last-name"
                                type="text"
                                :placeholder="placeholder.email2"
                            />
                            <p
                                v-if="isValidEmail2 == true"
                                class="text-red-500 text-xs italic"
                            ></p>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="first-phone"
                            >
                                NRO. TLF 1
                            </label>
                            <input
                                v-on:change="editInput.push('phone')"
                                v-model="editData.phone"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                :class="{
                                    valid: isValidPhone == true,
                                    inValid: isValidPhone == false,
                                }"
                                id="first-phone"
                                type="text"
                                :placeholder="placeholder.phone"
                            />
                            <p
                                v-if="isValidPhone == false"
                                class="text-red-500 text-xs italic"
                            >
                                Asegurate de rellenar este campo.
                            </p>
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="second-phone"
                            >
                                NRO. TLF 2
                            </label>
                            <input
                                v-on:change="editInput.push('phone2')"
                                v-model="editData.phone2"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                :class="{
                                    valid: isValidPhone2 == true,
                                    inValid: isValidPhone2 == false,
                                }"
                                id="second-phone"
                                type="text"
                                :placeholder="placeholder.phone2"
                            />
                            <p
                                v-if="isValidPhone2 == false"
                                class="text-red-500 text-xs italic"
                            >
                                Formato invalido.
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="pais"
                            >
                                PAIS
                            </label>
                            <div class="relative">
                                <select
                                    v-on:select="editInput.push('pais')"
                                    v-model="editData.pais"
                                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="pais"
                                >
                                    <option
                                        v-for="pais in countries"
                                        :key="pais"
                                        :value="pais"
                                    >
                                        {{ pais }}
                                    </option>
                                    <option selected>
                                        <!-- {{ empresa[0].pais }} -->
                                    </option>
                                </select>
                                <p
                                    v-if="isValidPais == false"
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
                            >
                                Estado
                            </label>
                            <div class="relative">
                                <select
                                    v-on:select="editInput.push('estado')"
                                    v-model="editData.estado"
                                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="estado"
                                >
                                    <option value="asdasd">New Mexico</option>
                                    <option value="asdasd">Missouri</option>
                                    <option value="asdasd">Texas</option>
                                    <!-- <option selected :value="empresa[0].estado"> -->
                                    <!-- {{ empresa[0].estado }} -->
                                    <!-- </option> -->
                                </select>
                                <p
                                    v-if="isValidEstado == false"
                                    class="text-red-500 text-xs italic"
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
                        <div class="w-full px-3">
                            <label
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="direction"
                            >
                                DIRECCIÓN
                            </label>
                            <input
                                v-on:change="editInput.push('direccion')"
                                v-model="editData.direccion"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="direction"
                                type="text"
                                :placeholder="placeholder.direccion"
                            />
                        </div>
                    </div>
                    {{ editInput }}

                    <button
                        v-if="empresa == undefined"
                        class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                        type="submit"
                        v-on:click="registerCompany"
                    >
                        Registrar
                    </button>
                    <div v-else class="flex">
                        <button
                            class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                            type="submit"
                            v-on:click="editCompany"
                        >
                            Editar
                        </button>

                        <button
                            class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                            type="submit"
                            v-on:click="deleteCompany"
                        >
                            Borrar
                        </button>
                    </div>
                </form>
            </div>
        </SectionMain>
    </LayoutAuthenticated>
</template>

<style scoped>
.valid {
    border: 1px solid green;
}

.inValid {
    border: 1px solid red;
}
</style>
