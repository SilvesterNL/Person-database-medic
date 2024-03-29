<?php
    require "requires/config.php";
    if (!$_SESSION['loggedin']) {
        Header("Location: login");
    }
    $profiles = $con->query("SELECT * FROM profiles ORDER BY lastsearch DESC LIMIT 6");
    $recentsearch_array = [];
    while ($data = $profiles->fetch_assoc()) { 
        $recentsearch_array[] = $data;
    }
    $reports = $con->query("SELECT * FROM reports ORDER BY created DESC LIMIT 6");
    $recentreports_array = [];
    while ($data = $reports->fetch_assoc()) { 
        $recentreports_array[] = $data;
    }
    $name = explode(" ", $_SESSION["name"]);
    $profilepic = explode(" ", $_SESSION["profilepic"]);
    $firstname = $name[0];
    $last_word_start = strrpos($_SESSION["name"], ' ') + 1;
    $lastname = substr($_SESSION["name"], $last_word_start);
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <link rel="shortcut icon" href="https://cdn.silvesterhensen.nl/icon.ico" type="image/x-icon" />
        <link rel="icon" type="image/png" sizes="16x16" href="https://www.politie.nl/politie2018/assets/images/icons/favicon-16.png">
        <link rel="icon" type="image/png" sizes="32x32" href="https://www.politie.nl/politie2018/assets/images/icons/favicon-32.png">
        <link rel="icon" type="image/png" sizes="64x64" href="https://www.politie.nl/politie2018/assets/images/icons/favicon-64.png">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/dropdown.css">
        <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
        <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

        <title>Ambulance Databank</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/starter-template/">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- Main -->
        <link href="assets/css/main.css" rel="stylesheet">   
    <!----======== CSS ======== -->
    
    
    <!----===== Menu css via cdn omdat veels te groot anders kaas CSS ===== -->
    
    
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

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="dashboard">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link opzoeken">
                        <a href="profiles">
                        <i class='bx bxs-group icon'></i>
                            <span class="text nav-text">Personen</span>
                        </a>
                    </li>
                    

                    
                    <li class="nav-link">
                        <a href="settings">
                        <i class='bx bx-comment-edit icon'></i>
                            <span class="text nav-text">Instellingen</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="status">
                        <i class='bx bx-support icon'></i>
                            <span class="text nav-text">Status</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="settings">
                        <i class='bx bx-comment-edit icon'></i>
                            <span class="text nav-text">Instellingen</span>
                        </a>
                    </li>


                    <li class="nav-link">
                    <span class="text nav-text"></span>
                    </li>
             
                   
                   


                    <?php if ($_SESSION["rank"] == "Leiding") { ?>
                    <li class="nav-link">
                    <span class="text nav-text leidingcenter">Leiding</span>
                    </li>
                    

                    <li class="nav-link">
                        <a href="users">
                        <i class='bx bx-male icon'></i>
                            <span class="text nav-text">Users</span>
                        </a>
                    </li>
                    
                    
                    <li class="nav-link">
                        <a href="overzicht">
                            <i class='bx bx-bookmarks icon' ></i>
                            <span class="text nav-text">Administratie</span>
                        </a>
                    </li>
                    

                </ul>
            </div>

            <?php } ?>
            
        
            <div class="bottom-content">
                <li class="">
                    <a href="logout">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Log uit</span>
                    </a>
                </li>



                <li class="nav-link">
                        <a class="darkmode">
                            <i class="bx bx-moon icon moon"></i>
                            <span class="text nav-text donkerwit">Dark</span>
                            </a>
                            <a class="lightmode">
                            <i style="left:10px!important;" class="bx bx-sun icon sun"></i>
                            <span class="text nav-text donkerlicht">Light</span>
                        </a>
                    </li>
                    
                
            </div>
        </div>

      

  <script src="./assets/js/script.js"></script>


    </nav>

  <!-- Navbar xx -->
        <main role="main" class="container">
            <div class="content-introduction">
                <h3 class="h3text">Welkom bij de Ambulance Databank</h3>
                <p class="p1text">Zoek personen en andere informatie op die je kunt gebruiken tijdens je dienst. <br />Ook kun je hier alle rapportages lezen, aanmaken en verwijderen. <br /><strong>Zorg ervoor dat alle documentatie goed wordt opgenomen.</strong>
                <br />
                <br />
                </p>
            </div>
            <div class="dashboard-container">
                <div class="left-panel-container">
                    <h5 class="panel-container-title">Laatste rapportages</h5>
                    <?php if(!empty($recentreports_array)) { ?>
                        <?php foreach($recentreports_array as $report) {?>
                            <form method="post" action="reports">
                                <input type="hidden" name="type" value="show">
                                <input type="hidden" name="reportid" value="<?php echo $report['id']; ?>">
                                <button type="submit" class="btn btn-panel panel-item" style="text-align:left!important;">
                                    <p class="panel-title"><?php echo $report['title']; ?></p>
                                </button>
                            </form>
                        <?php }?>
                    <?php } else { ?>
                            <p class="nopersp2text">Geen rapporten opgezocht..</p>
                    <?php } ?>
                </div>  
                <div class="right-panel-container">
                    <h5 class="panel-container-title">Laatst opgezocht</h5>
                    <div class="panel-list">
                    <?php if(!empty($recentsearch_array)) { ?>
                        <?php foreach($recentsearch_array as $person) {?>
                            <form method="post" action="profiles">
                                <input type="hidden" name="type" value="show">
                                <input type="hidden" name="personid" value="<?php echo $person['id']; ?>">
                                <button type="submit" class="btn btn-panel panel-item" style="text-align:left!important;">
                                    <p class="panel-author">Naam: <?php echo $person['fullname']; ?></p>
                                </button>
                            </form>
                        <?php }?>
                    <?php } else { ?>
                            <p>Geen personen opgezocht..</p>
                    <?php } ?>
                    </div>
                </div> 
            </div>
        </main>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="assets/js/main.js"></script>
        
    </body>
</html>
