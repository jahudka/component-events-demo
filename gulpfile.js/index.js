"use strict";

const gulp = require('gulp');
const nittro = require('gulp-nittro');
const scripts = require('./scripts');
const styles = require('./styles');

const builder = new nittro.Builder({
    vendor: {
        js: [
          'public/js/jquery/jquery-2.2.4.min.js',
          'public/js/popper.min.js',
          'public/js/bootstrap.min.js',
          'public/js/plugins.js',
          'public/js/active.js',
        ],
        css: [
          'public/css/core-style.css',
          'public/css/responsive.css',
        ]
    },
    base: {
        core: true,
        datetime: true,
        neon: true,
        di: true,
        ajax: true,
        forms: true,
        page: true,
        flashes: false,
        routing: false
    },
    extras: {
        checklist: false,
        dialogs: false,
        confirm: false,
        dropzone: false,
        paginator: false,
        keymap: false,
        storage: false
    },
    libraries: {
        js: [
          'public/js/presentation.js'
        ],
        css: [
          'public/css/styles.css',
          'public/css/presentation.css'
        ]
    },
    bootstrap: {
      params: {
        page: {
          whitelistLinks: true,
          scroll: {
            target: false,
          },
        },
        forms: {
          whitelistForms: true,
        },
      },
    },
    stack: true
});

exports.js = function nittroJs() {
    return scripts(builder, 'nittro.min.js');
};

exports.css = function nittroCss() {
    return styles(builder, 'nittro.min.css');
};

exports.default = gulp.parallel(exports.js, exports.css);
