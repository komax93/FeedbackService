$(document).ready(function() {
    $(this).on("click", ".btn-info-preview", function() {
        var login = $("input[name='login']").val();
        var email = $("input[name='email']").val();
        var date = getCurrentTime();
        var text = $("textarea[name='text']").val();

        if(login.length >= 3 && email.length >= 3 && text.length >= 3) {
            $(".comment-toggle.hideblock").toggle("slow");
            $(".comment-toggle .comment__login").html(login);
            $(".comment-toggle .comment__email").html(email);
            $(".comment-toggle .comment__date").html(date);
            $(".comment-toggle .comment__text").html(text);
            getPreviewImg("#my-file-selector", ".comment-toggle .comment__img > img");
        }
    });
});

function getCurrentTime() {
    var date = new Date();
    var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
    var month = ((date.getMonth() + 1) < 10) ? "0" + (date.getMonth() + 1) : (date.getMonth() + 1);
    var year = date.getFullYear();
    var hours = (date.getHours() < 10) ? "0" + date.getHours() : date.getHours();
    var minutes = (date.getMinutes() < 10) ? "0" + date.getMinutes() : date.getMinutes();
    var seconds = (date.getSeconds() < 10) ? "0" + date.getSeconds() : date.getSeconds();

    return day + "-" + month + "-" + year + " " + hours + ":" + minutes + ":" + seconds;
}

function getPreviewImg(uploadedFile, imageDest) {
    var file = $(uploadedFile).get(0).files[0];

    if(!file.type.match("image.*")) {
        return false;
    }

    var reader = new FileReader();
    reader.onloadend = function () {
        $(imageDest).attr("src", reader.result);
    }

    reader.readAsDataURL(file);
}