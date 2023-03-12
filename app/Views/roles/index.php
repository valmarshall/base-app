<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="pagetitle">
    <h1><?= $titlePage; ?></h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active">Daftar Role</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> <?= session()->getFlashdata('pesan'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="card">

                <div class="card-header">
                    <button class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        <i class="bi bi-plus-circle me-1"></i>
                        Tambah Role
                    </button>
                </div>

                <!-- Modal Tambah -->
                <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Role</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <?= form_open('/daftar-role/save'); ?>

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="role" class="form-label">Nama Role</label>
                                    <input type="text" class="form-control <?= (validation_show_error('role')) ? 'is-invalid' : ''; ?>" id="role" name="role" value="<?= old('role'); ?>" autofocus>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('role'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary rounded-pill">Simpan</button>
                            </div>
                            <?= form_close(); ?>

                        </div>
                    </div>
                </div>
                <!-- End Modal Tambah -->

                <div class="card-body">
                    <table class="datatable">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($roles as $r) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $r['role']; ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-success rounded-circle" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $r['slug']; ?>">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                        <a href="/daftar-role/delete/<?= $r['slug']; ?>" class="btn btn-sm btn-danger rounded-circle" onclick="return confirm('Apakah anda yakin akan menghapusnya?')">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>

            </div>

        </div>
    </div>
</section>

<?php foreach ($roles as $r) : ?>
    <!-- Modal Edit <?= $r['role']; ?> -->
    <div class="modal fade" id="modalEdit<?= $r['slug']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Role <?= $r['role']; ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <?= form_open('/daftar-role/update'); ?>

                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $r['id']; ?>">
                    <input type="hidden" name="slug" value="<?= $r['slug']; ?>">
                    <div class="mb-3">
                        <label for="role<?= $r['slug']; ?>" class="form-label">Nama Role</label>
                        <input type="text" class="form-control <?= (validation_show_error('role' . $r['slug'])) ? 'is-invalid' : ''; ?>" id="role<?= $r['slug']; ?>" name="role<?= $r['slug']; ?>" value="<?= (old('role' . $r['slug'])) ? old('role' . $r['slug']) : $r['role']; ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= validation_show_error('role' . $r['slug']); ?>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success rounded-pill">Edit</button>
                </div>
                <?= form_close(); ?>

            </div>
        </div>
    </div>
    <!-- End Modal Edit -->
<?php endforeach; ?>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<?php if (validation_show_error('role')) : ?>
    <script>
        $(document).ready(function() {
            $("#modalTambah").modal('show');
        });
    </script>
<?php endif; ?>

<?php foreach ($roles as $r) : ?>
    <?php if (validation_show_error('role' . $r['slug'])) : ?>
        <?php $idModal = '#modalEdit' . $r['slug'] ?>
        <script>
            $(document).ready(function() {
                $("<?= $idModal; ?>").modal('show');
            });
        </script>
    <?php endif; ?>
<?php endforeach; ?>
<?= $this->endSection(); ?>