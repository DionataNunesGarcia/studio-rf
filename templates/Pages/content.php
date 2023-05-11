<?php
use Cake\Utility\Text;
/** @var Blog $blog */
$img = $blog->cover
    ? "/Uploads/{$blog->cover->filename}"
    : 'img/blog-default.png';
?>
<!--? Hero Start -->
<div class="slider-area2">
    <div class="slider-height2 hero-overly d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap hero-cap2 text-center pt-80">
                        <h2>
                            <?= $blog->blogs_category->name ?> / <?= $blog->title ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->
<!--================Blog Area =================-->
<section class="blog_area single-post-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 posts-list">
                <div class="single-post">
                    <div class="feature-img text-center">
                        <img class="img-fluid" src="<?= $img ?>" alt="">
                    </div>
                    <div class="blog_details">
                        <h2 style="color: #2d2d2d;"
                            <?= $blog->subtitle ?>
                        </h2>
                        <ul class="blog-info-link mt-3 mb-4">
                            <li>
                                <i class="fa fa-user"></i> <?= h($blog->user->name) ?>
                            </li>
                            <li>
                                <time datetime="<?= h($blog->created) ?>">
                                    <?= h($blog->created->i18nFormat('dd/MM/yyyy HH:mm')) ?>
                                </time>
                            </li>
                        </ul>
                        <p class="excert">
                            <?= Text::wordWrap($blog->content) ?>
                        </p>
                    </div>
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
<!--================ Blog Area end =================-->