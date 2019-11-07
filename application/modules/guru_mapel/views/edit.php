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
				<?php endif ?> guru mapel
			</div>
			<div class="panel-body card-body">
				<div class="form-row">
					<div class="col-md-6 mb-3">
						<label for="mulai">mulai</label>
						<input name="jam_mulai" id="timepicker" width="350" value="">
					</div>
					<div class="col-md-6 mb-3">
						<label for="selesai">selesai</label>
						<input name="jam_selesai" id="timepicker2" width="350" value="">
					</div>
				</div>
				<input name="guru_id" type="hidden" value="<?= $id; ?>">
				<div class="form-group">
					<label for="hari">hari</label>
					<select name="hari" class="form-control">
						<?php if (!empty($hari)) : ?>
							<?php foreach ($hari as $key => $value) : ?>
								<?php $selected = ''; ?>
								<?php if (in_array($value['id'], $data['nama'])) : ?>
									<?php $selected = 'selected'; ?>
								<?php endif ?>
								<option value="<?php echo $value['id'] ?>" <?php echo $selected ?>><?php echo $value['nama'] ?></option>
							<?php endforeach ?>
						<?php endif ?>
					</select>
				</div>
				<div class="form-group">
					<label for="mapel">mapel</label>
					<select name="mapel_id" class="form-control">
						<?php if (!empty($mapel)) : ?>
							<?php foreach ($mapel as $key => $value) : ?>
								<?php $selected = ''; ?>
								<?php if (in_array($value['id'], $data['nama'])) : ?>
									<?php $selected = 'selected'; ?>
								<?php endif ?>
								<option value="<?php echo $value['id'] ?>" <?php echo $selected ?>><?php echo $value['nama'] ?></option>
							<?php endforeach ?>
						<?php endif ?>
					</select>
				</div>
				<div class="form-group">
					<label for="th_ajaran">angkatan</label>
					<select name="th_ajaran_id" class="form-control">
						<?php if (!empty($th_ajaran)) : ?>
							<?php foreach ($th_ajaran as $key => $value) : ?>
								<?php $selected = ''; ?>
								<?php if (in_array($value['id'], $data['title'])) : ?>
									<?php $selected = 'selected'; ?>
								<?php endif ?>
								<option value="<?php echo $value['id'] ?>" <?php echo $selected ?>><?php echo $value['title'] ?></option>
							<?php endforeach ?>
						<?php endif ?>
					</select>
				</div>
				<div class="form-group">
					<label for="kelas">kelas</label>
					<select name="kelas_id" class="form-control">
						<?php if (!empty($kelas)) : ?>
							<?php foreach ($kelas as $key => $value) : ?>
								<?php $selected = ''; ?>
								<?php if (in_array($value['id'], $data['nama'])) : ?>
									<?php $selected = 'selected'; ?>
								<?php endif ?>
								<option value="<?php echo $value['id'] ?>" <?php echo $selected ?>><?php echo $value['nama'] ?></option>
							<?php endforeach ?>
						<?php endif ?>
					</select>
				</div>
				<div class="panel-footer card-footer">
					<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
					<button class="btn btn-warning btn-sm" type="reset"><i class="fa fa-undo"></i> Reset</button>
				</div>
			</div>
		</div>
	</form>
</div>