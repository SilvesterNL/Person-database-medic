<?php
    require "requires/config.php";
    if (!$_SESSION['loggedin']) {
        Header("Location: login");
    }


    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($_POST['type'] == "1") {
            $update = $con->query("UPDATE users SET dat = '".$con->real_escape_string($_POST['status'])."' WHERE id = ".$_POST['userid']);
            if ($update) {
                $respone = true;
                $_SESSION['status'] = $_POST['status'];
            } else {
                $response = false;
            }
        } elseif ($_POST['type'] == "2") {
            $update = $con->query("UPDATE users SET dat = '".$con->real_escape_string($_POST['status'])."' WHERE id = ".$_POST['userid']);
            if ($update) {
                $respone = true;
                $_SESSION['status'] = $_POST['status'];
            } else {
                $response = false;
            }
        } elseif ($_POST['type'] == "3") {
            $update = $con->query("UPDATE users SET dat = '".$con->real_escape_string($_POST['status'])."' WHERE id = ".$_POST['userid']);
            if ($update) {
                $respone = true;
                $_SESSION['status'] = $_POST['status'];
            } else {
                $response = false;
            }
        } elseif ($_POST['type'] == "4") {
            $update = $con->query("UPDATE users SET dat = '".$con->real_escape_string($_POST['status'])."' WHERE id = ".$_POST['userid']);
            if ($update) {
                $respone = true;
                $_SESSION['status'] = $_POST['status'];
            } else {
                $response = false;
            }
        } elseif ($_POST['type'] == "5") {
            $update = $con->query("UPDATE users SET dat = '".$con->real_escape_string($_POST['status'])."' WHERE id = ".$_POST['userid']);
            if ($update) {
                $respone = true;
                $_SESSION['status'] = $_POST['status'];
            } else {
                $response = false;
            }
        } elseif ($_POST['type'] == "6") {
            $update = $con->query("UPDATE users SET dat = '".$con->real_escape_string($_POST['status'])."' WHERE id = ".$_POST['userid']);
            if ($update) {
                $respone = true;
                $_SESSION['status'] = $_POST['status'];
            } else {
                $response = false;
            }
        }
    
    
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
                        <a href="createprofile">
                        <i class='bx bx-user-plus icon'></i>
                            <span class="text nav-text">Nieuw Persoon</span>
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
                            <i class="bx bx-sun icon sun"></i>
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
                <h3 class="h3text">Status Dashboard</h3>
                <p class="p1text">Hier kan je zien wie er in dienst zijn en welke status hun zijn</p>
                
                <div class="left-panel-container">
                <form method="post">
                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "1" && $respone) {?>
                        <?php echo "<div class='notification'><p class='notitekst'><strong>SUCCES</strong>  Je status is succesvol aangepast</p></div>"; ?>
                    <?php } ?>
                        <input type="hidden" name="userid" value="<?php echo $_SESSION['id']; ?>">
                        <input type="hidden" name="status" value="1">
                        <input type="hidden" name="type" value="1">     
                        <div style="width:300px;" class="form-group">
                            <button type="submit" name="1" class="btn btn-primary btn-police statusbtn">Status 1</button>
                        </div>
                    </form>
                    <form method="post">
                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "2" && $respone) {?>
                        <?php echo "<div class='notification'><p class='notitekst'><strong>SUCCES</strong>  Je status is succesvol aangepast</p></div>"; ?>
                    <?php } ?>
                        <input type="hidden" name="userid" value="<?php echo $_SESSION['id']; ?>">
                        <input type="hidden" name="status" value="2">
                        <input type="hidden" name="type" value="2">     
                        <div style="width:300px;" class="form-group">
                            <button type="submit" name="2" class="btn btn-primary btn-police statusbtn">Status 2</button>
                        </div>
                    </form>
                    <form method="post">
                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "3" && $respone) {?>
                        <?php echo "<div class='notification'><p class='notitekst'><strong>SUCCES</strong>  Je status is succesvol aangepast</p></div>"; ?>
                    <?php } ?>
                        <input type="hidden" name="userid" value="<?php echo $_SESSION['id']; ?>">
                        <input type="hidden" name="status" value="3">
                        <input type="hidden" name="type" value="3">     
                        <div style="width:300px;" class="form-group">
                            <button type="submit" name="3" class="btn btn-primary btn-police statusbtn">Status 3</button>
                        </div>
                    </form>
                    <form method="post">
                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "4" && $respone) {?>
                        <?php echo "<div class='notification'><p class='notitekst'><strong>SUCCES</strong>  Je status is succesvol aangepast</p></div>"; ?>
                    <?php } ?>
                        <input type="hidden" name="userid" value="<?php echo $_SESSION['id']; ?>">
                        <input type="hidden" name="status" value="4">
                        <input type="hidden" name="type" value="4">     
                        <div style="width:300px;" class="form-group">
                            <button type="submit" name="4" class="btn btn-primary btn-police statusbtn">Status 4</button>
                        </div>
                    </form>
                    <form method="post">
                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "5" && $respone) {?>
                        <?php echo "<div class='notification'><p class='notitekst'><strong>SUCCES</strong>  Je status is succesvol aangepast</p></div>"; ?>
                    <?php } ?>
                        <input type="hidden" name="userid" value="<?php echo $_SESSION['id']; ?>">
                        <input type="hidden" name="status" value="5">
                        <input type="hidden" name="type" value="5">     
                        <div style="width:300px;" class="form-group">
                            <button type="submit" name="5" class="btn btn-primary btn-police statusbtn">Status 5</button>
                        </div>
                    </form>
                    <form method="post">
                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "6" && $respone) {?>
                        <?php echo "<div class='notification'><p class='notitekst'><strong>SUCCES</strong>  Je status is succesvol aangepast</p></div>"; ?>
                    <?php } ?>
                        <input type="hidden" name="userid" value="<?php echo $_SESSION['id']; ?>">
                        <input type="hidden" name="status" value="6">
                        <input type="hidden" name="type" value="6">
                        <div style="width:300px;" class="form-group">
                            <button type="submit" name="6" class="btn btn-primary btn-police statusbtn">Status 6</button>
                        </div>
                    </form>
                    </div>

                <div class="right-panel-container">
                <h5 class="h3text">Mensen Online:</h5>
                    </div>


        </main>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="assets/js/main.js"></script>
        
    </body>
</html>
