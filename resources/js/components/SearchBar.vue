<template>
    <div>
        <input type="text" placeholder="Where do you want to go?" v-model.trim="searchText">
        <button @click="$emit('searchText', searchText)">Search</button>
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