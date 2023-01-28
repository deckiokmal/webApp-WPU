<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h4>Detail Pelanggan</h4>
            <div class="card mb-2" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $pelanggan['KTP']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Nama : <?= $pelanggan['nama']; ?></h5>
                            <p class="card-text">[Media Access] -> <?= $pelanggan['akses']; ?> :: <?= $pelanggan['status']; ?></p>
                            <p class="card-text">[No Telp/WA] -><a href="https://wa.me/<?= $pelanggan['kontak']; ?>" target="_blank"><?= $pelanggan['kontak']; ?></a></p>
                            <p class="card-text"><small class="text-muted">IPWAN Pelanggan adalah <a class="btn btn-success" href="http://<?= $pelanggan['ipwan']; ?>" target="_blank"><?= $pelanggan['ipwan']; ?></a></small></p>
                            <a href="/pelanggan/edit/<?= $pelanggan['id']; ?>" class="btn btn-warning">Edit</a>
                            <form action="/pelanggan/<?= $pelanggan['id']; ?>" method="POST" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('apakah kamu yakin?');">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <a class="btn btn-success mt-1 mb-1" href="/pelanggan">Kembali ke list</a>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>