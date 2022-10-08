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
    <section class="bg-light p-3">
        <div class="container">
        <div class="row">

        <?php 
                      $sql = "SELECT * FROM `places`";
                      $result = mysqli_query($conn,$sql);
                      while($row = mysqli_fetch_array($result)){
                        //   echo $row['hotel_id'];
                        //   echo $row['hotel_name'];
                        $p_id = $row['place_id'];
                        $pn = $row['place_name'];
                        $p_desp = $row['bigdesp'];
                        //$p_img = $row['pic'];
                        // $loc = $row['place_loc'];
                        $p_img= '<img style="border-radius: 2%; height:70%; width:100%" src="data:image/jpeg;base64,'.base64_encode( $row['pic'] ).'"/>';
                        echo'
                        <div class="col-md-3 py-2">
                            <div class="card" style="width: 18rem;">';
                                   echo $p_img;
                                   echo'<div class="card-body">
                                    <p class="card-text text-center"><a class="text-decoration-none"href="info.php?id='.$p_id.'">'.$pn.'</a></p>
                                    <p class="text-center"></p>
                                </div>
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