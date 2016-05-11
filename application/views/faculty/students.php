<div class="container">
	<div class="row">
		<?php if (isset ($students[0])): ?>
			<table>
				<tr>
					<td>Name</td>
					<td>Email</td>
					<td>Enrollment</td>
					<td>Branch</td>
				</tr>
			<?php foreach ($students as $s): ?>
				<tr>
					<td><?= $s['first_name'].' '.$s['last_name']; ?></td>
					<td><?= $s['email'] ?></td>
					<td><?= $s['enrollment'] ?></td>
					<td><?= $s['branch'] ?></td>
				</tr>
			<?php endforeach; ?>
			</table>
		<?php endif; ?>
	</div>
</div>