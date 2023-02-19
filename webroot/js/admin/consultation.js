$(document).ready(function () {
    $('body')
        .on('click', '.btn-add-consultation', function (e) {
            e.preventDefault();
            let newEntity = {
                id: '',
                date: tomorrow(),
                time: '07:00',
                specialist_id: $('[name=specialist_id]').val(),
                value: $('[name=query_value]').val(),
                amount_paid: '',
                date_paid: '',
                description: '',
            };
            loadValuesModal(newEntity, 'Adicionar');
        })
        .on('click', '.btn-edit-modal', function (e) {
            e.preventDefault();
            let entity = datatablesCustom.convertObjectString($(this).data('entity'));
            loadValuesModal(entity, 'Editar');
        })
        .on('click', '.consultation-save', function (e) {
            e.preventDefault();
            let form = $('form#consultation');
            let urlSave = form.attr('action');
            $.ajax({
                type: "POST",
                url: urlSave,
                beforeSend: function(xhr){
                    xhr.setRequestHeader("X-CSRF-Token", _csrfToken);
                },
                dataType: "json",
                encode: true,
                data: form.serializeArray(),
                success: function (data){
                    alert(data.message);
                    datatableCurrent.draw();
                    $('#modal-consultation').modal('toggle')
                },
                error: function (request, status, error) {
                    console.log(request);
                    alert(request.responseText);
                }
            }).done(function (data) {
                closeLoad();
            });
        });
});


function tomorrow() {
    let myDate = new Date();
    myDate.setDate(myDate.getDate()+1);
    // format a date
    return myDate.getDate() + '/' + ("0" + (myDate.getMonth() + 1)).slice(-2) + '/' + myDate.getFullYear();
}

function loadValuesModal(entity, type) {
    let $modal = $('#modal-consultation');
    $modal.find('h4 #type').html(type);
    $modal.find('#consultation-id').val(entity.id);
    $modal.find('#consultation-date').val(entity.date);
    $modal.find('#consultation-time').val(entity.time);
    $modal.find('#select2-consultation.specialist_id').val(entity.specialist_id);
    $modal.find('#consultation-value').val(entity.value);
    $modal.find('#consultation-amount-paid').val(entity.amount_paid);
    $modal.find('#consultation-date-paid').val(entity.date_paid);
    $modal.find('#consultation-description').val(entity.description);
    $modal.modal('toggle');
}
