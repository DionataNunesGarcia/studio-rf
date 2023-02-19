<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs d-flex align-items-center" style="background-image: url('/img/BlackTherapists.jpg');">
    <div class="container position-relative d-flex flex-column align-items-center">

        <h2>Blog</h2>
        <ol>
            <li><a href="index.html">Home</a></li>
            <li>Conteúdos</li>
        </ol>

    </div>
</div><!-- End Breadcrumbs -->

<!-- ======= Blog Section ======= -->
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

        <div class="row g-5">
            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                <div class="row gy-5 posts-list">
                    <?php foreach ($blogs as $blog) { ?>
                        <?= $this->element('front/blog-card-post', ['blog' => $blog]) ?>
                    <?php } ?>
                </div>
                <!-- End blog posts list -->
                <?php echo $this->element('front/pagination',['class' => 'blog-pagination']) ?>
            </div>
            <?= $this->element('front/blogs-sidebar', ['latestBlogs' => $latestBlogs]) ?>

        </div>

    </div>
</section><!-- End Blog Section -->
