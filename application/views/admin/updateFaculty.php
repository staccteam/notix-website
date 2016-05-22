<div class="admin-updateFaculty">
    <div class="container group">
        <section>
            <div class="col span_2_of_4">
                <h2>Update Faculty</h2>
                <?= form_open('admin/update'); ?>
                    <input type="hidden" name="id" value="<?= $faculty[0]['id']; ?>">
                    <input name="first_name" type="text" value="<?= $faculty[0]['first_name']; ?>" placeholder="First Name"></input>
                    <input name="last_name" type="text" value="<?= $faculty[0]['last_name']; ?>" placeholder="Last Name"></input><br><br>
                    <input name="email" type="text" value="<?= $faculty[0]['email']; ?>" placeholder="Email"></input>
                    <input name="mobile" type="text" value="<?= $faculty[0]['mobile']; ?>" placeholder="Mobile Number"></input><br><br>
                    <input name="username" type="text" value="<?= $faculty[0]['username']; ?>" placeholder="Username"></input>
                    <input name="password" type="password" placeholder="Password"></input><br><br>
                    Branch:&nbsp;
                    <?php if (isset($branches[0])): ?>
                    <select name="branch">
                        <option disabled selected>select</option>
                        <?php foreach ($branches as $branch): ?>
                            <?php if ($branch['id'] == $faculty[0]['branch']): ?>
                            <option value="<?= $branch['id']; ?>" selected><?= $branch['branch']; ?></option>  
                            <?php else: ?>
                            <option value="<?= $branch['id']; ?>"><?= $branch['branch']; ?></option>  
                            <?php endif; ?>                     
                        <?php endforeach; ?>
                    </select><br><br>
                    <?php endif; ?>
                    <div class="input-field col s12">
                      <input id="is_admin" type="checkbox" name="is_admin">
                      <label for="is_admin">Is Admin?</label>
                    </div>
                    <input type="submit" value="Update"/>
                <?= form_close(); ?>
            </div>
        </section>
    </div>
</div>