<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="pagetitle">
    <h1><?= $titlePage; ?></h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active">Daftar Menu</li>
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
                    <a href="/daftar-menu/tambah" class="btn btn-primary rounded-pill">
                        <i class="bi bi-plus-circle me-1"></i>
                        Tambah Menu
                    </a>
                </div>

                <div class="card-body">
                    <table class="datatable">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Parent Menu</th>
                                <th>URL</th>
                                <th>Icon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($menus as $m) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td>
                                        <?= $m['nama']; ?>
                                    </td>
                                    <td>
                                        <?php foreach ($menus as $sm) : ?>
                                            <?php if ($sm['id'] == $m['parent_id']) : ?>
                                                <?= $sm['nama']; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </td>
                                    <td>
                                        <?= $m['url']; ?>
                                    </td>
                                    <td>
                                        <i class="<?= $m['icon']; ?>"></i>
                                        <?= $m['icon']; ?>
                                    </td>
                                    <td>
                                        <a href="/daftar-menu/edit/<?= $m['slug']; ?>" class="btn btn-sm btn-success rounded-circle">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <a href="/daftar-menu/delete/<?= $m['slug']; ?>" class="btn btn-sm btn-danger rounded-circle" onclick="return confirm('Apakah anda yakin akan menghapusnya?')">
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