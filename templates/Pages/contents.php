<div class="slider-area2">
    <div class="slider-height2 hero-overly d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap hero-cap2 text-center pt-80">
                        <h2><?= $category->name ?? 'Conteúdos' ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->
<!--================Blog Area =================-->
<section class="blog_area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="blog_left_sidebar">
                    <?php

                    use Cake\Utility\Text;

                    foreach ($blogs as $blog) {
                        $img = $blog->cover
                            ? "/Uploads/{$blog->cover->filename}"
                            : 'img/blog-default.png';
                        $url = $this->Url->build("/conteudo/{$blog->id}/{$blog->slug}", ['fullBase' => true]);
                        ?>
                        <article class="blog_item blog_details row">
                            <div class="blog_item_img text-center col-lg-4">
                                <img class="card-img rounded-0 img-fluid" src="<?= $img ?>" alt="">
                                <a href="<?= $url; ?>" class="blog_item_date">
                                    <h3><?= h($blog->created->i18nFormat('dd')); ?></h3>
                                    <p><?= h($blog->created->i18nFormat('MMM', 'America/Belem', 'pt-BR')); ?></p>
                                </a>
                            </div>

                            <div class="col-lg-8 blog-item-content">
                                <a class="d-inline-block" href="<?= $url; ?>">
                                    <h2 style="color: #2d2d2d;">
                                        <?= h($blog->title) ?>
                                    </h2>
                                </a>
                                <p>
                                    <?=
                                    Text::truncate(
                                        Text::wordWrap($blog->subtitle),
                                        180,
                                        [
                                            'ellipsis' => '...',
                                            'exact' => false
                                        ]
                                    );
                                    ?>
                                </p>
                                <ul class="blog-info-link">
                                    <li>
                                        <i class="fa fa-user"></i>  <?= h($blog->user->name) ?>
                                    </li>
                                </ul>
                            </div>
                        </article>
                    <?php } ?>
                    <?php echo $this->element('front/pagination',['class' => 'blog-pagination']) ?>
                </div>
            </div>
            <div class="col-lg-4">
                <?=
                $this->element('front/blogs-sidebar', [
                    'latestBlogs' => $latestBlogs,
                    'tags' => $tags
                ]);
                ?>
            </div>
        </div>
    </div>
</section>