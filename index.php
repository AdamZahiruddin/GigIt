<!-- SIGN IN PAGE -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gigit - Login</title>
    <link rel="stylesheet" href="style.css">

    <?php
      // Initialize session
      session_start(); // Start new session or resume existing session
      if(isset($_SESSION['username'])) {
          // Destroy the whole session
          $_SESSION = array(); // Clear all session variables
          session_destroy();
      }
    ?>
</head>

<body>
  <section class = "mid-section">

    <div class="logo">GigIt</div>
      <div class="container">
        <h1>Login</h1>

        <p class="subtext" style = "text-align: left;">Sign in into your account</p>
        
        <form class="loginform" action="login.php" method="POST">

          <div class="contain-input">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Username" required/>
          </div>

            <div class = "contain-input">
              <label for="password">Password:</label>
              <input type="password" id="password" name="password" placeholder="Password" required />
            </div>

            <div class = "forgotPass">
              <a class="links" style="text-align: left;" href="forgotPass.html">Forgot Password?</a>
            </div>

            <div class="center-container">
              <button style = 'display: block;' class="bluebutton" type="submit">Login</button>
            </div>  

            <p style = 'display:inline'>Don't have an account?</p><a class="links" href="signup.html">&nbspSign up</a>
        
          </form>
    </div>
  </section>
</body>
</html>