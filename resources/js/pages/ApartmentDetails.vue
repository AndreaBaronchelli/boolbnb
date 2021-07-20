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
    methods: {
        getDetails() {
            axios
                .get(
                    `http://127.0.0.1:8000/api/apartment=${this.$route.params.slug}`
                )
                .then(response => {
                    console.log(response.data);
                    this.apartment = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>

<style lang="scss" scoped>
img {
    max-width: 500px;
}
</style>
