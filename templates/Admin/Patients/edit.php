<?php
use App\Utils\ConvertCharacters;
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
        <div class="row">
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
                $this->Form->control('birth_date', [
                    'value' => ConvertDates::convertDateToPtBR($entity->birth_date),
                    'class' => 'datepicker',
                    'type' => 'text',
                    'label' => 'Data de Nascimento',
                ]);
                ?>
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
                $this->Form->control('query_value', [
                    'value' => ConvertCharacters::floatToString($entity->query_value),
                    'class' => 'nf2',
                    'type' => 'text',
                    'label' => 'Valor da Consulta',
                ]);
                ?>
            </div>
            <div class="col-md-4">
                <?=
                $this->element('admin/select2', [
                    'controller' => 'Specialists',
                    'name' => 'specialist_id',
                    'label' => __('Psicólogo'),
                    'multiple' => false,
                    'value' => $entity->specialist_id ?? 1,
                ])
                ?>
            </div>
            <div class="form-group col-md-4">
                <?php
                echo $this->element('admin/image-crop-upload', [
                    'upload' => $entity->avatar,
                    'label' => 'Avatar',
                ])
                ?>
            </div>
            <div class="form-group col-md-12">
                <?= $this->Form->control('observations', ['class' => 'form-control', 'label' => 'Observações', 'type' => 'textarea']) ?>
            </div>
        </div>
    </div>
    <?= $this->element('admin/address', ['address' => $entity->address, 'model' => 'Patients', 'foreignKey' => $entity->id]) ?>
    <div class="box-footer">
        <?= $this->element('admin/form-buttons', ['id' => $entity->id]) ?>
    </div>
</div>
<?= $this->Form->end() ?>
<?= $this->element('admin/image-crop-modal') ?>

<?php if ($entity->id) { ?>
    <?= $this->element('admin/search/metas-datatable') ?>
    <?= $this->Html->script(['admin/consultation.js',], ['block' => 'custom']) ?>
    <!-- Default box -->
    <div class="box">
        <?= $this->element('admin/box-title', ['title' => '<i class="fa fa-table"></i> Consultas']) ?>
        <div class="box-body">
            <div class="col-md-12 grid-buttons text-right">
                <?=
                $this->Html->link(__('<i class="fa fa-plus-square-o"></i> Nova Consulta'), [
                        'action' => 'add',
                        '_full' => true
                    ], [
                        'class' => 'btn btn-primary btn-add-consultation',
                        'escapeTitle' => false
                    ]
                );
                ?>
            </div>
            <div class="col-md-12">
                <table class="table table-datatable table-striped table-bordered nowrap " id="table-index" style="width: 100%">
                    <thead>
                    <tr>
                        <th>
                            <?= __('Data') ?>
                        </th>
                        <th>
                            <?= __('Hora') ?>
                        </th>
                        <th>
                            <?= __('Psicólogo') ?>
                        </th>
                        <th>
                            <?= __('Valores') ?>
                        </th>
                        <th>
                            <?= __('Criado') ?>
                        </th>
                        <th class="text-center actions">
                            <?= __('Ações') ?>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        let urlDatatable = "<?=
            $this->Url->build([
                'action' => 'searchConsultations',
                'prefix' => 'Admin',
                $entity->id
            ]);
            ?>";

        let titlePdf = "Consultas Paciente: " + "<?= $entity->name ?>";
        let datatableCurrent = $('#table-index').DataTable({
            dom: datatablesCustom.dom(),
            buttons: datatablesCustom.buttons(),
            serverSide: true,
            responsive: true,
            ajax: datatablesCustom.ajax(urlDatatable),
            searching: false,
            paging: true,
            ordering: false,
            processing: true,
            language: datatablesCustom.configDatatables().language,
            dataFilter: function(res) {
                debugger;
            },
            columns: [
                {
                    data: 'date'
                },
                {
                    data: 'time'
                },
                {
                    data: 'specialist'
                },
                {
                    data: 'value',
                    render: function(data, type, full, meta) {
                        let html = `<b>Valor Consulta:</b> R$ ` + data + '<br>';
                        html += `<b>Valor Pago:</b> R$ ` + full.entity.amount_paid + '<br>';
                        if (full.entity.date_paid) {
                            html += `<b>Data Pagamento: </b>` + full.entity.date_paid + '<br>';
                        }
                        return html;
                    }
                },
                {
                    data: 'created'
                },
                {
                    data: 'actions',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        let html = ``;
                        if (full.actions) {
                            html += datatablesCustom.buildBtnEditModal(full.actions.consultationSave, full.entity);
                            html += datatablesCustom.buildBtnDelete(data.delete);
                        }
                        return html;
                    }
                },
            ]
        });
    </script>

    <div class="modal fade" id="modal-consultation" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <?=
                $this->Form->create(null, ['url' => [
                    'action' => 'consultationSave',
                    $entity->id,
                    'fullBase' => true,
                ],
                    'enctype' => 'multipart/form-data',
                    'id' => 'consultation',
                ])
                ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        <span id="type"></span> Consulta
                    </h4>
                </div>
                <div class="modal-body">
                    <?= $this->Form->control('consultation.id', ['type' => 'hidden']) ?>
                    <?= $this->Form->control('consultation.patient_id', ['type' => 'hidden', 'value' => $entity->id]) ?>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <?=
                            $this->Form->control('consultation.date', [
                                'label' => 'Data',
                                'class' => 'datepicker'
                            ]);
                            ?>
                        </div>
                        <div class="form-group col-md-4">
                            <?=
                            $this->Form->control('consultation.time', [
                                'label' => 'Hora',
                                'type' => 'select',
                                'options' => \App\Utils\Enum\TimeEnum::getArrayThirtyMinutes()
                            ]);
                            ?>
                        </div>
                        <div class="form-group col-md-4">
                            <?=
                            $this->element('admin/select2', [
                                'controller' => 'Specialists',
                                'name' => 'consultation.specialist_id',
                                'label' => __('Psicólogo'),
                                'multiple' => false,
                                'value' => $entity->specialist_id,
                            ])
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <?=
                            $this->Form->control('consultation.value', [
                                'class' => 'nf2',
                                'type' => 'text',
                                'label' => 'Valor da Consulta',
                            ]);
                            ?>
                        </div>
                        <div class="form-group col-md-4">
                            <?=
                            $this->Form->control('consultation.amount_paid', [
                                'class' => 'nf2',
                                'type' => 'text',
                                'label' => 'Valor da Pago',
                            ]);
                            ?>
                        </div>
                        <div class="form-group col-md-4">
                            <?=
                            $this->Form->control('consultation.date_paid', [
                                'label' => 'Data Pagamento',
                                'class' => 'datepicker'
                            ]);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <?=
                            $this->Form->control('consultation.description', [
                                'class' => 'form-control',
                                'label' => 'Anotações',
                                'type' => 'textarea'
                            ])
                            ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" >Fechar</button>
                    <?=
                    $this->Form->button('<i class="fa fa-save"></i> Salvar', [
                        'class' => 'btn btn-primary consultation-save',
                        'escapeTitle' => false
                    ]);
                    ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
<?php } ?>
