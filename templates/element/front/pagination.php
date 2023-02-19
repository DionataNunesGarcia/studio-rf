<?php $class = $class ?? ''; ?>
<div class="<?= $class ?>">
    <ul class="pagination justify-content-center mb-0">
        <?php
        $this->Paginator->setTemplates([
            'prevDisabled' => '<li class="page-item disabled d-none"><a href="{{url}}" class="page-link"><i class="bi bi-chevron-double-left"></i></a></li>',
            'nextDisabled' => '<li class="page-item disabled d-none"><a href="{{url}}" class="page-link"><i class="bi bi-chevron-double-right"></i></a></li>',
            'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li> ',
            'current' => '<li class="page-item active"><a class="page-link" href="{{url}}">{{text}}</a></li> ',
            'first' => '<li class="page-item"><a class="page-link" href="{{url}}">Primeira</a></li> ',
            'last' => '<li class="page-item"><a class="page-link" href="{{url}}">Última</a></li> ',
            'prevActive' => '<li class="page-item"><a href="{{url}}" class="page-link"><i class="bi bi-chevron-double-left"></i></a></li>',
            'nextActive' => '<li class="page-item"><a href="{{url}}" class="page-link"><i class="bi bi-chevron-double-right"></i></a></li> ',
        ]);

        ?>
        <?php /*<?= $this->Paginator->first() ?> */ ?>
        <?= $this->Paginator->prev() ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next() ?>
        <?php /*<?= $this->Paginator->last() ?> */ ?>
    </ul>
</div>
