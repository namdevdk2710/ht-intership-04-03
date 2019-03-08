$(document).ready(function () {
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        let searchParams = new URLSearchParams(window.location.search);
        let param = searchParams.get('search');
        var page = $(this).attr('href').split('page=')[1];
        getUser(param, page);

    });

    function getUser(param,page) {
        $.ajax({
            type: 'get',
            url: '?search='+param+'&page=' + page,
            success: function(data) {
                $('#table-body').html($(data).find('#table-row'));
            }
        });
    };
    $(document).on('click','#user_delete',function (e) {
        return confirm('Bạn muốn xóa '+ $(this).attr('data-name')+ ' ?');
    });
})