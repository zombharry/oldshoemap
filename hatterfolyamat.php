<?php 
require 'csatlakozas.php';


$query="select * from terkep";
$result = $conn->query($query);
$adatok = array(
            'id' => array(),
			'boltnev' => array(),
            'varos' => array(),
			'iranyitoszam' => array(),
            'utca' => array(),
			'hsz' => array(),
            'uzemelteto' => array(),
            'kontakt' => array(),
            'tel' => array(),
            'email' => array(),
            'hossz' => array(),
            'szel' => array(),
        );
$hossz=mysqli_num_rows($result);
while ($row = mysqli_fetch_assoc($result)){
  $adatok[] = array(
                'id' => $row['id'],
				'boltnev' => $row['boltnev'],
                'varos' => $row['varos'],
				'iranyitoszam' => $row['iranyitoszam'],
                'utca' => $row['utca'],
				'hsz' => $row['hsz'],
                'uzemelteto' => $row['uzemelteto'],
                'kontakt' => $row['kontakt'],
                'tel' => $row['tel'],
                'email' => $row['email'],
                'hossz' => $row['hossz'],
                'szel' => $row['szel']
            );
  
}
$js_adatok=json_encode($adatok);



?>