<?php
    require "requires/config.php";
    if ($_SESSION['loggedin']) {
        Header("Location: dashboard");
    } else {
        Header("Location: login");
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="https://www.politie.nl/politie2018/assets/images/icons/favicon.ico" type="image/x-icon" />
        <link rel="icon" type="image/png" sizes="16x16" href="https://www.politie.nl/politie2018/assets/images/icons/favicon-16.png">
        <link rel="icon" type="image/png" sizes="32x32" href="https://www.politie.nl/politie2018/assets/images/icons/favicon-32.png">
        <link rel="icon" type="image/png" sizes="64x64" href="https://www.politie.nl/politie2018/assets/images/icons/favicon-64.png">
        <link rel="stylesheet" href="assets/css/style.css">
        <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
        

        <title>Ambulance Databank</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/starter-template/">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- Custom styles for this template -->
        <link href="assets/css/main.css" rel="stylesheet">
    </head>
    <body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="<?php echo $_SESSION["profilepic"]; ?>" alt="profile-pic" width="130" height="40"/>
                </span>

                <div class="text logo-text">
                    <span class="name"><?php echo $firstname . " " . substr($lastname, 0, 1); ?>.</span>
                    <span class="profession"><?php echo $_SESSION["rank"]; ?></span>
                </div>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Search...">
                </li>

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="dashboard">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link opzoeken">
                        <a href="profiles">
                            <i class='bx bx-bar-chart-alt-2 icon' ></i>
                            <span class="text nav-text">Opzoeken</span>
                        </a>
                    </li>
                    
                    <?php if ($_SESSION["rank"] == "Leiding") { ?>
                    <li class="nav-link">
                        <a href="Dropdown worden luuk">
                            <i class='bx bx-bell icon'></i>
                            <!-- <span class="text nav-text" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Leiding</span> -->
                            <span class="text nav-text">Leiding</span>
                            <!-- <ul class="dropdown">   -->

                        </a>
                    </li>
                    <?php } ?>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-pie-chart-alt icon' ></i>
                            <span class="text nav-text">Analytics</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-heart icon' ></i>
                            <span class="text nav-text">Likes</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-wallet icon' ></i>
                            <span class="text nav-text">Wallets</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="logout">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Log uit</span>
                    </a>
                </li>

                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Donker</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
                
            </div>
        </div>

      

  <script src="./assets/js/script.js"></script>


    </nav>


        <main role="main" class="container">
            <div class="content-introduction">
                <h3>Welkom bij de Ambulance Databank</h3>
                <p class="lead">Zoek personen, voertuigen en andere informatie op die je kunt gebruiken tijdens je dienst. <br />Ook kun je hier alle rapportages lezen, aanmaken, bijwerken en verwijderen. <br /><strong>Zorg ervoor dat alle documentatie goed wordt opgenomen en alle bewijzen erin worden meegenomen.</strong>
                
                </p>
                
            </div>
            <div class="dashboard-container">
                <!-- Left Container -->
                <div class="left-panel-container">
                    <h5 class="panel-container-title">Laatste rapportages</h5>
                    <div class="panel-list">
                        <div class="panel-item">
                            <h5 class="panel-title">#0001 Report Title</h5>
                            <p class="panel-author">door: K. Mulder</p>
                        </div>
                        <div class="panel-item">
                            <h5 class="panel-title">#0001 Report Title</h5>
                            <p class="panel-author">door: K. Mulder</p>
                        </div>
                        <div class="panel-item">
                            <h5 class="panel-title">#0001 Report Title</h5>
                            <p class="panel-author">door: K. Mulder</p>
                        </div>
                        <div class="panel-item">
                            <h5 class="panel-title">#0001 Report Title</h5>
                            <p class="panel-author">door: K. Mulder</p>
                        </div>
                        <div class="panel-item">
                            <h5 class="panel-title">#0001 Report Title</h5>
                            <p class="panel-author">door: K. Mulder</p>
                        </div>
                        <div class="panel-item">
                            <h5 class="panel-title">#0001 Report Title</h5>
                            <p class="panel-author">door: K. Mulder</p>
                        </div>
                    </div>
                </div>  
                <!-- Right Container -->
                <div class="right-panel-container">
                    <h5 class="panel-container-title">Opgezochte Personen</h5>
                    <div class="panel-list">
                        <div class="panel-item">
                            <h5 class="panel-title">Ricky de Wilde</h5>
                            <p class="panel-author">Volledige Naam: ELK384E39</p>
                        </div>
                        <div class="panel-item">
                            <h5 class="panel-title">Ricky de Wilde</h5>
                            <p class="panel-author">Volledige Naam: ELK384E39</p>
                        </div><div class="panel-item">
                            <h5 class="panel-title">Ricky de Wilde</h5>
                            <p class="panel-author">Volledige Naam: ELK384E39</p>
                        </div><div class="panel-item">
                            <h5 class="panel-title">Ricky de Wilde</h5>
                            <p class="panel-author">Volledige Naam: ELK384E39</p>
                        </div><div class="panel-item">
                            <h5 class="panel-title">Ricky de Wilde</h5>
                            <p class="panel-author">Volledige Naam: ELK384E39</p>
                        </div><div class="panel-item">
                            <h5 class="panel-title">Ricky de Wilde</h5>
                            <p class="panel-author">Volledige Naam: ELK384E39</p>
                        </div>
                    </div>
                </div> 
            </div>
        </main><!-- /.container -->

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>
