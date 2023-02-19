<?php
$this->Form->unlockField('image_upload_temp');
$this->Form->unlockField('upload.file');
$classDiv = $upload ? 'hidden-upload' : '';
echo "<div class='col-md-12 no-padding input-file-avatar $classDiv'>";
echo $this->Form->label($label);
echo $this->Form->file('upload.file', ['class' => 'upload_crop', 'multiple' => false, 'accept' => 'image/*', 'label' => 'Imagem']);
echo '</div>';
if (!empty($upload->filename)) {
    ?>
    <div class="file-avatar">
        <div class="col-md-12 no-padding text-center">
            <strong><?= $label ?: '' ?></strong><br/>
            <?= $this->Html->image('../Uploads/' . $upload->filename, ['class' => 'img-responsive img-user img-thumbnail']); ?>
        </div>
        <div class="col-md-12 no-padding text-center">
            <?=
            $this->Html->link("<i class='fa fa-trash'></i> Excluir", '#', [
                "alt" => $label,
                'escapeTitle' => false,
                'class' => 'btn btn-xs btn-danger delete-file-testimonial',
                'data-auth' => 'false',
                'data-foreign-key' => $upload->foreign_key,
                'data-model' => $upload->model,
                'data-id' => $upload->id,
            ]);
            ?>
        </div>
    </div>
<?php } ?>
<div id="uploaded_image"></div>
<style>
    .hidden-upload {
        display: none;
    }
    .file-avatar {
        border: 1px solid #dee2e6 !important;
        margin: 0 10px !important;
        box-shadow: 0 1px 2px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
        min-height: 215px;
    }
</style>
<script>
    let multipleFileUploadsDelete = "<?= $this->Url->build(['controller' => 'Utils', 'action' => 'multipleFileUploadsDelete',])?>";

    $("body")
        .on('click', '.file-avatar .delete-file-testimonial', function(e){
            if (!confirm("Deseja realmente deletar esse arquivo?")) {
                return;
            }
            e.preventDefault();
            deleteFile($(this).data('foreign-key'), $(this).data('model'),$(this).data('id'));
            $('.input-file-avatar').removeClass('hidden-upload');
            $('.file-avatar').addClass('hidden-upload');
        });
</script>
<?= $this->Html->script(['/js/admin/multi-uploads'], ['block' => 'custom']) ?>
