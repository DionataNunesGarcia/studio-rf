<?=
$this->Form->create($entity, ['url' => [
    'action' => $this->getRequest()->getParam('action'),
    $entity->id,
    'fullBase' => true,
], 'enctype' => 'multipart/form-data'])
?>
<div class="box">
    <?= $this->element('admin/box-title', ['title' => 'Cadastro']) ?>
    <div class="box-body">
        <fieldset>
            <?= $this->Form->hidden('id') ?>
            <?= $this->Form->hidden('status',['value' => 1]); ?>
            <div class="form-group col-md-4">
                <?= $this->Form->control('name', ['label' => 'Nome']); ?>
            </div>
            <div class="form-group col-md-4">
                <?= $this->Form->control('profession', ['label' => 'Profissão']); ?>
            </div>
            <div class="form-group col-md-4">
                <?=
                $this->Form->control('note', [
                    'type' => 'select',
                    'label' => __('Nota'),
                    'class' => 'form-control',
                    'required' => true,
                    'options' => [
                        1 => 1,
                        2 => 2,
                        3 => 3,
                        4 => 4,
                        5 => 5,
                    ]
                ]);
                ?>
            </div>
            <div class="form-group col-md-12">
                <?= $this->Form->control('content', ['class' => 'form-control', 'label' => 'Conteúdo', 'type' => 'textarea']) ?>
            </div>
            <div class="form-group col-md-4 no-padding">
                <?php
                echo $this->element('admin/image-crop-upload', [
                    'upload' => $entity->avatar,
                    'label' => 'Avatar',
                ])
                ?>
            </div>
        </fieldset>
    </div>
    <div class="box-footer">
        <?= $this->element('admin/form-buttons', ['id' => $entity->id]) ?>
    </div>
</div>
<?= $this->Form->end() ?>
<?= $this->element('admin/image-crop-modal') ?>
