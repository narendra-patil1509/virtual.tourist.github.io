<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location:login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions</title>
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
    <section class="p-3">
        <div class="container">
            <?php
                     $id=$_GET['questionid'];
                     $sql="SELECT * FROM `ques` WHERE q_id=$id";
                     $result=mysqli_query($conn,$sql);
                      while($row = mysqli_fetch_assoc($result)){
                            $id=$row['q_id'];
                            $q_title=$row['q_title'];
                            $q_desp=$row['q_desc'];

                            ///For posted only
                            $q_user_id=$row['q_user_id'];
                            $sql2="SELECT tname FROM `usert` WHERE sno=' $q_user_id'";
                            $result2=mysqli_query($conn,$sql2);
                            $row2=mysqli_fetch_assoc($result2);
                            ///end fo posted only
                            echo'<div class="p-5 mb-4 bg-light rounded-3">
                                    <h1 class="display-4">'.$q_title.'</h1>
                                    <p class="lead">'.$q_desp.'</p>
                                    <hr class="my-4">
                                    <p><b>Posted by:'.$row2['tname'].'</b></p>
                                 </div>';
                        }
            ?>
            <?php $method=$_SERVER['REQUEST_METHOD'];
            $showalert=false;
            if($method=='POST'){
               $cmnt=$_POST['cmnt'];
               $sno=$_POST['sno'];
               $sql="INSERT INTO `cmnts` (`c_content`, `q_id`, `c_by`, `c_time`) VALUES ( '$cmnt', '$id', '$sno', current_timestamp())";
               $resul=mysqli_query($conn,$sql);
               $showalert=true;
               if($showalert){
                   echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                            <strong>Success!</strong> Your comment has been added! Please wait for community to respond.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                   ';
               }

            }
            ?>
            <!-- $sql="INSERT INTO `cmnts` (`c_id`, `c_content`, `q_id`, `c_by`, `c_time`) VALUES (NULL, '$cmnt', '$id', '0', current_timestamp())"; -->
            <?php
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            echo'
            <div class="container">
                <h1 class="py-2">Post Comment</h1>
                <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
                    <div class="form-group">
                        <label for="">Type your comment</label>
                        <textarea class="form-control" name="cmnt" id="cmnt" rows="3"></textarea>
                        <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
                    </div>
                    <button type="submit" class="btn btn-primary mt-1">Post Comment</button>
                </form>
            </div>';
            }
            else{
                echo'<div class="container">
                        <h1 class="py-2">Post Comment</h1>
                        <p class="lead">You are not logged in. Please login to be able to post comment.</p>
                    </div>';
            }
            ?>
            <div class="container my-4 mb-5" id="ques">
             <h1 class="py-2">Browse Questions</h1>
            <?php
            $id=$_GET['questionid'];
            $sql="SELECT * FROM `cmnts` WHERE q_id=$id";
            $result=mysqli_query($conn,$sql);
            $noresult=true;
            while($row=mysqli_fetch_assoc($result)){
                $noresult=false;
                $id=$row['c_id'];
                $content=$row['c_content'];
                $q_user_id=$row['c_by'];
                $time=$row['c_time'];
                $sql2="SELECT tname FROM `usert` WHERE sno=' $q_user_id'";
                $result2=mysqli_query($conn,$sql2);
                $row2=mysqli_fetch_assoc($result2);
                // $q_desp=$row['c_desc'];
                echo'
                    <div class="media my-3 d-flex ">
                            <div class="p-1 ">
                                <h5 class="mt-0">
                                    <img src="img/user.png" width="54px" class="mr-3" alt="...">
                                </h5>
                            </div>
                            <div class="p-1">
                               <b><div class="font-bold mt-8 pt-0 ">'.$row2['tname'].' at '.$time.' </div></b>
                               <p class="font-weight-bold- my-0">'.$content.'</p>
                            </div>
                    </div>';
            }
            if($noresult){
                echo'<div class="jumbotron jumbotron-fluid bg-light">
                         <div class="container">
                             <p class="display-4">No Question posted here<p>
                             <p class="lead">Be the first person to ask a question.</p>
                         </div>
                     </div>';
            }
            ?>
            </div>
        </div>
    </section>
    <?php include 'partial/footer.php';?>
</body>

</html>