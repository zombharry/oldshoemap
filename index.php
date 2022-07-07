<?php 
include 'hatterfolyamat.php';

?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>terkepteszteles</title>
<script>
var adatok_js=JSON.parse('<?php echo $js_adatok ?>');
var hossz=<?php echo $hossz;?>;


        function initMap() {
		var myLatLng = {lat: 47.092525, lng: 19.739180};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: myLatLng
        });
		 
        var marker,a,szoveg;

		 var infowindow = new google.maps.InfoWindow({
    
  }); 
				  for(a=0; a<hossz; a++){
					   szoveg=					  
				
        marker = new google.maps.Marker({
                
                position: new google.maps.LatLng(adatok_js[a]['szel'],adatok_js[a]['hossz']),
                map: map,
				title: adatok_js[a]['cim'],
				icon: "images/shoes2.png"
				  });
				  
  google.maps.event.addListener(marker, 'click', (function(marker, a) {
            return function() {
                infowindow.setContent("Név:"+adatok_js[a]['boltnev'] +"<br> Cím: "+adatok_js[a]['iranyitoszam']+" "+adatok_js[a]['varos']+" "+adatok_js[a]['utca']+" "+adatok_js[a]['hsz']+"<br> Üzemeltető: "+adatok_js[a]['uzemelteto']+"<br> Kontakt: "+adatok_js[a]['kontakt']+"<br> Tel: "+adatok_js[a]['tel']+"<br> Email: "+adatok_js[a]['email']
);
                infowindow.open(map, marker);
            }
        })(marker, a));
				 };
				 
				};
		
		



      </script>

<body>

<div id="map" style="width:100%;height:900px;display: block;
  margin-left: auto;
  margin-right: auto;"></div>



<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuAerht5AggIdU6IkqPLZ6DvrrgVA9Xpg&callback=initMap">
</script>

</body>
</html>