<template>

<div class="message-form">
    <h3>Contat us for booking</h3>

    <div class="success" v-show="success">Message sended successfully</div>
    
    <form @submit.prevent="sendMessage">
        
        <!-- name -->
        <div class="error-field" v-for="(error, index) in errors.name" :key="`err-name-${index}`">{{error}}</div>
        <div class="field">
            <label for="name">Name*</label><br>
            <input type="text" id="name" placeholder="Your name" :disabled="this.fielDisabled ? '' : disabled" v-model="message.name">
        </div>
        <!-- email -->
        <div class="error-field" v-for="(error, index) in errors.email" :key="`err-email-${index}`">{{error}}</div>
        <div class="field">
            <label for="email">Email*</label><br>
            <input type="email" id="email" placeholder="Your email" :disabled="this.fielDisabled ? '' : disabled" v-model="message.email">
        </div>
        <!-- phone -->
        <div class="error-field" v-for="(error, index) in errors.phone_number" :key="`err-phone-${index}`">{{error}}</div>
        <div class="field">
            <label for="phone_number">Phone Number*</label><br>
            <input type="tel" id="phone_number" placeholder="Your phone number" v-model="message.phone_number">
        </div>
        <!-- num guests -->
        <div class="error-field" v-for="(error, index) in errors.num_guests" :key="`err-guests-${index}`">{{error}}</div>
        <div class="field">
            <label for="num_guests">Number of guests*</label><br>
            <input type="number" id="num_guests" placeholder="Number of guests for your booking" v-model="message.num_guests">
        </div>
        <!-- Message -->
        <div class="error-field" v-for="(error, index) in errors.message" :key="`err-message-${index}`">{{error}}</div>
        <div class="field">
            <label for="message">Message*</label><br>
            <textarea id="message" cols="30" rows="10" placeholder="Write your message here, I will answer you quickly :)" v-model="message.message"></textarea>
        </div>
        <button type="submit" :disabled="sending">
            {{ sending ? "Sending.." : "Send" }}
        </button>
    </form>
        
  </div>
</template>

<script>
export default {
    name: "MessageForm",
    props: ['apartment_id', 'user'],
    created() {
        this.checkLoggedUser();
    },
    data() {
        return {
            message: {
                apartment_id: this.apartment_id,
                // gli altri valori (name, email, ecc...)vengono creati automaticamente compilando i campi della form
            },
            errors: {},
            success: false,
            sending: false,
            fielDisabled: false,
        }
    },
    methods: {
        checkLoggedUser() {
            console.log(this.user);
            if (this.user.user_name != "") {
                this.message.name = this.user.user_name
                this.message.email = this.user.user_email
                this.fielDisabled = true;
            } else {
                this.fielDisabled = false;
            }
        },
        sendMessage(){  
            this.sending = true;    
            console.log(this.message);
            //invio a questo endpoind l'oggetto message con tutti i campi della form
            axios.post('http://127.0.0.1:8000/api/messageSubmit', this.message
            )
            .then(response => {
                console.log(response.data);
                this.sending = false;
                if (response.data.errors) {
                    this.errors = response.data.errors;
                    this.success = false;
                } else {
                    //clear fields
                    this.message.name = '';
                    this.message.email = '';
                    this.message.phone_number = '';
                    this.message.num_guests = '';
                    this.message.message = '';
                    this.errors = {};
                    this.success = true;
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

<style lang="scss" scoped>
    .field {
        margin-bottom: 15px;
    }

    .error-field {
        color: red;
    }

    .success {
        color: green;
    }

    button {
        width: 100px;
        padding: 5px 20px;
    }
</style>