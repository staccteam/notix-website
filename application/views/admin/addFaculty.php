<div class="admin-addfaculty">
    <div class="container group">
        <section>
            <div class="col span_2_of_4">
                <h2>Create Faculty</h2>
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
        <section>
            <div class="col span_2_of_4">
                <h2>Delete Faculty</h2>
                <p style="margin: 1% 0; color: gray;">
                    Select the username of the faculty to be deleted.
                </p>
                <?= form_open('admin/deleteFaculty'); ?>
                    <?php if (isset($faculties_username[0])): ?>
                        <select name="username">
                            <option disabled selected>select...</option>
                            <?php foreach ($faculties_username as $faculty): ?>
                                <option value="<?= $faculty['id']; ?>"><?= $faculty['username']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input type="submit" value="Delete"/>
                    <?php else: ?>
                        <p style="margin: 1% 0; color: gray;">
                            There are no faculties entry in the database. Create a Faculty First.
                        </p>
                    <?php endif; ?>
                <?= form_close(); ?>
            </div>
        </section>
    </div>
</div>