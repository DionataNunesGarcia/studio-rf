<?php
/**
 * @var \App\View\AppView $this
 */
?>
<?= $this->element('admin/search/metas-datatable') ?>
<?php include 'form-search.php' ?>

<!-- Default box -->
<div class="box">
    <?= $this->element('admin/box-title', ['title' => '<i class="fa fa-table"></i> Registros']) ?>
    <div class="box-body">
        <?= $this->element('admin/search/grid-buttons') ?>
        <div class="col-md-12">
            <table class="table table-datatable table-striped table-bordered nowrap " id="table-index" style="width: 100%">
                <thead>
                    <tr>
                        <th class="checkbox-select">
                            <?= $this->Form->checkbox('select_all', ['hiddenField' => false]); ?>
                        </th>
                        <th>
                            <?= __('Paciente') ?>
                        </th>
                        <th>
                            <?= __('Dia') ?>
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
            'action' => 'searchAjax',
            'prefix' => 'Admin',
        ]);
        ?>";

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
                data: 'id',
                className: 'text-center',
                render: function(data, type, full, meta) {
                    return full.actions.delete ? '<input type="checkbox" name="selected[]" value="' + data + '">' : '';
                }
            },
            {
                data: 'patient'
            },
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
                        html += datatablesCustom.buildBtnEdit(data.edit);
                        html += datatablesCustom.buildBtnDelete(data.delete);
                    }
                    return html;
                }
            },
        ]
    });
</script>

