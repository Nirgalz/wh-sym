<template>
  <div>
    <v-alert
        type="info"
    >{{ message }}</v-alert>
    <LeafletMap></LeafletMap>
  </div>
</template>

<script>
import LeafletMap from "./LeafletMap";
import TopMenu from "./TopMenu";

export default {
  name: 'Home',
  props: {},
  components: {
    TopMenu,
    LeafletMap
  },
  data: () => ({
    message: 'Hello Symfony + Vue.js!',
  }),
}
</script>
