
window._ = require('lodash');

window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

jQuery(document).ready(function($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': Laravel.csrfToken,
            'Accept': 'application/json'
        }
    });
});

require('notyf');

window.notyf = new Notyf();
