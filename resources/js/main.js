// Function to switch between tabs
function openTab(evt, tabName) {

    var i, tabcontent, tablinks;

    // Hide all tab content elements
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Remove 'active' class from all tab links
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Display the selected tab content and mark the tab link as active
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";

}

// Function to sanitize input value
function cleanInput($value) {
    $input = trim($value);          // Trim whitespace
    $input = strip_tags($input);    // Strip HTML tags
    $input = htmlspecialchars($input);  // Convert special characters to HTML entities

    return $input;
}

// Automatically click on the defaultOpen tab when the document is fully loaded
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('defaultOpen').click(); // Trigger a click event
});
