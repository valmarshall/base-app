<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="pagetitle">
    <h1><?= $titlePage; ?></h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active">Akses Role</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">

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
                                    <td>
                                        <?= $r['role']; ?>
                                    </td>
                                    <td>
                                        <a href="/akses-role/akses/<?= $r['slug']; ?>" class="btn btn-sm btn-info rounded-circle">
                                            <i class="bi bi-info-circle"></i>
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