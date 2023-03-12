<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="pagetitle">
    <h1><?= $titlePage; ?></h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/akses-role">Akses Role</a></li>
            <li class="breadcrumb-item active">Akses <?= $role['role']; ?></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">

                <div class="card-body">

                    <ul class="list-group mt-3">
                        <?php foreach ($menus as $m) : ?>
                            <?php if ($m['parent_id'] == 0) : ?>
                                <li class="list-group-item">
                                    <input class="form-check-input me-1" type="checkbox" value="<?= $m['id']; ?>" id="menu<?= $m['id']; ?>" data-role="<?= $role['id']; ?>" data-menu="<?= $m['id']; ?>" data-slug="<?= $role['slug']; ?>" <?= cekAkses($role['id'], $m['id']); ?>>
                                    <label class="form-check-label stretched-link" for="menu<?= $m['id']; ?>"><?= $m['nama']; ?></label>

                                </li>
                                <?php if ($m['url'] == "#") : ?>
                                    <ul class="list-group">
                                        <?php foreach ($menus as $sm) : ?>
                                            <?php if ($sm['parent_id'] == $m['id']) : ?>
                                                <li class="list-group-item mx-3">
                                                    <input class="form-check-input me-1" type="checkbox" value="<?= $sm['id']; ?>" id="menu<?= $sm['id']; ?>" data-role="<?= $role['id']; ?>" data-menu="<?= $sm['id']; ?>" data-slug="<?= $role['slug']; ?>" <?= cekAkses($role['id'], $sm['id']); ?>>
                                                    <label class="form-check-label stretched-link" for="menu<?= $sm['id']; ?>"><?= $sm['nama']; ?></label>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>

                </div>

            </div>

        </div>
    </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    $('.form-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');
        const slug = $(this).data('slug');

        $.ajax({
            url: "/akses-role/gantiakses",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                location.href = "/akses-role/akses/" + slug;
            }
        });
    });
</script>
<?= $this->endSection(); ?>