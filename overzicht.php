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
        }}
        $name = explode(" ", $_SESSION["name"]);
        $firstname = $name[0];


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

    <main role="main" class="container">
            <div class="content-introduction">
                <h3 class="titelgroot">Welkom op de administratie pagina!</h3>
                <p class="lead">Hier kan je alle informatie zien die je tijdens je dienst maar ook buiten je dienst nodig hebt als ambulancier <br />Zoals sollicitatie's zien en grafieken over aanwezigheid.<br /><strong style="font-size="20";">LET OP NOG NIET ALLE FUNCTIES WERKEN HIER WORD AAN GEWERKT. VOOR VRAGEN DM @Silvester#8287</strong>
                <br />
                <br />
                </p>
            </div>
            <div class="dashboard-container">
                

        

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>
