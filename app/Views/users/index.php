<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="pagetitle">
    <h1><?= $titlePage; ?></h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active">Daftar User</li>
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
                    <a href="/daftar-user/tambah" class="btn btn-primary rounded-pill">
                        <i class="bi bi-plus-circle me-1"></i>
                        Tambah User
                    </a>
                </div>

                <div class="card-body">
                    <table class="datatable">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($users as $u) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td>
                                        <img src="/assets/pp/<?= $u['foto']; ?>" alt="pp <?= $u['nama']; ?>" class="img-thumbnail rounded" width="75px">
                                    </td>
                                    <td>
                                        <p><?= $u['nama']; ?></p>
                                        <span class="badge bg-secondary"><?= $u['username']; ?></span>
                                    </td>
                                    <td>
                                        <?php foreach ($roles as $r) : ?>
                                            <?php if ($r['id'] == $u['id_role']) : ?>
                                                <?= $r['role']; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </td>
                                    <td>
                                        <a href="/daftar-user/edit/<?= $u['username']; ?>" class="btn btn-sm btn-success rounded-circle">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <a href="/daftar-user/delete/<?= $u['username']; ?>" class="btn btn-sm btn-danger rounded-circle" onclick="return confirm('Apakah anda yakin akan menghapusnya?')">
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

<?= $this->endSection(); ?>