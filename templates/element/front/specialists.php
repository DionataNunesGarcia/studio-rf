<!-- Gallery Area End -->
<?php if ($specialists) { ?>
    <!-- Team Start -->
    <div class="team-area section-padding30">
        <div class="container">
            <div class="row justify-content-center">
                <div class="cl-xl-7 col-lg-8 col-md-10">
                    <!-- Section Tittle -->
                    <div class="section-tittle text-center mb-70">
                        <span>Nosso Time</span>
                        <h2>CONHEÇA NOSSO TIME</h2>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <!-- single Tem -->
                <?php foreach ($specialists as $specialist) { ?>
                    <div class="col-lg-3 col-md-3 col-xl-3 col-sm-12 margin-zero-auto">
                        <div class="single-team mb-30">
                            <div class="team-img">
                                <img src="<?= \App\Utils\Images::getImage($specialist->user->avatar) ?>" alt="">
                            </div>
                            <div class="team-caption">
                                <h3><?= $specialist->name ?></h3>
                                <span><?= $specialist->specialists_category->name ?></span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Team End -->
<?php } ?>