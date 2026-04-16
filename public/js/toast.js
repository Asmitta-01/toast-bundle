(function () {
    'use strict';

    function showToast(toastEl) {
        if (toastEl.classList.contains('show')) return;
        toastEl.style.display = 'block';
        void toastEl.offsetHeight; // force reflow so opacity transition fires
        toastEl.classList.add('show');
    }

    function hideToast(toastEl) {
        if (!toastEl.classList.contains('show')) return;
        toastEl.classList.remove('show');
        var duration = parseFloat(getComputedStyle(toastEl).transitionDuration) * 1000;
        setTimeout(function () {
            toastEl.style.display = '';
        }, duration || 150);
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.asmitta-toast').forEach(function (toastEl) {
            var autohide = toastEl.getAttribute('data-asmitta-autohide') !== 'false';
            var delay = parseInt(toastEl.getAttribute('data-asmitta-delay') || '5000', 10);

            showToast(toastEl);

            var dismissBtn = toastEl.querySelector('[data-asmitta-dismiss="toast"]');
            if (dismissBtn) {
                dismissBtn.addEventListener('click', function () {
                    hideToast(toastEl);
                });
            }

            if (autohide && delay > 0) {
                setTimeout(function () {
                    hideToast(toastEl);
                }, delay);
            }
        });
    });
})();
