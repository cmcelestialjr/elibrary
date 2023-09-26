<template>
    <div>
      <h1>Register</h1>
      <form @submit.prevent="register">
        <input v-model="name" type="text" placeholder="Name">
        <input v-model="email" type="email" placeholder="Email">
        <input v-model="password" type="password" placeholder="Password">
        <button type="submit">Register</button>
      </form>
      <vue-loading-overlay :active="loading" :can-cancel="false"></vue-loading-overlay>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        name: '',
        email: '',
        password: '',
        loading: false,
      };
    },
    methods: {
      async register() {
        this.loading = true;
        try {
          // Implement your registration logic here
          // For example, you can make an API request to your Laravel backend
          // Once the registration is complete, set loading to false
          // Example: await authService.register(this.name, this.email, this.password);
          this.loading = false;
          // Redirect the user to the login page upon successful registration
          this.$router.push('/login');
        } catch (error) {
          this.loading = false;
          // Handle registration errors here
        }
      },
    },
  };
  </script>
  
  <style scoped>
  /* Add your component-specific styles here */
  </style>
  