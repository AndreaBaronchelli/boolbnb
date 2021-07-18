<template>
    <div>
        <Header @searchText="performSearch" />

        <main>
            <!-- <router-view></router-view> -->
            <ul>
                <li v-for="apartment in apartmentsArray" :key="apartment.id">
                    {{ apartment.title }}
                </li>
            </ul>
        </main>
    </div>
</template>

<script>
import axios from "axios";
import Header from "./components/Header.vue";
export default {
    name: "App",
    components: {
        Header
    },
    data() {
        return {
            apartmentsArray: []
        };
    },
    methods: {
        performSearch(searchText) {
            axios
                .get(`http://127.0.0.1:8000/api/apartment/${searchText}`)
                .then(response => {
                    this.apartmentsArray = response.data;
                    // console.log(response.data);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>

<style lang="scss">
body {
    font-family: sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
</style>
