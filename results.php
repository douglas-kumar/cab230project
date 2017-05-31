<?php require './includes/partials/header.inc' ?>
<?php require './includes/scripts/results.inc' ?>
<?php
	if (empty($results)) {
		$results = 0;
	} else {

		global $database;
		global $errors;

		$rats = array("itemId" => "rating");
		
		try {
            foreach ($results as $result) {
                $query = "SELECT AVG(rating) AS rat FROM reviews GROUP BY itemID Having itemId = :id";
                $stmt = $database->prepare($query);
                $stmt->bindParam("id", $result['id']);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $avg = $stmt->fetch();
                    $rats[$result['id']] = $avg['rat'];
                } else {
                    $rats[$result['id']] = "No ratings";
                }
            }
        } catch (PDOException $e) {
            die($e.getMessage());
        }        
            $locs = array();
            foreach ($results as $result) {
                array_push($locs, [$result['latitude'], $result['longitude']]);
            }
            $sumLats = 0;
            foreach ($locs as $loc) {
                $sumLats += $loc[0];
            }
            $sumLongs = 0;
            foreach($locs as $loc) {
                $sumLongs += $loc[1];
            }
            $origin = array();
            $origin[0] = round(($sumLats / count($locs)), 8);
            $origin[1] = round(($sumLongs / count($locs)), 7);
            $ids = array();
            foreach($results as $result) {
                array_push($ids, [$result['id'], $result['name'], $result['street'], $result['suburb']]);
            }
    }

?>

<h2>Search Results</h2>

    <?php 
    if (!empty($results)) {
        echo "<div id=\"resultsmap\" style=\"width:90%; height:350px; margin-left:auto; margin-right:auto; min-width: 400px\"></div>";
    }
    ?>
    <script type="text/javascript" async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDh4t1Pv3L1nXzZxB8ssKQhO_d0CmdaMV0&callback=createMap"></script>
    <script type="text/javascript">
        function createMap(locs, origin, ids) {
            var map;
                    
            var locs = <?php echo json_encode($locs) ?>;
            var origin = <?php echo json_encode($origin) ?>;
            var ids = <?php echo json_encode($ids) ?>;
            
            var middle = {lat: origin[0], lng: origin[1]};
            
            map = new google.maps.Map(document.getElementById('resultsmap'), {
                center: middle,
                zoom: 11
            });
            
            var infowindow, i;
            for (i = 0; i < locs.length; i++) {
                (function(index) {
                var marker = new google.maps.Marker({
                  position: new google.maps.LatLng(parseFloat(locs[index][0]), parseFloat(locs[index][1])),
                  title: ids[index][1],
                  map: map
                });
                   
               infowindow = new google.maps.InfoWindow();
        
               google.maps.event.addListener(marker, 'click', function () {
                   infowindow.setContent('<a href="park.php?itemId=' + ids[index][0] + '">' + ids[index][1] + '</a><br />' + ids[index][2] + ', ' + ids[index][3]);
                   infowindow.open(map, marker);
               }); 
                   
                })(i);
            }
        }
		
    </script>
<br>
	<table>
		<tr>
			<th>Rating</th>
			<th>Code</th>
			<th>Name</th>
			<th>Street</th>
			<th>Suburb</th>
		</tr>

		<?php
			if ($results != 0) {
				foreach($results as $result) {
				    $name = ucwords(strtolower($result['name']), " \.(");
				    $street = ucwords(strtolower($result['street']), " \.(");
				    $suburb = ucwords(strtolower($result['suburb']), " \.(");
					echo "<tr><td>";
					if ($rats[$result['id']] != "No ratings") {
						for ($i = 0; $i < floor($rats[$result['id']]); $i++) {
							echo "<img src=\"public/images/star.png\" alt=\"star.png\" >";
						}
					} else {
						echo"<i>No ratings</i>";
					}
					echo "</td>
						  <td>{$result['parkCode']}</td>
						  <td><a href=\"park.php?itemId={$result['id']}\">{$name}</a></td>
						  <td>{$street}</td>
						  <td>{$suburb}</td>
						  </tr>";
				}
			} else {
				echo "<tr><td colspan=\"5\">No items matched your search.</td></tr>";
			}
		?>

	</table>
            
<?php require './includes/partials/footer.inc' ?>