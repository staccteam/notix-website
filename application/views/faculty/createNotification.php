<div class="faculty-createNotification">
    <div class="container">
        <div>
            <?= form_open_multipart('faculty/create'); ?>
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
            <?= form_close(); ?>
        </div>
    </div>
</div>