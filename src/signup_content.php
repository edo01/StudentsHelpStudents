<!-- TO DO: 
    - check the email
    - send an email to confirm 
    - check the class -->  
<div class="container" style="padding-top:30px" >
    <div class="row tm-register-row tm-mb-35">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 tm-login-l">
            <form action="access.php" method="POST" class="tm-bg-black p-5 h-100">
                <div class="mb-2">
                    <label class="mr-4"></label>

                <div class="input-field">
                    <input placeholder="Nome" id="nome" name="name" required type="text" class="validate">
                </div>
                <div class="input-field">
                    <input placeholder="Cognome" id="cognome" name="surname" required type="text" class="validate">
                </div>
                <div class="input-field">
                    <input placeholder="Email" id="email" oninput="check_field('email', this)" required name="email" type="text" class="validate">
                </div>
                <div class="input-field">
                    <input placeholder="Username (bel)" id="username" oninput="check_field('username', this)" name="username" required type="text" class="validate">
                </div>
                <div class="input-field">
                    <input placeholder="password" id="password" oninput="check_password()" required name="password" type="password" class="validate">
                </div>
                <div class="input-field">
                    <input placeholder="ripeti password" id="password2" oninput="check_password()" required name="password2" type="password" class="validate">
                </div>
                <div class="input-field">
                    <input placeholder="classe" id="class" required name="class" type="text" class="validate">
                </div>
                </div>
                <div class="text-right mt-4">
                    <button type="submit" name="submit" value="register" class="waves-effect btn-large btn-large-white px-4 black-text">Registrati</button>
                </div>
            </form>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 tm-login-r">
            <header class="font-weight-light tm-bg-black p-5 h-100">
                <h3 class="mt-0 text-white font-weight-light">Registrati</h3>
                <p id="checker_email" style="color: red;visibility: hidden;">Email già utilizzata.</p>
                <p id="checker_username" style="color: red;visibility: hidden;">Username già utilizzato.</p>
                <p id="password_error" style="color: red;visibility: hidden;">Le password devono essere identiche.</p>
            </header>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 ml-auto mr-0 text-center">
            <a onclick="loadLogin(false)" class="waves-effect btn-large btn-large-white px-4 black-text rounded-0">Sei già registrato?</a>
        </div>
    </div>
    <footer class="row tm-mt-big mb-3">
    </footer>
</div>

<script src="js/jquery-3.2.1.slim.min.js"></script>
<script src="js/materialize.min.js"></script>
<script>
    $(document).ready(function () {
        $('select').formSelect();
    });
</script>     