<?php
    require "requires/config.php";
    if (!$_SESSION['loggedin']) {
        Header("Location: login");
    }
    if ($_SESSION["rank"] != "Leiding") {
        Header("Location: createambulancier");
    }
    $respone = false;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (trim($_POST['type']) == NULL) {
            Header("Location:dashboard");
        }}
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($_POST['type'] == "createambu") {
            $note = nl2br($_POST["note"]);
            $insert = $con->query("INSERT INTO ambulanciers (citizenid,fullname,avatar,fingerprint,dnacode,note,lastsearch) VALUES('".$con->real_escape_string($_POST['citizenid'])."','".$con->real_escape_string($_POST['fullname'])."','".$con->real_escape_string($_POST['avatar'])."','".$con->real_escape_string($_POST['fingerprint'])."','".$con->real_escape_string($_POST['dnacode'])."','".$con->real_escape_string($note)."',".time().")");
            if ($insert) {
                $last_id = $con->insert_id;
                $_SESSION["personid"] = $last_id;
                $respone = true;
                header('Location: ambulanciers');
            }
        } elseif ($_POST['type'] == "editambu") {
            $query = $con->query("SELECT * FROM ambulanciers WHERE id = ".$con->real_escape_string($_POST['profileid']));
            $selectedprofile = $query->fetch_assoc();
        } elseif ($_POST['type'] == "realeditambu") {
            $note = nl2br($_POST["note"]);
            $update = $con->query("UPDATE ambulanciers SET citizenid = '".$con->real_escape_string($_POST['citizenid'])."', fullname = '".$con->real_escape_string($_POST['fullname'])."', avatar = '".$con->real_escape_string($_POST['avatar'])."', fingerprint = '".$con->real_escape_string($_POST['fingerprint'])."', dnacode = '".$con->real_escape_string($_POST['dnacode'])."', note = '".$con->real_escape_string($note)."' WHERE id = ".$_POST['profileid']);
            if ($update) {
                $_SESSION["personid"] = $_POST['profileid'];
                $respone = true;
                header('Location: ambulanciers');
            } else {
                $response = false;
            }
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
                <h3>Nieuwe ambulancier maken</h3>
                <p class="lead">Hier kan je als leiding een nieuwe ambulance broeder in het systeem zetten<br />Zorg ervoor dat alle gegevens kloppen en dat er een juiste foto is geplaatst!</p>
            </div>
            <div class="createprofile-container">
            <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "editambu" && !empty($selectedprofile)) { ?>
                <form method="post">
                    <input type="hidden" name="type" value="realeditambu">
                    <input type="hidden" name="profileid" value="<?php echo $selectedprofile["id"]; ?>">
                    <div class="input-group mb-3">
                        <input type="text" name="citizenid" class="form-control login-user" value="<?php echo $selectedprofile["citizenid"]; ?>" placeholder="CitizenID" required>
                    </div>
                    <div class="input-group mb-2">
                        <input type="text" name="fullname" class="form-control login-pass" value="<?php echo $selectedprofile["fullname"]; ?>" placeholder="volledige naam" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="avatar" class="form-control login-user" value="<?php echo $selectedprofile["avatar"]; ?>" placeholder="profiel foto (imgur URL vb. https://i.imgur.com/zKDjdhe.png)" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="fingerprint" class="form-control login-user" value="<?php echo $selectedprofile["fingerprint"]; ?>" placeholder="Status (Vul een 1 in. Aangezien de functie nog niet werkt)">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="dnacode" class="form-control login-user" value="<?php echo $selectedprofile["dnacode"]; ?>" placeholder="Dienst Nummer">
                    </div>
                    <?php $notes = str_replace( "<br />", '', $selectedprofile["note"]); ?>
                    <div class="input-group mb-2">
                        <textarea name="note" class="form-control" value="<?php echo $notes; ?>" placeholder="notitie" required><?php echo $notes; ?></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="createambu" class="btn btn-primary btn-police">Pas Aan</button>
                    </div>
                </form>
            <?php } else { ?>
                <form method="post">
                    <input type="hidden" name="type" value="createambu">
                    <div class="input-group mb-3">
                        <input type="text" name="citizenid" class="form-control login-user" value="" placeholder="CitizenID" required>
                    </div>
                    <div class="input-group mb-2">
                        <input type="text" name="fullname" class="form-control login-pass" value="" placeholder="volledige naam" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="avatar" class="form-control login-user" value="" placeholder="profiel foto (imgur URL vb. https://i.imgur.com/zKDjdhe.png)">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="fingerprint" class="form-control login-user" value="" placeholder="Status (Vul 1 in aangezien de functie nog niet werkt)">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="dnacode" class="form-control login-user" value="" placeholder="Dienst Nummer">
                    </div>
                    <div class="input-group mb-2">
                        <textarea name="note" class="form-control" value="" placeholder="notitie"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="createambu" class="btn btn-primary btn-police">Voeg toe</button>
                    </div>
                </form>
            <?php } ?>
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
