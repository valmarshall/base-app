<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="pagetitle">
    <h1><?= $titlePage; ?></h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/daftar-menu">Daftar Menu</a></li>
            <li class="breadcrumb-item active">Tambah Menu</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">

                <?= form_open('/daftar-menu/save'); ?>

                <div class="card-body">

                    <div class="row mt-3">

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Menu</label>
                                <input type="text" class="form-control <?= (validation_show_error('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= old('nama'); ?>" autofocus>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('nama'); ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="parent" class="form-label">Parent Menu</label>
                                <select name="parent" id="parent" class="form-select <?= (validation_show_error('parent')) ? 'is-invalid' : ''; ?>">
                                    <option value="">--- Pilih Parent Menu ---</option>
                                    <option value="0" <?= (old('parent') === "0") ? 'selected' : ''; ?>>Tidak ada parent</option>
                                    <?php foreach ($menus as $m) : ?>
                                        <?php if ($m['url'] == "#") : ?>
                                            <?php
                                            $select = '';
                                            if ($m['id'] == old('parent')) {
                                                $select = 'selected';
                                            }
                                            ?>
                                            <option value="<?= $m['id']; ?>" <?= $select; ?>><?= $m['nama']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <small>
                                    <div class="form-text">*Pilih "Tidak ada parent" jika bukan dropdown dari menu lain</div>
                                </small>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('parent'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="url" class="form-label">URL Menu</label>
                                <input type="text" class="form-control <?= (validation_show_error('url')) ? 'is-invalid' : ''; ?>" id="url" name="url" value="<?= old('url'); ?>">
                                <small>
                                    <div class="form-text">*Masukkan "#" jika menu adalah parent menu</div>
                                </small>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('url'); ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="icon" class="form-label">Icon Class</label>
                                <input type="text" class="form-control <?= (validation_show_error('icon')) ? 'is-invalid' : ''; ?>" id="icon" name="icon" value="<?= old('icon'); ?>">
                                <small>
                                    <div class="form-text">*Hanya class dari icon (cth: "bi bi-speedometer"), icon dapat dilihat di <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icon</a></div>
                                </small>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('icon'); ?>
                                </div>
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