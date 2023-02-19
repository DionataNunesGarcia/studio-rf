<?php $about = $this->About->get();?>
<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs d-flex align-items-center" style="background-image: url('img/BlackTherapists.jpg');">
    <div class="container position-relative d-flex flex-column align-items-center">
        <h2>Contato</h2>
        <ol>
            <li>
                <a href="<?= $this->Url->build("/", ['fullBase' => true]); ?>">
                    Home
                </a>
            </li>
            <li>
                Contato
            </li>
        </ol>
    </div>
</div><!-- End Breadcrumbs -->

<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
    <div class="container position-relative" data-aos="fade-up">

        <div class="row gy-4 d-flex justify-content-end">

            <div class="col-lg-5" data-aos="fade-up" data-aos-delay="100">

                <div class="info-item d-flex">
                    <i class="bi bi-geo-alt flex-shrink-0"></i>
                    <div>
                        <h4>Local:</h4>
                        <p><?= $about->address->city ?>/<?= $about->address->uf ?></p>
                    </div>
                </div><!-- End Info Item -->

                <div class="info-item d-flex">
                    <i class="bi bi-envelope flex-shrink-0"></i>
                    <div>
                        <h4>Email:</h4>
                        <p><?= $about->email ?></p>
                    </div>
                </div><!-- End Info Item -->

                <div class="info-item d-flex">
                    <i class="bi bi-phone flex-shrink-0"></i>
                    <div>
                        <h4>Telefone:</h4>
                        <p><?= \App\Utils\Masks::phone($about->cell_phone) ?></p>
                    </div>
                </div><!-- End Info Item -->
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
                <?= $this->element('front/contact-form') ?>
            </div><!-- End Contact Form -->
        </div>
    </div>
</section><!-- End Contact Section -->
