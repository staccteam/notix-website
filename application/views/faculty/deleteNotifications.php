<div class="faculty-deleteNotifications">
    <div class="container">
    	<?= $this->session->userdata('first_name'); ?>
        <h1>Notification List</h1><br>
    </div>
    <?php if (isset($notifications[0])): ?>
    	<ul>
    		<?php foreach ($notifications as $n): ?>
    		<li><?= $n['title']; ?></li>
    		<?php endforeach; ?>
    	</ul>
	<?php endif; ?>
</div>