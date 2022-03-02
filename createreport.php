<?php
    require "requires/config.php";
    if (!$_SESSION['loggedin']) {
        Header("Location: login");
    }
    $result = $con->query("SELECT * FROM laws ORDER BY months ASC");
    $laws_array = [];
    while ($data = $result->fetch_assoc()) { 
        $laws_array[] = $data;
    }
    $respone = false;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($_POST['type'] == "createnew") {
            $query = $con->query("SELECT * FROM profiles WHERE id = ".$con->real_escape_string($_POST["profileid"]));
            $selectedprofile = $query->fetch_assoc();
        } elseif ($_POST['type'] == "create") {
            $profileid = NULL;
            $lawids = array_map('intval', explode(',', $_POST["laws"]));
            array_shift($lawids);
            if (isset($_POST["citizenid"]) && $_POST["citizenid"] != "") {
                $query = $con->query("SELECT * FROM profiles WHERE fullname = '".$con->real_escape_string($_POST["citizenid"])."'");
                $profile = $query->fetch_assoc();
                if ($profile != NULL) {
                    $profileid = $profile["id"];
                }
            }
            $reportnote = nl2br($_POST["report"]);
            $insert = $con->query("INSERT INTO reports (title,author,profileid,report,laws,created) VALUES('".$con->real_escape_string($_POST['title'])."','".$con->real_escape_string($_POST['author'])."','".$con->real_escape_string($profileid)."','".$con->real_escape_string($reportnote)."', '".json_encode($lawids)."',".time().")");
           
           
            $totalprice = 0;
            if (!empty($lawids)) {
                foreach($lawids as $lawid) {
                    $law = $con->query("SELECT * FROM laws WHERE id = ".$con->real_escape_string($lawid));
                    $selectedlaw = $law->fetch_assoc();
                    $totalprice = $totalprice + $selectedlaw["fine"];
                }
            }


                $last_id = $con->insert_id;
                $_SESSION["reportid"] = $last_id;
                $respone = true;
                header('Location: dashboard');
            }
        } elseif ($_POST["type"] == "edit") {
            $query = $con->query("SELECT * FROM reports WHERE id = ".$con->real_escape_string($_POST['reportid']));
            $selectedreport = $query->fetch_assoc();
            $laws = json_decode($selectedreport["laws"], true);
            $lawsedit_array = [];
            $totalprice = 0;
            $totalmonths = 0;
            if (!empty($laws)) {
                foreach($laws as $lawid) {
                    $law = $con->query("SELECT * FROM laws WHERE id = ".$con->real_escape_string($lawid));
                    $selectedlaw = $law->fetch_assoc();
                    $totalmonths = $totalmonths + $selectedlaw["months"];
                    $totalprice = $totalprice + $selectedlaw["fine"];
                    $lawsedit_array[] = $selectedlaw;
                }
            }
            $profile = $con->query("SELECT * FROM profiles WHERE id = ".$con->real_escape_string($selectedreport['profileid']));
            $profiledata = $profile->fetch_assoc();
        } elseif ($_POST["type"] == "realedit") {
            $report = nl2br($_POST["report"]);
            $profile = $con->query("SELECT * FROM profiles WHERE citizenid = '".$con->real_escape_string($_POST['citizenid'])."'");
            $profileid = 0;
            if ($profile->num_rows > 0) {
                $profiledata = $profile->fetch_assoc();
                $profileid = $profiledata['id'];
            }
            $reportnote = nl2br($_POST["report"]);
            $update = $con->query("UPDATE reports SET title = '".$con->real_escape_string($_POST['title'])."', author = '".$con->real_escape_string($_POST['author'])."', profileid = ".$con->real_escape_string($profileid).", report = '".$con->real_escape_string($reportnote)."', created = ".time()." WHERE id = ".$_POST['reportid']);
            if ($update) {
                $_SESSION["reportid"] = $_POST['reportid'];
                $respone = true;
                header('Location: reports');
            } else {
                $response = false;
            }
        }
    
    $name = explode(" ", $_SESSION["name"]);
    $firstname = $name[0];
    $last_word_start = strrpos($_SESSION["name"], ' ') + 1;
    $lastname = substr($_SESSION["name"], $last_word_start);
    $ip = NULL;
    function getUserIP()
    {
        // Get real visitor IP behind CloudFlare network
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
                $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
                $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }

        return $ip;
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
        <link rel="stylesheet" href="assets/css/content-styles.css" type="text/css">
        <link href="assets/css/profiles.css" rel="stylesheet">
        <link href="assets/css/laws.css" rel="stylesheet">

		 <!-- Froala text-editor scripts -->
        <!-- <link href="./_files/codemirror.min.css" rel="stylesheet">
        <script src="./_files/codemirror.min.js"></script>
        <script src="./_files/xml.min.js"></script>
        <link href="./_files/font-awesome.min.css" rel="stylesheet">
        <script src="./_files/froala_editor.pkgd.min.js"></script>
        <link href="./_files/froala_editor.pkgd.min.css" rel="stylesheet">
        <link href="./_files/froala_editor.min.css" rel="stylesheet">
        <script src="./_files/nl.js"></script> -->

		<!-- Froala Style Rules -->
        <style>
            .fr-box.fr-basic .fr-element.fr-view, 
            .fr-wrapper.show-placeholder .fr-element.fr-view {
                font-family: 'Roboto Mono', monospace!important;
            }

            .show-placeholder {
                display: none;
            }

            .fr-toolbar {
                border-radius: .25rem .25rem 0vh 0vh !important;
                border: 1px solid #ced4da;
            }

            .second-toolbar {
                border-radius: 0vh 0vh .25rem .25rem !important;
                border: 1px solid #ced4da;
            }

            .fr-active{
                fill: #004682 !important;
            }

            .fr-floating-btn {
                border-radius:.25em !important;
            }

            .none {
                display:none;
            }
            
            .fr-wrapper::before{
                font-family: 'Roboto Mono', monospace!important;
                text-align: left;
                content: "";
                display: none;
                position:absolute;
                width:100%;
                z-index:10000;
                height:fit-content;

                padding: 12.5px 25px;
                color:#FFF;
                text-decoration:none;
                background-color:white;
                /* background:rgba(58, 122, 176); */
                display:block;
                font-size:14px;
                font-family:sans-serif;
            }

            .fr-quick-insert {
                display: none !important;
            }
        </style>


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
                <h3 class="titelgroot">Report Maken</h3>
                <p class="lead">Hier kun je een nieuw reportage aanmaken.<br />Je kunt een Volledige Naam koppelen aan een reportage (Hiervoor MOET er een profiel bestaan) of je kan het leeg laten en later toevoegen.<br /><strong>Let op alles wat hier word geschreven kan later niet worden aangepast om corruptie te verkomen!</strong></p>
            </div>
            <div class="createreport-container">
                <div class="createreport-left">
                <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "edit" && !empty($selectedreport)) { ?>
                    <form method="post">
                        <input type="hidden" name="type" value="realedit">
                        <input type="hidden" name="author" class="form-control login-pass" value="<?php echo $_SESSION["name"]; ?>" placeholder="" required>
                        <input type="hidden" name="reportid" class="form-control login-pass" value="<?php echo $selectedreport["id"]; ?>" placeholder="" required>
                        <div class="input-group mb-3">
                            <input type="text" name="title" class="form-control login-user" value="<?php echo $selectedreport["title"]; ?>" placeholder="titel" required>
                        </div>
                        <?php if (!empty($profiledata)) { ?>
                            <div class="input-group mb-3">
                                <input type="text" name="citizenid" class="form-control login-user" value="<?php echo $profiledata["citizenid"]; ?>" placeholder="koppel bsn (mag leeg)">
                            </div>
                        <?php } else {?>
                            <div class="input-group mb-3">
                                <input type="text" name="citizenid" class="form-control login-user" value="" placeholder="koppel bsn (mag leeg)">
                            </div>
                        <?php } ?>
                        <?php $report = str_replace( "<br />", '', $selectedreport["report"]); ?>
                        <div class="input-group mb-2">
                            <textarea name="report" id="" class="form-control" value="" placeholder="reportage.." required="" style="display: none;"><?php echo $report; ?></textarea>
                        </div>
						<script>
						document.getElementById("textVanRapport").style.width = "500px";
						</script>
                        <div class="form-group">
                            <button type="submit" name="create" class="btn btn-primary btn-police">Bewerk reportage</button>
                        </div>
                    </form>
                <?php } else { ?>
                    <form method="post">
                        <input type="hidden" name="type" value="create">
                        <input type="hidden" name="laws" class="report-law-punishments" value="">
                        <input type="hidden" name="author" class="form-control login-pass" value="<?php echo $_SESSION["name"]; ?>" placeholder="" required>
                        <div class="input-group mb-3">
                            <input type="text" name="title" class="form-control login-user" value="" placeholder="titel" required>
                        </div>
                        <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "createnew") { ?>
                            <div class="input-group mb-3">
                                <input type="text" name="citizenid" class="form-control login-user" value="<?php echo $selectedprofile["fullname"]; ?>" placeholder="koppel Volledige Naam (mag leeg)">
                            </div>
                        <?php } else {?>
                            <div class="input-group mb-3">
                                <input type="text" name="citizenid" class="form-control login-user" value="" placeholder="koppel Volledige Naam (mag leeg)">
                            </div>
                        <?php } ?>
            <textarea class="ck-content" name="report" id="editor">

			<figure class="image">
                <img src="./assets/images/icon.png">
                <p></p>
        </figure>
            <li>AMBULANCE</li>
            <li>DISTRICT FORTIS</li>
            <li>BASISTEAM PILLBOX HILL</li>
            <br />
            <p>RAPPORTAGE:</p>
            <li>Ik, van team ambulance <?php echo $firstname . " " . substr($lastname, 0, 1); ?> met de functie <?php echo $_SESSION["rank"] ?> maak het volgende rapport.</li>
            <li>Op <?php echo date("d/m/Y") ?> omstreeks <?php echo date("H:i") ?> uur, bevond ik mij in dienst van de ambulance. En heb het volgende geconstateerd:</li>
            <br>
            <p>BEVINDINGEN</p>
            <li>Locatie van gebeurtenis: </li>
            <li>Staat van persoon bij aantreffen: </li>
            <li>Welke handelingen zijn gedaan door <?php echo $firstname . " " . substr($lastname, 0, 1); ?>: </li>
            <li>Zijn er nog handelingen gedaan door een andere ambulancier: </li>
            <br>
            <p>RIT:</p>
            <li>Prioriteit (A1, A2, A3): </li>
            <li>DIA: </li>
            <li>ARR Zorg: </li>
            <li>Rit naar ziekenhuis (A1, A2, A3): </li>

            </textarea>

                        <div class="form-group">
                            <button type="submit" name="create" class="btn btn-primary btn-police">Maak reportage</button>
                        </div>
                    </form>
                <?php } ?>
                </div>
               
                <script src="./assets/js/ckeditor.js"></script>
                <script src="./assets/js/translations/nl.js"></script>

<script>
	ClassicEditor
		.create( document.querySelector( '#editor' ), {
            cloudServices: {
            tokenUrl: 'https://87227.cke-cs.com/token/dev/147cf738f871ee8a9d8260f25da08548eb07885ce5bff42c5c14a4dafee8?limit=10',
            uploadUrl: 'https://87227.cke-cs.com/easyimage/upload/'
        }
			
        
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
</script>






            <?php if ($_SERVER['REQUEST_METHOD'] != "POST" || $_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] != "edit") { ?>
                <div class="laws">
                    <div class="lawlist-search">
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Zoeken</span>
                            </div>
                            <input type="text" class="lawsearch form-control" aria-label="Zoeken" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    </div>
                    <?php foreach($laws_array as $law){?>
                        <div class="report-law-item-tab" data-toggle="tooltip" data-html="true" title="<?php echo $law['description']; ?>">
                            <input type="hidden" class="lawlist-id" value="<?php echo $law['id']; ?>">
                            <h5 class="lawlist-title"><?php echo $law['name']; ?></h5>
                            <p class="lawlist-fine">Boete: €<span class="fine-amount"><?php echo $law['fine']; ?></span></p>
                            <p class="lawlist-months">Cel: <span class="months-amount"><?php echo $law['months']; ?></span> maanden</p>
                        </div>
                    <?php }?>
                    </div>
                </div>
            <?php } ?>
        </main><!-- /.container -->

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="assets/js/main.js"></script>



    </body>
</html>
