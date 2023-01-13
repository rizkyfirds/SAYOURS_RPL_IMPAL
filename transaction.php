<?php 
include 'config.php';

session_start(); 

$store = $_SESSION["strore_nama"];
//var_dump($store);
if(isset($_POST['back'])){
    header("location:dashboard.php");
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
    <title>STORE</title>
</head>
<body>
    <div>
        <form action="" method="post">
        <div class='flex bg-purple-900 py-1 h-16'>
            <button name='back'>
                <img src=SaYourss.png class='w-32 h-18 mx-4' alt="" />
            </button>
        </div>
        </form>
        <?php
        $sqll = "SELECT * FROM store WHERE store_id='$store'";
        $resultt = mysqli_query($db, $sqll);
        ?>
        <?php $row = mysqli_fetch_assoc($resultt); ?>
            <div class='flex h-screen bg-primary px-10 py-5 space-y-10 pt-18'>
                <form action="" method="post">
                    <p class='font-bold text-white text-6xl'>
                        <?= $row['strore_nama']?>
                    </p>
                    <p class='font-bold text-white text-2xl m-8'>Bagi yang ingin pesan di toko ini, maka anda bisa menghubungi pada kontak di bawah ini</p>
                    <p class='font-bold text-white text-xl m-8'>
                        <?=$row['contact_person']?>
                    </p>
                    <div>
                        <div class="grid grid-cols-5 gap-4 mt-5 px-10">
                            <?php        
                            $sqlll = "SELECT * FROM product WHERE  store_id='".$row['store_id']."'";
                            $resulttt = mysqli_query($db, $sqlll);
                            ?>
                            <?php while ($row_product = mysqli_fetch_assoc($resulttt)): ?>
                                <div class='w-[15rem] h-[20rem] bg-gray-300 rounded-xl bg-cover bg-center relative'>
                                    <?php   echo '<img src="data:image/jpeg;base64,'.base64_encode($row_product['product_photo']).'"/>';?>
                                    <div class='absolute bottom-0 px-2 bg-gray-400 w-full h-20 text-center rounded-xl'>
                                    <p class='text-xl font-bold font-Montserrat'>
                                        <?php echo $row_product['product_name'] ?>
                                    </p>
                                    <p class='text-l font-Montserrat'>
                                        <?php echo $row_product['price'] ?>
                                    </p>
                                    </div>
                                </div>  
                            <?php endwhile;?>
                        </div>
                    </div>
                </form>
            </div>
            <?php ?>
    </div>
</body>
</html>