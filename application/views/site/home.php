<div class="home">
    <section class="parallax">
        <p>An all new way to connect is here.</p>
    </section>
    <div class="container row">
        <div class="login-form col m6 s12">
            <p>Faculty Login</p>
            <?= form_open('auth/faculty/login'); ?>
                <div>
                    <input type="text" name="username" class="form-fields" placeholder="username or email"></input><br>
                    <input type="password" name="password" class="form-fields" placeholder="password"></input><br>
                </div>
                <input type="submit" class="login-btn" name="login-btn" value="LOGIN"></input>
            <?= form_close(); ?>
        </div>
        <div class="message-box col m6 s12">
            <div class="wrapper">
                <h1>What is Notix?</h1>
                <p>
                    Notix is a platform for instantly sharing all the news and happenings in the college. Currently, this website serves only as an admin console to the faculty members, but we are inclined to extend it to serve multiple purposes, such as, forums and personas. Students of HCET, please download the official Notix Android App from the Play Store: <a target="_blank" style="color:black;" href="#"><i class="fa fa-download"></i></a>
                </p>
            </div>
        </div>
    </div>
</div>
</div>