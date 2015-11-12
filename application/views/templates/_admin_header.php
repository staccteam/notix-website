<div class="admin-header">
    <div class="container">
        <span class="section-title" onclick="window.location='<?= base_url(); ?>admin/home'">
            <p><a onclick="window.location='<?= base_url(); ?>admin/home'"><i class="fa fa-tasks"></i>&nbsp;Admin Panel</a></p>
            <p class="page-title"><?= $title ?></p>
        </span>
        <span class="navlinks">
            <ul>
                <li><button onclick="window.location='<?= base_url(); ?>admin/logout'" class="ghost">Logout</button></li>
            </ul>
        </span>
    </div>
</div>