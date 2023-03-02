<?php

use App\Utils\Images;
use Cake\Utility\Text;

?>
<div class="professional-services section-bg d-none d-md-block" data-background="front-template/assets/img/gallery/section_bg04.jpg"></div>
<div class="profession-caption">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-12">
                <!-- Section Tittle -->
                <div class="section-tittle profession-details">
                    <span></span>
                    <h2><?= $service->name ?></h2>
                    <?= Text::wordWrap($service->content) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if($service->gallery) { ?>
    <!--? Gallery Area Start -->
    <div class="gallery-area pt-30 pb-40">
        <div class="container-fluid p-0 fix">
            <div class="row">
                <?php foreach($service->gallery as $gallery) { ?>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="single-gallery mb-30">
                            <div class="gallery-img" style="background-image: url(<?= Images::getImage($gallery) ?>);"></div>
                            <div class="thumb-content-box">
                                <div class="thumb-content">
                                    <h3><span>Intorior</span>Burj Khalifa</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Gallery Area End -->
<?php } ?>