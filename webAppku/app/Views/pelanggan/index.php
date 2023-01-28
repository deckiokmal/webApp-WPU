<!-- Memasukkan layout template -->
<?= $this->extend('layout/template'); ?>

<!-- Memberi tanda bahwa ini adalah section -->
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a class="btn btn-primary ml-2" href="/pelanggan/create">Tambah Data Pelanggan</a>
            <h2 class="mt-2">List of costumers</h2>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-info" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">KTP</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kontak</th>
                        <th scope="col">IP Address</th>
                        <th scope="col">Media Akses</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                    <?php foreach ($pelanggan as $p) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td>
                                <img class="photo-pelanggan" src="/img/<?= $p['KTP']; ?>" alt="">
                            </td>
                            <td><?= $p['nama']; ?></td>
                            <td><?= $p['kontak']; ?></td>
                            <td><?= $p['ipwan']; ?></td>
                            <td><?= $p['akses'];  ?></td>
                            <td><?= $p['status'];  ?></td>
                            <td>
                                <a href="/pelanggan/<?= $p['id']; ?>" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('pelanggan', 'pelanggan_page') ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>