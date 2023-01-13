<?php

include 'config.php';

session_start(); 

$username = $_SESSION['username'];
$sql ="SELECT * FROM user WHERE username='$username'";
$result = mysqli_query($db, $sql);  
$row = mysqli_fetch_assoc($result);
$id = $row['userID'];
if($row['photo_profile'] == null){
  $fotop= '<img src=fotoprof.png alt="" />';
}else{
  $fotop=$row['photo_profile'];
}
if(isset($_POST['simpan'])){
  $username_updt= $_POST['username'];
  $name_updt= $_POST['nama'];
  $bio_updt= $_POST['bio'];
  $email_updt= $_POST['email'];
  $nohp_updt= $_POST['phoneNum'];
  $tgl_updt= $_POST['tgl'];
  $gender_updt=$_POST['kelamin'];
  $alamat_updt=$_POST['alamat'];
  $query = "UPDATE user SET name='$name_updt', phone_number='$nohp_updt', birthdate='$tgl_updt', email='$email_updt', username='$username_updt', bio='$bio_updt',gender='$gender_updt',address='$alamat_updt' WHERE userID='$id'";
  $result= mysqli_query($db,$query);
  if($result == true){
    $_SESSION["username"] = $_POST['username'];
  }
  header("location:editprofile.php");
}

if(isset($_POST['delete'])){
  $query2 = "DELETE FROM user WHERE userID='$id'";
  mysqli_query($db,$query2);
  header("location:login.php");
}
if(isset($_POST['back'])){
  header("location:dashboard.php");
}

// if(isset($_POST['upload'])){
//   //nama gambar
//   $nama_gambar=$_FILES['foto']['name'];
//   //ukuran gambar
//   $ukuran_gambar = $_FILES['foto']['size']; 

//   $fileinfo = @getimagesize($_FILES["foto"]["tmp_name"]); 

//   //file gambar
//   $fotoprofile=addslashes(file_get_contents($_FILES['foto']['tmp_name']));
//   echo var_dump($fotoprofile);

//   if($ukuran_gambar > 819200){ 
//       echo 'Ukuran gambar melebihi 80kb';
//   }else{                    
//     $sql_l=mysqli_query($db,"INSERT INTO user(photo_profile) VALUES '$fotoprofile'");
//     if ($sql_l) {
//       echo 'Simpan data berhasil';
//     }else {
//       echo 'Simpan data gagal';
//     }
//   } 
  // $rand = rand();
  // $ekstensi =  array('png','jpg','jpeg','gif');
  // $filename = $_FILES['foto']['name'];
  // $ukuran = $_FILES['foto']['size'];
  // $ext = pathinfo($filename, PATHINFO_EXTENSION);
  
  // if(!in_array($ext,$ekstensi) ) {
  //   header("location:editprofile.php?alert=gagal_ekstensi");
  // }else{
  //   if($ukuran < 1044070){		
  //     $fotoo = $rand.'_'.$filename;
  //     move_uploaded_file($_FILES['foto']['tmp_name'], 'gambar/'.$rand.'_'.$filename);
  //     $query3= "INSERT INTO user (photo_profile) VALUES $fotoo";
  //     if(mysqli_query($db,$query3)){
  //       header("location:editprofile.php?alert=berhasil");
  //     }else{
  //       echo"'gagal!'";
  //       header("location:editprofile.php?");
  //     }
      
  //   }else{
  //     header("location:editprofile.php?alert=gagal_ukuran");
  //   }
  // }
// }

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
    <title>EDIT PROFILE</title>
</head>
<body>
  <div>
    <form action="" method="post">
      <div class='flex bg-purple-900 py-1 h-16'>
        <button name='back'>
          <img src=SaYourss.png class='w-32 h-18 mx-4' alt="" />
        </button>
      </div>
      <div class='flex bg-primary h-screen'>
        <div class="grid grid-cols-3 gap-5 mt-5 px-10">
          <div class='w-[28rem] h-[34rem] bg-gray-300 rounded-xl bg-cover bg-center relative'>
            <div class='flex m-4 place-content-center h-1/2'>
              <?php echo $fotop;?>
            </div>
            <div class='flex place-content-center text-4xl font-Montserrat m-6 font-bold'>
              <?php echo  $_SESSION['username']?>
            </div>
            <div>
              <div class='absolute bottom-0 px-1 bg-gray-400 items-center text-center rounded-xl'>
                <button name='delete' class='absolute bottom-14 left-48 items-center text-center text-red-500' >Delete Account</button>
              </div>
            </div>
          </div>
      </form>
        <form action="" method="post">
          <div class='w-[60rem] h-[34rem] bg-gray-300 rounded-xl bg-cover bg-center relative'>
            <div class='text-2xl font-bold font-Montserrat p-10'>
              Biodata Diri
            </div>
            <div class="grid grid-cols-2 gap-4">
              <div class='flex flex-col justify-center items-center'>
                <div class='w-[8rem] h-[8rem] m-4' ><?php echo $fotop;?></div>
                <div class='font-bold text-black text-xl'>Ubah Foto Profile</div>
                <form action="" method="post" enctype="multipart/form-data">
                  <input name="foto" type="file" id="foto" class='px-10 text-center bg-gray-100 rounded-2xl mt-10 p-3'>
                  <input name="upload" type="submit" value="Upload" class='px-10 text-center bg-fuchsia-900/80 text-white rounded-2xl mt-3 '> 
                </form>
              </div>
              <div class='flex flex-col gap-4 justify-start items-start'>
                <div>
                  <div class='font-bold text-black text-xl'>Info Profil</div>
                  <div class='grid grid-cols-2 gap-5'>
                    <div>
                      <div class='font-normal text-black text-l mt-2'>Nama</div>
                      <div class='font-normal text-black text-l mt-2'>Username</div>
                      <div class='font-normal text-black text-l mt-2'>Bio</div>
                    </div>
                    <div>
                      <input name='nama' type="text" class='text-center mt-2 bg-white-900 text-black rounded-xl' placeholder='<?php echo $row['name']?>' />
                      <input name='username' type="text" class='text-center mt-2 bg-white-900 text-black rounded-xl' placeholder='<?php echo $row['username']?>' />
                      <input name='bio' type="text" class='text-center mt-2 bg-white-900 text-black placeholder-white-500 rounded-xl' placeholder='<?php echo $row['bio']?>' />
                    </div>
                  </div>
                </div>
                <div>
                  <div class='font-bold text-black text-xl'>Info Pribadi</div>
                  <div class='grid grid-cols-2 gap-5'>
                    <div>
                      <div class='font-normal text-black text-l mt-2'>User ID</div>
                      <div class='font-normal text-black text-l mt-2'>Email</div>
                      <div class='font-normal text-black text-l mt-2'>Nomor HP</div>
                      <div class='font-normal text-black text-l mt-2'>Jenis Kelamin(male/female)</div>
                      <div class='font-normal text-black text-l mt-2'>Tanggal Lahir</div>
                      <div class='font-normal text-black text-l mt-2'>Alamat</div>
                    </div>
                    <div>
                      <div class='font-normal text-black text-l mt-2'><?php echo $row['userID']?></div>
                      <input name='email' type="text" class='text-center mt-2 bg-white-900 text-black rounded-xl' placeholder='<?php echo $row['email']?>' />
                      <input name='phoneNum' type="text" class='text-center mt-2 bg-white-900 text-black rounded-xl' placeholder='<?php echo $row['phone_number']?>' />
                      <input name='kelamin' type="text" class='text-center mt-2 bg-white-900 text-black rounded-xl' placeholder='<?php echo $row['gender']?>'/>
                      <input name='tgl' type="text" class='text-center mt-2 bg-white-900 text-black rounded-xl' placeholder='<?php echo $row['birthdate']?>' />
                      <input name='alamat' type="text" class='text-center mt-2 bg-white-900 text-black rounded-xl' placeholder='<?php echo $row['address']?>' />
                    </div>
                  </div>
                </div>
              </div>
              <div class='flex flex-col gap-4 justify-center items-center'>
                <button name='simpan' href='homepage' class='items-center w-30 bg-fuchsia-900 text-white text-center px-5 py-1 rounded-2xl p-10'>Simpan</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>