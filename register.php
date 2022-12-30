<?php

include 'config.php';

session_start();


if (isset($_POST['register'])) {
    $name = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    if($password != $confirm_password){
        echo "<script>alert('Password dengan Confirm Password berbeda!')</script>";
        header("Location: register.php");
    }

    $sql="INSERT INTO user (name, email, password) VALUES ('$name', '$email','$password')";
    if (mysqli_query($db, $sql)) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
    <title>REGISTER</title>
</head>
<body>
    <div>
        <div class='flex h-screen'>
            <div class='w-1/2 bg-primary'>
                <div class='w-center h-4/6 mt-8'>
                    <img src=SaYourss.png alt="" />
                </div>
            </div>
            <div class='w-1/2 bg-primary'>
                <form action="" method="post">
                    <div class='flex h-full'>
                        <div class='w-center mx-16 my-4 py-28 px-24 bg-violet-100/10 rounded-lg'>
                            <div class='w-center p-10 '>
                                <div>
                                <p class='w-center text-center text-4xl underline underline-offset-2 text-white font-Montserrat'>
                                    Register
                                </p>
                                <p class='w-center m-2 text-center text-sm text-white '>
                                    SaYours Account
                                </p>
                                </div>
                                <div class='w-center'>
                                    <input name="name" type="text" class='px-10 text-center bg-violet-100/10 rounded-lg m-2 text-white' placeholder='Name' />
                                </div>
                                <div>
                                    <input name="email" type="text" class='px-10 text-center bg-violet-100/10 rounded-lg m-2 text-white' placeholder='Email Address' />
                                </div>
                                <div>
                                    <input name="password" type="password" class='px-10 text-center bg-violet-100/10 rounded-lg m-2 text-white' placeholder='Password' />
                                </div>
                                <div>
                                    <input name="confirm_password" type="password" class='px-10 text-center bg-violet-100/10 rounded-lg m-2 text-white' placeholder='Confirmation Password' />
                                </div>
                                <div class='w-center mt-8 '>
                                    <button name="register" class='mx-12 px-8 w-2/3 bg-fuchsia-900 text-white px-5 py-1 rounded bold p-10'>Register</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
        </div>
            </div>
            
    </div>
</body>
</html>