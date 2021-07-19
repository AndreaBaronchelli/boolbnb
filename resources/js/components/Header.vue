<template>
    <header>
        <div class="container">
            <router-link :to="{ name: 'home' }">Homepage</router-link>
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

<style lang="scss" scoped></style>
