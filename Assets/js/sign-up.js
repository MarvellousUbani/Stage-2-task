// inputs
const username = document.querySelector('#name');
const email = document.querySelector('#mail');
const password = document.querySelector('#pass');
// button
const btn = document.querySelector('.btn-submit');

// message parent elements
const divN = document.querySelector('.name-div');
const divE = document.querySelector('.email-div');
const divP = document.querySelector('.password-div');
// 
const success = document.querySelector('.success');

// name message
const messageN = document.createElement('p')
messageN.classList.add('message')

// email message
const messageE = document.createElement('p')
messageE.classList.add('message')

// password message
const messageP = document.createElement('p')
messageP.classList.add('message')



// dummy database
const users = [];

btn.addEventListener('click', (e) => {
  e.preventDefault();

  if (username.value.length <= 0) {
    messageN.textContent = 'please type in a name'
    // 
    divN.appendChild(messageN);

    // validate email
    const emailCheck = /[@]/g.test(email.value);

    if (!emailCheck) {
      // 
      divE.appendChild(messageE);
      return messageE.textContent = 'incorrect email format'
    }

  }
  else {
    // 
    success.style.display = 'block';
    // 
    messageP.textContent = '';
    // // 
    messageE.textContent = '';
    // // 
    messageN.textContent = '';
  }



  // save users
  users.push(
    {
      name: username.value,
      email: email.value,
      password: password.value
    }
  )

  localStorage.setItem('users', JSON.stringify(users));

  username.value = '';
  email.value = '';
  password.value = '';


})


