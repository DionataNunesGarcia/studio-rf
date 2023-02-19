<div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">

    <div class="sidebar ps-lg-4">

        <div class="sidebar-item search-form">
            <h3 class="sidebar-title">Pesquisar</h3>
            <?= $this->Form->create(null, ['type' => 'get', 'class' => 'mt-3']); ?>
                <?= $this->Form->control('search', ['label' => false, 'value' => $this->request->getQuery('search')]); ?>
                <?=
                $this->Form->button('<i class="bi bi-search"></i>', [
                    'class' => 'btn btn-primary',
                    'escapeTitle' => FALSE
                ]);
                ?>
            <?= $this->Form->end(); ?>
        </div>
        <!-- End sidebar search formn-->

        <div class="sidebar-item categories">
            <h3 class="sidebar-title">Conteúdos</h3>
            <ul class="mt-3">
                <?php foreach ($categories as $category) { ?>
                    <li>
                        <a href="<?= $this->Url->build("/conteudos/{$category->slug}", ['fullBase' => true]); ?>">
                            <?= $category->name ?>
                            <span>
                                (<?= count($category->blogs) ?>)
                            </span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div><!-- End sidebar categories-->

        <div class="sidebar-item recent-posts">
            <h3 class="sidebar-title">Conteúdos Recentes</h3>

            <div class="mt-3">
                <?php
                /** @var \App\Model\Entity\Blog $latestBlog */
                foreach ($latestBlogs as $latestBlog) {
                    $img = $latestBlog->cover
                        ? "/../Uploads/{$latestBlog->cover->filename}"
                        : '/img/blog-default.png';
                    ?>
                    <div class="post-item mt-3">
                        <img src="<?= $img ?>" alt="" class="flex-shrink-0">
                        <div>
                            <h4>
                                <a href="<?= $this->Url->build("/conteudo/{$latestBlog->id}/{$latestBlog->slug}", ['fullBase' => true]); ?>">
                                    <?= $latestBlog->title ?>
                                </a>
                            </h4>
                            <time datetime="<?= $latestBlog->created ?>">
                                <?= $latestBlog->created->i18nFormat('dd/MM/yyyy HH:mm') ?>
                            </time>
                        </div>
                    </div>
                    <!-- End recent post item-->
                <?php } ?>
            </div>
        </div>
        <!-- End sidebar recent posts-->

        <?php if (isset($tags) && !empty($tags)) { ?>
            <div class="sidebar-item tags">
                <h3 class="sidebar-title">Tags</h3>
                <ul class="mt-3">

                    <?php foreach ($tags as $tag) { ?>
                        <li>
                            <a href="<?= $this->Url->build(['_name' => 'contents', '?' => ['tag' => $tag->slug]], ['fullBase' => true]); ?>">
                                <?= h($tag->name) ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>
        <!-- End sidebar tags-->

    </div><!-- End Blog Sidebar -->

</div>
