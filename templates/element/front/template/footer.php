<?php $about = $this->About->get();?>
<!-- ======= Footer ======= -->

<footer>
    <!--? Footer Start-->
    <div class="footer-area footer-bg">
        <div class="container">
            <div class="footer-top footer-padding">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-3 col-lg-4 col-md-5 col-sm-8">
                        <div class="single-footer-caption mb-50">
                            <!-- logo -->
                            <div class="footer-logo">
                                <a href="<?= $this->Url->build('/', ['fullBase' => true]); ?>">
                                    <?= $this->Html->image('logo.png', ['class' => 'logo']); ?>
                                </a>
                            </div>
                            <div class="footer-tittle">
                                <div class="footer-pera">
                                    <p class="info1">
                                        Construindo sonhos com leveza ✨
                                    </p>
                                </div>
                            </div>
                            <div class="footer-number">
                                <h4><?= \App\Utils\Masks::phone($about->cell_phone) ?></h4>
                                <p><?= $about->email ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-2 col-md-5 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Useful Links</h4>
                            </div>
                            <div class="footer-cap">

                                <!--                            Brasil <br><br>-->

                                <span><?= $about->address->city ?>/<?= $about->address->uf ?></span>
<!--                                <p>123 East 26th Street, Fifth Floor, New York, NY 10011</p>-->
                            </div>
                        </div>
                    </div>
                    <!-- Instagram -->
                    <div class="col-xl-4 col-lg-4 col-md-5 col-sm-7">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Instagram Feed</h4>
                            </div>
                            <div class="instagram-gellay">
                                <ul class="insta-feed">
                                    <li><a href="#"><img src="front-template/assets/img/gallery/instagram1.png" alt=""></a></li>
                                    <li><a href="#"><img src="front-template/assets/img/gallery/instagram2.png" alt=""></a></li>
                                    <li><a href="#"><img src="front-template/assets/img/gallery/instagram3.png" alt=""></a></li>
                                    <li><a href="#"><img src="front-template/assets/img/gallery/instagram4.png" alt=""></a></li>
                                    <li><a href="#"><img src="front-template/assets/img/gallery/instagram5.png" alt=""></a></li>
                                    <li><a href="#"><img src="front-template/assets/img/gallery/instagram6.png" alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-xl-9 col-lg-8">
                        <div class="footer-copy-right">
                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <!-- Footer Social -->
                        <div class="footer-social f-right">
                            <span>Follow Us</span>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.facebook.com/sai4ull"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fas fa-globe"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End-->
</footer>
<!-- Scroll Up -->
<div id="back-top" >
    <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
</div>
<!--<footer id="footer" class="footer">-->
<!--    <div class="footer-content">-->
<!--        <div class="container">-->
<!--            <div class="row gy-4">-->
<!--                <div class="col-lg-5 col-md-12 footer-info text-center">-->
<!--                    <a href="--><?= $this->Url->build('/', ['fullBase' => true]); ?><!--" class="logo d-flex align-items-center">-->
<!--                        <span>-->
<!--                            --><?php //= $this->Html->image('logo.png', ['class' => 'logo']); ?>
<!--                        </span>-->
<!--                    </a>-->
<!--                    <p class="text-justify">-->
<!--                        A subjetividade da psique preta: como uma herança da ancestralidade de sofrimento, ódio e culpa se inter-relaciona com a estrutura sadomasoquista-->
<!--                    </p>-->
<!--                    <div class="social-links d-flex  mt-3">-->
<!--                        --><?php //if($about->facebook) { ?>
<!--                            <a href="--><?php //= $about->facebook ?><!--" class="facebook"><i class="bi bi-facebook"></i></a>-->
<!--                        --><?php //} ?>
<!--                        --><?php //if($about->instagram) { ?>
<!--                            <a href="--><?php //= $about->instagram ?><!--" class="instagram"><i class="bi bi-instagram"></i></a>-->
<!--                        --><?php //} ?>
<!--                        --><?php //if($about->linkedin) { ?>
<!--                            <a href="--><?php //= $about->linkedin ?><!--" class="linkedin"><i class="bi bi-linkedin"></i></a>-->
<!--                        --><?php //} ?>
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="col-lg-2 col-6 footer-links">-->
<!--                    <h4>Links Úteis</h4>-->
<!--                    <ul>-->
<!--                        <li>-->
<!--                            <a href="--><?php //= $this->Url->build('/', ['fullBase' => true]); ?><!--" class="active">-->
<!--                                <i class="bi bi-dash"></i> Home-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="--><?php //= $this->Url->build('/sobre', ['fullBase' => true]); ?><!--">-->
<!--                                <i class="bi bi-dash"></i> Sobre-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="--><?php //= $this->Url->build('/servicos', ['fullBase' => true]); ?><!--">-->
<!--                                <i class="bi bi-dash"></i> Serviços-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="--><?php //= $this->Url->build('/contato', ['fullBase' => true]); ?><!--">-->
<!--                                <i class="bi bi-dash"></i> Contato-->
<!--                            </a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </div>-->
<!---->
<!--                <div class="col-lg-2 col-6 footer-links">-->
<!--                    <h4>Conteúdos</h4>-->
<!--                    <ul>-->
<!--                        --><?php //foreach ($categories as $category) { ?>
<!--                            <li>-->
<!--                                <a href="--><?php //= $this->Url->build("/conteudos/{$category->slug}", ['fullBase' => true]); ?><!--">-->
<!--                                    <i class="bi bi-dash"></i> --><?php //= $category->name ?>
<!--                                </a>-->
<!--                            </li>-->
<!--                        --><?php //} ?>
<!--                    </ul>-->
<!--                </div>-->
<!---->
<!--                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">-->
<!--                    <h4>Entre em contato: </h4>-->
<!--                    <p>-->
<!--                        --><?php //if ( $about->address) { ?>
<!--                            Cidade: --><?php //= $about->address->city ?><!--/--><?php //= $about->address->uf ?><!--<br>-->
<!--                            Brasil <br><br>-->
<!--                        --><?php //} ?>
<!--                        <strong>-->
<!--                            Telefone:-->
<!--                        </strong> --><?php //= \App\Utils\Masks::phone($about->cell_phone) ?>
<!--                        <br>-->
<!--                        <strong>-->
<!--                            Email:-->
<!--                        </strong> --><?php //= $about->email ?>
<!--                        <br>-->
<!--                    </p>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="footer-legal">-->
<!--        <div class="container">-->
<!--            <div class="copyright">-->
<!--                &copy; Copyright <strong>-->
<!--                    <span>-->
<!--                        --><?php //= $about->title ?>
<!--                    </span>-->
<!--                </strong>.-->
<!--                Todos os direitos reservados-->
<!--            </div>-->
<!--            <div class="credits">-->
<!--                Desenvolvido por <a href="https://www.linkedin.com/in/dionata-garcia/" target="_blank">Diônata Garcia</a>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</footer>-->
<!-- End Footer -->
