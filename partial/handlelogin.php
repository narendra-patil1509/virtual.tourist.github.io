<?php
// $showError = "false";
// if($_SERVER["REQUEST_METHOD"] == "POST"){
//     include 'db_connect.php';
//     $email = $_POST['loginEmail'];
//     $pass = $_POST['loginPass'];

//     $sql ="SELECT * FROM `useracc` WHERE username='$email'";
//     $result = mysqli_query($conn,$sql);
//     $numRows = mysqli_fetch_array($result);

//     $er = $numRows;
//     if($numRows==$er){
//       echo 'Hiii';
//       echo $email;
       
//         while($row = mysqli_fetch_assoc($result)){
          
//           if(password_verify($password, $row['password'])){
//             $login = true;
//             session_start();
//             $_SESSION['loggedin'] = true;
//             $_SESSION['loginEmail'] = $username;
//             //header("location:welcome.php");
//             echo 'yes';
//           }
//           else{
//            echo'No'; // $showError = " Invalid Credentials";
//           }
//         }
//     }
//     else{
//   echo'Nahi';  // $showError = " Invalid Credentials";
//     }
//     // header("Location: /A BE Project/index.php");
// }
?>
<?php
//New coded
// if($_SERVER["REQUEST_METHOD"] == "POST"){
//     $login=false;
//     $showerr=false;
//     include 'partial/db_connect.php';
//     $user= $_POST['loginEmail'];
//     $pass= $_POST['loginPassword'];
//     // $sql="Select * from usert tname='$user' AND tpass='$pass'";
//     $sql="SELECT sno FROM usert WHERE tname = '$user' and tpass = '$pass'";
//     $result= mysqli_query($conn,$sql);
//     $num= mysqli_num_rows($result);
//     if($num ==1){
//         $login = true;
//         session_start();
//         $_SESSION['loggedin']=true;
//         $_SESSION['tname']=$user;
//         header("location:index.php");
//     }
//     else{
//         $showerr="Invalid Credentials";
//         // $showerr=true;
//     }
// }
?>