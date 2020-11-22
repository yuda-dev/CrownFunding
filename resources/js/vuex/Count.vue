<template>
  <div>{{ $store.state.count }}</div>
</template>

<script>
export default {
  data() {
    return {};
  },

  created() {
    console.log(this.$store.state.count);
  }
};
</script>