document.addEventListener('DOMContentLoaded', () => {
    const params = new URLSearchParams(window.location.search);
    const tab = params.get('tab');

    if (tab) {
        const targetTab = $(`[data-target="#${tab}"]`);
        if (targetTab.length) {
            const tabTrigger = new bootstrap.Tab(targetTab[0]);
            tabTrigger.show();
        }
    }


});


$(function () {
    const tabLinks = document.querySelectorAll('[data-toggle="tab"]');
    tabLinks.forEach(tabLink => {
        tabLink.addEventListener('click', function(event) {
            const href = tabLink.getAttribute('href');
            const url = new URL(window.location.href);
            url.searchParams.set('tab', href.split('#')[1]);
            window.history.pushState({}, '', url);
        });

    });
});