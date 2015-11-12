<div class="admin-editFaculty">
    <div class="container">
        <h1>Records</h1><br>
        <?php if (isset($faculty_array[0])): ?>
        <table>
            <tr>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Email</td>
                <td>Mobile Number</td>
                <td>Branch</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
            <?php foreach ($faculty_array as $faculty): ?>
            <tr>
                <td><?= $faculty['first_name']; ?></td>
                <td><?= $faculty['last_name']; ?></td>
                <td><?= $faculty['email']; ?></td>
                <td><?= $faculty['mobile']; ?></td>
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