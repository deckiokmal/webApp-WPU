<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        This is My Contact.
        <?php foreach ($alamat as $a) : ?>
            <ul>
                <li><?= $a['tipe'];  ?></li>
                <li><?= $a['alamat'];  ?></li>
                <li><?= $a['kota'];  ?></li>
            </ul>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection(); ?>