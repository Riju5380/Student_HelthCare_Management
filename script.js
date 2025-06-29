
document.getElementById('loginForm').addEventListener('submit', function(e) {
  const userid = document.querySelector('input[name="userid"]').value.trim();
  const password = document.querySelector('input[name="password"]').value.trim();

  if (!userid || !password) {
    e.preventDefault();
    document.getElementById('errorMsg').textContent = 'Please fill all fields';
  }
});