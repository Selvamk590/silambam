document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('login-btn').addEventListener('click', () => {
      const username = document.getElementById('username-input').value;
      const password = document.getElementById('password-input').value;

      fetch('login.php', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json'
          },
          body: JSON.stringify({ username, password })
      })
      .then(response => response.json())
      .then(data => {
          if (data.message === 'Login successful') {
              window.location.href = data.redirect;
          } else {
              document.getElementById('error-message').innerText = data.message;
          }
      })
      .catch(error => {
          console.error('Error:', error);
          document.getElementById('error-message').innerText = 'An error occurred';
      });
  });
});
