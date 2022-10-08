<?php
$login=false;
$showerr=false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    include 'partial/db_connect.php';
    $user= $_POST["loginEmail"];
    $pass= $_POST["loginPassword"];
    // $sql="Select * from usert tname='$user' AND tpass='$pass'";
    $sql="SELECT sno FROM usert WHERE tname = '$user' AND tpass='$pass'";
    $result= mysqli_query($conn,$sql);
    $num= mysqli_num_rows($result);
    if($num ==1){
        $row=mysqli_fetch_assoc($result);
                $login = true;
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['sno']=$row['sno'];;
                $_SESSION['tname']=$user;
                header("location:index.php");
    }
    else{
        $showerr="Invalid Credentials";
        // $showerr=true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</head>

<body>
    <?php include 'partial/heading.php'; ?>
    <?php include 'partial/db_connect.php'; ?>
    <?php
    if($login){
        echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
               <strong>Success!</strong> You are logged in.
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    if($showerr){
        echo'<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
               <strong>Failed!</strong> '.$showerr.'.
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>';
    }
    ?>
    <div class="container">
        <h1 class="text-center">Login</h1>
        <form action="/A BE Project/login.php" method="post">
            <div class="mb-3">
                <label for="loginEmail" class="form-label">Username</label>
                <input type="text" class="form-control" id="loginEmail" name="loginEmail" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="loginPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="loginPassword" name="loginPassword">
            </div>
           
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    <?php include 'partial/footer.php';?>
</body>

</html>