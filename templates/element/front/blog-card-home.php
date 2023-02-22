<?php
use Cake\Utility\Text;

/** @var Blog $blog */
$img = $blog->cover
    ? "../Uploads/{$blog->cover->filename}"
    : 'img/blog-default.png';
?>

<div class="col-xl-6 col-lg-6 col-md-6">
    <div class="home-blog-single mb-30">
        <div class="blog-img-cap">
            <div class="blog-img">
                <img src="<?= $img ?>"= alt="">
            </div>
            <ul>
                <li class="black-bg">
                    <?= h($blog->created->i18nFormat('dd/MM/yyyy HH:mm')) ?>
                </li>
            </ul>
            <div class="blog-cap">
                <h3>
                    <a href="<?= $this->Url->build("/conteudo/{$blog->id}/{$blog->slug}", ['fullBase' => true]); ?>">
                        <?= Text::truncate(
                            Text::wordWrap($blog->content),
                            100,
                            [
                                'ellipsis' => '...',
                                'exact' => false
                            ]
                        ) ?>
                    </a>
                </h3>
                <a href="blog_details.html" class="more-btn">Read more</a>
            </div>
        </div>
    </div>
</div>