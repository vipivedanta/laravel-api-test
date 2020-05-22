<template>
	<h3>Loging out..please wait..</h3>
</template>

<script>

	import axios from 'axios'
  	import apiConfig from '../../config/api.json'
	
	export default {
		name: 'Logout',
		 data(){
	          return {
	              apiToken: '',
	              error: '',
	              success: ''
	          }
      	},

      	methods: {

          	doLogout: function() {
          		 
	              let payLoad = { api_token : this.apiToken }
	              axios.post(apiConfig.apiURL + 'logout',payLoad)
	              .then( response => {
	                  this.success = response.data.message
	                  this.$cookie.delete('viApiToken')
	                  this.$router.push({ path: 'login' })
	              })
	              .catch( error => {
	                  this.error = response.data.error
	              })
          	}
      	},

      	created() {
      		this.apiToken = this.$cookie.get('viApiToken');   
      		this.doLogout()
      	}
	}

</script>