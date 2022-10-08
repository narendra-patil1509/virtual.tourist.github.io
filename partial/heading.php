<?php 
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin=true;
}
else{
  $loggedin=false;
}
echo'<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="#">Tourism</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php"><button class="btn btn-outline-light" type="submit">Home</button></a>
      </li>';
      if($loggedin){
        echo'
      <li class="nav-item">
        <a class="nav-link" href="hotels.php"><button class="btn btn-outline-light" type="submit">Hotels</button></a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="places.php"><button class="btn btn-outline-light" type="submit">Places</button></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="destination.php"><button class="btn btn-outline-light" type="submit">Destination</button></a>
      </li>';}

      if(!$loggedin){
      echo'
      <li class="nav-item">
        <a class="nav-link" href="login.php"><button class="btn btn-success" type="submit">LOGIN</button></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="sign.php"><button class="btn btn-success" type="submit">SIGNUP</button></a>
      </li>';}

      if($loggedin){
      echo'
      <li class="nav-item">
        <a class="nav-link" href="logout.php"><button class="btn btn-success" type="submit">LOGOUT</button></a>
      </li>';}

      echo'
    </ul>
    <form class="d-flex" action="search.php">
      <input class="form-control me-2" name="search" type="search" placeholder="search" aria-label="Search">
      <button class="btn btn-outline-light" type="submit">Search</button>
    </form>
    <div class="mx-2">
        <button class=" rounded-circle btn btn-success" data-bs-toggle="modal" data-bs-target="">'.$_SESSION['tname'].'</button>
    </div>
    </ul>
  </div>
</div>
</nav>';

include 'partial/loginmdl.php';
include 'partial/signupmdl.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true"){
  echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> You can now login.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>