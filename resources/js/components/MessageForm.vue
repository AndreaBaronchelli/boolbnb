<template>
  <div class="message-form">
      <form action="">
          <!-- name -->
          <div class="name">
              <label for="user-name">Name</label><br>
              <input type="text" name="user-name" id="user-name" placeholder="Your name">
          </div>
          <!-- email -->
          <div class="email">
              <label for="email">Email</label><br>
              <input type="email" name="email" id="email" placeholder="Your email">
          </div>
          <!-- phone -->
          <div class="phone">
              <label for="phone-num">Phone Number</label><br>
              <input type="tel" name="phone-num" id="phone-num" placeholder="Your phone number">
          </div>
          <!-- num guests -->
          <div class="guests">
              <label for="guests">Number of guests</label><br>
              <input type="number" name="guests" id="guests" placeholder="Number of guests for your booking">
          </div>
          <!-- Message -->
          <div class="message">
              <label for="message">Message</label><br>
              <textarea name="message" id="message" cols="30" rows="10" placeholder="Write your message here, I will answer you quickly :)"></textarea>
          </div>
      </form>

  </div>
</template>

<script>
export default {
    name: "MessageForm"
}
</script>

<style>

</style>