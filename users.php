<?php
    require "requires/config.php";
    if (!$_SESSION['loggedin']) {
        Header("Location: login");
    }
    if ($_SESSION["rank"] != "Leiding") {
        Header("Location: users");
    }
    $respone = false;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (trim($_POST['type']) == NULL) {
            Header("Location:dashboard");
        }
        if ($_POST['type'] == "create") {
            $insert = $con->query("INSERT INTO users (username,password,name,role,dienstnummer,profilepic,rank,last_login) VALUES('".$con->real_escape_string($_POST['username'])."','".password_hash($con->real_escape_string($_POST['password']),PASSWORD_BCRYPT)."','".$con->real_escape_string($_POST['fullname'])."','user','".$con->real_escape_string($_POST['dienstnummer'])."','".$con->real_escape_string($_POST['profilepic'])."','".$con->real_escape_string($_POST['rank'])."','".date('Y-m-d')."')");
            if ($insert) {
                $respone = true;
            }
        } elseif ($_POST['type'] == "addspecial") {
            $insert = $con->query("INSERT INTO special (username,speciali) VALUES('".$con->real_escape_string($_POST['user'])."','".$con->real_escape_string($_POST['speciali'])."')");
            if ($insert) {
                $respone = true;
        }
        } elseif ($_POST['type'] == "removespecial") {
            $sql = "DELETE FROM special WHERE username = ".$con->real_escape_string($_POST['specialusername']);
        if ($con->query($sql)) {
            $respone = true;
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
            exit();
        }
        } elseif ($_POST['type'] == "delete") {
            $sql = "DELETE FROM users WHERE id = ".$con->real_escape_string($_POST['deleteuser']);
            if ($con->query($sql)) {
                $respone = true;
            } else {
                echo "Error deleting record: " . mysqli_error($conn);
                exit();
            }
        } elseif ($_POST['type'] == "edit") {
            $query = $con->query("SELECT * FROM users WHERE id = ".$con->real_escape_string($_POST['edituser']));
            $selecteduser = $query->fetch_assoc();
        } elseif ($_POST['type'] == "realedit") {
            $update = $con->query("UPDATE users SET username = '".$con->real_escape_string($_POST['username'])."', name = '".$con->real_escape_string($_POST['fullname'])."', rank = '".$con->real_escape_string($_POST['rank'])."' WHERE id = ".$_POST['userid']);
            if ($update) {
                $respone = true;
            } else {
                $response = false;
            }
        }
    }
    $name = explode(" ", $_SESSION["name"]);
    $firstname = $name[0];
    $last_word_start = strrpos($_SESSION["name"], ' ') + 1;
    $lastname = substr($_SESSION["name"], $last_word_start);

    $result = $con->query("SELECT * FROM users WHERE role = 'user'");
    $user_array = [];
    while ($data = $result->fetch_assoc()) { 
        $user_array[] = $data;
    }
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
                        <a href="reports">
                        <i class='bx bx-file icon' ></i>
                            <span class="text nav-text">Rapporten</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="ambulanciers">
                        <i class='bx bx-plus-medical icon' ></i>
                            <span class="text nav-text">Ambulanciers</span>
                        </a>
                    </li>

                    
                    <li class="nav-link">
                        <a href="createprofile">
                        <i class='bx bx-user-plus icon'></i>
                            <span class="text nav-text">Nieuw Persoon</span>
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
                        <a href="createambulancier">
                        <i class='bx bxs-duplicate icon'></i>
                            <span class="text nav-text">Nieuwe Ambu</span>
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
                <h3 class="titelgroot">Ambulanciers Instellingen</h3>
                <p class="lead">Hier kun je ambulanciers aanmaken, bewerken, verwijderen en specialisaties aanpassen. <br /><strong>Wanneer gebruikers verwijderd worden kan het niet meer ongedaan worden gemaakt!</strong></p>
            </div>
            <div class="users-container">
                <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "edit") { ?>
                    <div class="left-panel-container">
                    <h5 class="panel-container-title">Pas gebruiker aan</h5>
                    <form method="post">
                        <input type="hidden" name="type" value="realedit">
                        <input type="hidden" name="userid" value="<?php echo $selecteduser['id']; ?>">
                        <div class="input-group mb-3">
                            <input type="text" name="username" class="form-control login-user" value="<?php echo $selecteduser['username']; ?>" placeholder="gebruikersnaam">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="fullname" class="form-control login-user" value="<?php echo $selecteduser['name']; ?>" placeholder="volledige naam">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="rank" class="form-control login-user" value="<?php echo $selecteduser['rank']; ?>" placeholder="rank">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="create" class="btn btn-primary btn-police">Pas aan</button>
                        </div>
                    </form>
                </div> 
                <?php } else { ?>
                <!-- Left Container -->
                <div class="left-panel-container">
                    <h5 class="panel-container-title">Pas gebruiker aan</h5>
                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "realedit" && $respone) {?>
                        <?php echo "<p style='color: #13ba2c;'>Gebruiker aangepast!</p>"; ?>
                    <?php } ?>
                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "realedit" && !$respone) {?>
                        <?php echo "<p style='color:#9f1010;'>Gebruiker niet aangepast!</p>"; ?>
                    <?php } ?>
                    <form method="post">
                        <input type="hidden" name="type" value="edit">
                        <div class="form-group">
                            <label class="labeltekst" for="userselect">Gebruiker</label>
                            <select class="form-control" name="edituser">
                            <?php foreach($user_array as $user){?>
                                <option value="<?php echo $user["id"] ?>"><?php echo $user['name']; ?></option>
                            <?php }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="edit" class="btn btn-primary btn-police">Pas aan</button>
                        </div>
                    </form>
                </div>  
                <!-- Right Container -->
                <div class="right-panel-container">
                    <h5 class="panel-container-title">Verwijder gebruiker</h5>
                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "delete" && $respone) {?>
                        <?php echo "<p style='color: #13ba2c;'>Gebruiker verwijderd!</p>"; ?>
                    <?php } ?>
                    <form method="post">
                        <input type="hidden" name="type" value="delete">
                        <div class="form-group">
                            <label class="labeltekst" for="userselect">Gebruiker</label>
                            <select class="form-control" name="deleteuser">
                            <?php foreach($user_array as $user){?>
                                <option value="<?php echo $user["id"] ?>"><?php echo $user['name']; ?></option>
                            <?php }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="delete" class="btn btn-primary btn-police">Verwijder</button>
                        </div>
                    </form>
                </div> 
                <div class="left-panel-container">
                    <h5 class="panel-container-title">Voeg gebruiker toe</h5>
                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "create" && $respone) {?>
                        <?php echo "<p style='color: #13ba2c;'>Gebruiker toegevoegd!</p>"; ?>
                    <?php } ?>
                    <form method="post">
                        <input type="hidden" name="type" value="create">
                        <div class="input-group mb-3">
                            <input type="text" name="username" class="form-control login-user" value="" placeholder="Gebruikersnaam" required>
                        </div>
                        <div class="input-group mb-2">
                            <input type="password" name="password" class="form-control login-pass" value="" placeholder="Wachtwoord" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="fullname" class="form-control login-user" value="" placeholder="Voornaam + Achternaam" required>
                        </div>
                        <div class="input-group mb-4">
                            <input type="text" name="dienstnummer" class="form-control login-nummer" value="" placeholder="Dienst Nummer" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="profilepic" class="form-control login-nummer" value="" placeholder="Profielfoto (Bijvoorbeeld: Imgur.com/938472.jpg)" required>
                        </div>

                        <select class="form-control" style="margin-bottom:2vh;" name="rank" required>
                            <option value="Stagiair">Stagiair</option>
                            <option value="Helpende">Helpende</option>
                            <option value="Chauffeur">Chauffeur</option>
                            <option value="Broeder">Ambulance broeder</option>
                            <option value="VK">VK</option>
                            <option value="Specialist">Specialist</option>
                            <option value="Hoofdspecialist">Hoofdspecialist</option>
                            <option value="Geneeskundige">Geneeskundige</option>
                            <option value="Hoofdgeneeskundige">Hoofdgeneeskundige</option>
                            <option value="Academie">Academie</option>
                            <option value="Leiding">Leiding</option>
                        </select>
                        <div class="form-group">
                            <button type="submit" name="create" class="btn btn-primary btn-police">Voeg toe</button>
                        </div>
                    </form>
                </div> 
                <div class="right-panel-container">
                    <h5 class="panel-container-title">Voeg specialisatie toe</h5>
                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "addspecial" && $respone) {?>
                        <?php echo "<p style='color: #13ba2c;'>Specialisatie Aangepast</p>"; ?>
                    <?php } ?>
                    <form method="post">
                        <input type="hidden" name="type" value="addspecial">
                        <div class="form-group">
                            <label class="labeltekst" for="userselect">Gebruiker</label>
                            <select class="form-control" name="user">
                            <?php foreach($user_array as $user){?>
                                <option value="<?php echo $user["id"] ?>"><?php echo $user["name"]; ?></option>
                            <?php }?>
                            </select>
                            <label class="labeltekst" for="userselect">Specialisatie</label>
                            <select class="form-control" style="margin-bottom:2vh;" name="speciali" required>
                            <option value="GGD-arts">GGD-arts</option>
                            <option value="Rapid-Responder">Rapid Responder</option>
                            <option value="Mobiel-Medisch-Team">Het Mobiel Medisch Team</option>
                            <option value="Officier-van-dienst-geneeskunde">Officier van Dienst - Geneeskunde</option>
                        </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="addspecial" class="btn btn-primary btn-police">Voeg Specialisatie toe</button>
                        </div>
                    </form>
                </div> 
                <div class="right-panel-container">
                    <h5 class="panel-container-title">Verwijder Specialisaties</h5>
                    <h8 class="panel-container-title">Let op! Hiermee verwijder je alle specialisaties</h8>

                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "removespecial" && $respone) {?>
                        <?php echo "<p style='color: #13ba2c;'>Specialisatie Verwijderd</p>"; ?>
                    <?php } ?>
                    <form method="post">
                        <input type="hidden" name="type" value="removespecial">
                        <div class="form-group">
                            <br>
                            <label class="labeltekst" for="userselect">Gebruiker</label>
                            <select class="form-control" name="specialusername">
                            <?php foreach($user_array as $user){?>
                                <option value="<?php echo $user["id"] ?>"><?php echo $user['name']; ?></option>
                            <?php }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="removespecial" class="btn btn-primary btn-police">Verwijder</button>
                        </div>
                    </form>
                </div> 
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
