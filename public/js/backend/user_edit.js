$(document).ready(function () {
    $(document).on('change','#image', function (e) {
        if (this.files && this.files[0]) {
        var link = e.target.files[0].name;

            var reader = new FileReader();
            reader.onload = function(e) {

                $('#image-img').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }
    })
})