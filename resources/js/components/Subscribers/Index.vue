<template>
  <div>
    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
      <thead class="bg-gray-100 dark:bg-gray-700">
        <tr>
          <th scope="col"
              class="py-3 px-6 text-xs font-medium tracking-wider text-left text-white uppercase">
            #
          </th>
          <th scope="col"
              class="py-3 px-6 text-xs font-medium tracking-wider text-left text-white uppercase">
            Email
          </th>
          <th scope="col"
              class="py-3 px-6 text-xs font-medium tracking-wider text-left text-white uppercase">
            Name
          </th>

          <th scope="col"
              class="py-3 px-6 text-xs font-medium tracking-wider text-left text-white uppercase">
            State
          </th>
          <th scope="col" class="p-4">
            <span class="sr-only">Edit</span>
          </th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr class="hover:bg-gray-100 border-gray-500" v-for="subscriber in subscribers">
          <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap">
            {{ subscriber.id }}
          </td>
          <td class="py-4 px-6 text-sm font-medium text-gray-500 whitespace-nowrap">
            {{ subscriber.email }}
          </td>
          <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap">
            {{ subscriber.name }}
          </td>
          <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap">
            <span
                class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
              {{ subscriber.state }}
            </span>

          </td>
          <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
            <a :href="'/subscribers/'+subscriber.id+'/edit'" class="text-blue-600 dark:text-blue-500 hover:underline">
              Edit
            </a>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="mt-4">
      <Pagination :data="response" @pagination-change-page="getResults"/>
    </div>

  </div>
</template>

<script>
import LaravelVuePagination from 'laravel-vue-pagination';

export default {
  components: {
    'Pagination': LaravelVuePagination
  },
  data: function () {
    return {
      subscribers: [],
      response: {},
    }
  },
  mounted() {
    this.getResults();

  },
  methods: {
    getResults(page = 1) {
      window.axios.get('/api/v1/subscribers?page=' + page).then(res => {
        this.response = res.data
        this.subscribers = res.data.data
      })
    }
  }
}
</script>

<style>

</style>