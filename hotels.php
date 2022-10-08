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
            <div class="row justify-content-center">
                <div class="col-xl-6">

                    <!-- Fetch Hotels -->
                    <!-- Use a for loop to iterate through hotels -->
                    <?php 
                      $sql = "SELECT * FROM `hotels`";
                      $result = mysqli_query($conn,$sql);
                      while($row = mysqli_fetch_assoc($result)){
                        //   echo $row['hotel_id'];
                        //   echo $row['hotel_name'];
                        $id = $row['hotel_id'];
                        $hn = $row['hotel_name'];
                        $desp = $row['hotel_desp'];
                        $hotel_add = $row['hotel_add'];
                        $h_rating = $row['hotel_rating'];
                        $contact = $row['hotel_contact'];
                        $facility = $row['hotel_facility'];
                       // $h_pic = $row['hotel_pic'];
                        $h_pic ='<img style="border-radius: 2%; width:100%" src="data:image/jpeg;base64,'.base64_encode( $row['hotel_pic'] ).'"/>';
                        echo'<div class="card mb-3" style="max-width: 7400px;">
                        <div class="row mt-2 g-0">
                            <div class="col-md-4 mt-2 mb-2">';
                                echo $h_pic;
                                echo'
                            </div>
                            <div class="col-md-8 mt-3">
                                <div class="card-body mb-3 py-0">
                                    <h5 class="card-title pl-2 mt-0"><a class="text-decoration-none"href="hotelinfo.php?id='.$id.'">'.$hn.'</a></h5>
                                    <p class= "mt-3  "style="font-size:21px"><span><i class="material-icons" style="font-size:25px">place</i></span>'.$hotel_add.'</p>
                                    <span class="badge bg-success">24x7 Available</span>
                                    <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                                </div>
                            </div>
                        </div>
                    </div>';
                      }
                     ?>
                </div>
    </section>
    <?php include 'partial/footer.php';?>
</body>

</html>