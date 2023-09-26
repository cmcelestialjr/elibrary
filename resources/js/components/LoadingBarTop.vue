<template>
    <div v-if="isLoading" class="loading-bar"></div>
</template>
  
<script>
  export default {
    props: {
      isLoading: Boolean,
    },
  };
</script>