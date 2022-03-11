import jQuery from 'jquery';
import '@popperjs/core';
import bootstrap from 'bootstrap';

window.$ = window.jQuery = jQuery;

require('select2');

var quill = new Quill('#editor-container', {
    modules: {
        toolbar: [
            [{ header: [1, 2, false] }],
            ['bold', 'italic', 'underline'],
            ['image', 'code-block']
        ]
    },
    placeholder: 'Compose',
    theme: 'snow'
});

$("#editor-form").on("submit", function () {
    $("#note_text").val($("#editor-container").html());
});