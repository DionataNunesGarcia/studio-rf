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
                <?= $this->Form->control('email', ['label' => 'E-mail']); ?>
            </div>
            <div class="form-group col-md-4">
                <?=
                $this->Form->control('cpf', [
                    'value' => ($entity->cpf),
                    'class' => 'cpf',
                    'label' => 'CPF',
                ]);
                ?>
            </div>
            <div class="form-group col-md-4">
                <?=
                $this->Form->control('phone', [
                    'value' => ($entity->phone),
                    'class' => 'phone',
                    'label' => 'Telefone',
                ]);
                ?>
            </div>
            <div class="form-group col-md-4">
                <?=
                $this->Form->control('cell_phone', [
                    'value' => ($entity->cell_phone),
                    'class' => 'phone',
                    'label' => 'Celular',
                ]);
                ?>
            </div>
            <div class="form-group col-md-4">
                <?=
                $this->Form->control('birth_date', [
                    'value' => \App\Utils\ConvertDates::convertDateToPtBR($entity->birth_date),
                    'class' => 'datepicker',
                    'label' => 'Data de Nascimento',
                ]);
                ?>
            </div>
            <div class="form-group col-md-12">
                <?=
                $this->Form->control('observations', [
                    'class' => 'form-control ckeditor',
                    'label' => 'Observações',
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
<?php if ($entity->id) { ?>
    <div class="box">
        <?= $this->element('admin/box-title', ['title' => 'Arquivos']) ?>
        <div class="box-body">
            <?=
            $this->element('admin/multi-upload', [
                'foreignKey' => $entity->id,
                'model' => 'Clients',
            ]);
            ?>
        </div>
    </div>
<?php } ?>
