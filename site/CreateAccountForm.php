<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="informationStyle.css">
    <title>Spotify_generator_profile_edit</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
      <!-- Czcionka -->
     <style>
        @font-face {
            font-family: PixelFont;
            src: url(VT323-Regular.ttf);
        }
     </style>
</head>
<body>
<?php include 'database_conn.php';?>

<section class="vh-100" style="background-color: #8F8DD4; font-family: PixelFont;">
    <div class="container h-100" >
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
                  <form class="mx-1 mx-md-4" method="post">
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="text" id="form3Example1c" class="form-control" name="name"/>
                        <label class="form-label" for="form3Example1c">Your Name</label>
                      </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="email" id="form3Example3c" class="form-control" name="email" />
                        <label class="form-label" for="form3Example3c">Your Email</label>
                      </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="password" id="form3Example4c" class="form-control" name="password"/>
                        <label class="form-label" for="form3Example4c">Password</label>
                      </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="password" id="form3Example4cd" class="form-control" name="conf_password" />
                        <label class="form-label" for="form3Example4cd">Repeat your password</label>
                      </div>
                    </div>
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <input type="submit" class="btn btn-primary btn-lg" value ="register" name="submit">
                    </div>
                  </form>
                  <a href="Account.php">Go back to Login page</a>
                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                  <img src="background.png"
                    class="img-fluid" alt="Sample image">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php
  if(isset($_POST["submit"]))
  {
    $name = $_POST["name"];
    $email = $_POST["email"];  
    $password = $_POST["password"];
    $confpass = $_POST["conf_password"];

    $if_exists = $conn->prepare("SELECT * FROM user where email like :email OR name like :name");
    $if_exists->bindValue(':email', $email, PDO::PARAM_STR);
    $if_exists->bindValue(':name', $name, PDO::PARAM_STR);
    $if_exists->execute();
    $row = $if_exists->fetch(PDO::FETCH_ASSOC);

    if($row)
        {
          echo "<script>alert('User exists'); </script>";
        }
      else{
        if($password == $confpass)
        {
          $sql = $conn->prepare("INSERT INTO user (name,email,password,role) VALUES (:name,:email,:password,1)");
          $sql->bindValue(':name', $name, PDO::PARAM_STR);
          $sql->bindValue(':email', $email, PDO::PARAM_STR);
          $sql->bindValue(':password', $password, PDO::PARAM_STR);

          $sql->execute();

          echo "<script>alert('User created'); </script>";

        }
        else{
          echo "<script>alert('Passwords dont match'); </script>";
        }
      }
  }
  ?>
</body>
</html>