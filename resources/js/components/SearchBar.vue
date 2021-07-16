<template>
    <div>
        <input type="text" placeholder="Where do you want to go?" v-model.trim="searchText" @keyup="$emit('searchText', searchText)">
        <button @click="test">Search</button>
    </div>
</template>

<script>
export default {
    name: 'SearchBar',
    data(){
        return{
            searchText: "",
        }
    },
    methods: {
        test() {
            // console.log(this.searchText);
        }
    }
}
</script>


<style>

</style>