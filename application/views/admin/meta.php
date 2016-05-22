<div class="container">
	<div class="row">
		<?= form_open ('admin/addMetaData'); ?>

		<?php 
			$hcetAbout = '';
			$notixAbout = '';
			if (!empty ($about)) {
				$hcetAbout = $about['hcet_about_meta'];
				$notixAbout = $about['notix_about_meta'];
			}
		?>

		<p>
			<label for="about_meta">About Hcet:</label>
			<textarea name="hcet_about_meta" id="hcet_about_meta" ><?= $hcetAbout ?></textarea>
		</p>
		<p>
			<label for="about_meta">About Notix:</label>
			<textarea name="notix_about_meta" id="notix_about_meta" ><?= $notixAbout ?></textarea>
		</p>
		<p>
			<button class="primary" type="submit">Save</button>
		</p>


		<?php form_close (); ?>
	</div>
</div>