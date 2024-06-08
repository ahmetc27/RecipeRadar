function toggleForms(showForm) {
    if (showForm === 'edit') {
        document.getElementById('userForm').style.display = 'none';
        document.getElementById('userEditForm').style.display = 'block';
        document.getElementById('editButton').style.display = 'none';
        document.getElementById('cancelButton').style.display = 'inline-block';
    } else {
        document.getElementById('userForm').style.display = 'block';
        document.getElementById('userEditForm').style.display = 'none';
        document.getElementById('editButton').style.display = 'inline-block';
        document.getElementById('cancelButton').style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    toggleForms('view'); // Initially show the userForm and hide userEditForm
});