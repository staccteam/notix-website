<div class="faculty-profile">
    <div class="container group">
        <section class="col span_1_of_4 profile-pic-form">
            <?php if(isset($faculty[0]['image_url'])): ?>
            <img style="border-radius:50%;border:2px solid #ccc;background:#eee;" src="<?php echo $faculty[0]['image_url']; ?>">
            <?php else: ?>
            <img style="border-radius:50%;border:2px solid #ccc;background:#eee;" src="<?= base_url(); ?>/img/def_avatar.svg">
            <?php endif; ?>
            <?= form_open_multipart('faculty/uploadProfilePicture'); ?>
                <p>
                    <label for="msg-attachment">Change your Profile Picture</label>
                    <input name="profile-picture" id="profile-picture" type="file" accept=".jpg,.jpeg,.png"/>
                    <p style="color:gray;">Allowed File types: .jpg, .jpeg and .png</p>
                </p>
                <p><input type="submit" value="Upload"/></p>
            <?= form_close(); ?>
        </section>
        <section class="col span_1_of_4 profile-form">
            <ul>
                <?php foreach ($faculty[0] as $fd): ?>
                    <li>First Name: <?php echo $fd['first_name']; ?></li><br>
                <?php endforeach; ?>
            </ul>
        </section>
    </div>
</div>