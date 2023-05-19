<style>
    .treeview-menu li.disabled:hover, .treeview-menu li.disabled a:hover {
        cursor: no-drop;
    }
</style>
<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php
                $image = 'user-default.png';
                if (!empty($userSession['avatar']) && file_exists(WWW_ROOT . 'Uploads' . DS . $userSession['avatar']['filename'])) {
                    $image = "../Uploads/"  . $userSession['avatar']['filename'];
                }
                ?>
                <?= $this->Html->image($image, ['class' => 'img-circle']); ?>
            </div>
            <div class="pull-left info">
                <p>
                    <?= ucfirst($userSession['user']); ?>
                </p>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <!-- Cadastros -->
            <li>
                <a href="<?= $this->Url->build(['controller' => 'Clients', 'action' => 'index'], ['fullBase' => true]); ?>" title="" data-placement="right">
                    <i class="fa fa-users"></i>
                    <?= __('Clientes') ?>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build(['controller' => 'Events', 'action' => 'index'], ['fullBase' => true]); ?>" data-placement="right">
                    <i class="fa fa-calendar-plus-o"></i>
                    <?= __('Calendário') ?>
                </a>
            </li>
            <!-- Site -->
            <li class=" treeview">
                <a href="#">
                    <i class="fa fa-home"></i>
                    <span>
                        <?= __('Site') ?>
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?= $this->Url->build(['controller' => 'Blogs', 'action' => 'index'], ['fullBase' => true]); ?>" title="" data-placement="right">
                            <i class="fa fa-circle-o"></i>
                            <?= __('Conteúdos') ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['controller' => 'Blogs', 'action' => 'searchOwners'], ['fullBase' => true]); ?>" title="" data-placement="right">
                            <i class="fa fa-circle-o"></i>
                            <?= __('Meus Conteúdos') ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['controller' => 'BlogsCategories', 'action' => 'index'], ['fullBase' => true]); ?>" title="" data-placement="right">
                            <i class="fa fa-circle-o"></i>
                            <?= __('Categorias de Conteúdos') ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['controller' => 'Tags', 'action' => 'index'], ['fullBase' => true]); ?>" title="" data-placement="right">
                            <i class="fa fa-circle-o"></i>
                            <?= __('Tags') ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['controller' => 'Testimonials', 'action' => 'index'], ['fullBase' => true]); ?>" title="" data-placement="right">
                            <i class="fa fa-circle-o"></i>
                            <?= __('Testemunhos') ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['controller' => 'OurServices', 'action' => 'index'], ['fullBase' => true]); ?>" title="" data-placement="right">
                            <i class="fa fa-circle-o"></i>
                            <?= __('Serviços') ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['controller' => 'About', 'action' => 'edit'], ['fullBase' => true]); ?>" data-placement="right">
                            <i class="fa fa-address-book"></i>
                            <?= __('Sobre') ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['controller' => 'About', 'action' => 'banners'], ['fullBase' => true]); ?>" data-placement="right">
                            <i class="fa fa-picture-o"></i>
                            <?= __('Banners') ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['controller' => 'Contacts', 'action' => 'index'], ['fullBase' => true]); ?>" title="" data-placement="right">
                            <i class="fa fa-users"></i>
                            <?= __('Contatos') ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['controller' => 'ContactsNewsletters', 'action' => 'index'], ['fullBase' => true]); ?>" title="" data-placement="right">
                            <i class="fa fa-envelope"></i>
                            <?= __('NewsLetters') ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['controller' => 'EventsTypes', 'action' => 'index'], ['fullBase' => true]); ?>" data-placement="right">
                            <i class="fa fa-calendar-o"></i>
                            <?= __('Tipos de Eventos') ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['controller' => 'SpecialistsCategories', 'action' => 'index'], ['fullBase' => true]); ?>" title="" data-placement="right">
                            <i class="fa fa-circle-o"></i>
                            <?= __('Tipos de Especialistas') ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['controller' => 'Specialists', 'action' => 'index'], ['fullBase' => true]); ?>" title="" data-placement="right">
                            <i class="fa fa-circle-o"></i>
                            <?= __('Especialistas') ?>
                        </a>
                    </li>
                </ul>
            </li>

            <!--Admin-->
            <li class=" treeview">
                <a href="#">
                    <i class="fa fa-gears"></i> <span>
                        <?= __('Administração') ?>
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index'], ['fullBase' => true]); ?>" data-placement="right">
                            <i class="fa fa-users"></i>
                            <?= __('Usuários') ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['controller' => 'Levels', 'action' => 'index'], ['fullBase' => true]); ?>" data-placement="right">
                            <i class="fa fa-bar-chart-o"></i>
                            <?= __('Níveis Permissões') ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['controller' => 'SystemParameters', 'action' => 'edit'], ['fullBase' => true]); ?>" data-placement="right">
                            <i class="fa fa-gear"></i>
                            <?= __('Parâmetros do Sistema') ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['controller' => 'LogsChange', 'action' => 'index'], ['fullBase' => true]); ?>" data-placement="right">
                            <i class="fa fa-exclamation-triangle"></i>
                            <?= __('Logs Alterações') ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['controller' => 'LogsAccess', 'action' => 'index'], ['fullBase' => true]); ?>" data-placement="right">
                            <i class="fa fa-check"></i>
                            <?= __('Logs Acessos') ?>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout'], ['fullBase' => true]); ?>" data-auth="false" data-placement="right">
                    <i class="fa fa-sign-out"></i>
                    <?= __('Sair') ?>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
