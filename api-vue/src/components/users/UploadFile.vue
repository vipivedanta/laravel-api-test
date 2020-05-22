<template>
	<div class="col-md-6 col-sm-12 col-lg-4">

		<span v-if="error != ''" class="text text-danger" >{{ error }}</span>
        <span v-if="success != ''" class="text text-success" >{{ success }}</span>

		<form class="md-form">

			<input type="file" ref="file" v-on:change="setFile" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="Name">
			<span v-if="error.file != ''" class="text text-danger">{{ errors.file }}</span>


			<button class="btn btn-primary" :disabled="networkRequest" v-on:click="uploadFile" type="button" v-html="networkRequest?'Uploading...':'Upload'"></button>

		</form>
	</div>
</template>

<script>
	
	import apiConfig from '../../config/api.json'
	import axios from 'axios'

	export default {

		name: 'uploadFile',
		data() {
			return {
				file: '',
				error: '',
				success: '',
				networkRequest: false,
				apiToken:'',
				errors: {
					file: ''
				}
			}
		},

		methods: {

			setFile: function(e){
				this.file = this.$refs.file.files[0]				
			},

			uploadFile: function() {

				let payLoad = new FormData()
				payLoad.append('api_token',this.apiToken)
				payLoad.append('file',this.file)

				this.networkRequest = true

				axios.post(apiConfig.apiURL + 'upload-file',payLoad)
				.then( response => {
					this.networkRequest = false
					this.networkRequest = false
					if(response.data.status == true){
						this.success = response.data.message
						this.error = ''
						this.$router.push({ path:'products' })
						
					}else{
						this.error = response.data.message;
						this.success = ''
					}
						
				})
				.catch( error => {
					this.networkRequest = false	
					this.networkRequest = false
					this.error = error.response.data.message
					for(var k in error.response.data.errors)
                		this.errors[k] = error.response.data.errors[k][0]					
				})
			}
		},

		created() {
			this.apiToken = this.$cookie.get('viApiToken')
			
			if(this.apiToken == null) {
				this.$router.push({path:'login'})
			}
		}

	}

</script>