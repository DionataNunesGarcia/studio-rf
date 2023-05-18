<div class="blog_right_sidebar">
    <aside class="single_sidebar_widget search_widget">
        <?= $this->Form->create(null, ['type' => 'get', 'url' => ['action' => 'contents', 'fullBase' => true,]]); ?>
            <div class="form-group">
                <div class="input-group mb-3">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder='Pesquisar Conteúdo'
                        value="<?= $this->getRequest()->getQuery('search') ?>"
                        onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Pesquisar Conteúdo'"
                    >
                    <div class="input-group-append">
                        <button class="btns" type="submit"><i class="ti-search"></i></button>
                    </div>
                </div>
            </div>
        <?= $this->Form->end(); ?>
    </aside>

    <aside class="single_sidebar_widget post_category_widget">
        <h4 class="widget_title" style="color: #2d2d2d;">
            Categorias
        </h4>
        <ul class="list cat-list">
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
    </aside>
    <aside class="single_sidebar_widget popular_post_widget">
        <h3 class="widget_title" style="color: #2d2d2d;">Postagens Recentes</h3>
        <?php
        /** @var \App\Model\Entity\Blog $latestBlog */
        foreach ($latestBlogs as $latestBlog) {
            $img = $latestBlog->cover
                ? "/../Uploads/{$latestBlog->cover->filename}"
                : '/img/blog-default.png';
            ?>
            <div class="media post_item">
                <img src="<?= $img ?>" alt="<?= $latestBlog->title ?>">
                <div class="media-body">
                    <a href="<?= $this->Url->build("/conteudo/{$latestBlog->id}/{$latestBlog->slug}", ['fullBase' => true]); ?>">
                        <h3 style="color: #2d2d2d;">
                            <?= $latestBlog->title ?>
                        </h3>
                    </a>
                    <p><?= $latestBlog->created->i18nFormat('dd/MM/yyyy HH:mm') ?></p>
                </div>
            </div>
            <!-- End recent post item-->
        <?php } ?>
    </aside>
    <?php if (isset($tags) && !empty($tags)) { ?>
        <aside class="single_sidebar_widget tag_cloud_widget">
            <h4 class="widget_title" style="color: #2d2d2d;">Tag</h4>
            <ul class="list">
                <?php foreach ($tags as $tag) { ?>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'contents', '?' => ['tag' => $tag->slug]], ['fullBase' => true]); ?>">
                            <?= h($tag->name) ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </aside>
    <?php } ?>
</div>