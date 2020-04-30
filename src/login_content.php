<div class="container">
    <div class="row tm-register-row tm-mb-35">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 tm-login-l">
            <form action="access.php" method="POST" class="tm-bg-black p-5 h-100">
                <div class="input-field">
                    <input placeholder="Username" id="username" name="usernamel" required type="text" class="validate">
                </div>
                <div class="input-field mb-5">
                    <input placeholder="Password" id="password" name="passwordl" required type="password" class="validate">
                </div>
                <div class="tm-flex-lr">
                    <a href="#" class="white-text small">Forgot Password?</a>
                    <button type="submit" name="submit" value="login" class="waves-effect btn-large btn-large-white px-4 black-text rounded-0">Login</button>
                </div>
            </form>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 tm-login-r">
            <header class="font-weight-light tm-bg-black p-5 h-100">
                <h3 class="mt-0 text-white font-weight-light">Accedi</h3>
                <p id="error" style="color: red;visibility: hidden;">Username e password errati. Sei registrato nel sito?</p>
            </header>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 ml-auto mr-0 text-center">
            <a onclick="loadSignup()" class="waves-effect btn-large btn-large-white px-4 black-text rounded-0">Non sei registrato?</a>
        </div>
    </div>
    <footer class="row tm-mt-big mb-3">
        <div class="col-xl-12 text-center">
            <p class="d-inline-block tm-bg-black white-text py-2 tm-px-5">
                Copyright &copy; 2018 Company Name 

                - <a rel="nofollow" href="http://www.tooplate.com/view/2105-input">Input</a> by 
                <a rel="nofollow" href="http://tooplate.com" class="tm-footer-link">Tooplate</a>
            </p>
        </div>
    </footer>
</div>

<script src="js/jquery-3.2.1.slim.min.js"></script>
<script src="js/materialize.min.js"></script>
<script>
    $(document).ready(function () {
        $('select').formSelect();
    });
</script>     