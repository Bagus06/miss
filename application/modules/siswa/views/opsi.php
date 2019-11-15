<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if (!$this->input->get('kejuruan')) : ?>
    <div class="col-md-12 row">
        <?php foreach ($data['data'] as $key => $value) : ?>
            <div class="col-md-3" style="padding-top:1%;">
                <a href="<?php echo base_url('siswa/opsi?kejuruan=') ?><?php echo $value['nama'] ?>" class="btn btn-lg btn-info btn-block" style="color:white;background-color: #212529;font-size: -webkit-xxx-large;font-weight: bold;"><?php echo $value['nama'] ?></a>
            </div>
        <?php endforeach ?>
    </div>
<?php elseif ($this->input->get('kejuruan')) : ?>
    <div class="col-md-12 row">
        <?php $color = ['rpl' => '#000000', 'otkp' => '#00DCFF', 'tbsm' => '#004DFF', 'akl' => '#F9B100', 'bdp' => '#001640'] ?>

        <?php foreach ($kelas as $key => $value) : ?>
            <?php
                    $kejuruan = $this->input->get('kejuruan');
                    $jurusan = $value['nama'];
                    $jurusan = explode(' ', $jurusan);
                    $jurusan = $jurusan[1];
                    ?>
            <?php if ($jurusan == $kejuruan) : ?>
                <div class="col-md-3" style="padding-top:1%;">
                    <a href="<?php echo base_url('siswa/list?k=') ?><?= $value['id']; ?>" class="btn btn-lg btn-info btn-block" style="color:white;background-color: <?php echo $color[strtolower($jurusan)] ?>;"><?= str_replace(' ', '<br>', $value['nama']) ?></a>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    </div>
<?php else : ?>
<?php endif ?>