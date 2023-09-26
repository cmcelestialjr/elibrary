<template>
    <div id="body">
      <div class="login-reg-panel">
        <div class="login-info-box" :class="{ 'show-log-panel': selectedForm === 'login' }">
            <h2>Have an account?</h2>
            <label id="label-register" for="log-reg-show" @click="showLoginForm">Login</label>
        </div>

        <div class="register-info-box" :class="{ 'show-log-panel': selectedForm === 'register' }">
            <h2>Don't have an account?</h2>
            <label id="label-login" for="log-login-show" @click="showRegisterForm">Register</label>
        </div>

  
        <div class="white-panel" :class="whitePanelClasses">
          <div class="login-show" :class="{ 'show-log-panel': selectedForm === 'login' }">
            <h2>LOGIN</h2>
            <form @submit.prevent="login">
              <input v-model="email" type="email" placeholder="Email" autocomplete="current-email">
              <input v-model="loginPassword" type="password" placeholder="Password" autocomplete="current-password">
              <input type="submit" id="button-login" class="btn btn-dark btn-dark-scan" value="Login">
              <a id="forgot-password" href="#">Forgot password?</a>
            </form>
          </div>
          <div class="register-show" :class="{ 'show-log-panel': selectedForm === 'register' }">
            <h2>REGISTER</h2>
            <form @submit.prevent="register">
              <input v-model="email" type="email" placeholder="Email" autocomplete="current-email">
              <input v-model="registerPassword" type="password" placeholder="Password" autocomplete="current-password">
              <input v-model="confirmPassword" type="password" placeholder="Confirm Password" autocomplete="current-password">
              <input type="submit" id="button-register" class="btn btn-dark btn-dark-scan" value="Register">
            </form>
          </div>
        </div>
      </div>
      <loading-bar :isLoading="isLoading"></loading-bar>
    </div>
</template>
  
<script>
    import LoadingBar from "./loadingbartop.vue";
    
    export default {
      components: {
        LoadingBar,
      },
      data() {
        return {
          email: '',
          loginPassword: '',
          registerPassword: '',
          confirmPassword: '',
          isLoading: false,
          selectedForm: 'login',
        };
      },
      computed: {
        whitePanelClasses() {
            return {
                'right-log': this.selectedForm === 'register',
            };
        },
      },
      methods: {
        showLoginForm() {
            this.selectedForm = 'login';
        },

        showRegisterForm() {
            this.selectedForm = 'register';
        },
        async login() {
          this.isLoading = true; // Start the loading state
          try {
            
            // Redirect the user to the home page upon successful login
            setTimeout(() => {
              // After the action is completed, turn off the loading state
              this.isLoading = false;
              this.$router.push('/login');
              }, 300); // Simulated 2-second delay
          } catch (error) {
            this.isLoading = false; // Corrected variable name
            // Handle login errors here
          }
          // Simulate an asynchronous action (e.g., an API request)
  
          
        },
        async register() {
          this.isLoading = true; // Start the loading state
          try {
            
            // Redirect the user to the home page upon successful login
            setTimeout(() => {
              // After the action is completed, turn off the loading state
              this.isLoading = false;
              this.$router.push('/login');
              }, 300); // Simulated 2-second delay
          } catch (error) {
            this.isLoading = false; // Corrected variable name
            // Handle login errors here
          }
          // Simulate an asynchronous action (e.g., an API request)
  
          
        },
      },
    };
</script>
<style scoped>
   
#body{
  font-family: 'Mukta', sans-serif;
	height:100vh;
	min-height:550px;
	background-repeat: no-repeat;
	background-size:cover;
	background-position:center;
	position:relative;
    overflow-y: hidden;
}
#forgot-password{
  text-decoration:none;
  color:#444444;
}
.login-reg-panel{
    position: relative;
    top: 50%;
    transform: translateY(-50%);
	text-align:center;
    width:70%;
	right:0;left:0;
    margin:auto;
    height:400px;
    background-color: rgba(236, 48, 20, 0.9);
}
.white-panel{
    background-color: rgba(255,255, 255, 1);
    height:500px;
    position:absolute;
    top:-50px;
    width:50%;
    right:calc(50% - 50px);
    transition:.3s ease-in-out;
    z-index:0;
    box-shadow: 0 0 15px 9px #00000096;
}
.login-reg-panel input[type="radio"]{
    position:relative;
    display:none;
}
.login-reg-panel{
    color:#B8B8B8;
}
.login-reg-panel #label-login, 
.login-reg-panel #label-register{
    border:1px solid #9E9E9E;
    padding:5px 5px;
    width:150px;
    display:block;
    text-align:center;
    border-radius:10px;
    cursor:pointer;
    font-weight: 600;
    font-size: 18px;
}
.login-info-box{
    width:30%;
    padding:0 50px;
    top:20%;
    left:0;
    position:absolute;
    text-align:left;
}
.register-info-box{
    width:30%;
    padding:0 50px;
    top:20%;
    right:0;
    position:absolute;
    text-align:left;
    
}
.right-log{right:50px !important;}

.login-show, 
.register-show{
    z-index: 1;
    display:none;
    opacity:0;
    transition:0.3s ease-in-out;
    color:#242424;
    text-align:left;
    padding:50px;
}
.show-log-panel{
    display:block;
    opacity:0.9;
}
.login-show input[type="email"], .login-show input[type="password"]{
    width: 100%;
    display: block;
    margin:20px 0;
    padding: 15px;
    border: 1px solid #b5b5b5;
    outline: none;
}
.login-show #button-login {
    max-width: 150px;
    width: 100%;
    padding: 10px;
    text-transform: uppercase;
    border-radius: 2px;
    float:right;
    cursor:pointer;
}
.login-show a{
    display:inline-block;
    padding:10px 0;
}

.register-show input[type="email"], .register-show input[type="password"]{
    width: 100%;
    display: block;
    margin:20px 0;
    padding: 15px;
    border: 1px solid #b5b5b5;
    outline: none;
}
.register-show #button-register {
    max-width: 150px;
    width: 100%;
    padding: 10px;
    text-transform: uppercase;
    border-radius: 2px;
    float:right;
    cursor:pointer;
}
.credit {
    position:absolute;
    bottom:10px;
    left:10px;
    color: #3B3B25;
    margin: 0;
    padding: 0;
    font-family: Arial,sans-serif;
    text-transform: uppercase;
    font-size: 12px;
    font-weight: bold;
    letter-spacing: 1px;
    z-index: 99;
}

    
    
    
</style>