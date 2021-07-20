<template>
    <div class="container">
        <h1>{{ apartment.title }}</h1>
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

<style></style>
