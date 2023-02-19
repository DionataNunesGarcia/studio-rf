<?= $this->Form->create(null, ['type' => 'get', 'id' => 'datatable-search']); ?>
<div class="box">
    <?= $this->element('admin/box-title', ['title' => '<i class="fa fa-filter"></i> Filtrar']) ?>
    <div class="box-body">
        <div class="row">
            <div class="col-md-8">
                <?=
                $this->Form->control('dates_start_end', [
                    'class' => 'form-control dates-start-end',
                    'label' => 'Intervalo de Dias',
                    'autocomplete' => 'off',
                ]);
                ?>
            </div>
            <div class="form-group col-md-4">
                <?=
                $this->element('admin/select2', [
                    'controller' => 'Patients',
                    'name' => 'patient_id',
                    'label' => __('Patients'),
                    'multiple' => false,
                ])
                ?>
            </div>
            <?php if ($this->getRequest()->getParam('action') == 'index') { ?>
                <div class="form-group col-md-4">
                    <?=
                    $this->element('admin/select2', [
                        'controller' => 'Specialists',
                        'name' => 'specialist_id',
                        'label' => __('Psicólogo'),
                        'multiple' => false,
                    ])
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="box-footer">
        <div class="pull-right">
            <?= $this->element('admin/search/filter-buttons') ?>
        </div>
    </div>
</div>
<?= $this->Form->end(); ?>
