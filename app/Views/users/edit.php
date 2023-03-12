<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="pagetitle">
    <h1><?= $titlePage; ?></h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/daftar-user">Daftar User</a></li>
            <li class="breadcrumb-item active">Edit User</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">

                <?= form_open('/daftar-user/update'); ?>

                <div class="card-body">
                    <input type="hidden" name="id" value="<?= $user['id']; ?>">
                    <input type="hidden" name="usernameLama" value="<?= $user['username']; ?>">

                    <div class="row mt-3">

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control <?= (validation_show_error('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= (old('nama')) ? old('nama') : $user['nama']; ?>" autofocus>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('nama'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control <?= (validation_show_error('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?= (old('username')) ? old('username') : $user['username']; ?>">
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
                                        <?php $selected = ''; ?>
                                        <?php
                                        if ($r['id'] == $user['id_role']) {
                                            $selected = 'selected';
                                        }
                                        ?>
                                        <?php if ($r['id'] != 1) : ?>
                                            <option value="<?= $r['id']; ?>" <?= $selected; ?>><?= $r['role']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="card-footer">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-success rounded-pill" type="submit">Ubah</button>
                    </div>
                </div>

                <?= form_close(); ?>

            </div>

        </div>
    </div>
</section>

<?= $this->endSection(); ?>