<template>
  <div id="app">
    <div id="nav" v-show="apiToken == null">
      <router-link to="/">Home</router-link> |
      <router-link to="/register">Register</router-link> |
      <router-link to="/login">Login</router-link>
    </div>
    <div id="nav" v-show="apiToken != null">
      <router-link to="/products">Products</router-link> |
      <router-link to="/upload-file">Upload file</router-link> |
      <router-link to='/logout'>Logout</router-link>
    </div>
    <div class="container">
    <span v-if="error != ''" class="text text-danger" >{{ error }}</span>
    <span v-if="success != ''" class="text text-success" >{{ success }}</span>
    <router-view/>
    </div>
  </div>
</template>


<script>

 
    
    export default {
      name: 'App',
      data(){
          return {
              apiToken: '',
              error: '',
              success: ''
          }
      },
      created() {
          this.apiToken = this.$cookie.get('viApiToken');      
          console.log(this.apiToken,'apiToken')    
      },

      watch:{
          $route (to, from){
              this.apiToken = this.$cookie.get('viApiToken'); 
          }
      } 

      
    };

</script>

<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #2c3e50;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>
