<template>
  <div>
    <v-card :to="'/campaign/'+ campaign.id">
      <v-img :src="campaign.image" class="white--text">
        <v-card-title class="fill-height align-end" v-text="campaign.title"></v-card-title>
      </v-img>
    </v-card>
  </div>
</template>

<script>
export default {
  props: ["campaign"]
};
</script>