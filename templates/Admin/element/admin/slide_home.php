<div class="div-clone <?= $count == 0 ? 'hide' : '' ?>" data-count="<?= $count ?>">
    <div class="focus-slide">
        <div class="form-group col-md-5">
            <?=
            $this->Form->control('slide_home.title[]', [
                'label' => 'Título',
                'class' => 'slide-title',
                'id' => 'slide-title-' . $count,
                'disabled' => $count == 0,
                'value' => $slide->title ?? ''
            ]);
            ?>
        </div>
        <div class="form-group col-md-5">
            <?=
            $this->Form->control('slide_home.subtitle[]', [
                'label' => 'Subtítulo',
                'class' => 'slide-subtitle',
                'id' => 'slide-subtitle-' . $count,
                'disabled' => $count == 0,
                'required' => $count != 0,
                'value' => $slide->subtitle ?? ''
            ]);
            ?>
        </div>
        <div class="form-group col-md-2 text-center">
            <div class="remove-slide btn btn-md btn-danger margin-top-25 " onclick="return removeDivParent(this, '.div-clone')">
                <i class="fa fa-trash-o"></i>
            </div>
        </div>
    </div>
</div>