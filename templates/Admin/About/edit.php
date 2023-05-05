<?=
$this->Form->create($entity, [
    'url' => [
        'action' => 'edit',
        $entity->id,
        'fullBase' => true,
    ],
    'enctype' => 'multipart/form-data',
    'id' => 'form-about',
]);
?>
<div class="box">
    <?= $this->element('admin/box-title', ['title' => 'Dados Sistema', 'collapse' => false]) ?>
    <div class="box-body">
        <?= $this->Form->hidden('id') ?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group col-md-4">
                    <?= $this->Form->control('title', ['label' => 'Título']); ?>
                </div>
                <div class="form-group col-md-4">
                    <?= $this->Form->control('email', ['label' => 'E-mail', 'type' => 'email']); ?>
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
            </div>
            <div class="col-md-12">
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
                    <?= $this->Form->control('facebook'); ?>
                </div>
                <div class="form-group col-md-4">
                    <?= $this->Form->control('instagram'); ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group col-md-4">
                    <?= $this->Form->control('linkedin'); ?>
                </div>
                <div class="form-group col-md-4">
                    <?= $this->Form->control('github'); ?>
                </div>
                <div class="form-group col-md-4">
                    <?= $this->Form->control('video_home'); ?>
                </div>
                <div class="form-group col-md-4">
                    <?php
                    echo $this->element('admin/image-upload', [
                        'upload' => $entity->cover,
                        'label' => 'Capa',
                    ])
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?= $this->element('admin/address', ['address' => $entity->address, 'model' => 'About', 'foreignKey' => $entity->id]) ?>
    <?= $this->element('admin/box-title', ['title' => 'Textos']) ?>
    <div class="box-body">
        <div class="form-group col-md-12">
            <?= $this->Form->control('about', ['class' => 'ckeditor', 'label' => 'Sobre', 'type' => 'textarea']) ?>
        </div>
        <div class="form-group col-md-12">
            <?= $this->Form->control('vision', ['class' => 'ckeditor', 'label' => 'Visão', 'type' => 'textarea']) ?>
        </div>
        <div class="form-group col-md-12">
            <?= $this->Form->control('mission', ['class' => 'ckeditor', 'label' => 'Missão', 'type' => 'textarea']) ?>
        </div>
        <div class="form-group col-md-12">
            <?= $this->Form->control('values_about', ['class' => 'ckeditor', 'label' => 'Valores', 'type' => 'textarea']) ?>
        </div>
    </div>
    <?= $this->element('admin/box-title', ['title' => 'Slides Home']) ?>
    <div class="box-body">
        <div class="padding-side-15 margin-bottom-10">
            <button class="btn btn-success add-slide">
                <i class="fa fa-plus"></i>
                Adicionar
            </button>
        </div>
        <div class="select-container ">
            <?= $this->element('admin/slide_home', ['count' => 0]) ?>
            <?php
            foreach ($slides as $count => $slide) {
                $count++;
                echo $this->element('admin/slide_home', ['count' => $count, 'slide' => $slide]);
            }
            ?>
        </div>
    </div>
    <div class="box-footer">
        <?=
        $this->Form->button('<i class="fa fa-save"></i> Salvar', [
            'class' => 'btn btn-primary',
            'escapeTitle' => false
        ]);
        ?>
    </div>
</div>
<?= $this->Form->end() ?>
