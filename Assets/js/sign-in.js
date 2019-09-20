// inputs 
const email = document.querySelector('#mail');
const password = document.querySelector('#pass');

// button
const btn = document.querySelector('.btn-submit');

// message parent elements
const divP = document.querySelector('.password-div');
const success = document.querySelector('.success');

// password and email error message
const messageP = document.createElement('p')
messageP.classList.add('message')

//  get users
const users = localStorage.getItem('users')
// convert users to object
const userList = JSON.parse(users)

// submit
btn.addEventListener('click', (e) => {
    e.preventDefault();

    userList.forEach(user => {
        if (email.value !== user.email || password.value !== user.password) {
            messageP.textContent = 'incorrect email or password'
            // 
            divP.appendChild(messageP);
        }
        else {
            // 
            success.style.display = 'block';
        }
    })


    email.value = '';
    password.value = '';


    setTimeout(() => {
        window.location = '/login.html';
    }, 1000)
})
