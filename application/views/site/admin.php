<div class="admin">
    <div class="container">
        <div class="login-form col span_2_of_4">
            <?= $sess; ?>
            <p>Admin Login</p>
            <?= form_open('auth/login'); ?>
                <div>
                    <input type="text" name="username" class="form-fields" placeholder="username"></input><br>
                    <input type="password" name="password" class="form-fields" placeholder="password"></input><br>
                </div>
                <input type="submit" class="login-btn" name="login-btn" value="LOGIN"></input>
            <?= form_close(); ?>
        </div>
    </div>
</div>