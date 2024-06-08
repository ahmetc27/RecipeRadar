$(document).ready(function(){
    $("#togglePostFormBtn").click(function(){
        $("#postFormContainer").toggle();
        var buttonText = $(this).text() === "Toggle Post Form" ? "Hide Post Form" : "Toggle Post Form";
        $(this).text(buttonText);
    });
});
