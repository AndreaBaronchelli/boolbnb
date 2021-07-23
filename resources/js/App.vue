<template>
    <div class="cont">
        <Header @searchText="performSearch" :user="user" />
        <main>
            <router-view
                :apartmentArray="apartmentsArray"
                @searchText="performSearch"
                :query="searchText"
                :user="user"
                :apartmentsArray="apartmentsArray"
            ></router-view>
        </main>
        <Footer />
    </div>
</template>

<script>
import axios from "axios";
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";
export default {
    name: "App",
    components: {
        Header,
        Footer
    },
    data() {
        return {
            apartmentsArray: [],
            searchText: "",
            user: {
                user_id: document
                    .querySelector("meta[name='user-id']")
                    .getAttribute("content"),
                user_name: document
                    .querySelector("meta[name='user-name']")
                    .getAttribute("content"),
                user_email: document
                    .querySelector("meta[name='user-email']")
                    .getAttribute("content")
            }
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
        }
    }
};
</script>

<style lang="scss">
@import "../sass/frontoffice/_utilities";
@import "../sass/_variables";
body {
    font-family: "Roboto", sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
main {
    background: lightgray;
    padding: 20px 0;
    h1 {
        color: #511d1f;
    }
}

.tt-search-box {
    margin-top: 0;
}
.tt-search-box-input-container {
    padding: 0;
    height: 30px;
    padding: 10px;
    border: 1px solid #fb5a5f;
}
svg {
    fill: #fb5a5f;
}
</style>
