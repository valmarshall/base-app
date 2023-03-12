<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="pagetitle">
    <h1><?= $titlePage; ?></h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active">Ganti Password</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <?php if (session()->getFlashdata('pesanGagal')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal!</strong> <?= session()->getFlashdata('pesanGagal'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> <?= session()->getFlashdata('pesan'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="card">

                <?= form_open('/ganti-password/change'); ?>

                <div class="card-body">

                    <div class="row mt-3">

                        <div class="col-lg-3"></div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password Anda</label>
                                <input type="password" class="form-control <?= (validation_show_error('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" value="<?= old('password'); ?>" placeholder="Masukkan password anda ..." autofocus>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('password'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3"></div>

                    </div>

                    <div class="row">

                        <div class="col-lg-3"></div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">Password Baru</label>
                                <input type="password" class="form-control <?= (validation_show_error('newPassword')) ? 'is-invalid' : ''; ?>" id="newPassword" name="newPassword" value="<?= old('newPassword'); ?>" placeholder="Masukkan password baru ..." autofocus>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('newPassword'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3"></div>

                    </div>

                    <div class="row">

                        <div class="col-lg-3"></div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="rePassword" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control <?= (validation_show_error('rePassword')) ? 'is-invalid' : ''; ?>" id="rePassword" name="rePassword" value="<?= old('rePassword'); ?>" placeholder="Masukkan ulang password anda..." autofocus>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('rePassword'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3"></div>

                    </div>

                </div>

                <div class="card-footer">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary rounded-pill" type="submit">Simpan</button>
                    </div>
                </div>

                <?= form_close(); ?>

            </div>

        </div>
    </div>
</section>

<?= $this->endSection(); ?>