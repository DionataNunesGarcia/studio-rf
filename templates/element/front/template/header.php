<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img pere-text">
                <img src="/img/logo.jpg" alt="">
            </div>
        </div>
    </div>
</div>
<header>
    <!-- Header Start -->
    <div class="header-area header-transparent">
        <div class="main-header header-sticky">
            <div class="container-fluid">
                <div class="menu-wrapper d-flex align-items-center justify-content-between">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="<?= $this->Url->build('/', ['fullBase' => true]); ?>"><img src="img/logo.png" alt=""></a>
                    </div>
                    <!-- Main-menu -->
                    <div class="main-menu f-right d-none d-lg-block">
                        <nav>
                            <ul id="navigation">

                                <li>
                                    <a href="<?= $this->Url->build('/', ['fullBase' => true]); ?>" title="Home">Home</a>
                                </li>
                                <li>
                                    <a href="<?= $this->Url->build('/sobre', ['fullBase' => true]); ?>" title="Sobre">Sobre</a>
                                </li>
                                <li>
                                    <a href="<?= $this->Url->build('/servicos', ['fullBase' => true]); ?>">Serviços</a>
                                </li>

                                <?php
                                $limit = 6;
                                $count = count($categories);
                                $showSubMenu = $count > $limit;
                                //if exist 6 or more categories, show in submenu
                                if ($showSubMenu) {
                                ?>
                                    <li>
                                        <a href="<?php  $this->Url->build('/conteudos', ['fullBase' => true]); ?>">
                                            <span>
                                                Conteúdos
                                            </span>
                                            <i class="bi bi-chevron-down dropdown-indicator"></i>
                                        </a>
                                        <ul class="submenu">
                                <?php } ?>
                                <?php foreach ($categories as $category) { ?>
                                    <li>
                                        <a href="<?= $this->Url->build("/conteudos/{$category->slug}", ['fullBase' => true]); ?>">
                                            <?= $category->name ?>
                                        </a>
                                    </li>
                                <?php
                                }
                                if ($showSubMenu) { ?>
                                        </ul>
                                    </li>
                                <?php } ?>
                                <li>
                                    <a href="<?= $this->Url->build('/contato', ['fullBase' => true]); ?>">Contato</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- Header-btn -->
<!--                    <div class="header-btns d-none d-lg-block f-right">-->
<!--                        <a href="#" class="btn header-btn">Entre em Contato</a>-->
<!--                    </div>-->
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>