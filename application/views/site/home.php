<div class="home">
    <section class="parallax">
        <p>An all new way to connect is here.</p>
    </section>
    <div class="container">
        <div class="login-form">
            <p>Faculty Login</p>
            <?= form_open('auth/faculty/login'); ?>
                <div>
                    <input type="text" name="username" class="form-fields" placeholder="username/email"></input><br>
                    <input type="password" name="password" class="form-fields" placeholder="password"></input><br>
                </div>
                <input type="submit" class="login-btn" name="login-btn" value="Login"></input>
            <?= form_close(); ?>
        </div>
    </div>
</div>