<template>
    <header>
        <div class="container">
            <router-link :to="{ name: 'home' }">Logo
            </router-link>
            
        </div>
    </header>
</template>

<script>
export default {
    name: "Header",
    data() {
        return {};
    },
    methods: {
        test() {
            console.log(this.searchText);
        },
        search(searchText) {
            this.$emit("searchText", searchText);
        }
    }
};
</script>

<style lang="scss" scoped>
header{
    padding:20px;
    background: white;
}
</style>
