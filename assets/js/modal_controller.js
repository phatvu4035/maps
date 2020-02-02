(function($){
    $(document).on('click', '#rent', function () {
        initModal();
        addModalActive('.tab-rent', '#menueRent');
    });

    $(document).on('click', '#buy', function () {
        initModal();
        addModalActive('.tab-buy', '#menueBuy');
    });

    $(document).on('click', '#owner', function () {
        initModal();
        addModalActive('.tab-owner', '#menueOwner');
    });

    $(document).on('click', '#sell', function () {
        initModal();
        addModalActive('.tab-sell', '#menueSell');
    });

    $(document).on('click', '#company', function () {
        initModal();
        addModalActive('.tab-company', '#menueCompany');
    });

    $(document).on('click', '#recruit', function () {
        initModal();
        addModalActive('.tab-recruit', '#menueRecruit');
    });

    $(document).on('click', '#line', function () {
        initModal();
        addModalActive('.tab-line', '#menueLine');
    });

    function addModalActive(tab ,menue) {
        $(tab).addClass('active');
        $(menue).addClass('active in');
    }

    function initModal() {
        $('.nav-link > li').removeClass('active');
        $('.tab-content > article').removeClass('active in');
    }
})(jQuery);