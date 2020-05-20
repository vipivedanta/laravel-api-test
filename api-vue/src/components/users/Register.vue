<template>

    <div>
        <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12">
        
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" v-model="name" />
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" v-model="email" />
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" v-model="password" />
        </div>

        <div class="form-group">
            <button class="btn btn-primary" v-on:click="register">Register</button>
        </div>

        </div>
        </div>

    </div>

</template>

<script>

import apiConfig from '../../config/api'

export default {
  name: 'Register',
  data(){
      return{
          name:'',
          email:'',
          password:''
      }
  },
  methods: {
      register: function() {
          console.log(this.name)
      }
  }
}
</script>
