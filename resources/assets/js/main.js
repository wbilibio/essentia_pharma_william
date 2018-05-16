var App = App || {};
var height_window = $(window).height() - 50;

$(document).ready(function() {
    $('.content-general').css('min-height',height_window);

    App.deleteBtn();
    App.activeMasks();

    if($('.sortable').length > 0) App.sortableGrid();
    if($('.multiple-upload').length > 0) App.multipleUpload();

    $(document).on('click', '.input-publish', function(e){
        var $id = $(this).data('id');
        var $value = false;
        if($(this).is(':checked')){
            $value = true;
        }
        $.ajax({
            url: base_url + '/admin/news/publish/' + $id + '/' + $value,
            type: "GET",
            data: $(e.target).serialize(),
            success: function(data){
                if (data == 1) {
                    $('body,html').animate({
                        scrollTop :0
                    },1000);
                    $('.alert-success.msg-alert').fadeIn();
                } else {
                    $('body,html').animate({
                        scrollTop :0
                    },1000);
                    $('.alert-danger.msg-alert').fadeIn();
                }
            }
        });
    });
    $(document).on('click', '.input-publish-horoscopo', function(e){
        var $id = $(this).parents('tr').data('id');
        var $value = false;
        if($(this).is(':checked')){
            $value = true;
        }
        $.ajax({
            url: base_url + '/admin/horoscopo/publish/' + $id + '/' + $value,
            type: "GET",
            data: $(e.target).serialize(),
            success: function(data){
                if (data == 1) {
                    $('body,html').animate({
                        scrollTop :0
                    },1000);
                    $('.alert-success.msg-alert').fadeIn();
                } else {
                    $('body,html').animate({
                        scrollTop :0
                    },1000);
                    $('.alert-danger.msg-alert').fadeIn();
                }
            }
        });
    });
    $(document).on('click', '.salve-gallery', function(e){
        $('input[type="checkbox"]:checked:enabled').each(function(idx,el){
            var el = $(el);
            var $id = el.data('id');
            var $type = el.data('type');
            var $banner_id = $('input[name="banner_id"]').val();
            $.ajax({
                url: base_url + '/admin/banners_gallery/publish/' + $id + '/' + $type + '/' + $banner_id,
                type: "GET",
                data: $(e.target).serialize(),
                success: function(data){
                    if (data == 1) {
                        window.location.href = base_url + '/admin/banners_gallery/' + $banner_id;
                    } else {
                        $('.alert-danger.msg-alert').fadeIn();
                    }
                }
            });
        });
    });
});

App.multipleUpload = function() {
    Dropzone.options.dropzone = {
        dictDefaultMessage: "<h4>Clique ou arraste seus arquivos até aqui.</h4>"
    };
}


App.sortableGrid = function() {
    $( '.sortable' ).sortable().on('sortupdate', function() {
        var items = [];

        $('.sortable .ui-state-default').each(function(i){
            var order = $(".sortable .ui-state-default").length - i;
            obj = {'id': $(this).data('id'), 'order': order};
            items.push(obj);
        });

        App.reorder(items);
    });

    $( '.sortable' ).disableSelection();
}

App.reorder = function(items) {
    if(items.length > 0){
        $.ajax({
            url: window.location.href + 'clients/sortable',
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "POST",
            data: { items: items },
            success: function(data){
                if (data == 1) console.log("Sucesso!!");
                else location.reload();
            }
        });
    }
};


App.activeMasks = function () {
    $(".phone").mask('(99) 9999-9999?9', {placeholder: ""});
};

App.deleteBtn = function() {
    $('.delete-btn').on('click', function(e){
        e.preventDefault();
        var redirect = $(this).attr('href');

        return swal({
            title: 'Deseja realmente remover este item?',
            text: 'Essa operação não pode ser revertida.',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Sim, excluir!',
            closeOnConfirm: false
        },
        function(){
            window.location.href = redirect;
        });
    });
 }
