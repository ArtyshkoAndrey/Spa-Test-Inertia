<template>
  <app-header></app-header>
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <form method="post" @submit.prevent="submit">
        <h2 class="text-center">Sign In</h2>
        <errors-and-messages :errors="errors"></errors-and-messages>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" class="form-control" name="email" id="email" v-model="form.email" />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" id="password" v-model="form.password" />
        </div>
        <input type="submit" class="btn btn-primary btn-block" value="Login" />
      </form>
    </div>
  </div>
</template>
<script>
import AppHeader from "../../Partials/AppHeader";
import ErrorsAndMessages from "../../Partials/ErrorsAndMessages";
import {Inertia} from "@inertiajs/inertia";
import { usePage } from '@inertiajs/inertia-vue3'
import {reactive,inject} from 'vue';
export default {
  components: {
    ErrorsAndMessages,
    AppHeader
  },
  name: "Login",
  props: {
    errors: Object
  },
  setup() {
    const form = reactive({
      email: null,
      password: null,
      _token: usePage().props.value.csrf_token
    });
    const route = inject('$route');
    function submit() {
      Inertia.post(route('login'), form);
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
