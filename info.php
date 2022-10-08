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
    <title>Hotel</title>
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
                      $id=$_GET['id'];
                      $sql = "SELECT * FROM `places`";
                      $result = mysqli_query($conn,$sql);
                      while($row = mysqli_fetch_array($result)){
                            $pid = $row['place_id'];
                            $pn = $row['place_name'];
                            $p_desp = $row['bigdesp'];
                            $p_reach = $row['place_reach'];
                            $p_mode = $row['place_mode'];
                            // $p_img = $row['pic'];
                            $p_img= '<img style="border-radius: 2%; width:25%" src="data:image/jpeg;base64,'.base64_encode( $row['pic'] ).'"/>';
                            for($row=1;$row<2;$row++){
                                if($id==$pid){
                                    echo'
                                    <div class="p-5 mb-4 bg-light rounded-3">
                                        <div class="container-fluid py-5">'. $p_img.
                                            '<img src="#" class="img-fluid"alt="">
                                            <h1 class="display-5 fw-bold">'.$pn.'</h1>
                                            <p class="col-md-8 fs-4">'.$p_desp.'</p>
                                            <br>
                                            <h5 class="col-md-8 fs-4">How to reach :-</h5>
                                            <p class="col-md-8 fs-4">'.$p_reach.'</p>
                                            <br>
                                            <h5 class="col-md-8 fs-4">Mode of Transport :-</h5>
                                            <p class="col-md-8 fs-4">'.$p_mode.'</p>
                                            <!-- <button class="btn btn-primary btn-lg" type="button">Example button</button> -->
                                        </div>
                                    </div>';
                                }
                            }
                        }
            ?>
            <?php $method=$_SERVER['REQUEST_METHOD'];
            $showalert=false;
            if($method=='POST'){
                $q_ttl=$_POST['ttl'];
                $q_discuss=$_POST['discuss'];
                $sno=$_POST['sno'];
                
               // $sql="INSERT INTO `ques` (`q_title`, `q_desc`, `q_place_id`) VALUES ('$q_ttl', '$q_discuss','$id' current_timestamp())";
                
               $sql="INSERT INTO `ques` ( `q_title`, `q_desc`, `q_place_id`, `q_user_id`, `timestamp`) VALUES ( '$q_ttl', '$q_discuss', '$id', '$sno', current_timestamp())";
               $resul=mysqli_query($conn,$sql);
               $showalert=true;
               if($showalert){
                   echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                            <strong>Success!</strong> Your question has been added! Please wait for community to respond.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                   ';
               }

            }
            ?>
            <?php
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            echo'
            <div class="container">
                <h1 class="py-2">Start Discussion</h1>
                <form action="'. $_SERVER["REQUEST_URI"].'" method="post">
                    <div class="form-group">
                        <label for="">Problem Title</label>
                        <input type="text" class="form-control" name="ttl" id="ttl" rows="3">
                    </div>
                    <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
                    <div class="form-group">
                        <label for="">Elaborate your concern</label>
                        <textarea class="form-control" name="discuss" id="discuss" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-1">Submit</button>
                </form>
            </div>';}
            else{
                echo '<div class="container">
                          <h1 class="py-2">Start Discussion</h1>
                          <p class="lead">You are not logged in. Please login to be able to start a Discussion </p>
                      </div>';
            }
            ?>
            
            <div class="container my-4 mb-5" id="ques">
                <h1 class="py-2">Browse Questions</h1>
                <?php
                $id=$_GET['id'];
                $sql="SELECT * FROM `ques` WHERE q_place_id=$id";
                $result=mysqli_query($conn,$sql);
                $noresult=true;
                while($row=mysqli_fetch_assoc($result)){
                    $noresult=false;
                    $id=$row['q_id'];
                    $q_title=$row['q_title'];
                    $q_desp=$row['q_desc'];
                    $q_usert_id=$row['q_user_id'];
                    $time=$row['timestamp'];
                    $sql2="SELECT tname FROM `usert` WHERE sno= '$q_usert_id'";
                    $result2=mysqli_query($conn,$sql2);
                    $row2=mysqli_fetch_assoc($result2);
                    echo'
                        <div class="media my-3 d-flex  bd-highlight mb-3">
                        <div class="p-1  ">
                            <img src="img/user.png" width="54px" class="mr-3" alt="...">
                        </div> 
                        <div class="p-2 pt-0">
                            <h5 class="mt-0"><a class="text-dark text-decoration-none"href="ques.php?questionid='.$id.'">'.$q_title.'</a></h5>
                            <p class="font-bold">'.$q_desp.'</p>
                        </div>
                        <b class="ms-auto p-2 bd-highlight"><div class=" font-bold mt-8 pt-0 ">Asked by:'.$row2['tname'].' at '.$time.' </div></b>
                        </div>';
                }
                //    echo var_dump($noresult);
                    if($noresult){
                        echo'<div class="jumbotron jumbotron-fluid bg-light">
                                    <div class="container">
                                        <p class="display-4">No Question posted here<p>
                                        <p class="lead">Be the first person to ask a question.</p>
                                    </div>
                            </div>';
                    }?>
            </div>
            
        </div>
    </section>
    <?php include 'partial/footer.php';?>
</body>

</html>