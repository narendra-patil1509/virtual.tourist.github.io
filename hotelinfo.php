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
                      $sql = "SELECT * FROM `hotels`";
                      $result = mysqli_query($conn,$sql);
                      while($row = mysqli_fetch_array($result)){
                        $hid = $row['hotel_id'];
                        $hn = $row['hotel_name'];
                        $desp = $row['hotel_desp'];
                        $hotel_add = $row['hotel_add'];
                        $hotel_loc = $row['hotel_loc'];
                        $h_rating = $row['hotel_rating'];
                        $contact = $row['hotel_contact'];
                        $facility = $row['hotel_facility'];
                            // $p_img = $row['pic'];
                            $h_pic ='<img style="border-radius: 2%; width:100%" src="data:image/jpeg;base64,'.base64_encode( $row['hotel_pic'] ).'"/>';
                            for($row=1;$row<2;$row++){
                                if($id==$hid){
                                    echo'
                                    <div class="p-5 mb-4 bg-light rounded-3">
                                        <div class="container-fluid py-5">'. $h_pic.
                                            '<img src="#" class="img-fluid"alt="">
                                            <h1 class="display-5 fw-bold">'.$hn.'</h1>
                                            <p class="col-md-8 fs-4">'.$desp.'</p>
                                            <br>
                                            <h5 class="col-md-8 fs-4">Address :-</h5>
                                            <p class="col-md-8 fs-4"><a class="text-decoration-none"href="'.$hotel_loc.'">'.$hotel_add.'</a></p>
                                            <br>
                                            <h5 class="col-md-8 fs-4">Contact :-</h5>
                                            <p class="col-md-8 fs-4">'.$contact.'</p>
                                            <br>
                                            <h5 class="col-md-8 fs-4">Facility :-</h5>
                                            <p class="col-md-8 fs-4">'.$facility.'</p>
                                            <!-- <button class="btn btn-primary btn-lg" type="button">Example button</button> -->
                                        </div>
                                    </div>';
                                }
                            }
                        }
            ?> 
        </div>
    </section>
    <?php include 'partial/footer.php';?>
</body>
</html>