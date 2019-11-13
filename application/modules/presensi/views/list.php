<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-md-12 row">
	<?php foreach ($data['data'] as $key => $value) : ?>
		<div class="col-md-3" style="padding-top:1%;">
			<a href="<?= base_url('presensi/edit?k=') ?><?= $value['id'] ?>" class="btn btn-info btn-block" style="color:white;"><?= $value['nama'] ?></a>
		</div>
	<?php endforeach ?>
</div>