<?php
use Cake\Utility\Text;
$img = $testimonial->avatar ? "Uploads/{$testimonial->avatar->filename}" : 'user-default.png';
?>
<div class="single-testimonial text-center">
    <!-- Testimonial Content -->
    <div class="testimonial-caption ">
        <div class="testimonial-top-cap">
            <img src="<?= $img ?>" class="testimonial-img" alt="">
            <p>
                <?= Text::wordWrap($testimonial->content) ?>
            </p>
        </div>
        <!-- founder -->
        <div class="testimonial-founder  ">
            <div class="founder-img">
                <span><strong><?= h($testimonial->name) ?></strong>   -   <?= h($testimonial->profession) ?></span>
            </div>
        </div>
    </div>
</div>
