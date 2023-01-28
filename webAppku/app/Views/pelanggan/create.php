<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Tambah Data Pelanggan</h2>
            <form action="/pelanggan/save" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="KTP" class="col-sm-2 col-form-label">Photo KTP</label>
                    <div class="col-sm-8">
                        <input class="form-control <?= ($validation->hasError('KTP')) ? 'is-invalid' : ''; ?>" type="file" id="KTP" name="KTP" onchange="previewImg()">
                        <div class="invalid-feedback">
                            <?= $validation->getError('KTP'); ?>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <img src="/img/default.jpg" class="img-thumbnail img-preview">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nojar" class="col-sm-2 col-form-label">NoJar</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nojar')) ? 'is-invalid' : ''; ?>" id="nojar" name="nojar" autofocus value="<?= old('nojar'); ?>">
                        <div class=" invalid-feedback">
                            <?= $validation->getError('nojar'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= old('nama'); ?>">
                        <div class=" invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kontak" class="col-sm-2 col-form-label">Kontak</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('kontak')) ? 'is-invalid' : ''; ?>" id="kontak" name="kontak" value="<?= old('kontak'); ?>">
                        <div class=" invalid-feedback">
                            <?= $validation->getError('kontak'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" value="<?= old('alamat'); ?>">
                        <div class=" invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="akses" class="col-sm-2 col-form-label">Akses</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('akses')) ? 'is-invalid' : ''; ?>" id="akses" name="akses" value="<?= old('akses'); ?>">
                        <div class=" invalid-feedback">
                            <?= $validation->getError('akses'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ipwan" class="col-sm-2 col-form-label">IP WAN</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('ipwan')) ? 'is-invalid' : ''; ?>" id="ipwan" name="ipwan" value="<?= old('ipwan'); ?>">
                        <div class=" invalid-feedback">
                            <?= $validation->getError('ipwan'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('status')) ? 'is-invalid' : ''; ?>" id="status" name="status" value="<?= old('status'); ?>">
                        <div class=" invalid-feedback">
                            <?= $validation->getError('status'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>