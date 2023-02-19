<?php
echo $this->Form->control('upload.image_upload_temp', [
    'value' => $imageName,
    'type' => 'hidden',
    'class' => 'hidden image-upload-temp'
]);
echo $this->Html->image($image, ['label' => false, 'class' => 'img-responsive img-thumbnail image-crop-temp']);
?>

<script>
    let tempFile = $(".image-upload-temp").val();
    let formData = new FormData();
    formData.('upload[image_upload_temp]', tempFile)
</script>
