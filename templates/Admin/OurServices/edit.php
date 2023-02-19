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
            <div class="form-group col-md-6">
                <?= $this->Form->control('name', ['label' => 'Nome']); ?>
            </div>
            <div class="form-group col-md-6">
                <?php
                echo $this->element('admin/image-crop-upload', [
                    'upload' => $entity->icon,
                    'label' => 'Icone',
                ])
                ?>
            </div>
            <div class="form-group col-md-12">
                <?=
                $this->Form->control('content', [
                    'class' => 'form-control ckeditor',
                    'label' => 'Conteúdo',
                    'type' => 'textarea',
                    'required' => false,
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
