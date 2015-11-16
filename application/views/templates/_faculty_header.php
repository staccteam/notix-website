<div class="faculty-header">
    <div class="container">
        <span class="section-title">
            <p><a onclick="window.location='<?= base_url(); ?>faculty/home'"><i class="fa fa-tasks"></i>&nbsp;Faculty Console</a></p>
            <p class="page-title">Prof. <?php echo $this->session->userdata('faculty_first_name').' '.$this->session->userdata('faculty_last_name'); ?></p>
        </span>
        <span class="navlinks">
            <ul>
                <li><button onclick="window.location='<?= base_url(); ?>faculty/logout'" class="ghost">Logout</button></li>
            </ul>
        </span>
    </div>
</div>