<!-- TO DO: 
    - check the email
    - send an email to confirm 
    - check the class -->

<h4>username:</h4>
<input type="text" name="username" 
       oninput="check_field('username', this)" required>
<span id="checker_username" style="visibility:hidden;" > username già in uso </span>
<br>
<h4>password:</h4>
<input type="password" name="password" required>
<br>
<h4>ripeti password:</h4>
<input type="password" name="password2" required>
<br>
<h4>nome</h4>
<input type="text" name="name" required>

<h4>cognome</h4>
<input type="text" name="surname" required>
<br>

<h4>class</h4>
<input type="text" name="class" required>
<br>

<br>
<h4>email istituzionale:</h4>
<input type="text" name="email" oninput="check_field('email', this)" required>
<span id="checker_email" style="visibility:hidden;" > email già in uso </span>
<br>
<input type="submit" name="submit" value="registrati"> oppure <a onclick="loadLogin()">accedi</a>  
