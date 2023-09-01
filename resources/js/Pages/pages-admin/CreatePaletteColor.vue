<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import SectionMain from "@/components/SectionMain.vue";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";

import { ref, computed, onMounted } from "vue";

const props = defineProps({
    colors: { type: Object },
});

const PREDEF_COLORS = {
    color1: "#D90416",
    color2: "#F2508B",
    color3: "#0762D9",
    color4: "#F27507",
    color5: "#F2BFAC",
};

let editData = useForm({
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

// const toggleColor = (event) => {
//     const target = event.target.id;
//     const color = event.target.value;
//     switch (target) {
//         case "first-color":
//             document.getElementById(
//                 "first-color-circle"
//             ).style.backgroundColor = color;
//             break;
//         case "second-color":
//             document.getElementById(
//                 "second-color-circle"
//             ).style.backgroundColor = color;
//             break;
//         case "third-color":
//             document.getElementById(
//                 "third-color-circle"
//             ).style.backgroundColor = color;
//             break;
//         case "four-color":
//             document.getElementById("four-color-circle").style.backgroundColor =
//                 color;
//             break;
//         case "five-color":
//             document.getElementById("five-color-circle").style.backgroundColor =
//                 color;
//             break;
//     }
// };
const registerColors = (event) => {
    event.preventDefault();

    editData.put(route("colors.create"), {
        preserveScroll: true,
        onSuccess: () => {
            editData.reset();
            editData.status = true;
        },
    });
};

const editColors = (event) => {
    event.preventDefault();
    editData.patch(route("colors.edit"), {
        preserveScroll: true,
        onSuccess: () => {
            editData.reset();
            editData.status = true;
        },
    });
};
</script>

<template>
    <Head title="Mis colores" />
    <LayoutAuthenticated>
        <SectionMain>
            <div class="bg-white-400 flex justify-center items-center">
                <form class="flex flex-col justify-center mt-24">
                    <div class="flex justify-center items-center">
                        <div class="flex flex-col justify-center items-center">
                            <div
                                id="first-color-circle"
                                class="rounded-full h-48 w-48 m-2 flex text-center justify-center items-center text-white"
                                :style="`background-color: ${editData.color1};`"
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
                        </div>

                        <div class="flex flex-col justify-center items-center">
                            <div
                                id="second-color-circle"
                                class="rounded-full h-48 w-48 bg-teal-400 m-2 flex text-center justify-center items-center text-white"
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
                        </div>

                        <div class="flex flex-col justify-center items-center">
                            <div
                                id="third-color-circle"
                                class="rounded-full h-48 w-48 bg-[#722727] m-2 flex text-center justify-center items-center text-white"
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
                        </div>

                        <div class="flex flex-col justify-center items-center">
                            <div
                                id="four-color-circle"
                                class="rounded-full h-48 w-48 m-2 flex text-center justify-center items-center text-white"
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
                        </div>

                        <div class="flex flex-col justify-center items-center">
                            <div
                                id="five-color-circle"
                                class="rounded-full h-48 w-48 bg-[#1c1c1c] m-2 flex text-center justify-center items-center text-white"
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
                        </div>
                    </div>

                    <div class="flex justify-center items-center">
                        <button
                            v-if="colors == undefined"
                            class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline mt-10 focus:outline-none text-white font-bold py-2 px-4 rounded"
                            type="submit"
                            v-on:click="registerColors"
                        >
                            Registrar nueva paleta de colores
                        </button>

                        <button
                            v-else
                            class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline mt-10 focus:outline-none text-white font-bold py-2 px-4 rounded"
                            type="submit"
                            v-on:click="editColors"
                        >
                            Guardar los cambios
                        </button>
                    </div>
                    {{ editData }}
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
