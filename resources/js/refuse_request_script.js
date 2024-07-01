// Function to handle the refusal of the request
function refuseRequest(viewedUserID, currentUserID) {
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Define the request URL
    var url = 'services/refuse_request_service.php';

    // Create a FormData object to send data
    var formData = new FormData();
    formData.append('viewedUserID', viewedUserID);
    formData.append('currentUserID', currentUserID);

    // Open a POST request
    xhr.open('POST', url, true);

    // Set up the onload function to handle the response
    xhr.onload = function () {
        // Check if the request was successful (status code 200)
        if (xhr.status === 200) {
            // Redirect to the profile page of the current user
            window.location.href = 'profile.php?userID=' + viewedUserID;
        } else {
            // Display an error message
            console.error('Request failed. Status: ' + xhr.status);
        }
    };

    // Set up the onerror function to handle errors
    xhr.onerror = function () {
        console.error('Request failed. Check your network connection.');
    };

    // Send the request with the FormData
    xhr.send(formData);
}