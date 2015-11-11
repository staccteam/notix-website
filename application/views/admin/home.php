<div class="admin-home">
    <div class="container">
        <?php if (isset($list_faculties[0])): ?>
            <!-- 
            List Faculties here...  
            The Faculty information is stored inside an array: $list_faculties
            Loop through the array to get the stored information.
            -->
        <?php endif; ?>
        <div>
            <?= anchor('admin/addFaculty', 'Add Faculty'); ?>
        </div>
    </div>
</div>