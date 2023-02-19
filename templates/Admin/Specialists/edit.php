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
        <div class="form-group col-md-12">
            <?= $this->Form->control('content', ['class' => 'form-control', 'label' => 'Conteúdo', 'type' => 'textarea']) ?>
        </div>
    </div>
    <!--Configurações-->
    <?= $this->element('admin/box-title', ['title' => 'Configurações']) ?>
    <div class="box-body">
        <div class="form-group col-md-9">
            <?=
            $this->Form->control('days_of_week', [
                'type' => 'select',
                'label' => __('Dias da Semana'),
                'class' => 'select2-tags',
                'required' => true,
                'multiple' => true,
                'options' => \App\Utils\Enum\DaysOfWeek::getArray()
            ]);
            ?>
        </div>
        <div class="form-group col-md-3">
            <?=
            $this->Form->control('consultation_duration', [
                'label' => 'Duração da Consulta',
                'type' => 'range',
                'class' => 'change-label',
                'min' => 10,
                'step' => 10,
                'max' => 240,
            ]);
            ?>
            <span id="consultation-duration-label" class="label label-primary"><?= $entity->consultation_duration ?></span>
        </div>
        <div class="form-group col-md-3">
            <?=
            $this->Form->control('start_service', [
                'label' => 'Início Atendimento',
                'type' => 'select',
                'value' => ConvertDates::timeToString($entity->start_service),
                'options' => TimeEnum::getArrayThirtyMinutes()
            ]);
            ?>
        </div>
        <div class="form-group col-md-3">
            <?=
            $this->Form->control('end_service', [
                'label' => 'Final Atendimento',
                'type' => 'select',
                'value' => ConvertDates::timeToString($entity->end_service),
                'options' => TimeEnum::getArrayThirtyMinutes()
            ]);
            ?>
        </div>
        <div class="form-group col-md-3">
            <?=
            $this->Form->control('start_break', [
                'label' => 'Início Intervalo',
                'type' => 'select',
                'value' => ConvertDates::timeToString($entity->start_break),
                'options' => TimeEnum::getArrayThirtyMinutes()
            ]);
            ?>
        </div>
        <div class="form-group col-md-3">
            <?=
            $this->Form->control('end_break', [
                'label' => 'Final Intervalo',
                'type' => 'select',
                'value' => ConvertDates::timeToString($entity->end_break),
                'options' => TimeEnum::getArrayThirtyMinutes()
            ]);
            ?>
        </div>
    </div>
    <!--User-->
    <?= $this->element('admin/user', ['user' => $entity->user]);  ?>

    <div class="box-footer">
        <?= $this->element('admin/form-buttons', ['id' => $entity->id]) ?>
    </div>
</div>
<?= $this->Form->end() ?>
<script>
    $(document).ready(function(){
       $('body')
           .on('change, click', '.change-label',function (event) {
               event.preventDefault();
               let _this = $(this);
               $('#' + _this.attr('id') + '-label').html(_this.val());
           });
    });
</script>
