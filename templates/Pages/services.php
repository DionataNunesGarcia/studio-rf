<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs d-flex align-items-center" style="background-image: url('img/BlackTherapists.jpg');">
    <div class="container position-relative d-flex flex-column align-items-center">

        <h2>Serviços</h2>
        <ol>
            <li><a href="index.html">Home</a></li>
            <li>Serviços</li>
        </ol>

    </div>
</div><!-- End Breadcrumbs -->

<!-- ======= Our Services Section ======= -->
<section id="services-list" class="services-list">
    <div class="container" data-aos="fade-up">
        <div class="section-header">
            <h2>Serviços</h2>
        </div>
        <div class="row gy-5">
            <?php foreach ($ourServices as $service ) { ?>
                <?= $this->element("front/service", ['service' => $service]); ?>
            <?php } ?>
        </div>
    </div>
</section><!-- End Our Services Section -->


<?php if ($testimonials) { ?>
    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Depoimentos</h2>
            </div>

            <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">
                    <?php foreach ($testimonials as $testimonial ) { ?>
                        <?= $this->element("front/testimonial", ['testimonial' => $testimonial]); ?>
                    <?php } ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section><!-- End Testimonials Section -->
<?php } ?>
