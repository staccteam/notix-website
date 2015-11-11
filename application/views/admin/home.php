<?php if (isset($list_faculties[0])): ?>
<!-- 
List Faculties here...  
The Faculty information is stored inside an array: $list_faculties
Loop through the array to get the stored information.
-->
<?php endif; ?>
<div style="background-color: black;">
<?= anchor('admin/addFaculty', 'Add Faculty'); ?>
</div>