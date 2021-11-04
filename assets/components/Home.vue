<template>
  <div>
    <v-alert
        type="success"
    >{{ message }}</v-alert>
    <LeafletMap></LeafletMap>
  </div>
</template>

<script>
import LeafletMap from "./LeafletMap";

export default {
  name: 'Home',
  props: {},
  components: {
    LeafletMap
  },
  data: () => ({
    message: 'Hello Symfony + Vue.js!',
  }),
}
</script>
