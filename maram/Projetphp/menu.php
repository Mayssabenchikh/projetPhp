<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Fixed Navbar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style>
    body {
      padding-top: 50px;
    }

    .carousel .fill {
      height: 100vh;
      background-size: cover;
      background-position: center;
    }

    .form-control {
      width: 100%;
      max-width: 350px;
    }

    .navbar {
      padding: 10px 15px;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">EVENTY</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="home.php">Home</a></li>
      <li><a href="#">Events</a></li>
    </ul>

    <form method="GET" action="search.php" class="navbar-form navbar-left">
        <div class="form-group">
            <input type="text" name="category" class="form-control" placeholder="Catégorie (ex : Musique)">
        </div>
        <div class="form-group">
            <input type="text" name="location" class="form-control" placeholder="Lieu (ex : Paris)">
        </div>
        <div class="form-group">
            <input type="datetime-local" name="event_date" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </form>

    <ul class="nav navbar-nav navbar-right">
      <li><a href="loog.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="user.php"><span class="glyphicon glyphicon-log-in"></span> Log out</a></li>
    </ul>
  </div>
</nav>
