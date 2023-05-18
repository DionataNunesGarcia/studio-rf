<?php
use Cake\Utility\Text;
/** @var Blog $blog */
$img = $blog->cover
    ? "/Uploads/{$blog->cover->filename}"
    : 'img/blog-default.png';
?>
<main>
    <!--? Hero Start -->
    <div class="slider-area2">
        <div class="slider-height2 hero-overly d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap hero-cap2 text-center pt-80">
                            <h2>Nosso Portfolio</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->
    <!--? Gallery Area Start -->
    <div class="gallery-area pt-30 pb-40">
        <div class="container-fluid p-0 fix">
            <div class="row">
                <div class="col-xl-6 col-lg-4 col-md-6">
                    <div class="single-gallery mb-30">
                        <div class="gallery-img" style="background-image: url(assets/img/gallery/gallery1.png);"></div>
                        <div class="thumb-content-box">
                            <div class="thumb-content">
                                <h3><span>Intorior</span>Burj Khalifa</h3>
                                <a href="work.html"><i class="fas fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="single-gallery mb-30">
                        <div class="gallery-img" style="background-image: url(assets/img/gallery/gallery2.png);"></div>
                        <div class="thumb-content-box">
                            <div class="thumb-content">
                                <h3><span>Intorior</span>Burj Khalifa</h3>
                                <a href="work.html"><i class="fas fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="single-gallery mb-30">
                        <div class="gallery-img" style="background-image: url(assets/img/gallery/gallery3.png);"></div>
                        <div class="thumb-content-box">
                            <div class="thumb-content">
                                <h3><span>Intorior</span>Burj Khalifa</h3>
                                <a href="work.html"><i class="fas fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="single-gallery mb-30">
                        <div class="gallery-img" style="background-image: url(assets/img/gallery/gallery4.png);"></div>
                        <div class="thumb-content-box">
                            <div class="thumb-content">
                                <h3><span>Intorior</span>Burj Khalifa</h3>
                                <a href="work.html"><i class="fas fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="single-gallery mb-30">
                        <div class="gallery-img" style="background-image: url(assets/img/gallery/gallery5.png);"></div>
                        <div class="thumb-content-box">
                            <div class="thumb-content">
                                <h3><span>Intorior</span>Burj Khalifa</h3>
                                <a href="work.html"><i class="fas fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4 col-md-6">
                    <div class="single-gallery mb-30">
                        <div class="gallery-img" style="background-image: url(assets/img/gallery/gallery6.png);"></div>
                        <div class="thumb-content-box">
                            <div class="thumb-content">
                                <h3><span>Intorior</span>Burj Khalifa</h3>
                                <a href="work.html"><i class="fas fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="lode-more-btn text-center pt-60 pb-100">
                        <a href="#" class="btn">Load More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Gallery Area End -->
</main>
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