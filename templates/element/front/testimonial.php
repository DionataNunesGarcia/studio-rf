<?php
use Cake\Utility\Text;
$img = $testimonial->avatar ? "Uploads/{$testimonial->avatar->filename}" : 'user-default.png';
?>
<div class="swiper-slide">
    <div class="testimonial-item">
        <div class="stars">
            <?php
            $i = 0;
            while($i < 5) {
                $i++;
                $classStar = $i <= $testimonial->note ? 'bi-star-fill' : 'bi-star';
                echo "<i class='bi {$classStar}'></i>";
            }
            ?>
        </div>
        <p>
            <?= Text::wordWrap($testimonial->content) ?>
        </p>
        <div class="profile mt-auto">
            <img src="<?= $img ?>" class="testimonial-img" alt="">
            <h3><?= h($testimonial->name) ?></h3>
            <h4><?= h($testimonial->profession) ?></h4>
        </div>
    </div>
</div><!-- End testimonial item -->
