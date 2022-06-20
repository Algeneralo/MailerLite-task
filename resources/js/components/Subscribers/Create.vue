<template>
  <div>
    <div v-show="error!=''"
         class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
         role="alert">
      <span class="font-medium">Error!</span>
      {{ error }}
    </div>
    <form ref="form">
      <div class="mb-6">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
        <input type="email" id="email" v-model="subscriber.email"
               class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
               placeholder="name@flowbite.com" required>
      </div>
      <div class="mb-6">
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
        <input type="text" id="name" v-model="subscriber.name"
               class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
               placeholder="Name Surname" required>
      </div>
      <div class="mb-6">
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">State</label>
        <select id="states" required v-model="subscriber.state"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
          <option disabled selected>Choose a state</option>
          <option :value="state" v-for="state in states">{{ state }}</option>
        </select>
      </div>
      <label class="block mb-2 text-sm font-medium text-gray-900">Fields</label>

      <div v-for="(field, index) in fields" :key="index" class="row mb-3">
        <div class="col-lg-4">
          <input type="text" id="title" v-model="field.title"
                 class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                 placeholder="Title" required>
        </div>
        <div class="col-lg-4">
          <select id="states" required v-model="field.type"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option selected>Choose a type</option>
            <option :value="type" v-for="type in field_types">{{ type }}</option>
          </select>
        </div>
        <div class="col-lg-2">
          <div class="block float-left center align-baseline">
            <button type="button" @click="removeField(index)"
                    class="align-bottom bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded">
              <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                   viewBox="0 0 16 16">
                <path
                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                <path fill-rule="evenodd"
                      d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
              </svg>
            </button>
            <button type="button" v-if="index + 1 === fields.length" @click="addField"
                    class="align-bottom bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-2 rounded">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus"
                   viewBox="0 0 16 16">
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
              </svg>
            </button>
          </div>
        </div>
      </div>
      <button type="submit" @click="create"
              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Submit
      </button>
    </form>
  </div>
</template>

<script>

export default {
  props: [
    'states',
    'field_types',
  ],
  data() {
    return {
      subscriber: {},
      fields: [],
      blockRemoval: true,
      error: ''
    }
  },
  watch: {
    fields() {
      this.blockRemoval = this.fields.length <= 1
    }
  },
  methods: {
    addField() {
      let checkEmptyFields = this.fields.filter(field => field.number === null)
      if (checkEmptyFields.length >= 1 && this.fields.length > 0) {
        return
      }
      this.fields.push({
        type: null,
        title: null,
      })
    },
    removeField(fieldId) {
      if (!this.blockRemoval) {
        this.fields.splice(fieldId, 1)
      }
    },
    create(e) {
      this.error = '';
      if (!this.$refs['form'].checkValidity()) {
        return;
      }
      e.preventDefault();

      let component = this;
      console.log(this.fields)
      window.axios.post('/api/v1/subscribers', {
        name: this.subscriber.name,
        email: this.subscriber.email,
        state: this.subscriber.state,
        fields: this.fields
      })
          .then((res) => {
            location.href = '/subscribers';
          }).catch(function (error) {
        console.log(error.response)
        component.error = error.response.data.message;
      });
    }
  },

  mounted() {
    this.addField()
  }
}
</script>

<style>

</style>