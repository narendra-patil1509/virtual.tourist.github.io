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
    <div class="container my-3" id="maincontainer">
        <h1 class="py-3">Search results for <em>"<?php echo $_GET['search']?>"</em></h1>
        <?php
        $noresults = true;
        $query =$_GET['search'];
        $sql = "SELECT * FROM `places` WHERE `place_name` LIKE '%$query%'";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $title = $row['place_name'];
            $desc = $row['bigdesp'];
            $plac_id = $row['place_id'];
            $url = "info.php?id=".$plac_id;
            $noresults = false;

            // Display the search result
            echo '<div class="result">
                    <h3><a href="'.$url.'" class="text-dark text-decoration-none">'.$title.'</a></h1>
                    <p>'.$desc.'</p>
                </div>';    
        }
        if($noresults){
            echo '<div class="jumbotron jumbotron-fluid pt-5 pb-5">
            <div class="container">
            <p class="display-4">No Results Found</p>
                <p class="lead">Suggestions:<ul>
                    <li>Make sure that all words are spelled correctly.</li>
                    <li>Try different keywords.</li>
                    <li>Try more general keywords.</li></ul>
                </p>
            </div>
        </div>';
        }
    ?>
    </div>
    </section>
    <?php include 'partial/footer.php';?>
</body>
</html>