<div class="faculty-deleteNotifications">
    <div class="container">
        <?= $this->session->userdata('first_name'); ?>
        <h1>Notification List</h1><br>
        <?php if (isset($notifications[0])): ?>
            <table>
                <tr>
                    <th>Title</th>
                    <th>Message</th>
                    <th class="hidable">Created at</th>
                    <th>Delete</th>
                </tr>
                <?php foreach ($notifications as $n): ?>
                <tr>
                    <td><?= $n['title']; ?></td>
                    <td><?= $n['message']; ?></td>
                    <?php
                        $mysql_timestamp = strtotime($n['created_at']);
                        $timestamp = date('M d, Y | h:i A', $mysql_timestamp);
                    ?>
                    <td class="hidable"><?php echo $timestamp; ?></td>
                    <td><a href="#"><i class="fa fa-trash-o"></i></a></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No entries found.</p>
        <?php endif; ?>
    </div>
</div>