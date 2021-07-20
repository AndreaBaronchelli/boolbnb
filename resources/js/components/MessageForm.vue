<template>
  <div class="message-form">
      
        <!-- name -->
        <div class="name">
            <label for="user-name">Name</label><br>
            <input type="text" name="user-name" id="user-name" placeholder="Your name" v-model="message.name">
        </div>
        <!-- email -->
        <div class="email">
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email" placeholder="Your email" v-model="message.mail">
        </div>
        <!-- phone -->
        <div class="phone">
            <label for="phone-num">Phone Number</label><br>
            <input type="tel" name="phone-num" id="phone-num" placeholder="Your phone number" v-model="message.phoneNumber">
        </div>
        <!-- num guests -->
        <div class="guests">
            <label for="guests">Number of guests</label><br>
            <input type="number" name="guests" id="guests" placeholder="Number of guests for your booking" v-model="message.guests">
        </div>
        <!-- Message -->
        <div class="message">
            <label for="message">Message</label><br>
            <textarea name="message" id="message" cols="30" rows="10" placeholder="Write your message here, I will answer you quickly :)" v-model="message.textMessage"></textarea>
        </div>
        <button class="btn" @click="sendMessage">Invia</button>
        
  </div>
</template>

<script>
export default {
    name: "MessageForm",
    data() {
        return {
            message: {},
        }
    },
    methods: {
        sendMessage(){
            message = this.message;

            axios.post('/formSubmit', {
                name: message.name,
                mail: message.mail,
                phone: message.phoneNumber,
                guests: message.guests,
                text: message.textMessage
            })
            .then(function (response) {
                //
            })
            .catch(function (error) {
                //
            });
        }
    }
}
</script>

<style>

</style>