<template>
  <div style="height: 500px; width: 100%">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@2.6.0/assets/css/leaflet.css">
    <p>lat : {{targetMarker.lat}}</p>
    <p>lng : {{targetMarker.lng}}</p>
    <p>searched Result : {{targetMarker.searchedResult}}</p>
    <l-map
        ref="map"
        v-if="showMap"
        :zoom="zoom"
        :center="center"
        :options="mapOptions"
        style="z-index: 0; height: 80%"
        @update:center="centerUpdate"
        @update:zoom="zoomUpdate"
    >
      <l-tile-layer
          :url="url"
          :attribution="attribution"
      />
      <v-geosearch :options="geosearchOptions"></v-geosearch>
      <l-marker :lat-lng="withPopup">
        <l-popup>
          <div @click="innerClick">
            I am a popup
            <p v-show="showParagraph">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque
              sed pretium nisl, ut sagittis sapien. Sed vel sollicitudin nisi.
              Donec finibus semper metus id malesuada.
            </p>
          </div>
        </l-popup>
      </l-marker>
      <l-marker :lat-lng="withTooltip">
        <l-tooltip :options="{ permanent: true, interactive: true }">
          <div @click="innerClick">
            I am a tooltip
            <p v-show="showParagraph">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque
              sed pretium nisl, ut sagittis sapien. Sed vel sollicitudin nisi.
              Donec finibus semper metus id malesuada.
            </p>
          </div>
        </l-tooltip>
      </l-marker>
    </l-map>
  </div>
</template>

<script>
import L from "leaflet";
import {LMap, LTileLayer, LMarker, LPopup, LTooltip} from "vue2-leaflet";
import {OpenStreetMapProvider} from 'leaflet-geosearch';
import VGeosearch from 'vue2-leaflet-geosearch';

export default {
  name: "CreateMap",
  components: {
    LMap,
    LTileLayer,
    LMarker,
    LPopup,
    LTooltip,
    VGeosearch
  },
  data() {
    return {
      zoom: 13,
      center: L.latLng(47.41322, -1.219482),
      url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
      attribution:
          '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
      withPopup: L.latLng(47.41322, -1.219482),
      withTooltip: L.latLng(47.41422, -1.250482),
      currentZoom: 11.5,
      currentCenter: L.latLng(47.41322, -1.219482),
      showParagraph: false,
      mapOptions: {
        zoomSnap: 0.5
      },
      showMap: true,
      geosearchOptions: {
        marker: {
          // optional: L.Marker    - default L.Icon.Default
          icon: new L.Icon.Default(),
          draggable: true,
        },
        provider: new OpenStreetMapProvider({
          params: {
            email: 'znirgal@gmail.com', // auth for large number of requests
          },
        }),
        autoClose: true,
        style: 'bar',
      },
      targetMarker: {lat : 0, lng: 0, searchedResult : ''},
    };
  },
  methods: {
    zoomUpdate(zoom) {
      this.currentZoom = zoom;
    },
    centerUpdate(center) {
      this.currentCenter = center;
    },
    showLongText() {
      this.showParagraph = !this.showParagraph;
    },
    innerClick() {
      alert("Click!");
    }
  },
  mounted() {
    this.$refs.map.mapObject.on("geosearch/showlocation", response => {
      let marker = L.marker(L.latLng(response.location.y, response.location.x), {draggable: true}).addTo(this.$refs.map.mapObject);
      this.targetMarker.lat = marker.getLatLng().lat;
      this.targetMarker.lng = marker.getLatLng().lng;
      this.targetMarker.searchedResult = response.location.label;
      marker.on('move', () => {
        this.targetMarker.lat = marker.getLatLng().lat;
        this.targetMarker.lng = marker.getLatLng().lng;
      })
    });
  }
}

</script>

<style>
.leaflet-control-geosearch {
    color: black !important;
}
</style>