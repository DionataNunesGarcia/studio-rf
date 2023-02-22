<?php

use Cake\Utility\Text;

$about = $this->About->get();
$img = $about->cover ? "Uploads/{$about->cover->filename}" : 'user-default.png';
?>
<!-- ======= Breadcrumbs ======= -->
<!--? Hero Start -->
<div class="slider-area2">
    <div class="slider-height2 hero-overly d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap hero-cap2 text-center pt-80">
                        <h2>Sobre Nós</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="about-text">
    <div class="row">
        <div class="col-lg-4 col-md-4">
            <div class="about-text">
                <div class="section-title">
                    <h2>Quem Nós Somos</h2>
                </div>
                <div class="text-center">
                    <img src="<?= $img ?>" class="img-fluid" alt="<?= $about->title ?>">
                </div>
                <div class="about__para__text">
                    <p>
                        <?= Text::wordWrap($about->about) ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8">
            <div class="about__page__services">
                <div class="about__page__services__text">
                    <p>
                        <?= Text::wordWrap($about->values_about) ?>
                    </p>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="services__item">
                            <img src="img/mission.png" alt="">
                            <h4>Nossa Missião</h4>
                            <p>
                                <?= Text::wordWrap($about->mission) ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="services__item">
                            <img src="img/vision.png" alt="">
                            <h4>Nossa Visão</h4>
                            <p>
                                <?= Text::wordWrap($about->vision) ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->
<!--? our info Start -->
<div class="our-info-area pt-170 pb-100 section-bg" data-background="front-template/assets/img/gallery/section_bg02.jpg">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <div class="single-info mb-60">
                    <div class="info-caption">
                        <h4>Clean and Services</h4>
                        <p>For each project we establish relationships with partners who we know will help us. </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <div class="single-info mb-60">
                    <div class="info-caption">
                        <h4>Clean and Modern</h4>
                        <p>For each project we establish relationships with partners who we know will help us. </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <div class="single-info mb-60">
                    <div class="info-caption">
                        <h4>Clean and Modern</h4>
                        <p>For each project we establish relationships with partners who we know will help us. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Our Info start -->
<!--? Professional Services Start -->
<div class="professional-services section-bg d-none d-md-block" data-background="front-template/assets/img/gallery/section_bg04.jpg"></div>
<div class="profession-caption">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <!-- Section Tittle -->
                <div class="section-tittle profession-details">
                    <span>Our Professional Services</span>
                    <h2>We will create modern and first class intorior.</h2>
                    <p>Aorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <a href="about.html" class="btn btn3">Discover More About Ous</a>
            </div>
        </div>
    </div>
</div>
<!-- Professional Services End -->
<!-- Team Start -->
<div class="team-area section-padding30">
    <div class="container">
        <div class="row justify-content-center">
            <div class="cl-xl-7 col-lg-8 col-md-10">
                <!-- Section Tittle -->
                <div class="section-tittle text-center mb-70">
                    <span>Creative derector</span>
                    <h2>Best Interitor Services</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- single Tem -->
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-">
                <div class="single-team mb-30">
                    <div class="team-img">
                        <img src="front-template/assets/img/gallery/team2.png" alt="">
                    </div>
                    <div class="team-caption">
                        <h3><a href="#">Jhon Sunsa</a></h3>
                        <span>Creative derector</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-">
                <div class="single-team mb-30">
                    <div class="team-img">
                        <img src="front-template/assets/img/gallery/team3.png" alt="">
                    </div>
                    <div class="team-caption">
                        <h3><a href="#">Jhon Sunsa</a></h3>
                        <span>Creative derector</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-">
                <div class="single-team mb-30">
                    <div class="team-img">
                        <img src="front-template/assets/img/gallery/team1.png" alt="">
                    </div>
                    <div class="team-caption">
                        <h3><a href="#">Jhon Sunsa</a></h3>
                        <span>Creative derector</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team End -->
<!-- Testimonial Start -->
<div class="testimonial-area testimonial-padding">
    <div class="container">
        <!-- Testimonial contents -->
        <div class="row d-flex justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-10">
                <div class="h1-testimonial-active dot-style">
                    <!-- Single Testimonial -->
                    <div class="single-testimonial text-center">
                        <!-- Testimonial Content -->
                        <div class="testimonial-caption ">
                            <div class="testimonial-top-cap">
                                <img src="front-template/assets/img/gallery/testi-logo.png" alt="">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
                            </div>
                            <!-- founder -->
                            <div class="testimonial-founder  ">
                                <div class="founder-img">
                                    <span><strong>Christine Eve</strong>   -   Co Founder</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Single Testimonial -->
                    <div class="single-testimonial text-center">
                        <!-- Testimonial Content -->
                        <div class="testimonial-caption ">
                            <div class="testimonial-top-cap">
                                <img src="front-template/assets/img/gallery/testi-logo.png" alt="">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
                            </div>
                            <!-- founder -->
                            <div class="testimonial-founder  ">
                                <div class="founder-img">
                                    <span><strong>Christine Eve</strong>   -   Co Founder</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->
<!-- Brand Area Start -->
<div class="brand-area pt-120 pb-120">
    <div class="container">
        <div class="brand-active brand-border pt-50 pb-40">
            <div class="single-brand">
                <img src="front-template/assets/img/gallery/brand1.png" alt="">
            </div>
            <div class="single-brand">
                <img src="front-template/assets/img/gallery/brand2.png" alt="">
            </div>
            <div class="single-brand">
                <img src="front-template/assets/img/gallery/brand3.png" alt="">
            </div>
            <div class="single-brand">
                <img src="front-template/assets/img/gallery/brand4.png" alt="">
            </div>
            <div class="single-brand">
                <img src="front-template/assets/img/gallery/brand2.png" alt="">
            </div>
            <div class="single-brand">
                <img src="front-template/assets/img/gallery/brand5.png" alt="">
            </div>
        </div>
    </div>
</div>
<!-- Brand Area End -->
<!-- Want To work -->
<section class="wantToWork-area w-padding2">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-xl-8 col-lg-8 col-md-8">
                <div class="wantToWork-caption wantToWork-caption2">
                    <h2>Are you Searching For a First-Class Consultant?</h2>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-3">
                <a href="#" class="btn btn-black f-right">Contact Us</a>
            </div>
        </div>
    </div>
</section>
<!-- Want To work End -->