<?php if (!empty($data['data'])) : ?>
    <?php foreach ($data['data'] as $key => $value) : ?>
        <div class="modal fade" id="exampleModal<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Absen</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <input type="hidden" name="siswa_id" value="<?= $value['id'] ?>">
                        <input type="hidden" name="kelas_id" value="<?= $value['kelas_id'] ?>">
                        <div class="modal-body">
                            <?php foreach ($presensi as $key => $a) : ?>
                                <?php if ($a['siswa_id'] == $value['id']) : ?>
                                    <?php foreach ($ket as $key => $b) : ?>
                                        <?php if ($b['id'] == $a['keterangan']) : ?>
                                            <input class="form-control" type="text" value="<?= $b['title'] ?>" readonly>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php endif ?>
                            <?php endforeach ?>
                            <select class="custom-select" size="3" name="keterangan" required>
                                <?php foreach ($ket as $key => $b) : ?>
                                    <option value="<?php echo $b['id'] ?>"><?php echo $b['title'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <input type="hidden" name="tanggal" value="<?php echo date('Y-m-d'); ?>">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php endforeach ?>
<?php endif ?>