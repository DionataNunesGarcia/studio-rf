<?php
use App\Utils\Masks;
?>
<?= $this->element('admin/box-title', ['title' => 'Endereço', 'collapse' => false]) ?>
<div class="box-body">
    <?= $this->Form->hidden('address.id', ['value' => $address->id ?? null]); ?>
    <?= $this->Form->hidden('address.foreign_key', ['value' => $foreignKey]); ?>
    <?= $this->Form->hidden('address.model', ['value' => $model]); ?>
    <div class="form-group col-md-3">
        <?=
        $this->Form->control('address.cep', [
            'label' => 'CEP',
            'class' => 'cep',
            'value' => $address ? Masks::cep($address->cep) : null
        ]);
        ?>
    </div>
    <div class="form-group col-md-4">
        <?=
        $this->Form->control('address.street', [
            'label' => 'Rua',
            'value' => $address->street ?? null
        ]);
        ?>
    </div>
    <div class="form-group col-md-2">
        <?=
        $this->Form->control('address.number', [
            'label' => 'Nº',
            'value' => $address->number ?? null
        ]);
        ?>
    </div>
    <div class="form-group col-md-3">
        <?=
        $this->Form->control('address.complement', [
            'label' => 'Complemento',
            'value' => $address->complement ?? null
        ]);
        ?>
    </div>
    <div class="form-group col-md-3">
        <?=
        $this->Form->control('address.district', [
            'label' => 'Bairro',
            'value' => $address->district ?? null
        ]);
        ?>
    </div>
    <div class="form-group col-md-4">
        <?=
        $this->Form->control('address.city', [
            'label' => 'Cidade',
            'value' => $address->city ?? null
        ]);
        ?>
    </div>
    <div class="form-group col-md-2">
        <?=
        $this->Form->control('address.uf', [
            'label' => 'UF',
            'maxlength' => 2,
            'value' => $address->uf ?? null
        ]);
        ?>
    </div>
</div>
