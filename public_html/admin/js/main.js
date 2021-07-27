'use strict';

var EditorCarousel = {
    body: $('body'),
    form: null,
    init: function () {
        if (this.form) return this;

        this.body.append('<form action="/admin/media/carousel" method="post" ' +
            'enctype="multipart/form-data" id="img-form">' +
            '<input type="file" name="_gallery[]" accept="image/*" multiple id="_file"/>' +
            '</form>');

        this.form = $('#img-form', this.body);

        return this;
    },
    cleanup: function () {
        this.form && this.form.remove();
        this.form = null;
    },
    select: function () {
        var self = this;

        $('input', this.form)
            .trigger('click')
            .on('change', self.beginUpload.bind(this));

        return new Promise((resolve, reject) => {
            if (!self.form) {
                resolve(null);
            } else {
                self.form.ajaxForm({
                    success: resolve,
                    error: reject
                });
            }
        });
    },
    beginUpload: function (e) {
        $(this.form).trigger('submit');
        this.cleanup();
    },
    register: async function () {
        var res = await EditorCarousel.init().select();

        if (res && res.length > 0) {
            var html = [];
            for (var i = 0; i < res.length; i++) {
                html.push('<li data-src="' + res[i].src + '" data-thumb="' + res[i].src + '">');
                html.push('<div class="img-wrap">');
                html.push('<img src="' + res[i].src + '"/>');
                html.push('</div>');
                html.push('</li>');
            }
            this.html.insert('<ul class="e-carousel">' + html.join('\n') + '</ul>');
        }
    }
};

FroalaEditor.DefineIcon('carousel', {NAME: 'carousel', SVG_KEY: 'upload'});
FroalaEditor.RegisterCommand('carousel', {
    title: 'Chèn thư viện ảnh',
    focus: true,
    undo: true,
    refreshAfterCallback: true,
    callback: EditorCarousel.register
});
FroalaEditor.RegisterQuickInsertButton('carousel', {
    icon: 'carousel',
    title: 'Chèn thư viện ảnh',
    callback: EditorCarousel.register,
    undo: true
});

var editorConfig = {
    charCounterCount: false,
    heightMin: 240,
    language: 'vi',
    toolbarButtons: {
        'moreText': {
            'buttons': [
                'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily',
                'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting'
            ]
        },
        'moreParagraph': {
            'buttons': [
                'alignLeft', 'alignCenter', 'formatOLSimple', 'alignRight', 'alignJustify', 'formatOL',
                'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent', 'quote'
            ]
        },
        'moreRich': {
            'buttons': ['insertLink', 'insertImage', 'insertVideo', 'insertTable', 'carousel'],
            'buttonsVisible': 5
        },
        'moreMisc': {
            'buttons': [
                'undo', 'redo', 'fullscreen', 'print', 'getPDF', 'spellChecker', 'selectAll', 'html', 'help'
            ],
            'align': 'right',
            'buttonsVisible': 2
        }
    },
    quickInsertButtons: ['image', 'table', 'ol', 'ul', 'carousel'],
    imageUploadURL: '/admin/media/upload',
    imageUploadParam: 'image'
};

(function ($, body) {
    let heightMin;
    $('.content-js:visible').each(function (i, o) {
        heightMin = $(this).data('height');
        if (heightMin) {
            editorConfig.heightMin = parseInt(heightMin);
        }
        new FroalaEditor('#' + $(this).attr('id'), editorConfig);
    });

    var $form, method, action, o, _prompt;
    $('[data-method="post"]').each(function () {
        $(this).on('click', function () {
            o = $(this);
            _prompt = o.data('prompt');
            if (_prompt && !!_prompt.length && confirm(_prompt)) {
                method = o.data('method');
                action = o.data('action') || o.attr('href');
                $form = $('<form/>', {method: method, action: o.attr('href')});
                $form.append($('<input/>', {name: '_method', value: method, type: 'hidden'}));
                $form.hide().appendTo('body');
                $form.trigger('submit');
            }
            return !(_prompt && !!_prompt.length);
        });
    });
    $('[data-method="get"]').each(function () {
        $(this).on('click', function () {
            o = $(this);
            _prompt = o.data('prompt');
            action = o.data('action') || o.attr('href');

            if (!_prompt || !_prompt.length) return true;

            return confirm(_prompt);
        });
    });

    $("#main-modal").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget);
        if (!link || !link.length) return;
        var md = $(this);
        $(".modal-content", md).load(link.attr("href"), function () {
            $('input[name="meta_title"]:visible', md).focus();
            $('form', md).ajaxForm({
                success: function () {
                    $.notify({icon: 'add_alert', message: "Cập nhật thành công"},
                        {type: "success", placement: {from: 'bottom', align: 'right'}}
                    );
                },
                error: function (err) {
                    $.notify({icon: 'add_alert', message: err.statusText || 'Đã có lỗi xảy ra, hãy thử lại!'},
                        {type: "danger", placement: {from: 'bottom', align: 'right'}}
                    );
                }
            });
        });
    });
})(jQuery, jQuery('body'));
//# sourceMappingURL=main.js.map

$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
})

function show_up_meta_post(base_url,post_id){
    console.log(1);
    $.ajax({
        url:  base_url + '/quantri/posts/meta/'+post_id,
        type: 'GET',
        datatype: 'html',
        success: function(data){
            $('#div_modal_meta_data').html(data);
            $('#modal_post_meta').modal();
            // $('.cls_result').removeClass("hide");


        }

    });
}