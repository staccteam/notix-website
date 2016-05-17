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
					<td><?= getBranchNameByID($s['branch_id'])[0]['branch']; ?></td>
					<td>
						<?php if (! $s['verified']): ?>
							<a href="<?= base_url(); ?>faculty/verifyStudent/<?= $s['id']; ?>/1" style="color: red;">Verify Now!</a>
						<?php else: ?>
							<a href="<?= base_url(); ?>faculty/verifyStudent/<?= $s['id']; ?>/0" style="color: green;">Verified!</a>
						<?php endif; ?>
					</td>
					<td>
						<a href="<?= base_url() ?>faculty/editStudentPage/<?= $s['id'] ?>">edit</a>
					</td>
				</tr>
			<?php endforeach; ?>
			</table>
		<?php endif; ?>
	</div>
</div>