$(document).ready(function () {
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();

        var page = $(this).attr('href').split('page=')[1];
        getUser(page);

    });

    function getUser(page) {
        $.ajax({
            type: 'get',
            url: '?page=' + page,
            success: function(data) {

                $('#table-body').html($(data).find('#table-row'));
            }
        });
    };
    $(document).on('click','#user_delete',function (e) {
        return confirm('Bạn muốn xóa '+ $(this).attr('data-name')+ ' ?');
    });
})