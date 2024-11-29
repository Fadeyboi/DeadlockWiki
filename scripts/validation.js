function validateForm() {
  // Get form elements
  var name = document.getElementById("name").value.trim();
  var email = document.getElementById("email").value.trim();
  var age = document.getElementById("age").value.trim();
  var favoriteHero = document.getElementById("favorite_hero").value.trim();
  var rating = document.querySelector('input[name="rating"]:checked');
  var platform = document.getElementById("platform").value;
  var feedback = document.getElementById("feedback").value.trim();

  // Name validation
  if (name === "") {
    alert("Name is required.");
    return false;
  }

  // Email validation
  var emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
  if (email === "" || !email.match(emailPattern)) {
    alert("Please enter a valid email address.");
    return false;
  }

  // Age validation
  if (age === "" || isNaN(age) || age < 1 || age > 120) {
    alert("Please enter a valid age between 1 and 120.");
    return false;
  }

  // Favorite Hero validation
  if (favoriteHero === "") {
    alert("Please enter your favorite hero.");
    return false;
  }

  // Rating validation
  if (rating === null) {
    alert("Please select a rating.");
    return false;
  }

  // Platform validation
  if (platform === "") {
    alert("Please select your platform.");
    return false;
  }

  // Feedback validation
  if (feedback === "") {
    alert("Please provide your feedback.");
    return false;
  }

  // All validations passed
  return true;
}
