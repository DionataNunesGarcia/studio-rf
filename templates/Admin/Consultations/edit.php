<?php
$actionForm = $action ?? $this->getRequest()->getParam('action');
?>
<?=
$this->Form->create($entity, ['url' => [
        'action' => $actionForm,
        $entity->id,
        'fullBase' => true,
    ],
    'enctype' => 'multipart/form-data'
]);
$this->Form->unlockField('period.add');
$this->Form->unlockField('period.date');
$this->Form->unlockField('period.time');
?>
<div class="box">
    <?= $this->element('admin/box-title', ['title' => 'Cadastro']) ?>
    <div class="box-body">
        <fieldset>
            <?= $this->Form->control('id', ['type' => 'hidden']) ?>
            <?= $this->Form->control('patient_id', ['type' => 'hidden', 'value' => $entity->id]) ?>
            <div class="row">
                <div class="form-group col-md-6">
                    <?=
                    $this->element('admin/select2', [
                        'controller' => 'Patients',
                        'name' => 'patient_id',
                        'label' => __('Paciente'),
                        'multiple' => false,
                        'value' => $entity->patient_id,
                    ])
                    ?>
                </div>
                <div class="form-group col-md-6">
                    <?=
                    $this->Form->control('date', [
                        'label' => 'Data',
                        'type' => 'text',
                        'class' => 'datepicker'
                    ]);
                    ?>
                </div>
                <div class="form-group col-md-6">
                    <?=
                    $this->Form->control('time', [
                        'label' => 'Hora',
                        'type' => 'select',
                        'options' => \App\Utils\Enum\TimeEnum::getArrayThirtyMinutes()
                    ]);
                    ?>
                </div>
                <div class="form-group col-md-6">
                    <?=
                    $this->element('admin/select2', [
                        'controller' => 'Specialists',
                        'name' => 'specialist_id',
                        'label' => __('Psicólogo'),
                        'multiple' => false,
                        'value' => $entity->specialist_id,
                    ])
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <?=
                    $this->Form->control('value', [
                        'class' => 'nf2',
                        'type' => 'text',
                        'label' => 'Valor da Consulta',
                    ]);
                    ?>
                </div>
                <div class="form-group col-md-6">
                    <?=
                    $this->Form->control('amount_paid', [
                        'class' => 'nf2',
                        'type' => 'text',
                        'label' => 'Valor da Pago',
                    ]);
                    ?>
                </div>
                <div class="form-group col-md-6">
                    <?=
                    $this->Form->control('date_paid', [
                        'label' => 'Data Pagamento',
                        'type' => 'text',
                        'class' => 'datepicker'
                    ]);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <?=
                    $this->Form->control('description', [
                        'class' => 'form-control',
                        'label' => 'Anotações',
                        'type' => 'textarea'
                    ])
                    ?>
                </div>
            </div>
            <?php if (!$entity->id) { ?>
                <div class="row">
                    <div class="form-group col-md-12">
                        <?= $this->Form->checkbox('period.add', ['hiddenField' => false, 'id' => 'period-add']); ?>
                        <label for="period-add">Adicionar Periodo</label>
                    </div>
                    <div class="col-md-12 no-padding period-duplicate">
                        <div class="form-group col-md-5">
                            <?=
                            $this->Form->control('period.date[]', [
                                'label' => 'Data',
                                'type' => 'text',
                                'class' => 'datepicker-clone'
                            ]);
                            ?>
                        </div>
                        <div class="form-group col-md-5">
                            <?=
                            $this->Form->control('period.time[]', [
                                'label' => 'Hora',
                                'type' => 'select',
                                'empty' => '-- Selecione --',
                                'options' => \App\Utils\Enum\TimeEnum::getArrayThirtyMinutes()
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </fieldset>
    </div>
    <div class="box-footer">
        <?= $this->element('admin/form-buttons', ['id' => $entity->id]) ?>
    </div>
</div>
<?= $this->Form->end() ?>
<?= $this->element('admin/image-crop-modal') ?>
<script>
    $(function() {
        $(document).ready(function(){

            let buttonAdd = '<div class="col-md-2"><br><span><button class="btn btn-success btn-add" type="button"><span class="glyphicon glyphicon-plus"></span></button></span></div>';
            let periodHtmlClone = '<div class="period-clonned">'+$(".period-duplicate").html()+buttonAdd+'</div>';
            $( ".period-duplicate" ).html(periodHtmlClone);
            $( ".period-duplicate" ).after('<div class="period-clone"></div>');
            $('.period-duplicate').hide();
            datepickerClone();

            $(document)
                .on('click', '.btn-add', function(e) {
                    e.preventDefault();
                    $( ".period-clone" ).append(periodHtmlClone);
                    $(this).removeClass('btn-add').addClass('btn-remove')
                        .removeClass('btn-success').addClass('btn-danger')
                        .html('<span class="glyphicon glyphicon-minus"></span>');
                    datepickerClone();
                })
                .on('click', '.btn-remove', function(e) {
                    $(this).parents('.period-clonned').remove();

                    e.preventDefault();
                    return false;
                })
                .on('change', '#period-add', function(e) {
                    e.preventDefault();
                    console.log($(this).is(':checked'));
                    if ($(this).is(':checked')) {
                        $('.period-duplicate').fadeIn();
                        return false;
                    }
                    $('.period-duplicate').hide();
                });
        });
    });
    function datepickerClone() {
        $('.datepicker-clone').datepicker({
            format: "dd/mm/yyyy",
            language: 'pt-BR',
        });
    }
</script>
