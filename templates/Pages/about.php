<?php
$about = $this->About->get();
$img = $about->cover ? "Uploads/{$about->cover->filename}" : 'user-default.png';
?>
<!-- ======= Breadcrumbs ======= -->

<div class="breadcrumbs d-flex align-items-center" style="background-image: url('img/BlackTherapists.jpg');">
    <div class="container position-relative d-flex flex-column align-items-center">

        <h2>Sobre</h2>
        <ol>
            <li>
                <a href="<?= $this->Url->build("/", ['fullBase' => true]); ?>">
                    Home
                </a>
            </li>
            <li>
                Sobre
            </li>
        </ol>

    </div>
</div><!-- End Breadcrumbs -->

<!-- ======= About Section ======= -->
<section id="team" class="team">
    <div class="container" data-aos="fade-up">

        <div class="row gy-4" data-aos="fade-up">
            <div class="col-lg-4">
                <div class="team-member">
                    <div class="member-img">
                        <img src="<?= $img ?>" class="img-fluid" alt="<?= $about->title ?>">
                        <div class="social">
                            <?php if($about->facebook) { ?>
                                <a href="<?= $about->facebook ?>" target="_blank">
                                    <i class="bi bi-facebook"></i>
                                </a>
                            <?php } ?>
                            <?php if($about->instagram) { ?>
                                <a href="<?= $about->instagram ?>" target="_blank">
                                    <i class="bi bi-instagram"></i>
                                </a>
                            <?php } ?>
                            <?php if($about->linkedin) { ?>
                                <a href="<?= $about->linkedin ?>" target="_blank">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="member-info">
                        <span>Psicóloga</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="content ps-lg-5">
                    <h3><?= $about->title ?></h3>
                    <span class="text-justify">
                        <?= \Cake\Utility\Text::wordWrap($about->about) ?>
                    </span>
                </div>
            </div>
        </div>

    </div>
</section><!-- End About Section -->

<!-- ======= Why Choose Us Section ======= -->
<?= $this->element("front/benefits", ['benefits' => $benefits]); ?>
