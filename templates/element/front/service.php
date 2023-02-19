<?php
use Cake\Utility\Text;
?>
<div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="100">
    <div class="icon flex-shrink-0">
        <i class="bi bi-card-heading" style="color: #f57813;"></i>
    </div>
    <div>
        <h4 class="title">
            <a href="#" class="stretched-link" data-bs-toggle="modal" data-bs-target="#modal-<?= "{$service->slug}" ?>">
                <?= h($service->name) ?>
            </a>
        </h4>

        <p class="description">
            <?=
            Text::truncate(
                Text::wordWrap($service->content),
                100,
                [
                    'ellipsis' => '...',
                    'exact' => false
                ]
            );
            ?>
        </p>
    </div>
</div>
<!-- End Service Item -->
<!-- Modal -->
<div class="modal fade" id="modal-<?= $service->slug ?>" tabindex="-1" aria-labelledby="modal-label-<?= "{$service->slug}" ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-label-<?= "{$service->slug}" ?>">
                    <?= h($service->name) ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-3">
                        <?php
                        $icon = $service->icon ? "../Uploads/{$service->icon->filename}" : 'image-default.png';
                        ?>
                        <?= $this->Html->image($icon, ['class' => 'img-responsive img-thumbnail']); ?>
                    </div>
                    <div class="col-xl-9">
                        <?= Text::wordWrap($service->content) ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
