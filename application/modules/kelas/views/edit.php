<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-md-12">
	<?php if (!empty($data['msg'])) : ?>
		<?php echo alert($data['status'], $data['msg']) ?>
		<?php if (!empty($data['msgs'])) : ?>
			<?php foreach ($data['msgs'] as $key => $value) : ?>
				<?php echo alert($data['status'], $value) ?>
			<?php endforeach ?>
		<?php endif ?>
	<?php endif ?>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="panel panel-default card card-default">
			<div class="panel-heading card-header">
				<?php if (empty($data['data'])) : ?>
					tambah
				<?php else : ?>
					ubah
				<?php endif ?> kelas
			</div>
			<div class="panel-body card-body">
				<div class="form-group">
					<label for="kelas_id">kelas</label>
					<select name="kelas_id" class="form-control">
						<?php if (!empty($j)) : ?>
							<?php foreach ($j as $key => $value) : ?>
								<?php $selected = ''; ?>
								<?php if ($value['id'] == $data['data']['kelas_id']) : ?>
									<?php $selected = 'selected'; ?>
								<?php endif ?>
								<option value="<?php echo $value['id'] ?>" <?php echo $selected ?>><?php echo $value['level'] ?></option>
							<?php endforeach ?>
						<?php endif ?>
					</select>
				</div>
				<div class="form-group">
					<label for="nama">nama</label>
					<input type="text" class="form-control" name="nama" placeholder="nama" value="<?php echo @$data['data']['nama'] ?>">
				</div>
			</div>
			<div class="panel-footer card-footer">
				<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
				<button class="btn btn-warning btn-sm" type="reset"><i class="fa fa-undo"></i> Reset</button>
			</div>
		</div>
	</form>
</div>