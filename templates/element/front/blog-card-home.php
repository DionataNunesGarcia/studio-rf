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
                <a href="<?= $url; ?>">
                    <img src="<?= $img ?>"= alt="">
                </a>
            </div>
            <ul>
                <li class="black-bg"><?= h($blog->created->i18nFormat('dd/MM/yyyy HH:mm')) ?></li>
                <li><i class="fa fa-user"></i> <?= h($blog->user->name) ?></li>
            </ul>
            <div class="blog-cap">
                <h3>
                    <a href="<?= $url; ?>">
                        <?= h($blog->title) ?>
                    </a>
                </h3>
                <h4>
                    <?=
                    Text::truncate(
                        Text::wordWrap($blog->subtitle),
                        100,
                        [
                            'ellipsis' => '...',
                            'exact' => false
                        ]
                    );
                    ?>
                </h4>
                <a href="<?= $url; ?>">Leia Mais</a>
            </div>
        </div>
    </div>
</div>