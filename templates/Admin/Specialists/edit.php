<?php
use App\Utils\Enum\TimeEnum;
use App\Utils\ConvertDates;

echo $this->Form->create($entity, ['url' => [
    'action' => $this->getRequest()->getParam('action'),
    $entity->id,
    'fullBase' => true,
], 'enctype' => 'multipart/form-data'])
?>
<div class="box">
    <?= $this->element('admin/box-title', ['title' => 'Cadastro']) ?>
    <div class="box-body">
        <?= $this->Form->hidden('id') ?>
        <?= $this->Form->hidden('status',['value' => 1]); ?>
        <div class="form-group col-md-4">
            <?= $this->Form->control('name', ['label' => 'Nome']); ?>
        </div>
        <div class="form-group col-md-4">
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
            $this->element('admin/select2', [
                'controller' => 'SpecialistsCategories',
                'name' => 'specialist_category_id',
                'label' => __('Tipo de Especialista'),
                'multiple' => false,
                'required' => true,
                'value' => $entity->specialist_category_id,
            ])
            ?>
        </div>
        <div class="form-group col-md-12">
            <?= $this->Form->control('content', ['class' => 'form-control', 'label' => 'Conteúdo', 'type' => 'textarea']) ?>
        </div>
    </div>
    <!--User-->
    <?= $this->element('admin/user', ['user' => $entity->user]);  ?>

    <div class="box-footer">
        <?= $this->element('admin/form-buttons', ['id' => $entity->id]) ?>
    </div>
</div>
<?= $this->Form->end() ?>
<?= $this->element('admin/image-crop-modal') ?>