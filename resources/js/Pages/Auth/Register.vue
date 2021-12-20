<template>
  <app-header></app-header>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <form method="post" @submit.prevent="submit">
          <h2 class="text-center">Create New Account</h2>

          <errors-and-messages :errors="errors"></errors-and-messages>

          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" v-model="form.name"/>
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" id="email" v-model="form.email"/>
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" v-model="form.password"/>
          </div>

          <input type="submit" class="btn btn-primary btn-block" value="Register"/>
        </form>
      </div>
    </div>
  </div>

</template>

<script>
import AppHeader from "../../Partials/AppHeader";
import ErrorsAndMessages from "../../Partials/ErrorsAndMessages";

import {inject, reactive} from "vue";
import {usePage} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";

export default {
  name: "Register",
  components: {
    ErrorsAndMessages,
    AppHeader
  },
  props: {
    errors: Object
  },
  setup() {
    const form = reactive({
      name: null,
      email: null,
      password: null,
      _token: usePage().props.value.csrf_token
    });

    const route = inject('$route');

    function submit() {
      Inertia.post(route('register'), form);
    }

    return {
      form, submit
    }
  }
}
</script>

<style scoped>
form {
  margin-top: 20px;
}
</style>