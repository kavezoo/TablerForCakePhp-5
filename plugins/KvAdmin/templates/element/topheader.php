<header class="navbar navbar-expand-md d-print-none">
    <div class="container-xl">
        <!-- BEGIN NAVBAR TOGGLER -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="<?= __('Toggle navigation') ?>">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- END NAVBAR TOGGLER -->

        <!-- BEGIN NAVBAR LOGO -->
        <div class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <?= $this->Html->link(
                '<svg xmlns="http://www.w3.org/2000/svg" width="110" height="32" viewBox="0 0 232 68" class="navbar-brand-image">
                    <path d="M64.6 16.2C63 9.9 58.1 5 51.8 3.4 40 1.5 28 1.5 16.2 3.4 9.9 5 5 9.9 3.4 16.2 1.5 28 1.5 40 3.4 51.8 5 58.1 9.9 63 16.2 64.6c11.8 1.9 23.8 1.9 35.6 0C58.1 63 63 58.1 64.6 51.8c1.9-11.8 1.9-23.8 0-35.6zM33.3 36.3c-2.8 4.4-6.6 8.2-11.1 11-1.5.9-3.3.9-4.8.1s-2.4-2.3-2.5-4c0-1.7.9-3.3 2.4-4.1 2.3-1.4 4.4-3.2 6.1-5.3-1.8-2.1-3.8-3.8-6.1-5.3-2.3-1.3-3-4.2-1.7-6.4s4.3-2.9 6.5-1.6c4.5 2.8 8.2 6.5 11.1 10.9 1 1.4 1 3.3.1 4.7zM49.2 46H37.8c-2.1 0-3.8-1-3.8-3s1.7-3 3.8-3h11.4c2.1 0 3.8 1 3.8 3s-1.7 3-3.8 3z" fill="#066fd1" style="fill: var(--tblr-primary, #066fd1)"></path>
                    <path d="M105.8 46.1c.4 0 .9.2 1.2.6s.6 1 .6 1.7c0 .9-.5 1.6-1.4 2.2s-2 .9-3.2.9c-2 0-3.7-.4-5-1.3s-2-2.6-2-5.4V31.6h-2.2c-.8 0-1.4-.3-1.9-.8s-.9-1.1-.9-1.9c0-.7.3-1.4.8-1.8s1.2-.7 1.9-.7h2.2v-3.1c0-.8.3-1.5.8-2.1s1.3-.8 2.1-.8 1.5.3 2 .8.8 1.3.8 2.1v3.1h3.4c.8 0 1.4.3 1.9.8s.8 1.2.8 1.9-.3 1.4-.8 1.8-1.2.7-1.9.7h-3.4v13c0 .7.2 1.2.5 1.5s.8.5 1.4.5c.3 0 .6-.1 1.1-.2.5-.2.8-.3 1.2-.3zm28-20.7c.8 0 1.5.3 2.1.8.5.5.8 1.2.8 2.1v20.3c0 .8-.3 1.5-.8 2.1-.5.6-1.2.8-2.1.8s-1.5-.3-2-.8-.8-1.2-.8-2.1c-.8.9-1.9 1.7-3.2 2.4-1.3.7-2.8 1-4.3 1-2.2 0-4.2-.6-6-1.7-1.8-1.1-3.2-2.7-4.2-4.7s-1.6-4.3-1.6-6.9c0-2.6.5-4.9 1.5-6.9s2.4-3.6 4.2-4.8c1.8-1.1 3.7-1.7 5.9-1.7 1.5 0 3 .3 4.3.8 1.3.6 2.5 1.3 3.4 2.1 0-.8.3-1.5.8-2.1.5-.5 1.2-.7 2-.7zm-9.7 21.3c2.1 0 3.8-.8 5.1-2.3s2-3.4 2-5.7-.7-4.2-2-5.8c-1.3-1.5-3-2.3-5.1-2.3-2 0-3.7.8-5 2.3-1.3 1.5-2 3.5-2 5.8s.6 4.2 1.9 5.7 3 2.3 5.1 2.3zm32.1-21.3c2.2 0 4.2.6 6 1.7 1.8 1.1 3.2 2.7 4.2 4.7s1.6 4.3 1.6 6.9-.5 4.9-1.5 6.9-2.4 3.6-4.2 4.8c-1.8 1.1-3.7 1.7-5.9 1.7-1.5 0-3-.3-4.3-.9s-2.5-1.4-3.4-2.3v.3c0 .8-.3 1.5-.8 2.1-.5.6-1.2.8-2.1.8s-1.5-.3-2.1-.8c-.5-.5-.8-1.2-.8-2.1V18.9c0-.8.3-1.5.8-2.1.5-.6 1.2-.8 2.1-.8s1.5.3 2.1.8c.5.6.8 1.3.8 2.1v10c.8-1 1.8-1.8 3.2-2.5 1.3-.7 2.8-1 4.3-1zm-.7 21.3c2 0 3.7-.8 5-2.3s2-3.5 2-5.8-.6-4.2-1.9-5.7-3-2.3-5.1-2.3-3.8.8-5.1 2.3-2 3.4-2 5.7.7 4.2 2 5.8c1.3 1.6 3 2.3 5.1 2.3zm23.6 1.9c0 .8-.3 1.5-.8 2.1s-1.3.8-2.1.8-1.5-.3-2-.8-.8-1.3-.8-2.1V18.9c0-.8.3-1.5.8-2.1s1.3-.8 2.1-.8 1.5.3 2 .8.8 1.3.8 2.1v29.7zm29.3-10.5c0 .8-.3 1.4-.9 1.9-.6.5-1.2.7-2 .7h-15.8c.4 1.9 1.3 3.4 2.6 4.4 1.4 1.1 2.9 1.6 4.7 1.6 1.3 0 2.3-.1 3.1-.4.7-.2 1.3-.5 1.8-.8.4-.3.7-.5.9-.6.6-.3 1.1-.4 1.6-.4.7 0 1.2.2 1.7.7s.7 1 .7 1.7c0 .9-.4 1.6-1.3 2.4-.9.7-2.1 1.4-3.6 1.9s-3 .8-4.6.8c-2.7 0-5-.6-7-1.7s-3.5-2.7-4.6-4.6-1.6-4.2-1.6-6.6c0-2.8.6-5.2 1.7-7.2s2.7-3.7 4.6-4.8 3.9-1.7 6-1.7 4.1.6 6 1.7 3.4 2.7 4.5 4.7c.9 1.9 1.5 4.1 1.5 6.3zm-12.2-7.5c-3.7 0-5.9 1.7-6.6 5.2h12.6v-.3c-.1-1.3-.8-2.5-2-3.5s-2.5-1.4-4-1.4zm30.3-5.2c1 0 1.8.3 2.4.8.7.5 1 1.2 1 1.9 0 1-.3 1.7-.8 2.2-.5.5-1.1.8-1.8.7-.5 0-1-.1-1.6-.3-.2-.1-.4-.1-.6-.2-.4-.1-.7-.1-1.1-.1-.8 0-1.6.3-2.4.8s-1.4 1.3-1.9 2.3-.7 2.3-.7 3.7v11.4c0 .8-.3 1.5-.8 2.1-.5.6-1.2.8-2.1.8s-1.5-.3-2.1-.8c-.5-.6-.8-1.3-.8-2.1V28.8c0-.8.3-1.5.8-2.1.5-.6 1.2-.8 2.1-.8s1.5.3 2.1.8c.5.6.8 1.3.8 2.1v.6c.7-1.3 1.8-2.3 3.2-3 1.3-.7 2.8-1 4.3-1z" fill-rule="evenodd" clip-rule="evenodd" fill="#4a4a4a"></path>
                </svg>',
                '/',
                [
                    'escape' => false,
                    'aria-label' => 'Tabler'
                ]
            ) ?>
        </div>
        <!-- END NAVBAR LOGO -->

        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item d-none d-md-flex me-3">
                <div class="btn-list">
                    <?= $this->Html->link(
                        $this->Icon->outline('brand-github', ['class' => 'icon icon-2']) . ' ' . __('Source code'),
                        'https://github.com/tabler/tabler',
                        [
                            'escape' => false,
                            'class' => 'btn btn-5',
                            'target' => '_blank',
                            'rel' => 'noreferrer'
                        ]
                    ) ?>

                    <?= $this->Html->link(
                        $this->Icon->outline('heart', ['class' => 'icon text-pink icon-2']) . ' ' . __('Sponsor'),
                        'https://github.com/sponsors/codecalm',
                        [
                            'escape' => false,
                            'class' => 'btn btn-6',
                            'target' => '_blank',
                            'rel' => 'noreferrer'
                        ]
                    ) ?>
                </div>
            </div>

            <div class="d-none d-md-flex">
                <div class="nav-item">
                    <?= $this->Html->link(
                        $this->Icon->outline('moon', ['class' => 'icon icon-1']),
                        ['?' => ['theme' => 'dark']],
                        [
                            'escape' => false,
                            'class' => 'nav-link px-0 hide-theme-dark',
                            'data-bs-toggle' => 'tooltip',
                            'data-bs-placement' => 'bottom',
                            'aria-label' => __('Enable dark mode'),
                            'data-bs-original-title' => __('Enable dark mode')
                        ]
                    ) ?>

                    <?= $this->Html->link(
                        $this->Icon->outline('sun', ['class' => 'icon icon-1']),
                        ['?' => ['theme' => 'light']],
                        [
                            'escape' => false,
                            'class' => 'nav-link px-0 hide-theme-light',
                            'data-bs-toggle' => 'tooltip',
                            'data-bs-placement' => 'bottom',
                            'aria-label' => __('Enable light mode'),
                            'data-bs-original-title' => __('Enable light mode')
                        ]
                    ) ?>
                </div>

                <!-- Értesítések (Notifications) -->
                <div class="nav-item dropdown d-none d-md-flex">
                    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="<?= __('Show notifications') ?>" data-bs-auto-close="outside" aria-expanded="false">
                        <?= $this->Icon->outline('bell', ['class' => 'icon icon-1']) ?>
                        <span class="badge bg-red"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                        <div class="card">
                            <div class="card-header d-flex">
                                <h3 class="card-title"><?= __('Notifications') ?></h3>
                                <div class="btn-close ms-auto" data-bs-dismiss="dropdown"></div>
                            </div>
                            <div class="list-group list-group-flush list-group-hoverable">
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span class="status-dot status-dot-animated bg-red d-block"></span></div>
                                        <div class="col text-truncate">
                                            <a href="#" class="text-body d-block"><?= __('Example 1') ?></a>
                                            <div class="d-block text-secondary text-truncate mt-n1">Change deprecated html tags to text decoration classes (#29604)</div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#" class="list-group-item-actions">
                                                <?= $this->Icon->outline('star', ['class' => 'icon text-muted icon-2']) ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span class="status-dot d-block"></span></div>
                                        <div class="col text-truncate">
                                            <a href="#" class="text-body d-block"><?= __('Example 2') ?></a>
                                            <div class="d-block text-secondary text-truncate mt-n1">justify-content:between ⇒ justify-content:space-between (#29734)</div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#" class="list-group-item-actions show">
                                                <?= $this->Icon->outline('star', ['class' => 'icon text-yellow icon-2']) ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span class="status-dot d-block"></span></div>
                                        <div class="col text-truncate">
                                            <a href="#" class="text-body d-block"><?= __('Example 3') ?></a>
                                            <div class="d-block text-secondary text-truncate mt-n1">Update change-version.js (#29736)</div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#" class="list-group-item-actions">
                                                <?= $this->Icon->outline('star', ['class' => 'icon text-muted icon-2']) ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span class="status-dot status-dot-animated bg-green d-block"></span></div>
                                        <div class="col text-truncate">
                                            <a href="#" class="text-body d-block"><?= __('Example 4') ?></a>
                                            <div class="d-block text-secondary text-truncate mt-n1">Regenerate package-lock.json (#29730)</div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#" class="list-group-item-actions">
                                                <?= $this->Icon->outline('star', ['class' => 'icon text-muted icon-2']) ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <a href="#" class="btn btn-2 w-100"><?= __('Archive all') ?></a>
                                    </div>
                                    <div class="col">
                                        <a href="#" class="btn btn-2 w-100"><?= __('Mark all as read') ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alkalmazások (Apps Menu) -->
                <div class="nav-item dropdown d-none d-md-flex me-3">
                    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="<?= __('Show app menu') ?>" data-bs-auto-close="outside" aria-expanded="false">
                        <?= $this->Icon->outline('apps', ['class' => 'icon icon-1']) ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title"><?= __('My Apps') ?></div>
                                <div class="card-actions btn-actions">
                                    <a href="#" class="btn-action">
                                        <?= $this->Icon->outline('settings', ['class' => 'icon icon-1']) ?>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body scroll-y p-2" style="max-height: 50vh">
                                <div class="row g-0">
                                    <div class="col-4">
                                        <a href="#" class="d-flex flex-column flex-center text-center text-secondary py-2 px-2 link-hoverable">
                                            <?= $this->Html->image('/static/brands/android.svg', ['class' => 'w-6 h-6 mx-auto mb-2', 'width' => 24, 'height' => 24, 'alt' => 'Android']) ?>
                                            <span class="h5">Android</span>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="#" class="d-flex flex-column flex-center text-center text-secondary py-2 px-2 link-hoverable">
                                            <?= $this->Html->image('/static/brands/facebook.svg', ['class' => 'w-6 h-6 mx-auto mb-2', 'width' => 24, 'height' => 24, 'alt' => 'Facebook']) ?>
                                            <span class="h5">Facebook</span>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="#" class="d-flex flex-column flex-center text-center text-secondary py-2 px-2 link-hoverable">
                                            <?= $this->Html->image('/static/brands/github.svg', ['class' => 'w-6 h-6 mx-auto mb-2', 'width' => 24, 'height' => 24, 'alt' => 'GitHub']) ?>
                                            <span class="h5">GitHub</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Felhasználói fiók / Menü -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 p-0 px-2" data-bs-toggle="dropdown" aria-label="<?= __('Open user menu') ?>" aria-expanded="false">
                    <span class="avatar avatar-sm" style="background-image: url('<?= $this->Url->assetUrl('/static/avatars/000m.jpg') ?>')"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div><?= h($currentUser->name ?? 'Jeff Shoemaker') ?></div>
                        <div class="mt-1 small text-secondary"><?= h($currentUser->role_title ?? __('Admin')) ?></div>
                    </div>
                </a>

				<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
					<a href="#" class="dropdown-item d-flex align-items-center justify-content-between">
						<span><?= __('Status') ?></span>
						<?= $this->Icon->outline('activity', ['class' => 'icon text-muted ms-auto']) ?>
					</a>

					<?= $this->Html->link(
						'<span>' . __('Profile') . '</span>' . $this->Icon->outline('user', ['class' => 'icon text-muted ms-auto']),
						['controller' => 'Users', 'action' => 'login'],
						['escape' => false, 'class' => 'dropdown-item d-flex align-items-center justify-content-between']
					) ?>

					<a href="#" class="dropdown-item d-flex align-items-center justify-content-between">
						<span><?= __('Feedback') ?></span>
						<?= $this->Icon->outline('message-dots', ['class' => 'icon text-muted ms-auto']) ?>
					</a>

					<div class="dropdown-divider"></div>

					<?= $this->Html->link(
						'<span>' . __('Settings') . '</span>' . $this->Icon->outline('settings', ['class' => 'icon text-muted ms-auto']),
						['controller' => 'Users', 'action' => 'register'],
						['escape' => false, 'class' => 'dropdown-item d-flex align-items-center justify-content-between']
					) ?>

					<?= $this->Html->link(
						'<span>' . __('Change Password') . '</span>' . $this->Icon->outline('key', ['class' => 'icon text-muted ms-auto']),
						['controller' => 'Users', 'action' => 'change-password'],
						['escape' => false, 'class' => 'dropdown-item d-flex align-items-center justify-content-between']
					) ?>

					<?= $this->Html->link(
						'<span>' . __('Logout') . '</span>' . $this->Icon->outline('logout', ['class' => 'icon text-muted ms-auto']),
						['controller' => 'Users', 'action' => 'logout'],
						['escape' => false, 'class' => 'dropdown-item d-flex align-items-center justify-content-between']
					) ?>
				</div>


            </div>
			

        </div>
    </div>
</header>