<div class="admin-addfaculty">
    <div class="container">
        <section>
            <div>
                <?= form_open('admin/create') ?>
                    <input name="first_name" type="text" placeholder="First Name"></input>
                    <input name="last_name" type="text" placeholder="Last Name"></input><br><br>
                    <input name="email" type="text" placeholder="Email"></input>
                    <input name="mobile" type="text" placeholder="Mobile Number"></input><br><br>
                    <input name="username" type="text" placeholder="Username"></input>
                    <input name="password" type="text" placeholder="Password"></input><br><br>
                    Branch:&nbsp;
                    <?php if (isset($branches[0])): ?>
                    <select name="branch">
                        <option disabled selected>select</option>
                        <?php foreach ($branches as $branch): ?>
                        <option value="<?= $branch['id']; ?>"><?= $branch['branch']; ?></option>                       
                        <?php endforeach; ?>
                    </select><br><br>
                    <?php endif; ?>
                    <input type="submit" value="Create"/>
                <?= form_close(); ?>
            </div>
        </section>
    </div>
</div>