<?php
$placeholder = !empty($user->id) ? 'Só preencher se for alterar' : 'Digíte aqui a sua senha.';
$required = empty($user->id) ? true : false;
?>
<?= $this->element('admin/box-title', ['title' => 'Usuário']) ?>
<div class="box-body">
    <?= $this->Form->control('user.id', ['value' => $user->id, 'type' => 'hidden']); ?>
    <div class="form-group col-md-4">
        <?= $this->Form->control('user.user', [
            'label' => 'Usuário',
            'value' => $user->user,
            'required' => true,
            'autocomplete' => 'off'
        ]); ?>
    </div>
    <div class="form-group col-md-4">
        <?=
        $this->Form->control('user.password', [
            'label' => 'Senha',
            'type' => 'password',
            'value' => '',
            'placeholder' => $placeholder,
            'required' => $required,
            'autocomplete' => 'off'
        ]);
        ?>
    </div>
    <div class="form-group col-md-4">
        <?=
        $this->Form->control('user.password_confirm', [
            'label' => 'Confirmar Senha',
            'type' => 'password',
            'value' => '',
            'placeholder' => $placeholder,
            'required' => $required,
            'autocomplete' => 'off'
        ]);
        ?>
    </div>
    <div class="form-group col-md-4">
        <?=
        $this->element('admin/select2', [
            'controller' => 'levels',
            'name' => 'user.level_id',
            'label' => 'Nível',
            'multiple' => false,
            'required' => true,
            'value' => $user->level_id,
            'placeholder' => 'Pesquise o Nível de Permissão'
        ])
        ?>
    </div>
    <div class="form-group col-md-4">
        <?=
        $this->Form->control('user.status', [
            'type' => 'select',
            'label' => __('Situação'),
            'class' => 'form-control select2',
            'required' => true,
            'options' => \App\Utils\Enum\StatusEnum::ARRAY_SIMPLE
        ]);
        ?>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <?php
            echo $this->element('admin/image-crop-upload', [
                'upload' => $user->avatar,
                'label' => 'Avatar',
            ])
            ?>
        </div>
    </div>
</div>
<?= $this->element('admin/image-crop-modal') ?>
<script>
    $(window).on('load', function () {
        if ($('input#user-id').length) {
            setTimeout(function(){
                if (!$('input#user-id').val()) {
                    $('#user-user, #user-password').val('');
                }
            }, 300);
        }
    });
</script>
