<?php if ($benefits) { ?>
    <!-- ======= Benefits ======= -->
    <section id="why-us" class="why-us">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Por que fazer terapia?</h2>

            </div>
            <div class="row g-0" data-aos="fade-up" data-aos-delay="200">

                <div class="col-xl-5 img-bg" style="background-image: url('img/black-woman.jpg'); background-position: center;"></div>
                <div class="col-xl-7 slides  position-relative">

                    <div class="slides-1 swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($benefits as $benefit ) { ?>
                                <div class="swiper-slide">
                                    <div class="item">
                                        <h3 class="mb-3">
                                            <?= h($benefit->title) ?>
                                        </h3>
                                        <h4 class="mb-3">
                                            <?= h($benefit->subtitle) ?>
                                        </h4>
                                        <span class="text-justify">
                                            <?= \Cake\Utility\Text::wordWrap($benefit->content) ?>
                                        </span>
                                    </div>
                                </div><!-- End slide item -->
                            <?php } ?>

                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>

            </div>

        </div>
    </section>
    <!-- End Benefits -->
<?php } ?>
