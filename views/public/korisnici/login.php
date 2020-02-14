<script type="text/javascript" src="<?php echo URL . 'libs/javascript/jquery.validate.min.js' ?>"></script>

<h1>LOGIN</h1>

<form class="form" action="<?php echo URL . 'korisnici/ulogujSe'; ?>" method="post" id="login_form" >
    <label for="login">Login:</label> <input type="text" id="login" name="login" required /> <br/>
    <label for="password">Password:</label> <input type="password" id="password" name="password" required /> <br/>
    <input class="button" type="submit" value="Login">
</form>

<p class="mt15">
    Ukoliko nemate kreiran nalog, morate da se <a class="bold" href="<?php echo URL . 'korisnici/registracija' ?>">registrujete</a>.
</p>

<script type="text/javascript">
    $(function() {
        $('#login_form').validate();
    });
</script>