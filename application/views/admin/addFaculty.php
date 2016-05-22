<div class="admin-addFaculty">
    <div class="container">
        <section>
            <div class="row">
                <?= form_open('admin/create', array('class' => 'col s12')) ?>
                  <div class="row">
                    <div class="input-field col s6">
                      <input id="first_name" name="first_name" type="text" class="validate">
                      <label for="first_name">First Name</label>
                    </div>
                    <div class="input-field col s6">
                      <input id="last_name" type="text" name="last_name" class="validate">
                      <label for="last_name">Last Name</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="email" type="email" name="email" class="validate">
                      <label for="email">Email</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="mobile" type="text" name="mobile" class="validate">
                      <label for="mobile">Mobile Number</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="username" type="text" name="username" class="validate">
                      <label for="username">Username</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="password" type="password" name="password" class="validate">
                      <label for="password">Password</label>
                    </div>
                  </div>
                  <div class="row">
                    <?php if (isset($branches[0])): ?>
                    <div class="col s12">
                        <label>Branch: </label>
                        <select name="branch" class="browser-default">
                            <option value="" disabled selected>select</option>
                            <?php foreach ($branches as $branch): ?>
                            <option value="<?= $branch['id']; ?>"><?= $branch['branch']; ?></option>                       
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php endif; ?>
                    </div>
                    <div class="row">
                    <div class="input-field col s12">
                      <input id="is_admin" type="checkbox" name="is_admin">
                      <label for="is_admin">Is Admin?</label>
                    </div>
                  </div>
                    <input class="waves-effect waves-light btn" type="submit" value="Create"/>
                <?= form_close(); ?>
            </div>
        </section>
    </div>
</div>