<template>

<div class="message-form">
    

    
    <form @submit.prevent="sendMessage">
        <h2>Contact us for booking</h2>
        <div class="cont">
            <div class="date">
                    <!-- name -->
                <div class="error-field" v-for="(error, index) in errors.name" :key="`err-name-${index}`">{{error}}</div>
                <div class="field">
                    <label for="name">Name*</label><br>
                    <input type="text" id="name" placeholder="Your name" v-model="message.name">
                </div>
                <!-- email -->
                <div class="error-field" v-for="(error, index) in errors.email" :key="`err-email-${index}`">{{error}}</div>
                <div class="field">
                    <label for="email">Email*</label><br>
                    <input type="email" id="email" placeholder="Your email" v-model="message.email">
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
            </div>
            <div class="date">
                <!-- Message -->
                <div class="error-field" v-for="(error, index) in errors.message" :key="`err-message-${index}`">{{error}}</div>
                <div class="field">
                    <label for="message">Message*</label><br>
                    <textarea id="message" cols="30" rows="10" placeholder="Write your message here, I will answer you quickly :)" v-model="message.message"></textarea>
                </div>
            </div>
        </div>
        <button type="submit" :disabled="sending">
            {{ sending ? "Sending.." : "Send" }}
        </button>
        <div class="success" v-show="success">Message sended successfully</div>
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
        }
    },
    methods: {
        checkLoggedUser() {
            console.log(this.user);
            if (this.user.user_name != null) {
                this.message.name = this.user.user_name
                this.message.email = this.user.user_email
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
                    // this.message.name = '';
                    // this.message.email = '';
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
form{
    display: flex;
    flex-direction: column;
    align-items: center;
    background: white;
    border-radius: 10px;
    margin-top:20px;
    padding:20px;
    color:#511d1f;
    h2{
        color:#a63c3f;
    }
}

.cont{
    display: flex;
    flex-wrap: wrap;
    justify-content:center;
    width: 100%;
    .date{
        margin:20px
    }
    input{
        width: 220px;
        height: 30px;
        border:solid 1px #fb5a5f;
        margin-top: 5px;
        padding:10px;
    }
    textarea{
        width: 240px;
        height: 300px;
        border:solid 1px #fb5a5f;
        margin-top: 5px;
        padding:10px;
    }
}
    .field {
        margin-bottom: 15px;
    }

    .error-field {
        color: white;
        background-color: #fb5a5f;
        border-radius: 8px;
        padding: 2px 7px;
        font-size: 13px;
        text-align: center;
    }

    .success {
        color: #18511b;
        background-color: #66ff7b;
        border-radius: 10px;
        padding: 3px 10px;
        text-align: center;
        margin-top: 10px;
    }

    button {
        padding:0 30px;
        margin:0;
    }
</style>