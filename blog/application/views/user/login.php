<?= validation_errors() ?>
<?= $login_errors ?>

<form action="<?= base_url() . 'user/login' ?>" method="post" class="stack-form">

	<label>Email:</label>
	<input type="email" name="user_email" value="">

	<label>Password:</label>
	<input type="password" name="user_password" value="">

	<input type="submit" value="Entrar">

</form>