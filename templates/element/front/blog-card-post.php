<?php
use Cake\Utility\Text;

/** @var Blog $blog */
$img = $blog->cover
    ? "/../Uploads/{$blog->cover->filename}"
    : '/img/blog-default.png';
?>
<div class="col-lg-6">
    <article class="d-flex flex-column">
        <div class="post-img">
            <img src="<?= $img ?>" alt="" class="img-fluid">
        </div>
        <div class="meta-top">
            <div class="category float-start">
                <i class="bi bi-folder"></i>
                <a href="<?= $this->Url->build("/conteudos/{$blog->blogs_category->slug}", ['fullBase' => true]); ?>">
                    <?= $blog->blogs_category->name ?>
                </a>
            </div>
            <time class="float-end" datetime="<?= $blog->created ?>">
                <small>
                    <?= $blog->created->i18nFormat('dd/MM/yyyy HH:mm') ?>
                </small>
            </time>
        </div>

        <h2 class="title">
            <a href="<?= $this->Url->build("/conteudo/{$blog->id}/{$blog->slug}", ['fullBase' => true]); ?>">
                <?= $blog->title ?>
            </a>
        </h2>

        <!-- End meta bottom -->
<!--        <div class="meta-top">-->
<!--            <ul>-->
<!--                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-details.html">John Doe</a></li>-->
<!--                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="2022-01-01">Jan 1, 2022</time></a></li>-->
<!--                <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-details.html">12 Comments</a></li>-->
<!--            </ul>-->
<!--        </div>-->

        <div class="content">
            <p>
                <?= Text::truncate(
                    Text::wordWrap($blog->content),
                    100,
                    [
                        'ellipsis' => '...',
                        'exact' => false
                    ]
                );
                ?>
            </p>
        </div>

        <div class="read-more mt-auto align-self-end">
            <a href="<?= $this->Url->build("/conteudo/{$blog->id}/{$blog->slug}", ['fullBase' => true]); ?>">Leia Mais <i class="bi bi-arrow-right"></i></a>
        </div>

    </article>
</div>
<!-- End post list item -->
