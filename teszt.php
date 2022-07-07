<?php

require 'db.php';
session_start();
$felhasznalo=$_SESSION['meresiazon'];
$teszt=$_POST['tesztid'];
error_reporting(0);

if ($_SESSION['logged_in'] != 1) {
    $_SESSION['message'] = "Ahhoz hogy megtekintsd ezt az oldalt, előbb be kell jelentkezned!!";
    header("location: error.php");
}
$kitoltotte = "SELECT meresiazon,sorozat FROM valaszok, kerdesek where meresiazon like '".$felhasznalo."'  and valaszok.kerdesid=kerdesek.kerdesid and sorozat='$teszt'";
/*
$kitoltotte = "SELECT meresiazon FROM valaszok, kerdesek where valaszok.meresiazon = '$felhasznalo' and kerdesek.sorozat='$teszt'";
*/
       /* 
	   $engedely = mysqli_query($conn, $kitoltotte);
        if(mysqli_num_rows($engedely)>=1){
             $_SESSION['uzenet'] = "Ezt a tesztet már kitöltötted";
    header("location: profile.php");

        } 
		*/
		
$aktivteszt = "SELECT * FROM sorozatok where név like '$teszt' and aktiv=0 ";
$aktiv = mysqli_query($conn, $aktivteszt);
if(mysqli_num_rows($aktiv)>=1){
    $_SESSION['message'] = "Ez a teszt nem aktív";
    header("location: error.php");
    
}

        
        

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$idolekerd="SELECT kitoltesi_ido FROM sorozatok WHERE név like '$teszt'";
$idoeredmeny=mysqli_query($conn,$idolekerd);
while($s=mysqli_fetch_assoc($idoeredmeny)){
    $ido=$s['kitoltesi_ido'];
}

?>
<html lang="hu-HU">
    <head>
        <meta charset="UTF-8">
        <title>Matek teszt</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/jquery-3.3.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script>$(document).ready(function () {
                $('div').not('#0, .progress, .progress-bar').hide();
            });
            
            
            </script> 
            <script>
var lejart=false;            
 
// Set the date we're counting down to
var most = new Date().getTime();
var newDateObj = new Date(most + <?php echo $ido;?>*60000);

var countDownDate = new Date(newDateObj).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds

  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML =  hours + ": " + minutes + ": " +seconds;
 
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    lejart=true;
    if(lejart==true){
    $(document).ready(function () {
                $('div,#demo').not('.progress, .progress-bar').hide(1000,function(){
                                                        $('#lejart').show(1000);
                                                    });
            });
    
    
}
  }
}, 1000);



</script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/refreshform.css">
        <link href="https://fonts.googleapis.com/css?family=Pacifico|Roboto:400,500,700" rel="stylesheet">
    </head>
    <body>
        <p id="demo"></p>

             <?php
//A tömb létrehozása
        $kerdeslista = array(
            'tipus' => array(),
            'opcioegy' => array(),
            'opcioketto' => array(),
            'opcioharom' => array(),
            'opcionegy' => array(),
            'kerdes' => array(),
            'szoveg' => array(),
            'kerdesid' => array(),
            'opcioegykep' => array(),
            'opciokettokep' => array(),
            'opcioharomkep' => array(),
            'opcionegykep' => array(),
            'szovehkep' => array(),
            'kerdeskep' => array(),
        );

//SQL lekérdezés  

        $sqles = "SELECT tipus,opcioegy,opcioketto,opcioharom,opcionegy,kerdes,szoveg,kerdesid,opcioegykep,opciokettokep,opcioharomkep,opcionegykep,szovehkep,kerdeskep FROM kerdesek WHERE sorozat='$teszt' order by rand()";
        $feladatsor = mysqli_query($conn, $sqles);

//a többdimenziós tömb feltöltése

        while ($news = mysqli_fetch_array($feladatsor)) {
            $kerdeslista[] = array(
                'tipus' => $news['tipus'],
                'opcioegy' => $news['opcioegy'],
                'opcioketto' => $news['opcioketto'],
                'opcioharom' => $news['opcioharom'],
                'opcionegy' => $news['opcionegy'],
                'kerdes' => $news['kerdes'],
                'szoveg' => $news['szoveg'],
                'kerdesid' => $news['kerdesid'],
                'opcioegykep' => $news['opcioegykep'],
                'opciokettokep' => $news['opciokettokep'],
                'opcioharomkep' => $news['opcioharomkep'],
                'opcionegykep' => $news['opcionegykep'],
                'szovehkep' => $news['szovehkep'],
                'kerdeskep' => $news['kerdeskep']
            );
        }

        $ossz = mysqli_num_rows($feladatsor);



        for ($row = 0; $row <= $ossz; $row++) { 

            //-----------------RADIO ----------------  

            if ($kerdeslista[$row]['tipus'] == 1) {
                ?>
                <div class="progress">
  <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="<?php echo $ossz ?>" style="width:<?php echo ($row/$ossz*100) ?>%"></div>
  <?php echo $row?>/<?php echo $ossz?>
</div>
                <div name="<?php echo $row; ?>" id="<?php echo $row; ?>" class="mind"> 
                    <form class="form-style-5" accept-charset="utf-8" onkeypress="return event.keyCode != 13;">
                        
                        <p class="feladat"><?php echo $kerdeslista[$row]["szoveg"] ?></p>
                        <img class="math-img"  src="img/<?php echo $kerdeslista[$row]["szovehkep"] ?>" alt="" onerror="this.style.display='none'" >
                        <p class="leiras"><?php echo $kerdeslista[$row]["kerdes"] ?></p>
                        <img src="img/<?php echo $kerdeslista[$row]["kerdeskep"] ?>" alt="" onerror="this.style.display='none'">
                        <input type="hidden" name="kerdesid" id="kerdesid<?php echo $row; ?>" value="<?php echo $kerdeslista[$row]['kerdesid']; ?>">
                        <input type="hidden" name="meresiazon" id="meresiazon<?php echo $row; ?>" value="<?php echo $_SESSION['meresiazon'] ?>">
                        <input type="hidden" name="kerdesid" id="kerdes<?php echo $row; ?>" value="<?php echo $kerdeslista[$row]['kerdes'] ?>">
                        <input type="radio" class="hidden" value="" name="valasz<?php echo $row; ?>" checked="checked">
                        <label class="container"><?php echo $kerdeslista[$row]['opcioegy'] ?>
                            <img src="img/<?php echo $kerdeslista[$row]['opcioegykep'] ?>" alt="" onerror="this.style.display='none'">
                            <input type="radio" name="valasz<?php echo $row; ?>" value="<?php echo $kerdeslista[$row]['opcioegy'] ?>">
                            <span class="checkmark1"></span>
                        </label>
                        <label class="container"><?php echo $kerdeslista[$row]['opcioketto'] ?> <img src="img/<?php echo $kerdeslista[$row]['opciokettokep'] ?>" alt="">
                            <input type="radio" name="valasz<?php echo $row; ?>" value="<?php echo $kerdeslista[$row]['opcioketto'] ?>">
                            <span class="checkmark1"></span>
                        </label>
                        <label class="container"> <?php echo $kerdeslista[$row]['opcioharom'] ?> <img src="img/<?php echo $kerdeslista[$row]['opcioharomkep'] ?>" alt="">
                            <input type="radio" name="valasz<?php echo $row; ?>" value="<?php echo $kerdeslista[$row]['opcioharom'] ?>">
                            <span class="checkmark1"></span>
                        </label>
                        <label class="container"><?php echo $kerdeslista[$row]['opcionegy'] ?> <img src="img/<?php echo $kerdeslista[$row]['opcionegykep'] ?>" alt="">
                            <input type="radio" name="valasz<?php echo $row; ?>" value="<?php echo $kerdeslista[$row]['opcionegy'] ?>">
                            <span class="checkmark1"></span>
                        </label>
                        <input type="button" id="submit<?php echo $row; ?>" value="tovább ->>"/>
                        <?php
//------------------------RADIO GOMBOT FELDOLGOZÓ SCRIPT KEZDETE-----------------------------------------------
                        ?>
                        <script>$(document).ready(function () {
                                $("#submit<?php echo $row; ?>").click(function () {
                                    var meresiazon = "<?php echo $_SESSION ['meresiazon'] ?>";
                                    var kerdesid = "<?php echo $kerdeslista[$row]['kerdesid']; ?>";
                                    var valasz = $("input[name='valasz<?php echo $row; ?>']:checked").val();
                                    if(valasz==""){alert("Kérlek válaszolj a kérdésre!")}else{
                                    $.post("refreshform.php", {meresiazon1: meresiazon, kerdesid1: kerdesid, valasz1: valasz},
                                            function (data) {
                                                
                                                    $('#<?php echo $row; ?>').hide(1000, function () {
                                                        $('#<?php echo $row + 1; ?>').show(1000);
                                                    });
                                                
                                            });
                                    };
                                });
                            });
                        </script>
                        <?php
//------------------------RÁDIÓ GOMBOT FELDOLGOZÓ SCRIPT VÉGE-----------------------------------------------
                        ?>
                    </form>
                </div>
                <?php
                //--------------------TEXT-----------------------
            } elseif ($kerdeslista[$row]['tipus'] == 2) {
                ?>
                <div name="<?php echo $row; ?>" id="<?php echo $row; ?>" class="mind">
                    <div class="progress">
  <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="<?php echo $ossz ?>" style="width:<?php echo ($row/$ossz*100) ?>%">
      <?php echo $row?>/<?php echo $ossz?>
  </div>
</div>
                    <form class="form-style-5" accept-charset="utf-8" onkeypress="return event.keyCode != 13;">
                       
                        <img class="math-img"  src="img/<?php echo $kerdeslista[$row]["szovehkep"] ?>" alt="" onerror="this.style.display='none'" >
                         <p class="feladat"><?= $kerdeslista[$row]["szoveg"] ?></p>
                        <p class="leiras"><?= $kerdeslista[$row]["kerdes"] ?></p>
                        <p><img src="img/<?php echo $kerdeslista[$row]["kerdeskep"] ?>" alt="" onerror="this.style.display='none'">
                            <input type="hidden" name="kerdesid" id="kerdesid<?php echo $row; ?>" value="<?php echo $kerdeslista[$row]['kerdesid']; ?>">
                            <input type="hidden" name="meresiazon" id="meresiazon<?php echo $row; ?>" value="<?php echo $_SESSION['meresiazon'] ?>">
                            <input type="hidden" name="kerdes" id="kerdes<?php echo $row; ?>" value="<?php echo $kerdeslista[$row]['kerdes'] ?>">
                            <input type="text"  id="<?php [$row] ?>" name="valasz<?php echo $row; ?>" autocomplete="off">  
                            <input type="button" id="submit<?php echo $row; ?>" value="tovább ->>" >
                            <script>
        <?php
//------------------------SZÖVEGET FELDOLGOZÓ SCRIPT KEZDETE-----------------------------------------------
        ?>
                                $(document).ready(function () {
                                    $("#submit<?php echo $row; ?>").click(function () {
                                        var meresiazon = "<?php echo $_SESSION['meresiazon'] ?>";
                                        
                                        var kerdesid = "<?php echo $kerdeslista[$row]['kerdesid']; ?>";
                                        var valasz = $("input[name='valasz<?php echo $row; ?>']").val();
                                        if (valasz === "") {
                                            alert("Kérlek írj be valamit!");
                                        } else {
                                            $.post("refreshform.php", {meresiazon1: meresiazon, kerdesid1: kerdesid, valasz1: valasz},
                                                    function (data) {
                                                        {
                                                            $('#<?php echo $row; ?>').hide(1000, function () {
                                                                $('#<?php echo $row + 1; ?>').show(1000);
                                                            });
                                                        }
                                                        ;

                                                    });
                                        }
                                        ;
                                    });
                                });
                            </script>
                            <?php
//------------------------SZÖVEGET FELDOLGOZÓ SCRIPT VÉGE-----------------------------------------------
                            ?>
                    </form>
                </div>
                <?php
            } elseif ($kerdeslista[$row]['tipus'] == 3) {

                //--------------------------CHECKBOX------------------
                ?>
                <div name="<?php echo $row; ?>" id="<?php echo $row; ?>" class="mind" method="post">
                    <div class="progress">
  <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="<?php echo $ossz ?>" style="width:<?php echo ($row/$ossz*100) ?>%">
      <?php echo $row?>/<?php echo $ossz?>
  </div>
</div>
                    <form class="form-style-5" accept-charset="utf-8" name="form<?php echo $row; ?>" method="post" >
                        <p class="feladat"><?php echo $kerdeslista[$row]["szoveg"] ?></p>
                        <img class="math-img"  src="img/<?php echo $kerdeslista[$row]["szovehkep"] ?>" alt="" onerror="this.style.display='none'" >
                        <p class="leiras"><?php echo $kerdeslista[$row]["kerdes"] ?></p>
                        <img src="img/<?php echo $kerdeslista[$row]["kerdeskep"] ?>" alt="" onerror="this.style.display='none'">
                        <input type="hidden" name="kerdesid" id="kerdesid<?php echo $row; ?>" value="<?php echo $kerdeslista[$row]['kerdesid']; ?>">
                        <input type="hidden" name="meresiazon" id="meresiazon<?php echo $row; ?>" value="<?php echo $_SESSION['meresiazon'] ?>">
                        <input type="hidden" name="kerdes" id="kerdes<?php echo $row; ?>" value="<?php echo $kerdeslista[$row]['kerdes'] ?>">

                        <label class="container"> <?php echo $kerdeslista[$row]['opcioegy'] ?><img src="img/<?php echo $kerdeslista[$row]['opcioegykep'] ?>" alt="">
                            <input type="checkbox" name="valasz<?php echo $row; ?>[]" value="<?php echo $kerdeslista[$row]['opcioegy'] ?>">  
                            <span class="checkmark"></span>
                        </label>
                        <br>
                        <label class="container"><?php echo $kerdeslista[$row]['opcioketto'] ?> <img src="img/<?php echo $kerdeslista[$row]['opciokettokep'] ?>" alt="">
                            <input type="checkbox" name="valasz<?php echo $row; ?>[]" value="<?php echo $kerdeslista[$row]['opcioketto'] ?>"> 
                            <span class="checkmark"></span>
                        </label>
                        <label class="container"> <?php echo $kerdeslista[$row]['opcioharom'] ?> <img src="img/<?php echo $kerdeslista[$row]['opcioharomkep'] ?>" alt="">
                            <input type="checkbox" name="valasz<?php echo $row; ?>[]" value="<?php echo $kerdeslista[$row]['opcioharom'] ?>"> 
                            <span class="checkmark"></span>
                        </label>
                        <label class="container"><?php echo $kerdeslista[$row]['opcionegy'] ?> <img src="img/<?php echo $kerdeslista[$row]['opcionegykep'] ?>" alt="">
                            <input type="checkbox" name="valasz<?php echo $row; ?>[]" value="<?php echo $kerdeslista[$row]['opcionegy'] ?>"> 
                            <span class="checkmark"></span>
                        </label>
                        <input type="button" name="submit<?php echo $row; ?>" id="submit<?php echo $row; ?>" value="tovább ->>">
                    </form>
                    <?php
//------------------------CHECKBOXOT FELDOLGOZÓ SCRIPT KEZDETE-----------------------------------------------
                    ?>
                    <script>$(document).ready(function () {
                            $("#submit<?php echo $row; ?>").click(function () {
                                var valaszok = [];
                                var meresiazon = "<?php echo $_SESSION['meresiazon'] ?>";
                                
                                var kerdesid = "<?php echo $kerdeslista[$row]['kerdesid']; ?>";

                                /* look for all checkboes that have a parent id called 'checkboxlist' attached to it and check if it was checked */
                                $("input[name='valasz<?php echo $row; ?>[]']:checked").each(function () {
                                    valaszok.push($(this).val());
                                });

                                /* we join the array separated by the comma */
                                var valasz;
                                valasz = valaszok.join(',');

                                /* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
                                if (valasz.length > 0) {
                                    $.post('refreshform.php', {meresiazon1: meresiazon, kerdesid1: kerdesid, valasz1: valasz}, function (data) {
                                        $('#<?php echo $row; ?>').hide(1000, function () {
                                            $('#<?php echo $row + 1; ?>').show(1000);
                                        });
                                    });
                                } else {
                                    alert("Kérlek jelölj be legalább egy mezőt!");
                                }
                            });
                        });
                    </script>
                    <?php
//------------------------CHECKBOXOT FELDOLGOZÓ SCRIPT VÉGE-----------------------------------------------
                    ?>
                </div>

                <?php
            } elseif ($kerdeslista[$row]['tipus'] == 4) {

//-------------------------------LEGÖRDÜLŐ MENÜ 4 LEHETŐSÉGGEL--------------------------
                ?>
                <div name="<?php echo $row; ?>" id="<?php echo $row; ?>" class="mind">
                    <div class="progress">
  <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="<?php echo $ossz ?>" style="width:<?php echo ($row/$ossz*100) ?>%">
      <?php echo $row?>/<?php echo $ossz?>
  </div>
</div>
                    <form class="form-style-5" accept-charset="utf-8" onkeypress="return event.keyCode != 13;">
                        <p class="feladat"><?= $kerdeslista[$row]["szoveg"] ?></p>
                        <img class="math-img"  src="img/<?php echo $kerdeslista[$row]["szovehkep"] ?>" alt="" onerror="this.style.display='none'" >
                        <p class="leiras"><?= $kerdeslista[$row]["kerdes"] ?></p>
                        <img src="img/<?php echo $kerdeslista[$row]["kerdeskep"] ?>" alt="" onerror="this.style.display='none'">
                        <input type="hidden" name="kerdesid" id="kerdesid<?php echo $row; ?>" value="<?php echo $kerdeslista[$row]['kerdesid']; ?>">
                        <input type="hidden" name="meresiazon" id="meresiazon<?php echo $row; ?>" value="<?php echo $_SESSION['meresiazon'] ?>">
                        <input type="hidden" name="kerdes" id="kerdes<?php echo $row; ?>" value="<?php echo $kerdeslista[$row]['kerdes'] ?>">
                        <select name="valasz<?php echo $row; ?>">
                            <option value="">Kérlek válaszd ki a megfelelőt</option>
                            <option value="<?php echo $kerdeslista[$row]['opcioegy'] ?>"><?= $kerdeslista[$row]['opcioegy'] ?></option>
                            <option value="<?php echo $kerdeslista[$row]['opcioketto'] ?>"><?= $kerdeslista[$row]['opcioketto'] ?></option>
                            <option value="<?php echo $kerdeslista[$row]['opcioharom'] ?>"><?= $kerdeslista[$row]['opcioharom'] ?></option>
                            <option value="<?php echo $kerdeslista[$row]['opcionegy'] ?>"><?= $kerdeslista[$row]['opcionegy'] ?></option>
                        </select>
                        <input type="button" id="submit<?php echo $row; ?>" value="tovább ->>" >
                        <?php
//------------------------LEGÖRDÜLŐ MENÜ FELDOLGOZÓ SCRIPT KEZDETE-----------------------------------------------
                        ?>
                        <script>$(document).ready(function () {
                                $("#submit<?php echo $row; ?>").click(function () {
                                    var meresiazon = "<?php echo $_SESSION['meresiazon'] ?>";
                                
                                    var kerdesid = "<?php echo $kerdeslista[$row]['kerdesid']; ?>";
                                    var valasz = $("select[name='valasz<?php echo $row; ?>']").val();
                                    if (valasz==""){alert("Kérlek válaszolj a kérdésre")}
                                    else{

                                    $.post("refreshform.php", {meresiazon1: meresiazon, kerdesid1: kerdesid, valasz1: valasz},
                                            function (data) {

                                                {
                                                    $('#<?php echo $row; ?>').hide(1000, function () {
                                                        $('#<?php echo $row + 1; ?>').show(1000);
                                                    });
                                                }}
                                            )};
                                });
                            });
                        </script>
                        <?php
//------------------------LEGÖRDÜLŐ MENÜ FELDOLGOZÓ SCRIPT VÉGE-----------------------------------------------
                        ?>
                    </form>
                </div>
                <?php
            }
//-------------TÖBB SZÖVEGBEVITEL------------------
            elseif ($kerdeslista[$row]['tipus'] == 5) {
                ?>
                <div name="<?php echo $row; ?>" id="<?php echo $row; ?>" class="mind">
                    <div class="progress">
  <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="<?php echo $ossz ?>" style="width:<?php echo ($row/$ossz*100) ?>%">
      <?php echo $row?>/<?php echo $ossz?>
  </div>
</div>
                    <form class="form-style-5" accept-charset="utf-8" onkeypress="return event.keyCode != 13;">
                        <p class="feladat"><?= $kerdeslista[$row]["szoveg"] ?></p>
                        <img class="math-img"  src="img/<?php echo $kerdeslista[$row]["szovehkep"] ?>" alt="" onerror="this.style.display='none'" >
                        <p class="leiras"><?= $kerdeslista[$row]["kerdes"] ?></p>
                        <br><img src="img/<?php echo $kerdeslista[$row]["kerdeskep"] ?>" alt="" onerror="this.style.display='none'">
                        <input type="hidden" name="kerdesid" id="kerdesid<?php echo $row; ?>" value="<?php echo $kerdeslista[$row]['kerdesid']; ?>">
                        <input type="hidden" name="meresiazon" id="meresiazon<?php echo $row; ?>" value="<?php echo $_SESSION['meresiazon'] ?>">
                        <input type="hidden" name="kerdes" id="kerdes<?php echo $row; ?>" value="<?php echo $kerdeslista[$row]['kerdes'] ?>">
                        <p class="justified-sorozat" >
                            <input type="text"  class="sorozat" name="avalasz<?php echo $row; ?>" autocomplete="off"> 
                            <input type="text"  class="sorozat" name="bvalasz<?php echo $row; ?>" autocomplete="off"> 
                            <input type="text"  class="sorozat" name="cvalasz<?php echo $row; ?>" autocomplete="off"> 
                            <input type="text"  class="sorozat" name="dvalasz<?php echo $row; ?>" autocomplete="off"> 
                        </p>
                        <input type="button" id="submit<?php echo $row; ?>" value="tovább ->>">
                        <?php
//------------------------TÖBB SZÖVEGBEVITELI MEZŐT FELDOLGOZÓ SCRIPT KEZDETE-----------------------------------------------
                        ?>
                        <script>
                            $(document).ready(function () {
                                $("#submit<?php echo $row; ?>").click(function () {

                                    var meresiazon = "<?php echo $_SESSION['meresiazon'] ?>";
                                    
                                    var kerdesid = "<?php echo $kerdeslista[$row]['kerdesid']; ?>";
                                    var valasza = $("input[name='avalasz<?php echo $row; ?>']").val();
                                    var valaszb = $("input[name='bvalasz<?php echo $row; ?>']").val();
                                    var valaszc = $("input[name='cvalasz<?php echo $row; ?>']").val();
                                    var valaszd = $("input[name='dvalasz<?php echo $row; ?>']").val();
                                    var valasz;
                                    valasz = valasza + "," + valaszb + "," + valaszc + "," + valaszd;
                                    if (valasza == "" || valaszb == "" || valaszc == "" || valaszd == "") {
                                        alert("Kérlek válaszolj a kérdésre!");
                                    } else {
                                        $.post("refreshform.php", {meresiazon1: meresiazon,  kerdesid1: kerdesid, valasz1: valasz},
                                                function (data) {
                                                    {
                                                        $('#<?php echo $row; ?>').hide(1000, function () {
                                                            $('#<?php echo $row + 1; ?>').show(1000);
                                                        });
                                                    }
                                                    ;
                                                });
                                    }
                                    ;
                                });
                            });
                        </script>
                        <?php
//------------------------TÖBB SZÖVEGBEVITELI MEZŐT FELDOLGOZÓ SCRIPT SCRIPT VÉGE-----------------------------------------------
                        ?>
                    </form>
                </div>

                <?php
                //-----------------KETTŐ RÁDIÓGOMB------------------------------
            } else if ($kerdeslista[$row]['tipus'] == 6) {
                ?><div name="<?php echo $row; ?>" id="<?php echo $row; ?>" class="mind"> 
                <div class="progress">
  <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="<?php echo $ossz ?>" style="width:<?php echo ($row/$ossz*100) ?>%">
      <?php echo $row?>/<?php echo $ossz?>
  </div>
</div>
                    <form class="form-style-5" accept-charset="utf-8" onkeypress="return event.keyCode != 13;">
                        <img class="math-img"  src="img/<?php echo $kerdeslista[$row]["szovehkep"] ?>" alt="" onerror="this.style.display='none'" >
                        <p class="feladat"><?= $kerdeslista[$row]["szoveg"] ?></p>
                        
                        <p class="leiras"><?= $kerdeslista[$row]["kerdes"] ?></p>
                        <img src="img/<?php echo $kerdeslista[$row]["kerdeskep"] ?>" alt="" onerror="this.style.display='none'">
                        <input type="hidden" name="kerdesid" id="kerdesid<?php echo $row; ?>" value="<?php echo $kerdeslista[$row]['kerdesid']; ?>">
                        <input type="hidden" name="meresiazon" id="meresiazon<?php echo $row; ?>" value="<?php echo $_SESSION['meresiazon'] ?>">
                        <input type="hidden" name="kerdesid" id="kerdes<?php echo $row; ?>" value="<?php echo $kerdeslista[$row]['kerdes'] ?>">
                        <input type="radio" class="hidden" value="" name="valasz<?php echo $row; ?>" checked="checked">
                        <label class="container"><?php echo $kerdeslista[$row]['opcioegy'] ?>
                            <img src="img/<?php echo $kerdeslista[$row]['opcioegykep'] ?>" alt=""> 
                            <input type="radio" name="valasz<?php echo $row; ?>" value="<?php echo $kerdeslista[$row]['opcioegy'] ?>"
                                   <span class="checkmark1"></span>
                        </label>
                        <label class="container"><?php echo $kerdeslista[$row]['opcioketto'] ?> 
                            <img src="img/<?php echo $kerdeslista[$row]['opciokettokep'] ?>" alt="">
                            <input type="radio" name="valasz<?php echo $row; ?>" value="<?php echo $kerdeslista[$row]['opcioketto'] ?>" 
                                   <span class="checkmark1"></span>
                        </label>
                        <input type="button" id="submit<?php echo $row; ?>" value="tovább ->>" />
                        <?php
//------------------------KETTŐ RÁDIO GOMBOT FELDOLGOZÓ SCRIPT KEZDETE-----------------------------------------------
                        ?>
                        <script>
                            $(document).ready(function () {
                                $("#submit<?php echo $row; ?>").click(function () {
                                    var meresiazon = "<?php echo $_SESSION['meresiazon'] ?>";
                                    
                                    var kerdesid = "<?php echo $kerdeslista[$row]['kerdesid']; ?>";
                                    var valasz = $("input[name='valasz<?php echo $row; ?>']:checked").val();
                                    if (valasz === "") {
                                        alert("kérlek jelölj be valamit!");
                                    } else {
                                        $.post("refreshform.php", {meresiazon1: meresiazon, kerdesid1: kerdesid, valasz1: valasz},
                                                function (data) {
                                                    {
                                                        $('#<?php echo $row; ?>').hide(1000, function () {
                                                            $('#<?php echo $row + 1; ?>').show(1000);
                                                        });
                                                    }
                                                });
                                    }
                                });
                            });
                        </script>
                        <?php
//------------------------KETTŐ RÁDIO GOMBOT FELDOLGOZÓ SCRIPT VÉGE-----------------------------------------------                            
                        ?>
                    </form>
                </div>
                <?php
            } elseif ($kerdeslista[$row]['tipus'] == 7) {

//-------------------------------OPTIONSELECT 3 LEHETŐSÉGGEL--------------------------
                ?>
                <div name="<?php echo $row; ?>" id="<?php echo $row; ?>" class="mind">
                    <div class="progress">
  <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="<?php echo $ossz ?>" style="width:<?php echo ($row/$ossz*100) ?>%">
      <?php echo $row?>/<?php echo $ossz?>
  </div>
</div>
                    <form class="form-style-5" accept-charset="utf-8" onkeypress="return event.keyCode != 13;">
                        <p class="feladat"><?php echo $kerdeslista[$row]["szoveg"] ?></p>
                        <img class="math-img"  src="img/<?php echo $kerdeslista[$row]["szovehkep"] ?>" alt="" onerror="this.style.display='none'" >
                        <p class="leiras"><?php echo $kerdeslista[$row]["kerdes"] ?></p>
                        <img src="img/<?php echo $kerdeslista[$row]["kerdeskep"] ?>" alt="" onerror="this.style.display='none'">
                        <input type="hidden" name="kerdesid" id="kerdesid<?php echo $row; ?>" value="<?php echo $kerdeslista[$row]['kerdesid']; ?>">
                        <input type="hidden" name="meresiazon" id="meresiazon<?php echo $row; ?>" value="<?php echo $_SESSION['meresiazon'] ?>">
                        <input type="hidden" name="kerdes" id="kerdes<?php echo $row; ?>" value="<?php echo $kerdeslista[$row]['kerdes'] ?>">
                        <select name="valasz<?php echo $row; ?>">
                            <option value="">Kérlek válaszd ki a megfelelőt! </option>
                            <option value="<?php echo $kerdeslista[$row]['opcioegy'] ?>"><?= $kerdeslista[$row]['opcioegy'] ?></option>
                            <option value="<?php echo $kerdeslista[$row]['opcioketto'] ?>"><?= $kerdeslista[$row]['opcioketto'] ?></option>
                            <option value="<?php echo $kerdeslista[$row]['opcioharom'] ?>"><?= $kerdeslista[$row]['opcioharom'] ?></option>
                        </select>
                        <input type="button" id="submit<?php echo $row; ?>" value="tovább ->>">
                        <?php
//------------------------3 LEHETŐSÉGES LEGÖRDÜLŐ MENÜT FELDOLGOZÓ SCRIPT KEZDETE-----------------------------------------------
                        ?>
                        <script>$(document).ready(function () {
                                $("#submit<?php echo $row; ?>").click(function () {
                                    var meresiazon = "<?php echo $_SESSION['meresiazon'] ?>";
                                    
                                    var kerdesid = "<?php echo $kerdeslista[$row]['kerdesid']; ?>";
                                    var valasz = $("select[name='valasz<?php echo $row; ?>']").val();
                                    if (valasz==""){alert("Kérlek válaszolj a kérdésre")}
                                    else{

                                    $.post("refreshform.php", {meresiazon1: meresiazon,  kerdesid1: kerdesid, valasz1: valasz},
                                            function (data) {

                                                {
                                                    $('#<?php echo $row; ?>').hide(1000, function () {
                                                        $('#<?php echo $row + 1; ?>').show(1000);
                                                    });
                                                }}
                                            )};
                                });
                            });
                        </script>
                        <?php
//------------------------3 LEHETŐSÉGES LEGÖRDÜLŐ MENÜT FELDOLGOZÓ SCRIPT VÉGE-----------------------------------------------
                        ?>
                    </form>
                </div>
                <?php
                // 2 Rádió és 1 szöveg
            } elseif ($kerdeslista[$row]['tipus'] == 8) {
                ?> <div name="<?php echo $row?>" id="<?php echo $row; ?>" class="mind">
                    <div class="progress">
  <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="<?php echo $ossz ?>" style="width:<?php echo ($row/$ossz*100) ?>%">
      <?php echo $row?>/<?php echo $ossz?>
  </div>
</div>
                    <form class="form-style-5" accept-charset="utf-8" onkeypress="return event.keyCode != 13;">
                        <p class="feladat"><?php echo $kerdeslista[$row]["szoveg"] ?></p>
                        <img class="math-img"  src="img/<?php echo $kerdeslista[$row]["szovehkep"] ?>" alt="" onerror="this.style.display='none'" >
                        <p class="leiras"><?php echo $kerdeslista[$row]["kerdes"] ?></p>
                        <img src="img/<?php echo $kerdeslista[$row]["kerdeskep"] ?>" alt="" onerror="this.style.display='none'">
                        <input type="hidden" name="kerdesid" id="kerdesid<?php echo $row; ?>" value="<?php echo $kerdeslista[$row]['kerdesid']; ?>">
                        <input type="hidden" name="meresiazon" id="meresiazon<?php echo $row; ?>" value="<?php echo $_SESSION['meresiazon'] ?>">
                        <input type="hidden" name="kerdes" id="kerdes<?php echo $row; ?>" value="<?php echo $kerdeslista[$row]['kerdes'] ?>">
                        <input type="radio" class="hidden" value="" name="valasz<?php echo $row; ?>" checked="checked">
                        <label class="container"><?php echo $kerdeslista[$row]['opcioegy'] ?>
                            <img src="img/<?php echo $kerdeslista[$row]['opcioegykep'] ?>" alt=""> 
                            <input type="radio" class="valasz<?php echo $row; ?>" name="valasz<?php echo $row; ?>" value="<?php echo $kerdeslista[$row]['opcioegy'] ?>"
                                   <span class="checkmark1"></span>
                        </label>
                        <label class="container"><?php echo $kerdeslista[$row]['opcioketto'] ?> 
                            <img src="img/<?php echo $kerdeslista[$row]['opciokettokep'] ?>" alt="">
                            <input type="radio" class="valasz<?php echo $row; ?>" name="valasz<?php echo $row; ?>" value="<?php echo $kerdeslista[$row]['opcioketto'] ?>" 
                                   <span class="checkmark1"></span>
                        </label>
                        <input type="text" id="<?php [$row] ?>" name="szvalasz<?php echo $row; ?>" autocomplete="off">
                        <input type="button" id="submit<?php echo $row; ?>" value="tovább ->>">
                        <script>
                            $(document).ready(function () {
                                $("#submit<?php echo $row; ?>").click(function () {
                                    var meresiazon = "<?php echo $_SESSION['meresiazon'] ?>";
                                    
                                    var kerdesid = "<?php echo $kerdeslista[$row]['kerdesid']; ?>";
                                    var rvalasz = $("input[name='valasz<?php echo $row; ?>']:checked").val();
                                    var szvalasz = $("input[name='szvalasz<?php echo $row; ?>']").val();
                                    var valasz = rvalasz + ":" + szvalasz+";";
                                    if (szvalasz == "" || rvalasz=="") {
                                        alert("Kérlek válaszolj a kérdésre")
                                    } else {
                                       $.post("refreshform.php", {meresiazon1: meresiazon, kerdesid1: kerdesid, valasz1: valasz},
                                            function (data) {
                                                {
                                                    $('#<?php echo $row; ?>').hide(1000, function () {
                                                        $('#<?php echo $row + 1; ?>').show(1000);
                                                    });
                                                }
                                            });
                                };
                                });
                            });
                        </script>
                     </form>
                    </div>
                        <?php
                    }
                };
                ?> 
                <div id="<?php echo $ossz ?>"  class="form-style-5">
                    <form action="profile.php">
                        <h1>Sikeres teszt kitöltés! </h1>
                        <input type="submit" value="VISSZATÉRÉS A FŐOLDALRA!">
                    </form>

                </div>
                <div id="lejart"  class="form-style-5">
                    <form action="profile.php">
                        <h1>Lejárt az idő </h1>
                        <input type="submit" value="VISSZATÉRÉS A FŐOLDALRA!">
                    </form>

                </div>
                </body>
                </html>
