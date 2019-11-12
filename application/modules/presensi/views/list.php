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
</div>
<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<i class="fas fa-table"></i>
			Presensi siswa kelas Tanggal <?= date('Y-m-d'); ?>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" class="datatable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>nama</th>
							<th style="text-align:center;">keterangan</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>No</th>
							<th>nama</th>
							<th style="text-align:center;">keterangan</th>
						</tr>
					</tfoot>
					<tbody>
						<?php $i = 1; ?>
						<?php if (!empty($data['data'])) : ?>
							<?php foreach ($data['data'] as $key => $value) : ?>
								<tr>
									<td><?php echo $i ?></td>
									<td><?php echo $value['nama'] ?></td>
									<td align="center">
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?= $value['id'] ?>">absen</button>
									</td>
								</tr>
								<?php $i++; ?>
							<?php endforeach ?>
						<?php endif ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
	</div>
</div>
<?php
$this->load->view($this->uri->rsegments[1] . '/' . 'modal');
?>