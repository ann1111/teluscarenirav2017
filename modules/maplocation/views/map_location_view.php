<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Using MySQL and PHP with Google Maps</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>

  <body>
	<?php echo form_open('maplocation/location_result'); ?>
	<table>
		<tr> 
			<td>Select Category</td>
			<td>  
				<select name="map_category" > 
				<option value="restaurant"> Restaurant </option>
				<option value="bar"> Bar </option> 
				</select>
			</td> 
		</tr>
		<tr> 
			<td></td>
			<td><input type="submit" name="submit_category" value="SUBMIT"/></td>
		</tr>
	</table>
	<?php echo form_close(); ?>
    
  </body>
</html>