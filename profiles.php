<?php
    require "requires/config.php";
    if (!$_SESSION['loggedin']) {
        Header("Location: login");
    }
    $respone = false;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($_POST['type'] == "search") {
            $result = $con->query("SELECT * FROM profiles WHERE concat(' ', fullname, ' ') LIKE '%".$con->real_escape_string($_POST['search'])."%' OR citizenid = '".$con->real_escape_string($_POST['search'])."' OR dnacode = '".$con->real_escape_string($_POST['search'])."' OR fingerprint = '".$con->real_escape_string($_POST['search'])."'");
            $search_array = [];
            while ($data = $result->fetch_assoc()) { 
                $search_array[] = $data;
            }
        }elseif ($_POST['type'] == "show" || isset($_SESSION["personid"]) && $_SESSION["personid"] != NULL) {
            if (isset($_SESSION["personid"]) && $_SESSION["personid"] != NULL) {
                $personId = $_SESSION["personid"];
            } else {
                $personId = $_POST['personid'];
            }
            $query = $con->query("SELECT * FROM profiles WHERE id = ".$con->real_escape_string($personId));
            $selectedprofile = $query->fetch_assoc();
            $result = $con->query("SELECT * FROM reports WHERE profileid = ".$con->real_escape_string($personId)." ORDER BY created DESC");
            $update = $con->query("UPDATE profiles SET lastsearch = ".time()." WHERE id = ".$personId);
            $reports_array = [];
            while ($data = $result->fetch_assoc()) { 
                $reports_array[] = $data;
            }
            $_SESSION["personid"] = NULL;
        }
    }
    $name = explode(" ", $_SESSION["name"]);
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
        <link rel="shortcut icon" href="https://cdn.silvesterhensen.nl/icon.ico" type="image/x-icon" />
        <link rel="icon" type="image/png" sizes="16x16" href="https://www.politie.nl/politie2018/assets/images/icons/favicon-16.png">
        <link rel="icon" type="image/png" sizes="32x32" href="https://www.politie.nl/politie2018/assets/images/icons/favicon-32.png">
        <link rel="icon" type="image/png" sizes="64x64" href="https://www.politie.nl/politie2018/assets/images/icons/favicon-64.png">
        <link rel="stylesheet" href="assets/css/style.css">
        <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
        <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

        <title>Ambulance Databank</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/starter-template/">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- Custom styles for this template -->
        <link href="assets/css/main.css" rel="stylesheet">
        <link href="assets/css/profiles.css" rel="stylesheet">
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
                            <span class="text nav-text">Personen</span>
                        </a>
                    </li>
                    
                    <?php if ($_SESSION["rank"] == "Leiding") { ?>
                    <li class="nav-link">
                        <a href="reports">
                            <i class='bx bx-bell icon'></i>
                            <span class="text nav-text">Rapporten</span>
                        </a>
                    </li>
                    <?php } ?>

                    <li class="nav-link">
                    <span class="text nav-text"></span>
                    </li>

                    
                    <li class="nav-link">
                    <span class="text nav-text">🡣 Leiding 🡣</span>
                    </li>

                    <li class="nav-link">
                        <a href="ambulanciers">
                            <i class='bx bx-heart icon' ></i>
                            <span class="text nav-text">Ambulanciers</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="users">
                            <i class='bx bx-wallet icon' ></i>
                            <span class="text nav-text">Nieuwe Ambula!</span>
                        </a>
                    </li>
                    
                    <li class="nav-link">
                        <a href="createambulancier">
                            <i class='bx bx-wallet icon' ></i>
                            <span class="text nav-text">Administratie</span>
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

                <li class="nav-link">
                        <a class="darkmode">
                            <i class="bx bx-moon icon moon"></i>
                            <span class="text nav-text donkerwit">Dark</span>
                            </a>
                            <a class="lightmode">
                            <i class="bx bx-sun icon sun"></i>
                            <span class="text nav-text donkerlicht">Light</span>
                        </a>
                    </li>
                
            </div>
        </div>

      

  <script src="./assets/js/script.js"></script>


    </nav>
  
        <main role="main" class="container">
            <div class="content-introduction">
                <h3 class="h3profile">Personen</h3>
                <p class="pprofile">Hier kun je personen opzoeken om informatie in te zien, een rapportage aan te maken of profielen aanmaken. <br />Het zou kunnen zijn dat een persoon niet bestaat, maak hiervoor een profiel aan en voer de juiste gegevens in.</p>
            </div>
            <div class="profile-container">
                <div class="profile-search">
                    <?php if ($_SERVER['REQUEST_METHOD'] != "POST" || $_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] != "show") { ?>
                        <a href="createprofile" class="btn btn-pol btn-md my-0 ml-sm-2">MAAK NIEUW PROFIEL</a>
                    <?php } else { ?>
                        <form method="post" action="createprofile">
                            <input type="hidden" name="type" value="edit">
                            <input type="hidden" name="profileid" value="<?php echo $selectedprofile['id']; ?>">
                            <button type="submit" name="issabutn" class="btn btn-pol btn-md my-0 ml-sm-2">PAS PROFIEL AAN</button>
                        </form>
                    <?php } ?>
                    <br /><br />
                    <form method="post" class="form-inline ml-auto">
                        <input type="hidden" name="type" value="search">
                        <div class="md-form my-0">
                            <input class="form-control" name="search" type="text" placeholder="Zoek een persoon.." aria-label="Search">
                        </div>
                        <button type="submit" name="issabutn" class="btn btn-pol btn-md my-0 ml-sm-2">ZOEK</button>
                    </form>
                </div>
                <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "search") { ?>
                    <div class="search-panel">
                        <h5 class="panel-container-title">Gevonden personen..</h5>
                        <div class="panel-list">
                            <?php if (empty($search_array)) { ?>
                                <p>Geen persoon persoon gevonden.. Maak een profiel aan.</p>
                            <?php } else { ?>
                                <?php foreach($search_array as $person) {?>
                                    <form method="post">
                                        <input type="hidden" name="type" value="show">
                                        <input type="hidden" name="personid" value="<?php echo $person['id']; ?>">
                                        <button type="submit" class="btn btn-panel panel-item">
                                            <h5 class="panel-titleprof"><?php echo $person['fullname']; ?></h5>
                                            <img width="200" height="200" class="panel-author profilepicpro" src="<?php echo $person['avatar']; ?>">
                                        </button>
                                    </form>
                                <?php }?>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "show" && !empty($selectedprofile)) { ?>
                    <div class="profile-panel">
                        <div class="profile-avatar">
                            <img src="<?php echo $selectedprofile["avatar"]; ?>" alt="profile-pic" width="150" height="150" />
                        </div>
                        <div class="profile-information">
                            <p><strong>Naam:</strong><br /><?php echo $selectedprofile["fullname"]; ?></p>
                            <p><strong>Geboortedatum:</strong><br /><?php echo $selectedprofile["fingerprint"]; ?></p>
                            <p><strong>Bloedgroep:</strong><br /><?php echo $selectedprofile["dnacode"]; ?></p>
                            <p><strong>Notitie:</strong><br /><?php echo $selectedprofile["note"]; ?></p>
                        </div>
                    </div>
                    <div class="profile-reports-panel">
                        <div class="profile-lastincidents">
                            <form method="post" action="createreport" style="float:right; margin-left: 1vw;">
                                <input type="hidden" name="type" value="createnew">
                                <input type="hidden" name="profileid" value="<?php echo $selectedprofile['id']; ?>">
                                <button type="submit" name="issabutn"  class="btn btn-success btn-md my-0 ml-sm-2 newrapportbtn">NIEUW RAPPORT</button>
                            </form>
                            <form method="post" action="createwarrant" style="float:right;">
                                <input type="hidden" name="type" value="create">
                                <input type="hidden" name="profileid" value="<?php echo $selectedprofile['id']; ?>">
                            </form>
                            <br />
                            <h5 class="panel-container-title">Laatste rapportages</h5>
                            <div class="panel-list">
                                <?php if (empty($reports_array)) { ?>
                                    <p>Geen reportages gevonden bij deze persoon..</p>
                                <?php } else { ?>
                                    <?php foreach($reports_array as $report) {?>
                                        <form method="post" action="reports">
                                            <input type="hidden" name="type" value="show">
                                            <input type="hidden" name="reportid" value="<?php echo $report['id']; ?>">
                                            <button type="submit" class="btn btn-panel panel-item">
                                                <h5 class="panel-title panelprof">#<?php echo $report['id']; ?> <?php echo $report['title']; ?></h5>
                                                <p class="panel-author panelaupro">door: <?php echo $report['author']; ?></p>
                                            </button>
                                        </form>
                                    <?php }?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!---->
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
