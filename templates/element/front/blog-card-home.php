<?php
use Cake\Utility\Text;

/** @var Blog $blog */
$img = $blog->cover
    ? "../Uploads/{$blog->cover->filename}"
    : 'img/blog-default.png';

$url = $this->Url->build("/conteudo/{$blog->id}/{$blog->slug}", ['fullBase' => true]);
?>

<div class="col-xl-4 col-lg-4 col-md-4">
    <div class="home-blog-single mb-30">
        <div class="blog-img-cap">
            <div class="blog-img">
                <img src="<?= $img ?>"= alt="">
            </div>
            <div class="blog-cap">
                <a href="<?= $url; ?>">
                    <h3>
                        <?= h($blog->title) ?>
                    </h3>
                    <h4>
                        <?=
                        Text::truncate(
                            Text::wordWrap($blog->subtitle),
                            45,
                            [
                                'ellipsis' => '...',
                                'exact' => false
                            ]
                        );
                        ?>
                    </h4>
                </a>
                <a href="<?= $url; ?>" class="more-btn">Leia Mais</a>
                <br/>
                <span class="float-left">
                    <?= h($blog->created->i18nFormat('dd/MM/yyyy HH:mm')) ?>
                </span>
                <span class="float-right">
                <i class="fa fa-user"></i> <?= h($blog->user->name) ?>
                </span>
            </div>
        </div>
    </div>
</div>