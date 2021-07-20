<template>
  <div class="message-form">
      
        <form @submit.prevent="sendMessage">


            <!-- name -->
            <div class="name">
                <label for="name">Name*</label><br>
                <input type="text" id="name" placeholder="Your name" v-model="name">
            </div>
            <div v-for="(error, index) in errors.name" :key="`err-name-${index}`">{{error}}</div>
            <!-- email -->
            <div class="email">
                <label for="email">Email*</label><br>
                <input type="email" id="email" placeholder="Your email" v-model="email">
            </div>
            <div v-for="(error, index) in errors.email" :key="`err-email-${index}`">{{error}}</div>
            <!-- phone -->
            <div class="phone">
                <label for="phone_number">Phone Number*</label><br>
                <input type="tel" id="phone_number" placeholder="Your phone number" v-model="phone_number">
            </div>
            <div v-for="(error, index) in errors.phone_number" :key="`err-phone-${index}`">{{error}}</div>
            <!-- num guests -->
            <div class="guests">
                <label for="num_guests">Number of guests*</label><br>
                <input type="number" id="num_guests" placeholder="Number of guests for your booking" v-model="num_guests">
            </div>
            <div v-for="(error, index) in errors.num_guests" :key="`err-guests-${index}`">{{error}}</div>
            <!-- Message -->
            <div class="message">
                <label for="message">Message*</label><br>
                <textarea id="message" cols="30" rows="10" placeholder="Write your message here, I will answer you quickly :)" v-model="message"></textarea>
            </div>
            <div v-for="(error, index) in errors.message" :key="`err-message-${index}`">{{error}}</div>
            <button type="submit">Invia</button>
        </form>
        
  </div>
</template>

<script>
export default {
    name: "MessageForm",
    data() {
        return {
            name: '',
            email: '',
            phone_number: '',
            num_guests: '',
            message: '',
            errors: {},
        }
    },
    methods: {
        sendMessage(){      
            axios.post('http://127.0.0.1:8000/api/messageSubmit', {
                name: this.name,
                email: this.email,
                phone_number: this.phone_number,
                num_guests: this.num_guests,
                message: this.message
            },
            )
            .then(response => {
                console.log(response.data);
                if (response.data.errors) {
                    this.errors = response.data.errors;
                } else {
                    //clear fields
                }
            })
            .catch(error => {
                console.log(error.data);
                this.errors = error.data;
            });
        }
    }
}
</script>

<style>

</style>