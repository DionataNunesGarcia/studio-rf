<?php
use Cake\Utility\Text;
/** @var Blog $blog */
$img = $blog->cover
    ? "/Uploads/{$blog->cover->filename}"
    : 'img/blog-default.png';
?>
<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs d-flex align-items-center" style="background-image: url('/img/BlackTherapists.jpg');">
    <div class="container position-relative d-flex flex-column align-items-center">
        <h2>
            Conteúdo <?= $blog->blogs_category->name ?>
        </h2>
        <ol>
            <li>
                <a href="<?= $this->Url->build("/", ['fullBase' => true]); ?>">
                    Home
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build("/conteudos/{$blog->blogs_category->slug}", ['fullBase' => true]); ?>">
                    <?= $blog->blogs_category->name ?>
                </a>
            </li>
            <li>
                Conteúdo <?= $blog->title ?>
            </li>
        </ol>
    </div>
</div><!-- End Breadcrumbs -->

<!-- ======= Blog Details Section ======= -->
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">
        <div class="row g-5">
            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                <article class="blog-details">
                    <div class="post-img text-center">
                        <img src="<?= $img ?>" alt="" class="img-fluid">
                    </div>
                    <h2 class="title">
                        <?= $blog->title ?>
                    </h2>
                    <div class="meta-top">
                        <ul>
<!--                            <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-details.html">John Doe</a></li>-->
                            <li class="d-flex align-items-center">
                                <i class="bi bi-clock"></i>
                                <time datetime="<?= h($blog->created) ?>">
                                    <?= h($blog->created->i18nFormat('dd/MM/yyyy HH:mm')) ?>
                                </time>
                            </li>
<!--                            <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-details.html">12 Comments</a></li>-->
                        </ul>
                    </div>
                    <!-- End meta top -->

                    <div class="content">
                        <?= Text::wordWrap($blog->content) ?>
                    </div>
                    <!-- End post content -->

                    <div class="meta-bottom">
                        <i class="bi bi-folder"></i>
                        <ul class="cats">
                            <li>
                                <a href="<?= $this->Url->build("/conteudos/{$blog->blogs_category->slug}", ['fullBase' => true]); ?>">
                                    <?= $blog->blogs_category->name ?>
                                </a>
                            </li>
                        </ul>
                        <?php if ($blog->tags) { ?>
                            <i class="bi bi-tags"></i>
                            <ul class="tags">
                                <?php
                                $tagsContent = [];
                                foreach ($blog->tags as $tag) {
                                    $tagsContent[] = $tag->name;
                                    ?>
                                    <li>
                                        <a href="<?= $this->Url->build(['_name' => 'contents', '?' => ['tag' => $tag->slug]], ['fullBase' => true]); ?>">
                                            <?= h($tag->name) ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>
                    <!-- End meta bottom -->

                    <?=
                    $this->element('shared-buttons', [
                        'title' => $blog->title,
                        'description' => \Cake\Utility\Text::wordWrap($blog->content),
                        'img' => $img,
                        'tags' => $tagsContent,
                    ]);
                    ?>
                </article>
                <!-- End blog post -->
            </div>

            <?=
            $this->element('front/blogs-sidebar', [
                'latestBlogs' => $latestBlogs,
                'tags' => $tags
            ]);
            ?>
        </div>

    </div>
</section><!-- End Blog Details Section -->
