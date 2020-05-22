<template>
	<div>
        <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12">

        <span v-if="error != ''" class="text text-danger" >{{ error }}</span>
        <span v-if="success != ''" class="text text-success" >{{ success }}</span>
        
        <!-- Default form login -->
        <form class="text-center border border-light p-5" action="#!">

            <p class="h4 mb-4">Sign in</p>

            <!-- Email -->
            <input type="email" v-model="email" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="E-mail">
            <span v-if="error.email != ''" class="text text-danger">{{ errors.email }}</span>

            <!-- Password -->
            <input type="password" v-model="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password">
            <span v-if="error.password != ''" class="text text-danger">{{ errors.password }}</span>

            

            <!-- Sign in button -->
            <button :disabled="networkRequest" class="btn btn-info btn-block my-4" type="button" v-on:click="login" v-html="networkRequest ? 'Processing..': 'Login'"></button>

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
		name: 'Login',
		data() {
			return {
				email: '',
				password: '',
				error: '',
				success: '',
				networkRequest: false,
				errors: {
		            email: '',
		            password: ''
		        }
			}
		},

		methods: {

			login: function() {
				let user = {
					email: this.email,
					password: this.password
				}
				this.networkRequest = true
				axios.post(apiConfig.apiURL + 'login',user,{
					'Access-Control-Allow-Origin':'*'
				})
				.then( response => {
					this.networkRequest = false
					if(response.data.status == true){
						this.success = response.data.message
						this.error = ''
						this.newUser('','')
						this.$cookie.set("viApiToken", response.data.data.api_token,1)
						this.$router.push({path:'upload-file'})
					}else{
						this.error = response.data.message;
					}
						
				})
				.catch( error => {
					this.networkRequest = false
					this.error = error.response.data.message
					for(var k in error.response.data.errors)
                		this.errors[k] = error.response.data.errors[k][0]
					})
			},

			newUser: function(email,password) {
		          this.email = email
		          this.password = password
		      }
		}
	}
</script>