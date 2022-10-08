<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location:login.php");
    exit;
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Tourism -<?php $_SESSION['tname']?></title>
</head>

<body>
    <?php include 'partial/heading.php'; ?>
    <?php include 'partial/db_connect.php'; ?>
    <!-- <?php echo $_SESSION['sno'];?> -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./img/aj1.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption text-left animated zoomIn delay-1s">
                    <h5 class="display-4">Looking for your favorite destination in Jalgaon?</h5>
                    <p class="lead">Pack your bags and get ready to explore the beauty of Banana city.. we are here to give u the best experience</p>
                    <button class="btn btn-primary">Read more</button>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./img/aj2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./img/aj3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- temp
    <div class="d-flex bd-highlight">
        <div class="p-2 w-100 bd-highlight">
        <section class="bg-primary p-1 " style="width:85%;">
        <div class="container mr-0 ml-0 ">
            <div class="row text-center">
                <div class="col">
                    <h5 class="display-4">
                        <span class="text-teal">Popular</span> Places
                    </h5>
                    <p class="lead">Here are some popular places listed below and information regarding click on the picture.</p>
                </div>
            </div>
            <div class="row">
                <?php
                  $sql = "SELECT * FROM `places`ORDER BY place_id ASC LIMIT 3";
                  $result = mysqli_query($conn,$sql);
                  while($row = mysqli_fetch_array($result)){
                    $pid = $row['place_id'];
                        $pn = $row['place_name'];
                        $p_desp = $row['bigdesp'];
                        $loc = $row['place_loc'];
                        // $p_img = $row['pic'];
                        $p_img= '<img style="border-radius: 2%; width:100%" src="data:image/jpeg;base64,'.base64_encode( $row['pic'] ).'"/>';
                        // <img src="./img/las vegas.jpg" class="img-fluid"alt="">
                        for($row=1;$row<2;$row++){
                        echo'
                            <div class="col-md-4">
                                <div class="card">';echo
                                   $p_img;echo'
                                    <div class="card-body">
                                        <h3 class="card-title">
                                        '.$pn.',Jalgaon
                                        </h3>
                                        <p class="card-text">'.$loc.'</p>
                                        <button class="btn btn-dark btn-sm "><a class="text-decoration-none text-light"href="info.php?id='.$pid.'">Read More </a></button>
                                    </div>
                                </div>
                            </div>';
                        }
                    }
                ?>
            </div>
        </div>
    </section>
        </div>
        <div class="p-2 flex-shrink-1 bd-highlight"><h6>
            <p>Welcome to Virtual Tourist Giude. Here we are for u to help you during your journey an make u feel safe and happy. we will be guiding you through all the major places in Jalgaon including the common. and the rarest places.</p>
        </h6></div>
    </div> -->
    <!-- temp -->
    <!-- Popular Places -->
    <section class="bg-Primary p-3">
        <div class="container ">
        <div class="row text-center">
                <div class="col">
                    <h5 class="display-4">
                        <span class="text-teal">Virtual Tourist Guide</span> 
                    </h5>
                    <p class="lead">Welcome to Virtual Tourist Giude. Here we are for u to help you during your journey an make u feel safe and happy. we will be guiding you through all the major places in Jalgaon including the common. and the rarest places..</p>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-Primary p-3">
        <div class="container ">
            <div class="row text-center">
                <div class="col">
                    <h5 class="display-4">
                        <span class="text-teal">Popular</span> Places
                    </h5>
                    <p class="lead">Pack your bags and get ready to explore the beauty of Banana city.. we are here to give u the best experience.</p>
                </div>
            </div>
            <div class="row">
                <?php
                  $sql = "SELECT * FROM `places`ORDER BY place_id ASC LIMIT 3";
                  $result = mysqli_query($conn,$sql);
                  while($row = mysqli_fetch_array($result)){
                    $pid = $row['place_id'];
                        $pn = $row['place_name'];
                        $p_desp = $row['bigdesp'];
                        $loc = $row['place_loc'];
                        // $p_img = $row['pic'];
                        $p_img= '<img style="border-radius: 2%; width:100%" src="data:image/jpeg;base64,'.base64_encode( $row['pic'] ).'"/>';
                        // <img src="./img/las vegas.jpg" class="img-fluid"alt="">
                        for($row=1;$row<2;$row++){
                        echo'
                            <div class="col-md-4">
                                <div class="card">';echo
                                   $p_img;echo'
                                    <div class="card-body">
                                        <h3 class="card-title">
                                        '.$pn.',Jalgaon
                                        </h3>
                                        <p class="card-text">'.$loc.'</p>
                                        <button class="btn btn-dark btn-sm "><a class="text-decoration-none text-light"href="info.php?id='.$pid.'">Read More </a></button>
                                    </div>
                                </div>
                            </div>';
                        }
                    }
                ?>

            </div>
        </div>
    </section>

    </div>
    <?php include 'partial/footer.php';?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>