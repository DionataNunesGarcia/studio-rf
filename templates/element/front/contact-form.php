<?php
$foreignKey = $foreignKey ?? null;
$model = $model ?? null;
?>
<?= $this->Form->create(null, ['url' => ['_name' => 'save-contact'], 'class' => 'php-email-form']) ?>
<?= $this->Form->control('foreign_key', ['label' => false, 'type' => 'hidden', 'value' => $foreignKey]); ?>
<?= $this->Form->control('model', ['label' => false, 'type' => 'hidden', 'value' => $model]); ?>
<div class="row">
    <div class="col-md-6 form-group">
        <?= $this->Form->control('name', ['label' => false, 'placeholder' => 'Seu Nome:', 'class' => 'form-control', 'required' => true]); ?>
    </div>
    <div class="col-md-6 form-group mt-3 mt-md-0">
        <?= $this->Form->control('email', ['label' => false, 'placeholder' => 'E-mail', 'class' => 'form-control', 'required' => true, 'type' => 'email']); ?>
    </div>
</div>
<div class="form-group mt-3">
    <?= $this->Form->control('subject', ['label' => false, 'placeholder' => 'Assunto:', 'class' => 'form-control', 'required' => true]); ?>
</div>
<div class="form-group mt-3">
    <?= $this->Form->control('message', ['label' => false, 'placeholder' => 'Sua Menssagem:', 'class' => 'form-control', 'type' => 'textArea', 'rows' => 5, 'required' => true]); ?>
</div>
<div class="my-3">
    <div class="loading">Loading</div>
    <div class="error-message"></div>
    <div class="sent-message">Sua mensagem foi enviada, agradecemos seu contato!</div>
</div>
<div class="text-center">
    <?= $this->Form->button('<i class="bi bi-send"></i> Enviar Mensagem', ['class' => 'btn btn-primary', 'escapeTitle' => false]); ?>
</div>
<?= $this->Form->end() ?>
