<template>
    <div class="container">
        <div v-if="apartment">
            <img
                :src="`http://127.0.0.1:8000/storage/${apartment.image}`"
                :alt="apartment.title"
            />
            <h2>{{ apartment.title }}</h2>
            <div>
                <span>{{ apartment.address }}</span>
            </div>
            <div>
                <span>{{ apartment.square_meters }} mq</span>
            </div>
            <div>
                <span
                    >Price per night:
                    <strong>€{{ apartment.price }}</strong></span
                >
            </div>
            <div>
                Available services:
                <ul>
                    <li v-for="service in apartment.services" :key="service.id">
                        <strong>{{ service.name }}</strong>
                    </li>
                </ul>
            </div>
            <div id="map" class="map"></div>
            <router-link
                :to="{ name: 'results', params: { search: this.query } }"
                >Back to results</router-link
            >
        </div>
        <div v-else>Loading...</div>
    </div>
</template>

<script>
import axios from "axios";
import tt from "@tomtom-international/web-sdk-maps";

export default {
    name: "ApartmentDetails",
    data() {
        return {
            apartment: null
        };
    },
    props: ["query"],
    created() {
        this.getDetails();
    },
    updated() {
        this.createMap();
    },
    methods: {
        getDetails() {
            axios
                .get(
                    `http://127.0.0.1:8000/api/apartment=${this.$route.params.slug}`
                )
                .then(response => {
                    this.apartment = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        createMap() {
            tt.setProductInfo("BoolBnB", "1.0");
            tt.map({
                key: "4j77acI2RkgcxaYW2waGQ74SEPwpmFML",
                container: "map",
                center: [12.48, 41.9], //Roma
                zoom: 4
            });
            // var marker = new tt.Marker()
            //     .setLngLat([this.apartment.longitude, this.apartment.latitude])
            //     .addTo(map);
        }
    }
};
</script>

<style lang="scss" scoped>
img {
    max-width: 500px;
}
#map {
    width: 300px;
    height: 300px;
}
</style>
