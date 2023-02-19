<?php
/**
 * @var \App\View\AppView $this
 */
?>
<?= $this->element('admin/search/metas-datatable') ?>
<?= $this->Form->create(null, ['type' => 'get', 'id' => 'datatable-search']); ?>
<div class="box">
    <?= $this->element('admin/box-title', ['title' => '<i class="fa fa-filter"></i> Filtrar']) ?>
    <div class="box-body">
        <div class="form-group col-md-6">
            <?=
            $this->Form->control('name', [
                'label' => 'Nome',
                'placeholder' => 'Pesquisar pelo Nome'
            ]);
            ?>
        </div>
        <div class="form-group col-md-6">
            <?=
            $this->Form->control('cpf', [
                'label' => 'CPF',
                'placeholder' => 'Pesquisar pelo CPF',
                'class' => 'cpf'
            ]);
            ?>
        </div>
    </div>
    <div class="box-footer">
        <div class="pull-right">
            <?= $this->element('admin/search/filter-buttons') ?>
        </div>
    </div>
</div>
<?= $this->Form->end(); ?>

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
                            <?= __('Nome') ?>
                        </th>
                        <th>
                            <?= __('E-mail') ?>
                        </th>
                        <th>
                            <?= __('CPF') ?>
                        </th>
                        <th>
                            <?= __('Telefones') ?>
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

    let titlePdf = "Pacientes";
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
                data: 'name'
            },
            {
                data: 'email'
            },
            {
                data: 'cpf'
            },
            {
                data: 'phone',
                render: function(data, type, full, meta) {
                    let html = ``;
                    if (full.phone) {
                        html += 'Telefone: ' + full.phone + '<br>';
                    }
                    if (full.cell_phone) {
                        html += 'Celular: ' + full.cell_phone + '<br>';
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

