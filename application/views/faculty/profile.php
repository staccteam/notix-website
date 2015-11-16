<div class="faculty-profile">
    <div class="container group">
        <?= form_open_multipart('faculty/uploadProfilePicture'); ?>
      		<p>
                <label for="msg-attachment">Upload Profile Picture: </label>
                <input name="profile-picture" id="profile-picture" type="file" accept=".jpg,.jpeg,.png"/>
                <p style="color:gray;">Allowed File types: .jpg, .jpeg and .png</p>
            </p>
            <p><input type="submit" value="Upload"/></p>
        <?= form_close(); ?>
    </div>
</div>