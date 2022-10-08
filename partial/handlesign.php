<?php
// if($_SERVER["REQUEST_METHOD"] == "POST"){
//     $showAlert=false;
//     include 'db_connect.php';
//     $useremail= $_POST['signupEmail'];
//     $pass= $_POST['signupPassword'];
//     $cpass= $_POST['signupcPassword'];
//     $exists=false;
//     if(($pass==$cpass) && $exists==false){
//         $sql="INSERT INTO `usert` (`tname`, `tpass`, `dt`) VALUES ('$useremail', '$pass', current_timestamp());"
//         $result= mysqli_query($conn,$sql);
//         if($result){
//             $showAlert=true;
//             echo 'Osm';
//         }
//     }

    //check whether this email exists
//     $Sql = "SELECT * FROM `useracc` WHERE username = '$useremail'";
//     $result = mysqli_query($conn,$existSql);
//     $numRows = mysqli_num_rows($result);
//     if($numRows>0){
//         $showError = "Email already exists";
//     }
//     else{
//         if($pass == $cpass){
//             $hash = password_hash($pass, PASSWORD_DEFAULT);
//             $sql = "INSERT INTO `useracc` (`username`, `password`, `created`) VALUES (' $useremail', '$hash', current_timestamp())";
//             $result = mysqli_query($conn,$sql);
//             echo $result;
//             if($result){
//                 $showAlert = true;
//                 header("Location: /A BE PROJECT/index.php?signupsuccess=true");
//                 exit();
//             }

//         }
//         else{
//             $showError ="Password do not match";

//         }
//     }
//     header("Location: /A BE PROJECT/index.php?signupsuccess=false&error=$showError");
// }
?>

<?php//new coded
// if($_SERVER["REQUEST_METHOD"] == "POST"){
//     $show=false;
//     $err=false;
//     include 'partial/db_connect.php';
//     $useremail= $_POST['signupEmail'];
//     $pass= $_POST['signupPassword'];
//     $cpass= $_POST['signupcPassword'];
//     // $exists=false;

//     //Check whether this username Exists
//     $existSql= "SELECT * FROM `usert` WHERE tname='$useremail'";
//     $result=mysqli_query($conn,$existSql);
//     $numExistRows=mysqli_num_rows($result);
//     if($numExistRows>0){
//         // $exists=true;
//         $err="Username already exists";
//     }
//     else{
//         // $exists=false;
//         if(($pass==$cpass)){
//             $sql="INSERT INTO `usert` (`tname`, `tpass`, `dt`) VALUES ('$useremail', '$pass', current_timestamp());";
//             $result= mysqli_query($conn,$sql);
//             if($result){
//                 $show=true;
//             }
//         }
//         else{
//             $err="Password do not match";
//         }
//     }
// }
?>