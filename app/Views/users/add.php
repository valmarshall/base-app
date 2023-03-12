<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="pagetitle">
    <h1><?= $titlePage; ?></h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/daftar-user">Daftar User</a></li>
            <li class="breadcrumb-item active">Tambah User</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">

                <?= form_open('/daftar-user/save'); ?>

                <div class="card-body">

                    <div class="row mt-3">

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control <?= (validation_show_error('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= old('nama'); ?>" autofocus>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('nama'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control <?= (validation_show_error('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?= old('username'); ?>">
                                <div class="invalid-feedback">
                                    <?= validation_show_error('username'); ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="role" class="form-label">Pilih Role</label>
                                <select name="role" id="role" class="form-select">
                                    <option value="">--- Pilih Role ---</option>
                                    <?php foreach ($roles as $r) : ?>
                                        <?php if ($r['id'] != 1) : ?>
                                            <option value="<?= $r['id']; ?>"><?= $r['role']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <small>
                                    <div class="form-text">*Kosongkan password untuk menggunakan password default (123456)</div>
                                </small>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="rePassword" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="rePassword" name="rePassword" placeholder="Masukkan ulang password..">

                            </div>
                        </div>

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