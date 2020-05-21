<template>

    <div>
        <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12">

        <span v-if="error != ''" class="text text-danger" >{{ error }}</span>
        <span v-if="success != ''" class="text text-success" >{{ success }}</span>
        
        <!-- Default form login -->
        <form class="text-center border border-light p-5" action="#!">

            <p class="h4 mb-4">Sign up</p>

            <input type="text" v-model="name" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="Name">

            <!-- Email -->
            <input type="email" v-model="email" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="E-mail">

            <!-- Password -->
            <input type="password" v-model="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password">

            

            <!-- Sign in button -->
            <button :disabled="networkRequest" class="btn btn-info btn-block my-4" type="button" v-on:click="register" v-html="networkRequest ? 'Processing..': 'Sign up'"></button>

        </form>
        <!-- Default form login -->

        </div>
        </div>

    </div>

</template>

<script>

import apiConfig from '../../config/api.json'
import axios from 'axios'

export default {
  name: 'Register',
  data(){
      return{
          name:'',
          email:'',
          password:'',
          error:'',
          success:'',
          networkRequest: false
      }
  },
  methods: {
      
      register: function() {
          let user = {
              name: this.name,
              email: this.email,
              password: this.password
          }
          this.networkRequest = true
          axios.post(apiConfig.apiURL + 'register',user)
          .then( response => {
              this.networkRequest = false
              if(response.data.status == true){
                  this.success = response.data.message
                  this.newUser('','','')
                  
              }else{
                  this.error = response.error;
              }
                  
          })
          .catch( error => {
              this.networkRequest = false
              this.error = error.message
          })
      },

      newUser: function(name,email,password) {
          this.name = name
          this.email = email
          this.password = password
      }
  }
}
</script>
