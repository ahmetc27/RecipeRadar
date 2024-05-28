document.addEventListener('DOMContentLoaded', (event) => {
    fetch('user.json')
        .then(response => response.json())
        .then(data => {
            generateUserList(data);
        })
        .catch(error => console.error('Error fetching user data:', error));
});

function generateUserList(users) {
    let userList = document.getElementById('userList');
    userList.innerHTML = '';
    
    users.forEach(user => {
        let li = document.createElement('li');
        li.setAttribute('data-username', user.userName);
        li.setAttribute('data-email', user.email);
        li.textContent = `${user.firstName} ${user.lastName} (${user.userName}) - ${user.email}`;
        userList.appendChild(li);
    });
}

function searchUsers() {
    let input = document.getElementById('searchBar').value.toLowerCase();
    let userList = document.getElementById('userList');
    let users = userList.getElementsByTagName('li');

    for (let i = 0; i < users.length; i++) {
        let username = users[i].getAttribute('data-username');
        let email = users[i].getAttribute('data-email');
        if (username.toLowerCase().indexOf(input) > -1 || email.toLowerCase().indexOf(input) > -1) {
            users[i].style.display = '';
        } else {
            users[i].style.display = 'none';
        }
    }
}
