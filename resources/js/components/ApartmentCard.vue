<template>
  <div class="card">
      <!-- DA RISOLVERE -->
      <!-- <img v-bind:src="'/storage/apartments-images/image'+apartment.image" alt="{{apartment.title}}"> -->
      <h2>{{apartment.title}}</h2>
      <span>{{apartment.address}}</span>
      <p>{{apartment.square_meters}}</p>
      <h3>{{apartment.price}}</h3>

  </div>
</template>

<script>
export default {
    name: "ApartmentCard",
    props: ['apartment'],

}
</script>

<style lang="scss" scoped>
    .card {
        text-align: center;
        border: 2px solid black;
        border-radius: 10px;
        margin: 10px;
        padding: 10px;
    }
</style>