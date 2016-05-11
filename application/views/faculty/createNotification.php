<div class="faculty-createNotification">
    <div class="container">
        <div class="row">
            <?= form_open_multipart('faculty/create', array('class' => 'col s12' )); ?>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="msg-title" class="materialize-textarea" name="msg-title"></textarea>
                        <label for="msg-title">Title</label>
                    </div>
                    <div class="input-field col s12">
                        <textarea id="msg-body" class="materialize-textarea" name="msg-body"></textarea>
                        <label for="msg-body">Body</label>
                    </div>
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>File</span>
                            <label for="msg-attachment">File Attachment: </label>
                            <input name="msg-attachment" id="msg-attachment" type="file" accept=".doc,.docx,.pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                        <p style="color:gray;">Allowed File types: .doc, .docx, .pdf, .jpg, .jpeg and .png</p>
                    </div>
                    <p><input type="submit" value="Send"/></p>
                </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>