<?php

include 'config.php';

session_start();


if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
  $result = mysqli_query($db, $sql);
  if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $row['username'];
    header("Location: dashboard.php");
  } else {
    echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
  }
}

if (isset($_POST['sign_up'])){
  header("Location: register.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'primary': "#462A50",
          }
        }
      }
    }
  </script>
  <title>LOGIN</title>
</head>

<body>
  <div>
    <div class='flex h-screen'>
      <form action="" method="post" class='w-1/2 bg-primary'>
        <div class='w-center h-4/6 mt-8'>
          <img src=SaYourss.png alt="" />
        </div>
        <div class='h-14 text-center mt-20'>
          <button name="sign_up" href="" class='w-center text-center underline italic text-white'>Sign Up</button>
        </div>
      </form>
      <div class='w-1/2 bg-primary'>
        <div class='flex h-full'>
          <form action="" method="post" class='w-center m-auto px-24 py-32 bg-violet-100/10 rounded-lg'>
            <div class='divide-y p-10'>
              <div>
                <input name="email" type="text" class=' px-10 text-center bg-transparent text-white' placeholder='Email' />
              </div>
              <div>
                <input name="password" type="password" class='px-10 text-center bg-transparent text-white' placeholder='Password' />
              </div>
            </div>
            <div class='flex h-full w-center'>
              <div class= 'mt-8 px-12'>
                <button name="login" class='w-64 bg-fuchsia-900 text-white px-5 py-1 rounded bold p-10'>Login</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>