<?php 

function locations_callback( $post ) { 
	$locationinfo = get_post_meta( $post->ID );
?>
	<p>
		<div class="sm-row-content custom">
			<label for="date">Opening Date:</label>
			<input type="date" name="date" id="date" value="<?php if ( isset ( $locationinfo['date'] ) ) echo $locationinfo['date'][0]; ?>" />
		</div>
		<div class="sm-row-content custom">
			<label for="street_address">Street Address 1:</label>
			<input type="text" name="street_address" id="street_address" value="<?php if ( isset ( $locationinfo['street_address'] ) ) echo $locationinfo['street_address'][0]; ?>" />
		</div>
		<div class="sm-row-content custom">
			<label for="street_address_2">Street Address 2:</label>
			<input type="text" name="street_address_2" id="street_address_2" value="<?php if ( isset ( $locationinfo['street_address_2'] ) ) echo $locationinfo['street_address_2'][0]; ?>" />
		</div>
		<div class="sm-row-content custom">
			<label for="city">City:</label>
			<input type="text" name="city" id="city" value="<?php if ( isset ( $locationinfo['city'] ) ) echo $locationinfo['city'][0]; ?>" />
		</div>
		<div class="sm-row-content custom">
			<label for="zip">Zip Code:</label>
			<input type="text" name="zip" id="zip" value="<?php if ( isset ( $locationinfo['zip'] ) ) echo $locationinfo['zip'][0]; ?>" />
		</div>
		<div class="sm-row-content custom">
			<label for="position">Review Score:</label>
			<select name="review" id="review">
				<option value="0">-- SELECT STAR REVIEW SCORE --</option>
				<option value="1" <?php if (isset($providerinfo['review']) && $providerinfo['review'][0] == 1){ echo "selected"; }; ?>>1</option>
				<option value="2" <?php if (isset($providerinfo['review']) && $providerinfo['review'][0] == 2){ echo "selected"; }; ?>>2</option>
				<option value="3" <?php if (isset($providerinfo['review']) && $providerinfo['review'][0] == 3){ echo "selected"; }; ?>>3</option>
				<option value="4" <?php if (isset($providerinfo['review']) && $providerinfo['review'][0] == 4){ echo "selected"; }; ?>>4</option>
				<option value="5" <?php if (isset($providerinfo['review']) && $providerinfo['review'][0] == 5){ echo "selected"; }; ?>>5</option>
			</select>
		</div>
		<!-- <div class="sm-row-content">
			<label for="state">State:</label>
			<select name="state" id="state">
				<option value="AL" <?php if($locationinfo['state'] == "AL"){ echo "selected"; }; ?>>Alabama</option>
				<option value="AK" <?php if($locationinfo['state'] == "AK"){ echo "selected"; }; ?>>Alaska</option>
				<option value="AZ" <?php if($locationinfo['state'] == "AZ"){ echo "selected"; }; ?>>Arizona</option>
				<option value="AR" <?php if($locationinfo['state'] == "AR"){ echo "selected"; }; ?>>Arkansas</option>
				<option value="CA" <?php if($locationinfo['state'] == "CA"){ echo "selected"; }; ?>>California</option>
				<option value="CO" <?php if($locationinfo['state'] == "CO"){ echo "selected"; }; ?>>Colorado</option>
				<option value="CT" <?php if($locationinfo['state'] == "CT"){ echo "selected"; }; ?>>Connecticut</option>
				<option value="DE" <?php if($locationinfo['state'] == "DE"){ echo "selected"; }; ?>>Delaware</option>
				<option value="DC" <?php if($locationinfo['state'] == "DC"){ echo "selected"; }; ?>>District Of Columbia</option>
				<option value="FL" <?php if($locationinfo['state'] == "FL"){ echo "selected"; }; ?>>Florida</option>
				<option value="GA" <?php if($locationinfo['state'] == "GA"){ echo "selected"; }; ?>>Georgia</option>
				<option value="HI" <?php if($locationinfo['state'] == "HI"){ echo "selected"; }; ?>>Hawaii</option>
				<option value="ID" <?php if($locationinfo['state'] == "ID"){ echo "selected"; }; ?>>Idaho</option>
				<option value="IL" <?php if($locationinfo['state'] == "IL"){ echo "selected"; }; ?>>Illinois</option>
				<option value="IN" <?php if($locationinfo['state'] == "IN"){ echo "selected"; }; ?>>Indiana</option>
				<option value="IA" <?php if($locationinfo['state'] == "IA"){ echo "selected"; }; ?>>Iowa</option>
				<option value="KS" <?php if($locationinfo['state'] == "KS"){ echo "selected"; }; ?>>Kansas</option>
				<option value="KY" <?php if($locationinfo['state'] == "KY"){ echo "selected"; }; ?>>Kentucky</option>
				<option value="LA" <?php if($locationinfo['state'] == "LA"){ echo "selected"; }; ?>>Louisiana</option>
				<option value="ME" <?php if($locationinfo['state'] == "ME"){ echo "selected"; }; ?>>Maine</option>
				<option value="MD" <?php if($locationinfo['state'] == "MD"){ echo "selected"; }; ?>>Maryland</option>
				<option value="MA" <?php if($locationinfo['state'] == "MA"){ echo "selected"; }; ?>>Massachusetts</option>
				<option value="MI" <?php if($locationinfo['state'] == "MI"){ echo "selected"; }; ?>>Michigan</option>
				<option value="MN" <?php if($locationinfo['state'] == "MN"){ echo "selected"; }; ?>>Minnesota</option>
				<option value="MS" <?php if($locationinfo['state'] == "MS"){ echo "selected"; }; ?>>Mississippi</option>
				<option value="MO" <?php if($locationinfo['state'] == "MO"){ echo "selected"; }; ?>>Missouri</option>
				<option value="MT" <?php if($locationinfo['state'] == "MT"){ echo "selected"; }; ?>>Montana</option>
				<option value="NE" <?php if($locationinfo['state'] == "NE"){ echo "selected"; }; ?>>Nebraska</option>
				<option value="NV" <?php if($locationinfo['state'] == "NV"){ echo "selected"; }; ?>>Nevada</option>
				<option value="NH" <?php if($locationinfo['state'] == "NH"){ echo "selected"; }; ?>>New Hampshire</option>
				<option value="NJ" <?php if($locationinfo['state'] == "NJ"){ echo "selected"; }; ?>>New Jersey</option>
				<option value="NM" <?php if($locationinfo['state'] == "NM"){ echo "selected"; }; ?>>New Mexico</option>
				<option value="NY" <?php if($locationinfo['state'] == "NY"){ echo "selected"; }; ?>>New York</option>
				<option value="NC" <?php if($locationinfo['state'] == "NC"){ echo "selected"; }; ?>>North Carolina</option>
				<option value="ND" <?php if($locationinfo['state'] == "ND"){ echo "selected"; }; ?>>North Dakota</option>
				<option value="OH" <?php if($locationinfo['state'] == "OH"){ echo "selected"; }; ?>>Ohio</option>
				<option value="OK" <?php if($locationinfo['state'] == "OK"){ echo "selected"; }; ?>>Oklahoma</option>
				<option value="OR" <?php if($locationinfo['state'] == "OR"){ echo "selected"; }; ?>>Oregon</option>
				<option value="PA" <?php if($locationinfo['state'] == "PA"){ echo "selected"; }; ?>>Pennsylvania</option>
				<option value="RI" <?php if($locationinfo['state'] == "RI"){ echo "selected"; }; ?>>Rhode Island</option>
				<option value="SC" <?php if($locationinfo['state'] == "SC"){ echo "selected"; }; ?>>South Carolina</option>
				<option value="SD" <?php if($locationinfo['state'] == "SD"){ echo "selected"; }; ?>>South Dakota</option>
				<option value="TN" <?php if($locationinfo['state'] == "TN"){ echo "selected"; }; ?>>Tennessee</option>
				<option value="TX" <?php if($locationinfo['state'] == "TX"){ echo "selected"; }; ?>>Texas</option>
				<option value="UT" <?php if($locationinfo['state'] == "UT"){ echo "selected"; }; ?>>Utah</option>
				<option value="VT" <?php if($locationinfo['state'] == "VT"){ echo "selected"; }; ?>>Vermont</option>
				<option value="VA" <?php if($locationinfo['state'] == "VA"){ echo "selected"; }; ?>>Virginia</option>
				<option value="WA" <?php if($locationinfo['state'] == "WA"){ echo "selected"; }; ?>>Washington</option>
				<option value="WV" <?php if($locationinfo['state'] == "WV"){ echo "selected"; }; ?>>West Virginia</option>
				<option value="WI" <?php if($locationinfo['state'] == "WI"){ echo "selected"; }; ?>>Wisconsin</option>
				<option value="WY" <?php if($locationinfo['state'] == "WY"){ echo "selected"; }; ?>>Wyoming</option>
			</select>		
		</div> -->
		<div class="sm-row-content custom">
			<label for="phone">Phone Number:</label>
			<input type="text" name="phone" id="phone" value="<?php if ( isset ( $locationinfo['phone'] ) ) echo $locationinfo['phone'][0]; ?>" />
		</div>
		<div class="sm-row-content custom">
			<label for="fax">Fax Number:</label>
			<input type="text" name="fax" id="fax" value="<?php if ( isset ( $locationinfo['fax'] ) ) echo $locationinfo['fax'][0]; ?>" />
		</div>
		<div class="sm-row-content custom">
			<label for="lat">Latitude:</label>
			<a href="https://www.latlong.net/" target="_blank">Find Coordinates by Entering Your Address At This Link and enter them below.</a>
			<input type="text" name="lat" id="lat" value="<?php if ( isset ( $locationinfo['lat'] ) ) echo $locationinfo['lat'][0]; ?>" />
		</div>
		<div class="sm-row-content custom">
			<label for="lon">Longitude:</label>
			<input type="text" name="lon" id="lon" value="<?php if ( isset ( $locationinfo['lon'] ) ) echo $locationinfo['lon'][0]; ?>" />
		</div>
		<div class="sm-row-content custom">
			<label for="teaser">Hours:</label>
			<?php 
				$teaser=  get_post_meta($_GET['post'], 'teaser' , true ) ; wp_editor( htmlspecialchars_decode($teaser), 'teaser', $settings = array('textarea_name'=>'teaser', 'media_buttons'=> false) ); ?>
		</div>
		<div class="sm-row-content custom">
			<label for="ctatitle">Custom Button Title (if blank, defaults to Request Appointment):</label>
			<input type="text" name="ctatitle" id="ctatitle" value="<?php if ( isset ( $locationinfo['ctatitle'] ) ) echo $locationinfo['ctatitle'][0]; ?>" />
		</div>
		<div class="sm-row-content custom">
			<label for="ctalink">Custom Button URL (if blank, defaults to Contact Us Page):</label>
			<input type="text" name="ctalink" id="ctalink" value="<?php if ( isset ( $locationinfo['ctalink'] ) ) echo $locationinfo['ctalink'][0]; ?>" />
		</div>
	</p>
	<?php } 