<template>
    <div class="cont">
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
            axios.get(`http://127.0.0.1:8000/api/apartment/${searchArray.search}/${searchArray.radius}/${searchArray.rooms}/${searchArray.beds}/${searchArray.checkedServices}`)
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
@import "../sass/_variables";
body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
main{
    background:lightgray;
    padding: 20px 10px;
    h1{
        color:#511d1f;
        position: relative;
        z-index: 9;
    }
}

.tt-search-box{
       margin-top:0;
}
.tt-search-box-input-container{
    padding: 0;
    height: 30px;
    padding:10px;
    border: 1px solid #fb5a5f;
   
}
svg{
    fill: #fb5a5f;
}
</style>
