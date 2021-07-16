<template>
    <div>
        
        <Header @searchText="performSearch"/> 
        
        <main>
            <router-view></router-view>
        </main>

    </div>
</template>

<script>

import axios from 'axios';
import Header from "./components/Header.vue";
export default {
    name:'App',
    components: {
        Header
    },
    data() {
        return {
            apartmentsArray: [],
        }
    },
    methods: {
        performSearch(searchText) {
            this.searchText = searchText;
            // console.log(this.searchText);

            axios.get(`http://127.0.0.1:8000/api/apartment/`)
            .then(res => {
                    console.log(res.data);
                    this.apartmentsArray = res.data.apartments;
                    console.log(this.apartmentsArray);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
}
</script>

<style lang="scss">

    body{
        font-family: sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
</style>
