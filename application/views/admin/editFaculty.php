<div class="admin-editFaculty">
    <div class="container">
        <h1>Records</h1><br>
        <?php if (isset($faculty_array[0])): ?>
        <table>
            <tr>
                <th>Name</th>
                <th class="hidable">Email</th>
                <th class="hidable">Mobile Number</th>
                <th>Branch</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php foreach ($faculty_array as $faculty): ?>
            <tr>
                <td><?= $faculty['first_name']; ?>&nbsp;<?= $faculty['last_name']; ?></td>
                <td class="hidable"><?= $faculty['email']; ?></td>
                <td class="hidable"><?= $faculty['mobile']; ?></td>
                <td><?= $faculty['branch_name']; ?></td>
                <td><a href="<?= base_url(); ?>admin/updateFaculty/<?= $faculty['id']; ?>"><i class="fa fa-pencil"></i></a></td>
                <td><a href="<?= base_url(); ?>admin/deleteFaculty/<?= $faculty['id']; ?>"><i class="fa fa-trash-o"></i></a></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php else: ?>
        <p>No entries found.</p>
        <?php endif; ?>
    </div>
</div>