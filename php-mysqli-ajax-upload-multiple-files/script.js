/*
 @Author: Sanjay Kumar
 @Project: PHP MySQLi How to Upload Multiple Files with Ajax
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/

$(document).ready(function() {

    $("input").prop('required', true);

    $('#multipleFile').change(function() {
        var ext = this.value.match(/\.(.+)$/)[1];
        switch (ext) {
            case 'txt':
            case 'pdf':
            case 'docx':
            case 'csv':
            case 'xlsx':
                $('#error').text("");
                $('button').attr('disabled', false);
                break;
            default:
                $('#error').text("File must be of type txt,pdf,docx,csv,xlsx.");
                $('button').attr('disabled', true);
                this.value = '';
        }
    });

    $("#submitForm").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
            url: "process.php",
            type: "POST",
            cache: false,
            contentType: false, // you can also use multipart/form-data replace of false
            processData: false,
            data: new FormData(this),
            success: function(response) {
                $("#success").show();
                $("#success").fadeOut(2800);
            }
        });
    });
});