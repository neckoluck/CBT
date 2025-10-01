<?php

if (session()->getFlashdata('message')) :
    $msg   = session()->getFlashdata('message');
    $pisah = explode('-', $msg); ?>

    <span class="fw-300 text-center mt-0" id="notif" data-type="<?= is_notif(current($pisah))['notif']; ?>" data-text="<span class='fw-500'><?= is_notif(current($pisah))['pesan']; ?></span> - <?= ucfirst(set_message($msg)); ?>"></span class="fw-300 text-center">

<?php endif; ?>

<script>
    var NotyJgrowl = function() {
        var _componentNoty = function() {
            if (typeof Noty == 'undefined') {
                console.warn('Warning - noty.min.js is not loaded.');
                return;
            }

            Noty.overrideDefaults({
                theme: 'limitless',
                layout: 'topRight',
                type: 'alert',
                timeout: 2500
            });

            var mText = $('#notif').data('text');
            var mType = $('#notif').data('type');

            if (mText) {
                new Noty({
                    layout: 'bottomCenter',
                    text: mText,
                    type: mType
                }).show();
            }
        }
        return {
            init: function() {
                _componentNoty();
                _componentJgrowl();
            }
        }
    }();

    document.addEventListener('DOMContentLoaded', function() {
        NotyJgrowl.init();
    });
</script>

<script>
    $('.check-input-switchery').on('change.form-check-input-switchery', function(e, state) {
        if (e.target.checked == true) {
            $value = 1;
        }

        $('input#input-switchery').val($value);
    });
</script>