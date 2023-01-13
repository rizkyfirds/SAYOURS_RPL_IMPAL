<?php

include 'config.php';

session_start(); 
$arr=[];
$i=0;
$username = $_SESSION['username'];
$sql ="SELECT * FROM user WHERE username='$username'";
$result = mysqli_query($db, $sql);  
$row = mysqli_fetch_assoc($result);
if($row['photo_profile'] == null){
    $fotop= '<img src=fotoprof.png alt="" />';
}else{
    $fotop=$row['photo_profile'];
}
//var_dump($fotop);
if (isset($_POST['foto']) || isset($_POST['user'])){
    header("Location: editprofile.php");
}

if(isset($_POST['trnsc'])){
    // $_SESSION["strore_nama"] = $arr[1];
    header("Location: transaction.php");
    // echo $_SESSION["strore_nama"];
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
    <title>DASHBOARD</title>
</head>
<body>
   <div>
    <div class="">
        <div class="relative z-10">
            <div class='fixed w-full'>
                <form action="" method="post">
                    <div class="flex items-center justify-between bg-purple-900 py-1 h-20">
                        <div class='w-3/12'>
                            <img src=SaYourss.png class="w-3/6 mx-20" alt="" />
                        </div>
                        <div class='w-5/12'>
                            <input type="text" placeholder='lagi cari apa nih' class='w-full py-2 px-5 rounded-xl' />
                        </div>
                        <div class='w-4/12'>
                            <div class="flex m-4">
                                <div class="w-2/6 place-content-center m-3 ">
                                    <button name = "foto" class='w-16 m-auto'>
                                        <?php 
                                        // var_dump($fotop);die;
                                        echo $fotop;
                                        ?>
                                    </button>
                                </div>
                                <button name="user" class='w-3/6 m-auto h-center font-bold text-2xl text-white ml-12'>
                                    <?php echo  $_SESSION['username']?>
                                </button>
                                <div class='w-1/6 m-auto text-white ml-10'>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-10 h-10">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <?php
        $sqll = "SELECT * FROM store";
        $resultt = mysqli_query($db, $sqll);
        ?>
        <?php while ($row = mysqli_fetch_assoc($resultt)): ?>
            <div class='bg-primary px-10 py-5 space-y-10 pt-24'>
                <form action="" method="post">
                    <button name='trnsc' class='font-bold text-white text-2xl'>
                        <?= $row['strore_nama'];
                        $_SESSION["strore_nama"] = $row['store_id'];
                        // if($_POST['trnsc']==True){
                        //     $_SESSION["strore_nama"] = $row['store_id'];
                        // }
                        // $arr[$i] =$row['strore_nama'];
                        // echo $arr[$i];
                        // $i++;
                        ?>
                    </button>
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
            <?php endwhile;?>
            <!-- <?= $arr[0]; ?>
            <?= $arr[1]; ?>
            <?= $arr[2]; ?> -->
            
    </div> 
</body>