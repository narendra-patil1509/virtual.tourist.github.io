<?php
$show=false;
$err=false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    include 'partial/db_connect.php';
    $useremail= $_POST['signupEmail'];
    $pass= $_POST['signupPassword'];
    $cpass= $_POST['signupcPassword'];
    // $exists=false;

    //Check whether this username Exists
    $existSql= "SELECT * FROM `usert` WHERE tname='$useremail'";
    $result=mysqli_query($conn,$existSql);
    $numExistRows=mysqli_num_rows($result);
    if($numExistRows>0){
        // $exists=true;
        $err="Username already exists";
    }
    else{
        // $exists=false;
        if(($pass==$cpass)){
            // $hash = password_hash($pass,PASSWORD_DEFAULT);
            $sql="INSERT INTO `usert` (`tname`, `tpass`, `dt`) VALUES ('$useremail', '$pass', current_timestamp());";
            $result= mysqli_query($conn,$sql);
            if($result){
                $show=true;
            }
        }
        else{
            $err="Password do not match";
        }
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
    <?php
    if($show){
        echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
               <strong>Success!</strong> You can now login.
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    if($err){
        echo'<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
               <strong>Error!</strong> '.$err.'.
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>';
    }
    ?>
    <div class="container">
        <h1 class="text-center">Signup to our Website</h1>
        <form action="/A BE Project/sign.php" method="post">
            <div class="mb-3">
                <label for="signupEmail" class="form-label">Username</label>
                <input type="text" class="form-control" id="signupEmail" name="signupEmail" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="signupPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="signupPassword" name="signupPassword">
            </div>
            <div class="mb-3">
                <label for="signupcPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="signupcPassword" name="signupcPassword">
            </div>
            <button type="submit" class="btn btn-primary">Signup</button>
        </form>
    </div>
    <?php include 'partial/footer.php';?>
</body>

</html>