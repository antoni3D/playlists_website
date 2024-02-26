<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="accountStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <title>Spotify_generator_account</title>
    <style>
      @font-face {
          font-family: PixelFont;
          src: url(VT323-Regular.ttf);
      }
   </style>
</head>
<body style="background-color: #d4d0c8;">
<?php include 'database_conn.php';?>
    <!-- Header - najwyzszy blok (zawiera nagłówek oraz oraz elementy graficzne) -->
    <header id="header" class="colorChange">
        <img src="sunt.png" alt="slonce">
        <h1 style="color: white;">Search : </h1>
        <h2>Your Account</h2>
        <img src="starssprite.png" alt="" class="RightIcons" id="BlockerStars">
        <img src="max.png" alt="" class="RightIcons">
        <img src="min.png" alt="" class="RightIcons">
        <img src="cross.png" alt="" class="RightIcons">
    </header>

    <!-- Toolbar - blok nad głównym polem (zawiera odnośniki to innych pod-stron ) -->
    <section id="toolbar">
      <button onclick = "window.location.href='Main.php';">main</button>
      <button onclick = "window.location.href='Account.php';">account</button> 
      <button onclick = "window.location.href='Create.php';">create</button> 
      <button onclick = "window.location.href='Saved.php';">saved</button>
      <button onclick = "window.location.href='Help.php';">help</button>  
  </section>

    <!-- Main - główne pole (zawiera lewy oraz prawy pasek) -->
    <main>
      <div class="container h-100" style="font-family: PixelFont;" >
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-lg-12 col-xl-11">
            <div class="card text-black" style="border-radius: 25px; background-color: #8F8DD4; border: none;">
              <div class="card-body p-md-5">
                <div class="row justify-content-center">
                  <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Login</p>
                    <form class="mx-1 mx-md-4" action="Account.php" method="post">
                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input type="email" id="form3Example3c" class="form-control" name="email" required=""/>
                          <label class="form-label" for="form3Example3c">Your Email</label>
                        </div>
                      </div>
                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input type="password" id="form3Example4c" class="form-control" name="password" required="" />
                          <label class="form-label" for="form3Example4c">Password</label>
                        </div>
                      </div>
                      <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <input type="submit" class="btn btn-primary btn-lg" value="Login" name="login">
                      </div>
                      <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <button type="button" class="btn btn-primary btn-lg" onclick="window.location.href='CreateAccountForm.php';" style="color: white;">Sign up</button>
                      </div>
                    </form>
                    <?php
      if(isset($_POST['login']))
      {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql=$conn->prepare("SELECT * FROM user where email like :email AND password like :password;");
        $sql->bindValue(':email', $email, PDO::PARAM_STR);
        $sql->bindValue(':password', $password, PDO::PARAM_STR);
        $sql->execute();

        $row  = $sql -> fetch();

        

        if(is_array($row))
        {
          $_SESSION["email"] = $row['email'];
          $_SESSION["password"] = $row['password'];
          $_SESSION["id"] = $row['id'];
          $_SESSION["logged"] = TRUE;
          $_SESSION["role"] = $row['role'];
          $_SESSION["name"] = $row['name'];
          echo "zalogowano - ";
          echo '<a href="Main.php">Go back to Main page</a>';

        }
        else {
          echo "<script>alert('zle dane'); </script>";

        }
      }
    ?>
                  </div>
                  <div class="col-md-10 col-lg-6 col-xl-5 d-flex align-items-center order-1 order-lg-2">
                    <img src="background2.png"
                      class="img-fluid" alt="Sample image" style="border-radius: 20px;">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>  
    </main>
</body>
</html>