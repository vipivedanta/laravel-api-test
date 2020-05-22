<template>
	<div>
		<table class="table">
		  <thead class="black white-text">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Product</th>
		      <th scope="col">Price</th>
		      <th scope="col">SKI</th>
		    </tr>
		  </thead>

		  <tbody v-if="networkRequest">
		  	<tr>
		  		<td colspan="5" class="text text-info text-center">Fetching products..please wait..</td>
		  	</tr>
		  </tbody>

		  <tbody v-if="products.length > 0">
		    <tr v-for="(product,index) in products">
		      <th scope="row">{{ product.id }}</th>
		      <td>{{ product.name }}</td>
		      <td>{{ product.price }}</td>
		      <td>{{ product.ski }}</td>
		    </tr>
		  </tbody>
		</table>

		
	</div>
</template>

<script>
	
	import apiConfig from '../../config/api.json'
	import axios from 'axios'
	
	export default {
		name: 'ProductList',
		data() {
			return {
				products: [],
				success: '',
				error: '',
				apiToken: '',
				networkRequest: false
			}
		},

		methods: {

			listProducts: function() {

				this.networkRequest = true

				axios.get(apiConfig.apiURL + 'list-products?api_token=' + this.apiToken)
				.then( response => {
					this.networkRequest = false
					this.products = response.data.data
					this.success = response.data.message
				})
				.catch( error => {
					this.networkRequest = false
					this.error = error.message
					this.message = ''
				})
			}
		},

		created() {
			this.apiToken = this.$cookie.get('viApiToken')
			if(this.apiToken == null) {
				this.$router.push({path:'login'})
			}

			this.listProducts()
		}
	};

</script>

<style>
	.black {
		background-color: #000;
	}
	.white-text {
		color:#fff;
	}
</style>