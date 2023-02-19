<?php
use Cake\Utility\Text;

/** @var Blog $blog */
$img = $blog->cover
    ? "../Uploads/{$blog->cover->filename}"
    : 'img/blog-default.png';
?>
<div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
    <div class="post-box">
        <div class="post-img">
            <img src="<?= $img ?>" class="img-fluid" alt="">
        </div>
        <div class="meta">
            <span class="post-date">
                <?= h($blog->created->i18nFormat('dd/MM/yyyy HH:mm')) ?>
            </span>
            <span class="post-author">
                / <?= h($blog->blogs_category->name) ?>
            </span>
        </div>
        <h3 class="post-title">
            <?= $blog->title ?>
        </h3>
        <p>
            <?= Text::truncate(
                Text::wordWrap($blog->content),
                100,
                [
                    'ellipsis' => '...',
                    'exact' => false
                ]
            ) ?>
        </p>
        <a href="<?= $this->Url->build("/conteudo/{$blog->id}/{$blog->slug}", ['fullBase' => true]); ?>" class="readmore stretched-link">
            <span>Ler mais</span>
            <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</div>
