<style type="text/css">
form{
	margin-top: 200px;
}
</style>
<?= form_open('auth/regStudent'); ?>

<input name="firstName">
<input name="lastName">
<input name="email" placeholder="email">
<input name="password" type="password">
<input name="mobile" placeholder="mobile">
<input name="enrollment" placeholder="enrollment">
<input name="branch" placeholder="branch">
<input type="submit" value="register" />


<?= form_close(); ?>

<br />
<br />

<?= form_open('auth/loginStudent'); ?>

<input name="email">
<input name="password">
<input type="submit" value="login" />

<?= form_close(); ?>