<?php
$services = [
    'facebook' => __('Compartilhar no Facebook'),
    'whatsapp' => __('Compartilhar no WhatsApp'),
    'linkedin' => __('Compartilhar no LinkedIn'),
    'twitter' => __('Compartilhar no Twitter')
];
?>
<div class="mobile-social-share">
    <div id="socialHolder">
        <div id="socialShare">
            <strong>Compartilhar:</strong>
            <br>
            <ul class="">
                <?php
                foreach ($services as $service => $linkText) {
                    echo '<li>' . $this->SocialShare->fa(
                            $service, null, ['icon_class' => 'bi bi-'.$service, 'title' => $linkText, 'class' => 'btn btn-'.$service]
                    ) . '</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>
<?php ?>

<?php
/** @var \Meta\View\Helper\MetaHelper $meta */
$meta = $this->Meta;
$sobre = $this->About->get();
$title = isset($title)
    ? "{$title} - {$sobre->nome}"
    : $sobre->nome;

$meta->keywords($title, 'pt-BR');
$meta->keywords(implode(',', $tags), 'pt-BR');
$meta->description($description ?? '');
$meta->robots(['index' => false]);
?>
<meta property="og:image" content="<?= $img ?>"/>
<meta property="twitter:image" content="<?= $img ?>"/>
<style>
    .mobile-social-share {
        background: none repeat scroll 0 0 transparent;
        display: block !important;
        min-height: 20px !important;
        margin: 10px 0px 50px 0;
    }

    .mobile-social-share ul {
        float: left;
        list-style: none outside none;
        margin: 0;
        min-width: 61px;
        padding: 0;
        display: flex;
    }

    .mobile-social-share li {
        display: block;
        font-size: 18px;
        list-style: none outside none;
        margin-bottom: 3px;
        margin-left: 4px;
        margin-top: 3px;
    }
    #socialShare .btn {
        width: 36px;
        height: 36px;
        color: #FFFFFF!important;
        font-size: 17px;
        padding: 4px !important;
    }
    .btn-twitter {
        background-color: #3399CC !important;
    }

    .btn-facebook {
        background-color: #3D5B96 !important;
    }

    .btn-facebook {
        background-color: #3D5B96 !important;
    }

    .btn-google {
        background-color: #DD3F34 !important;
    }

    .btn-linkedin {
        background-color: #1884BB !important;
    }

    .btn-whatsapp {
        background-color: #5cb75c !important;
    }

    .btn-pinterest {
        background-color: #CC1E2D !important;
    }

    .btn-mail {
        background-color: #FFC90E !important;
    }
</style>
