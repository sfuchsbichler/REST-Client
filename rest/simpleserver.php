<?php
$methode = $_SERVER['REQUEST_METHOD'];
//$req = explode('/', trim($_SERVER['PATH_INFO'],'/'));
//$dateiname = ($req[isset0]) && !empty($req[0]) ?
//                                       $req[0] : NULL;
$daten = file_get_contents('php://input');

@$link = mysqli_connect( "localhost", "root", "" )or die( "Verbindung zum SQL-Server nicht möglich" );
mysqli_set_charset( $link, "utf8" );

@mysqli_select_db( $link, "rest" )or die( "Datenbankzugriff gescheitert" );
 
switch ($methode) {
  case 'GET':
        class foo
        {
        }

        $sql = "SELECT * FROM schueler";
        $result = mysqli_query( $link, $sql );

        $objectList = array();

        while ($row = mysqli_fetch_assoc( $result )) {
          $myObj = new foo;
          $myObj->id = $row['Schueler_ID'];
          $myObj->name = $row['Name'];
          $myObj->klasse = $row['Klasse'];

          array_push($objectList, $myObj);
        }
        //$myJSON = json_encode($myObj);

        echo json_encode($objectList);

    break;
  case 'POST':
        //$daten_decoded = json_decode($daten);
        //$z = $daten_decoded->x * $daten_decoded->y;

        $schueler = json_decode($daten);

        $stmt = mysqli_prepare($link, "INSERT INTO schueler (Name, Klasse) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $schueler->name, $schueler->klasse);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        //$sql = "INSERT INTO schueler (Schueler_ID, Name, Klasse) VALUES (NULL, '$schueler->name', '$schueler->klasse')";
        //$result = mysqli_query( $link, $sql );

    echo("hinzugefuegteDaten: " . json_encode($schueler));
    break;
  case 'PUT':
    //file_put_contents('files/'.$dateiname, $daten, FILE_APPEND); 
    break;
  case 'DELETE':
    //unlink('files/'.$dateiname); 
    break;
}
?>