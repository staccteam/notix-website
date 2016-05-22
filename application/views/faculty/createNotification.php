<div class="faculty-createNotification">
    <div class="container">
        <?= form_open_multipart('faculty/create'); ?>
        <div class="col-md-6">
            
                <p><label for="msg-title">Title</label></p>
                <p><textarea id="msg-title" name="msg-title" cols="60" rows="2" placeholder="Tagline for notification"></textarea></p><br>
                <p><label for="msg-body">Body</label></p>
                <p><textarea id="msg-body" name="msg-body" cols="60" rows="20" placeholder="Type your message here..."></textarea></p>
                <p>
                    <label for="msg-attachment">File Attachment: </label>
                    <input name="msg-attachment" id="msg-attachment" type="file" accept=".doc,.docx,.pdf,.jpg,.jpeg,.png"/>
                    <p style="color:gray;">Allowed File types: .doc, .docx, .pdf, .jpg, .jpeg and .png</p>
                </p>
                <p><input type="submit" value="Send"/></p>
            
        </div>
        <div class="col-md-6">
            <?php 
                if ($this->session->userdata('faculty_is_admin')): 
                    $branches = _getData(DB_PREFIX.'branches');
                ?>
                <h2>Send Notification to:</h2>
                <?php foreach ($branches as $key => $value): ?>
                    <p>
                    <input id="branch_select_<?= $key ?>" type="checkbox" name="branch_select[]" value="<?= $value['id'] ?>" /><label for="branch_select_<?= $key ?>"><?= $value['branch']; ?></label>
                    </p>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <?= form_close(); ?>
    </div>
</div>