<template>
    <div>
        <Header @searchText="performSearch" />

        <main>
            <router-view
                :apartmentArray="apartmentsArray"
                @searchText="performSearch"
                @searchArray="newSearch"
                :query="searchText"
            ></router-view>
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
            apartmentsArray: [],
            searchText: "",
        };
    },
    methods: {
        performSearch(searchText) {
            this.searchText = searchText;
            axios
                .get(`http://127.0.0.1:8000/api/apartment/${searchText}`)
                .then(response => {
                    this.apartmentsArray = response.data;
                })
                .catch(err => {
                    console.log(err);
                });
        },
        newSearch(searchArray) {
            console.log(searchArray);
            axios.get(`http://127.0.0.1:8000/api/apartment/${searchArray.search}/${searchArray.radius}/${searchArray.rooms}/${searchArray.beds}`)
            .then(response => {
                console.log(response.data);
            })
            .catch(err => {
                console.log(err);
            })
        }
    }
};
</script>

<style lang="scss">
@import "../sass/frontoffice/_utilities";
body {
    font-family: sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
</style>
