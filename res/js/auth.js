window.addEventListener("DOMContentLoaded", (event) => {
  var form = document.getElementById("login-form");
  var form2 = document.getElementById("regis-form");
  var emailInput = document.getElementById("email");
  var passwordInput = document.getElementById("pass");
  var confirmedPasswordInput = document.getElementById("pass2");
  
  try{
  form.addEventListener("submit", function(event) {
    const email = emailInput.value.trim();
    const password = passwordInput.value.trim();
  
    if (email === "") {
      event.preventDefault();
      alert("Email is required.");
      return;
    }
  
    if (!isValidEmail(email)) {
      event.preventDefault();
      alert("Please enter a valid email address.");
      return;
    }
  
    if (password === "") {
      event.preventDefault();
      alert("Password is required.");
      return;
    }
  
  });} catch(e){
    console.log(e);
  }

  try{
  form2.addEventListener("submit", function(event) {
    const email = emailInput.value.trim();
    const password = passwordInput.value.trim();
    const password2 = confirmedPasswordInput.value.trim();
  
    if (email === "") {
      event.preventDefault();
      alert("Email is required.");
      return;
    }
  
    if (!isValidEmail(email)) {
      event.preventDefault();
      alert("Please enter a valid email address.");
      return;
    }
  
    if (password === "") {
      event.preventDefault();
      alert("Password is required.");
      return;
    }

    if (!(password === password2)) {
      event.preventDefault();
      alert("Passwords do not match.");
      return;
    }
  
  });}catch(e){
    console.log(e);
  }

});

  
  
  function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }
  