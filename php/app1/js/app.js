const baseUrl = '/app1';

function login(event) {
    event.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    fetch(`${baseUrl}/login.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email, password })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'account.html';
        } else {
            showErrorMessage(data.error);
        }
    })
    .catch(error => {
        console.error('Erreur :', error);
    });
}

function register(event) {
    event.preventDefault();
    const nom = document.getElementById('nom').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    fetch(`${baseUrl}/register.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ nom, email, password })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'login.html';
        } else {
            showErrorMessage(data.error);
        }
    })
    .catch(error => {
        console.error('Erreur :', error);
    });
}

function fetchAccountInfo() {
    fetch(`${baseUrl}/account.php`)
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const accountInfo = `
                <p>Nom : ${data.user.nom}</p>
                <p>Email : ${data.user.email}</p>
            `;
            document.getElementById('account-info').innerHTML = accountInfo;
        } else {
            showErrorMessage(data.error);
            window.location.href = 'index.html';
        }
    })
    .catch(error => {
        console.error('Erreur :', error);
    });
}

function fetchFriends() {
    fetch(`${baseUrl}/friends.php`)
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            let friendsList = '<ul>';
            data.friends.forEach(friend => {
                friendsList += `
                    <li>
                        ${friend.nom}
                        <button onclick="removeFriend(${friend.id})">Supprimer</button>
                    </li>
                `;
            });
            friendsList += '</ul>';
            document.getElementById('friends-list').innerHTML = friendsList;
        } else {
            showErrorMessage(data.error);
            window.location.href = 'index.html';
        }
    })
    .catch(error => {
        console.error('Erreur :', error);
    });
}

function addFriend(friendId) {
    fetch(`${baseUrl}/add_friend.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ friend_id: friendId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            fetchFriends();
        } else {
            showErrorMessage(data.error);
        }
    })
    .catch(error => {
        console.error('Erreur :', error);
    });
}

function removeFriend(friendId) {
    fetch(`${baseUrl}/remove_friend.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ friend_id: friendId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            fetchFriends();
        } else {
            showErrorMessage(data.error);
        }
    })
    .catch(error => {
        console.error('Erreur :', error);
    });
}

function fetchGroups() {
    fetch(`${baseUrl}/groups.php`)
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            let groupsList = '<ul>';
            data.groups.forEach(group => {
                groupsList += `
                    <li>
                        <a href="group_chat.html?id=${group.id}">${group.nom}</a>
                    </li>
                `;
            });
            groupsList += '</ul>';
            document.getElementById('groups-list').innerHTML = groupsList;
        } else {
            showErrorMessage(data.error);
            window.location.href = 'index.html';
        }
    })
    .catch(error => {
        console.error('Erreur :', error);
    });
}

function createGroup() {
    const nom = prompt('Entrez le nom du nouveau groupe');
    if (nom) {
        fetch(`${baseUrl}/create_group.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ nom })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                fetchGroups();
            } else {
                showErrorMessage(data.error);
            }
        })
        .catch(error => {
            console.error('Erreur :', error);
        });
    }
}

function fetchUsers() {
    fetch(`${baseUrl}/users.php`)
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            let usersList = '<ul>';
            data.users.forEach(user => {
                usersList += `
                    <li>
                        ${user.nom}
                        <button onclick="addFriend(${user.id})">Ajouter en ami</button>
                    </li>
                `;
            });
            usersList += '</ul>';
            document.getElementById('users-list').innerHTML = usersList;
        } else {
            showErrorMessage(data.error);
            window.location.href = 'index.html';
        }
    })
    .catch(error => {
        console.error('Erreur :', error);
    });
}

function fetchGroupChat(groupId) {
    fetch(`${baseUrl}/group_chat.php?id=${groupId}`)
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('group-name').textContent = data.group_name;
            document.getElementById('group-id').value = groupId;
            let messagesList = '';
            data.messages.forEach(message => {
                messagesList += `
                    <div>
                        <strong>${message.expediteur}</strong> : ${message.contenu}
                        <small>${message.date_envoi}</small>
                    </div>
                `;
            });
            document.getElementById('messages').innerHTML = messagesList;
        } else {
            showErrorMessage(data.error);
            window.location.href = 'groups.html';
        }
    })
    .catch(error => {
        console.error('Erreur :', error);
    });
}

function sendMessage(event) {
    event.preventDefault();
    const groupId = document.getElementById('group-id').value;
    const message = document.getElementById('message-input').value;

    fetch(`${baseUrl}/send_message.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ group_id: groupId, message })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('message-input').value = '';
            fetchGroupChat(groupId);
        } else {
            showErrorMessage(data.error);
        }
    })
    .catch(error => {
        console.error('Erreur :', error);
    });
}

function logout() {
    fetch(`${baseUrl}/logout.php`)
    .then(() => {
        window.location.href = 'index.html';
    })
    .catch(error => {
        console.error('Erreur :', error);
    });
}
