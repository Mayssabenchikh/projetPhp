<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Transparente</title>
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
</head >
<body>
    <header>
        <nav class="navbar">
            <div class="navbar-left">
                <div class="logo">
                    <a href="#">EVENTY</a>
                </div>
                <ul class="navs">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Events</a></li>
                </ul>
            </div>
            <ul class="nav-links">
                <li><a href="#">Login</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </nav>
      <form action="search.php" method="get">   
    <div class="search-bar">
    <div class="dropdown">
        <div id="drop-text" class="dropdown-text">
          <span id="span">Everything</span>
          <i id="icon" class="fa-solid fa-chevron-down"></i>
        </div>
        <ul id="list" class="dropdown-list">
          <li class="dropdown-list-item" name="category">Catégorie</li>
          <li class="dropdown-list-item" name="location">Lieu</li>
        </ul>
        
      </div>
     
      <div class="search-box">
        <input type="text" id="search-input" placeholder="Search anything..." />
        <input type="datetime-local" name="event_date">
        <button type="submit" class="fa-solid fa-magnifying-glass"></button>
        
      </div>
      
    </div></form>  
    </header>
    <script src="script.js"></script>

</body>
</html>
