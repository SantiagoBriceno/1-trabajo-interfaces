<script setup>

// defineProps({
//   arrayList: Array
//  });

const arrayList = [
    {
    name:'Andres',
    role:'Admin',
    createdAt: '12/09/2023',
    status: 'active',
    id: 1
    },
    {
    name:'Santiago',
    role:'Admin',
    createdAt: '01/08/2013',
    status: 'active',
    id: 2
    },
    {
    name:'Carlos',
    role:'Cliente',
    createdAt: '07/04/2019',
    status: 'inactive',
    id: 3
    }
]

</script>
<template>
  <div class="container max-w-3xl px-4 mx-auto sm:px-8">
    <div class="py-8">
      <div class="flex flex-row justify-between w-full mb-1 sm:mb-0">
        <h2 class="text-2xl leading-tight">Users</h2>
        <div class="text-end"></div>
      </div>
      <div class="px-4 py-4 -mx-4 overflow-x-auto sm:-mx-8 sm:px-8">
        <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
          <table class="min-w-full leading-normal">
            <thead>
              <tr>
                <th
                  scope="col"
                  class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200"
                >
                  User
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="user of arrayList" :key="user.id">
                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                  <div class="flex items-center">
                    <div class="flex-shrink-0">
                      <a href="#" class="relative block"></a>
                    </div>
                    <div class="ml-3">
                      <p class="text-gray-900 whitespace-no-wrap">{{user.name}}c</p>
                    </div>
                  </div>
                </td>
                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                  <p class="text-gray-900 whitespace-no-wrap">{{user.role}}</p>
                </td>
                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                  <p class="text-gray-900 whitespace-no-wrap">{{user.createdAt}}</p>
                </td>
                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                  <p class="text-gray-900 whitespace-no-wrap">{{user.createdAt}}</p>
                </td>
                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                  <span
                    class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900"
                  >
                    <span
                      aria-hidden="true"
                      class="absolute inset-0 bg-green-200 rounded-full opacity-50"
                    >
                    </span>
                    <span class="relative"> {{ user.status }} </span>
                  </span>
                </td>
                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                  <a href="#" class="text-indigo-600 hover:text-indigo-900">
                    Edit
                  </a>
                </td>
                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                  <a href="#" class="text-indigo-600 hover:text-indigo-900">
                    Delete
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

