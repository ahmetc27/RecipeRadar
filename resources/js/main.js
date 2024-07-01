//rewrite comments!!!

// function to switch between tabs
function openTab(evt, tabName) {
    
    var i, tabcontent, tablinks;

    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";

}

function cleanInput($value)
{
    $input = trim($value);
    $input = strip_tags($input);
    $input = htmlspecialchars($input);

    return $input;
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('defaultOpen').click();
});