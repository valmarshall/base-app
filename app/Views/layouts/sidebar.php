<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <?php foreach ($sidebarMenu as $sbm) : ?>
            <?php if (cekAkses(session()->get('role'), $sbm['id']) == 'checked') : ?>
                <?php if ($sbm['url'] != "#" && $sbm['parent_id'] == 0) : ?>
                    <li class="nav-item">
                        <a class="nav-link <?= cekAktifSingleNav($sbm['slug']); ?>" href="<?= $sbm['url']; ?>">
                            <i class="<?= $sbm['icon']; ?>"></i>
                            <span><?= $sbm['nama']; ?></span>
                        </a>
                    </li>
                <?php elseif ($sbm['url'] == "#") : ?>
                    <li class="nav-item">
                        <a class="nav-link <?= cekAktifParent($sbm['id']); ?>" data-bs-target="#<?= $sbm['slug']; ?>-nav" data-bs-toggle="collapse" href="<?= $sbm['url']; ?>">
                            <i class="<?= $sbm['icon']; ?>"></i><span><?= $sbm['nama']; ?></span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="<?= $sbm['slug']; ?>-nav" class="nav-content collapse <?= (cekAktifParent($sbm['id']) != 'collapsed') ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
                            <?php
                            $subMenuModel = new \App\Models\MenusModel();
                            $subMenu = $subMenuModel->getMenusChild($sbm['id']);
                            ?>
                            <?php foreach ($subMenu as $sm) : ?>
                                <?php if (cekAkses(session()->get('role'), $sm['id']) == 'checked') : ?>
                                    <li>
                                        <a href="<?= $sm['url']; ?>" <?= cekAktifChild($sm['slug']); ?>>
                                            <i class="<?= $sm['icon']; ?>"></i>
                                            <span><?= $sm['nama']; ?></span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>


        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link" href="pages-blank.html">
                <i class="bi bi-file-earmark"></i>
                <span>Blank</span>
            </a>
        </li><!-- End Blank Page Nav -->

    </ul>

</aside><!-- End Sidebar-->