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
                <?= $this->Form->control('title', ['label' => 'Título']); ?>
            </div>
            <div class="form-group col-md-6">
                <?= $this->Form->control('subtitle', ['label' => 'Subtitulo']); ?>
            </div>
            <div class="form-group col-md-12">
                <label for="content" class="required">Conteúdo</label>
                <?= $this->Form->input('content', ['class' => 'ckeditor', 'text' => 'Conteúdo', 'type' => 'textarea']) ?>
            </div>
        </fieldset>
    </div>
    <div class="box-footer">
        <?= $this->element('admin/form-buttons', ['id' => $entity->id]) ?>
    </div>
</div>
<?= $this->Form->end() ?>
<?= $this->element('admin/image-crop-modal') ?>
