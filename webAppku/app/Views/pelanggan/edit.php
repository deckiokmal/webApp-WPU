<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Edit Data Pelanggan</h2>
            <form action="/pelanggan/update/<?= $pelanggan['id']; ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="KTPLama" value="<?= $pelanggan['KTP']; ?>">
                <div class="row mb-3">
                    <label for="nojar" class="col-sm-2 col-form-label">NoJar</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control <?= ($validation->hasError('nojar')) ? 'is-invalid' : ''; ?>" id="nojar" name="nojar" autofocus value="<?= $pelanggan['nojar']; ?>">
                        <div class=" invalid-feedback">
                            <?= $validation->getError('nojar'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= $pelanggan['nama']; ?>">
                        <div class=" invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kontak" class="col-sm-2 col-form-label">Kontak</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control <?= ($validation->hasError('kontak')) ? 'is-invalid' : ''; ?>" id="kontak" name="kontak" value="<?= $pelanggan['kontak']; ?>">
                        <div class=" invalid-feedback">
                            <?= $validation->getError('kontak'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" value="<?= $pelanggan['alamat']; ?>">
                        <div class=" invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="akses" class="col-sm-2 col-form-label">Akses</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control <?= ($validation->hasError('akses')) ? 'is-invalid' : ''; ?>" id="akses" name="akses" value="<?= $pelanggan['akses']; ?>">
                        <div class=" invalid-feedback">
                            <?= $validation->getError('akses'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ipwan" class="col-sm-2 col-form-label">IP WAN</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control <?= ($validation->hasError('ipwan')) ? 'is-invalid' : ''; ?>" id="ipwan" name="ipwan" value="<?= $pelanggan['ipwan']; ?>">
                        <div class=" invalid-feedback">
                            <?= $validation->getError('ipwan'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <div class="dropdown col-sm-4">
                        <input type="text" class="form-control id=" status" name="status" value="<?= $pelanggan['status']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="KTP" class="col-sm-2 col-form-label">Photo KTP</label>
                    <div class="col-sm-8">
                        <input class="form-control <?= ($validation->hasError('KTP')) ? 'is-invalid' : ''; ?>" type="file" id="KTP" name="KTP" onchange="previewImg()">
                        <div class="invalid-feedback">
                            <?= $validation->getError('KTP'); ?>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <img src="/img/<?= $pelanggan['KTP']; ?>" class="img-thumbnail img-preview mb-2">(<?= $pelanggan['KTP']; ?>)</img>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>