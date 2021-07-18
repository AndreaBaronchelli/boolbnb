<template>

<div>

    <h1>results</h1>
    <ul>
        <li v-for="apartment in apartmentArray" :key="apartment.id">
            {{apartment.title}}
        </li>
    </ul>

</div>


</template>

<script>
export default {
    name: "Results",
    props: ['apartmentArray'],
};
</script>

<style></style>
