<div class="faculty-deleteNotifications">
    <div class="container">
        <?= $this->session->userdata('first_name'); ?>
        <h1>Notification List</h1><br>
        <?php if (isset($notifications[0])): ?>
            <table>
                <tr>
                    <th>Title</th>
                    <th class="hidable">Message</th>
                    <th class="hidable">Created at</th>
                    <th>Manage</th>
                </tr>
                <?php foreach ($notifications as $n): ?>
                <tr >
                    <td><?= $n['title']; ?></td>
                    <?php
                    if (!function_exists('echo_short')){
                        function echo_short($string, $length){
                            if(strlen($string)<=$length){
                                return $string;
                            }
                            else {
                                $c_string = substr($string,0,$length) . '...';
                                return $c_string;
                            }
                        }
                    }
                     ?>
                    <td class="hidable"><?php echo echo_short($n['message'],75); ?></td>
                    <?php
                        $mysql_timestamp = strtotime($n['created_at']);
                        $timestamp = date('M d, Y | h:i A', $mysql_timestamp);
                    ?>
                    <td class="hidable"><?php echo $timestamp; ?></td>
                    <td><a class="md-trigger" data-modal="modal-1" id="notification_link" href="#"><i class="fa fa-external-link-square notification_id" data-txt="<?= $n['id']; ?>"></i></a></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No entries found.</p>
        <?php endif; ?>
    </div>
    <div class="md-modal md-effect-1" id="modal-1" style="height:60%;">
        <div class="md-content" style="height:60%; overflow-y:scroll;">
            <h3 id="modal-title"></h3>
            <div id="modal-body">
                
            </div>
        </div>
        <button class="md-close">Close me!</button>
        <button onclick="window.location();">Delete</button>
    </div>
    <div class="md-overlay"></div>
</div>


<input type="hidden" value="<?= base_url(); ?>" id="base_url" />