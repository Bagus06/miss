<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if (@$day == 'Sat' || @$day == 'Sun' || empty($find_mhp)): ?>
	<div class="col-md-12">
		<?php if (!empty($data['msg'])): ?>
			<?php echo alert($data['status'],$data['msg']) ?>
			<?php if (!empty($data['msgs'])): ?>
				<?php foreach ($data['msgs'] as $key => $value): ?>
						<?php echo alert($data['status'], $value) ?>
					<?php endforeach ?>	
			<?php endif ?>
		<?php endif ?>
	</div>
<?php else: ?>
	<div class="col-md-12" style="padding-bottom: 150px;">
		<?php if (!empty($find_mhp)): ?>
			<h4>Presensi siswa kelas (<?php echo @$kelas[$find_mhp['kelas_id']] ?>)</h4>
			<h6>Guru ( <?php echo @$guru[$find_mhp['guru_id']] . ', ' . @$mapel[$find_mhp['mapel_id']] . ', ' . @$find_mhp['jam_mulai'] . '-' . $find_mhp['jam_selesai'] ?> )</h6>
		<?php endif ?>
		<div class="card">
			<div class="card-header">
				<i class="fas fa-table"></i>
				Presensi siswa Tanggal <?= date('Y-m-d'); ?>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" class="datatable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th width="10px">No</th>
								<th>nama</th>
								<th style="text-align:center;">keterangan</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th width="10px">No</th>
								<th>nama</th>
								<th style="text-align:center;">keterangan</th>
							</tr>
						</tfoot>
						<tbody>
							<?php if (!empty($data['data']) && is_array($data['data'])) : ?>
								<?php $no = 1; ?>
								<?php foreach ($data['data'] as $key => $value) : ?>
									<tr id="abs_<?php echo $value['id']?>">
										<td><?php echo $no; ?></td>
										<td><?php echo $value['nama'] ?></td>
										<td align="center">
											<button type="button" class="btn btn-block 
												<?php foreach ($presensi as $key => $a) : ?>
													<?php if ($a['siswa_id'] == $value['id']) : ?>
														<?php foreach ($ket as $key => $b) : ?>
															<?php if ($b['id'] == $a['keterangan']) : ?>
																<?= $b['color']; ?>
															<?php endif ?>
														<?php endforeach ?>
													<?php endif ?>
												<?php endforeach ?>
												" data-toggle="modal" data-target="#exampleModal<?= $value['id'] ?>">
												<?php foreach ($presensi as $key => $a) : ?>
													<?php if ($a['siswa_id'] == $value['id']) : ?>
														<?php foreach ($ket as $key => $b) : ?>
															<?php if ($b['id'] == $a['keterangan']) : ?>
																<?= $b['title']; ?>
															<?php endif ?>
														<?php endforeach ?>
													<?php endif ?>
												<?php endforeach ?>
											</button>
										</td>
									</tr>
									<?php $no++ ?>
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
<?php endif ?>