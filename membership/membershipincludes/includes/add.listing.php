<?php
require_once ABSPATH .'/wp-load.php';
global $wpdb;
$user_ID = get_current_user_id();
$package = "select `package` from `".$wpdb->prefix ."question` where `user_ID` = ".$user_ID." ";
$userpackage = $wpdb->get_results($package);
?>
<form action="<?php echo plugin_dir_url(__FILE__);?>single.action.php" method="post" name="farmform" enctype="multipart/form-data">
<ul class="add-PropertyForm">
	<li>
		<h6 class="add-PropertyForm-list-title">Post Featured Image</h6>
		<span class="add-PropertyForm-textfild">
		    <input type="file" value="" name="file" class="paa_field"/>
		    <input type="hidden" value="<?php echo $userpackage[0]->package;?>" name="package"/>
		</span>
    </li>
	<li>
		<h6 class="add-PropertyForm-list-title">Image </h6>
		<span class="add-PropertyForm-textfild">
		    <input type="file" value="" name="file2" class="paa_field"/>
		</span>
    </li>
    <li>
		<h6 class="add-PropertyForm-list-title">Image </h6>
		<span class="add-PropertyForm-textfild">
		    <input type="file" value="" name="file3" class="paa_field"/>
		</span>
    </li>
	<li>
		<h6 class="add-PropertyForm-list-title">Farm Name * </h6>
		<span class="add-PropertyForm-textfild">
		    <input type="text" value="" name="farmname" class="paa_field" placeholder="Farm Name"/>
		</span>    
    </li>
    <li>
		<h6 class="add-PropertyForm-list-title">Address * </h6>
		<span class="add-PropertyForm-textfild">
		    <input type="text" value="" name="farmaddress" class="paa_field" placeholder="Address"/>
		</span>    
    </li>
	<li>
		<h6 class="add-PropertyForm-list-title">City * </h6>
		<span class="add-PropertyForm-textfild">
		    <input type="text" value="" name="farmcity" class="paa_field" placeholder="City"/>
		</span>    
    </li>
	<li>
		<h6 class="add-PropertyForm-list-title">Zip * </h6>
		<span class="add-PropertyForm-textfild">
		    <input type="text" value="" name="farmzip" class="paa_field" placeholder="Zip"/>
		</span>    
    </li>
    <li>
		<h6 class="add-PropertyForm-list-title">Phone * </h6>
		<span class="add-PropertyForm-textfild">
			<input type="text" value="" name="farmphone" class="paa_field" placeholder="Phone"/>
		</span>    
	</li>
    <li>
		<h6 class="add-PropertyForm-list-title">Farm Description * </h6>
		<span class="add-PropertyForm-textfild">
		    <textarea name="farmdescription" class="paa_field" placeholder="Farm Description"></textarea>
		</span>
    </li>
    <li>
        <h6 class="add-PropertyForm-list-title">Region Facility located:</h6>
        <span class="add-PropertyForm-textfild">
            <select name="Region">
                <option>Select Property Region</option>
                <option value="Upper Peninsula">Upper Peninsula</option>
                <option value="Central Michigan">Central Michigan</option>
                <option value="Lower Michigan">Lower Michigan</option>
                <option value="Western Michigan">Western Michigan</option>
            </select>
        </span>
    </li>
	<div class="full-length-width"> 
		<span class="full-inner-title">Type of Facility:</span>
		<div class="radio-outerbox">
			<div class="roundedOnecheck">
				Boarding
				<input type="checkbox" name="whattypeoffacility" id="whattypeoffacility1" value="Boarding">
				<label for="whattypeoffacility1"></label>
			</div>
			<div class="roundedOnecheck">
				Boarding & Training
				<input type="checkbox" name="whattypeoffacility" id="whattypeoffacility2" value="Boarding & Training">
				<label for="whattypeoffacility2"></label>
			</div>
			<div class="roundedOnecheck">
				Training
				<input type="checkbox" name="whattypeoffacility" id="whattypeoffacility3" value="Training">
				<label for="whattypeoffacility3"></label>
			</div>
		</div>
	</div>    
	<div class="full-length-width"> 
		<span class="full-inner-title">Boarding Provided:</span>
		<div class="radio-outerbox">
			<div class="roundedOnecheck">
				Stall Board
				<input type="checkbox" name="boarding_provided[]" id="customcbutton1" value="Stall Board">
				<label for="customcbutton1"></label>
			</div>
			<div class="roundedOnecheck">
				Pasture Board
				<input type="checkbox" name="boarding_provided[]" id="customcbutton2" value="Pasture Board">
				<label for="customcbutton2"></label>
			</div>
			<div class="roundedOnecheck">
				Partial Board
				<input type="checkbox" name="boarding_provided[]" id="customcbutton3" value="Partial Board">
				<label for="customcbutton3"></label>
			</div>
			<div class="roundedOnecheck">
				Self-Board
				<input type="checkbox"  name="boarding_provided[]" id="customcbutton4" value="Self-Board">
				<label for="customcbutton4"></label>
			</div>
			<div class="roundedOnecheck">
				Personal Stall
				<input type="checkbox" name="boarding_provided[]" id="customcbutton5" value="Personal Stall">
				<label for="customcbutton5"></label>
			</div>
			<div class="roundedOnecheck">
				Retirement
				<input type="checkbox" name="boarding_provided[]" id="customcbutton10" value="Retirement">
				<label for="customcbutton10"></label>
			</div>
		</div>
	</div>
<!---  2nd part  ---->	
	<div class="full-length-width"> 
		<span class="full-inner-title">Discipline Specific:</span>
		<div class="radio-outerbox">
			<div class="roundedOnecheck">
				English
				<input type="checkbox" name="discipline[]" id="customcbutton6" value="English">
				<label for="customcbutton6"></label>
			</div>
                        <div class="roundedOnecheck">
				English Pleasure
				<input type="checkbox" name="discipline[]" id="customcbutton11" value="English Pleasure">
				<label for="customcbutton11"></label>
			</div>
			<div class="roundedOnecheck">
				Western
				<input type="checkbox" name="discipline[]" id="customcbutton7" value="Western">
				<label for="customcbutton7"></label>
			</div>
			<div class="roundedOnecheck">
				Western Pleasure
				<input type="checkbox" name="discipline[]" id="customcbutton8" value="Western Pleasure">
				<label for="customcbutton8"></label>
			</div>
			<div class="roundedOnecheck">
				Dressage
				<input type="checkbox" name="discipline[]" id="customcbutton9" value="Dressage">
				<label for="customcbutton9"></label>
			</div>
			<div class="roundedOnecheck">
				Saddle Seat
				<input type="checkbox" name="discipline[]" id="customcbutton10" value="Saddle Seat">
				<label for="customcbutton10"></label>
			</div>
			<div class="roundedOnecheck">
				Hunter/Jumper
				<input type="checkbox" name="discipline[]" id="customcbutton100" value="Hunter/Jumper">
				<label for="customcbutton100"></label>
			</div>
			<div class="roundedOnecheck">
				Eventing
				<input type="checkbox" name="discipline[]" id="customcbutton12" value="Eventing">
				<label for="customcbutton12"></label>
			</div>
			<div class="roundedOnecheck">
				Polo and Polocrosse
				<input type="checkbox" name="discipline[]" id="customcbutton13" value="Polo and Polocrosse">
				<label for="customcbutton13"></label>
			</div>
			<div class="roundedOnecheck">
				Gymkhana Events
				<input type="checkbox" name="discipline[]" id="customcbutton14" value="Gymkhana Events">
				<label for="customcbutton14"></label>
			</div>
			<div class="roundedOnecheck">
				Field/Foxhunting
				<input type="checkbox" name="discipline[]" id="customcbutton15" value="Field/Foxhunting">
				<label for="customcbutton15"></label>
			</div>
			<div class="roundedOnecheck">
				Harness Racing
				<input type="checkbox" name="discipline[]" id="customcbutton16" value="Harness Racing">
				<label for="customcbutton16"></label>
			</div>
			<div class="roundedOnecheck">
				Racing
				<input type="checkbox" name="discipline[]" id="customcbutton17" value="Racing">
				<label for="customcbutton17"></label>
			</div>
			<div class="roundedOnecheck">
				Not Discipline Specific
				<input type="checkbox" name="discipline[]" id="customcbutton101" value="Not Discipline Specific">
				<label for=""></label>
			</div>
			<div class="roundedOnecheck">
				Other
				<input type="checkbox" name="discipline[]" id="customcbutton1001" value="Other">
				<label for=""></label>
			</div>

		</div>
	</div>
<!---  3rd part  ---->	
	<div class="full-length-width"> 
		<span class="full-inner-title">Trainer Provided:</span>
		<div class="radio-outerbox">
			<div class="roundedOne">
				Farm Trainers only
				<input type="radio" name="trainerprovided" id="customcbutton13" value="Farm Trainers only">
				<label for="customcbutton13"></label>
			</div>
			<div class="roundedOne">
				Outside Trainers allowed
				<input type="radio" name="trainerprovided" id="customcbutton14" value="Outside Trainers allowed">
				<label for="customcbutton14"></label>
			</div>
			<div class="roundedOne">
				or Either
				<input type="radio" name="trainerprovided" id="customcbutton15" value="or Either">
				<label for="customcbutton15"></label>
			</div>
		</div>
	</div>
<!---  4rth part  ---->	
	<div class="full-length-width"> 
		<span class="full-inner-title">Boarder Population:</span>
		<div class="radio-outerbox">
			<div class="roundedOne">
				Adult
				<input type="radio" name="boarderpopulation" id="customcbutton16" value="Adult">
				<label for="customcbutton16"></label>
			</div>
			<div class="roundedOne">
				Family oriented
				<input type="radio" name="boarderpopulation" id="customcbutton17" value="Family oriented">
				<label for="customcbutton17"></label>
			</div>
			<div class="roundedOne">
				Teenagers 
				<input type="radio" name="boarderpopulation" id="customcbutton18" value="Teenagers">
				<label for="customcbutton18"></label>
			</div>
			<div class="roundedOne">
				Mixed
				<input type="radio" name="boarderpopulation" id="customcbutton19" value="Mixed">
				<label for="customcbutton19"></label>
			</div>
			<div class="roundedOne">
				4H
				<input type="radio" name="boarderpopulation" id="customcbutton19" value="4H">
				<label for="customcbutton19"></label>
			</div>
		</div>
	</div>
<!---  5th part  ---->	
<!---  6th part  ---->	
	<div class="full-length-width"> 
		<span class="full-inner-title">Lessons provided:</span>
		<div class="radio-outerbox">
			<div class="roundedOne">
				Yes
				<input id="roundedOne2" type="radio" value="Yes" name="lessonsprovided">
				<label for="roundedOne2"></label>
			</div>
			<div class="roundedOne">
				No
				<input id="roundedOne3" type="radio" value="No" name="lessonsprovided">
				<label for="roundedOne3"></label>
			</div>
		</div>
	</div>
<!---  7th part  ---->	
	<div class="full-length-width"> 
		<span class="full-inner-title">Owners live on farm:</span>
		<div class="radio-outerbox">
			<div class="roundedOne">
				Yes
				<input id="roundedOne4" type="radio" value="Yes" name="ownersliveonfarm">
				<label for="roundedOne4"></label>
			</div>
			<div class="roundedOne">
				No
				<input id="roundedOne5" type="radio" value="No" name="ownersliveonfarm">
				<label for="roundedOne5"></label>
			</div>
		</div>
	</div>	
<!---  8th part  ---->	
	<div class="full-length-width"> 
		<span class="full-inner-title">Observation Room:</span>
		<div class="radio-outerbox">
			<div class="roundedOne">
				Yes
				<input id="roundedOne6" type="radio" value="Yes" name="observationroom">
				<label for="roundedOne6"></label>
			</div>
			<div class="roundedOne">
				yes and heated
				<input id="roundedOne7" type="radio" value="yesandheated" name="observationroom">
				<label for="roundedOne7"></label>
			</div>
			<div class="roundedOne">
				No
				<input id="roundedOne7" type="radio" value="No" name="observationroom">
				<label for="roundedOne7"></label>
			</div>
			
		</div>
	</div>
<!---  9th part  ---->	
	<div class="full-length-width"> 
		<span class="full-inner-title">Inside bathroom:</span>
		<div class="radio-outerbox">
			<div class="roundedOne">
				Yes
				<input id="roundedOne8" type="radio" value="Yes" name="insidebathroom">
				<label for="roundedOne8"></label>
			</div>
			<div class="roundedOne">
				No
				<input id="roundedOne9" type="radio" value="No" name="insidebathroom">
				<label for="roundedOne9"></label>
			</div>
		</div>
	</div>
<!---  10th part  ---->	
	<div class="full-length-width"> 
		<span class="full-inner-title">Grain provided:</span>
		<div class="radio-outerbox">
			<div class="roundedOne">
				Yes
				<input id="roundedOne10" type="radio" value="Yes" name="grainprovided">
				<label for="roundedOne10"></label>
			</div>
			<div class="roundedOne">
				Yes (Pasture board with fee)
				<input id="roundedOne10" type="radio" value="Yes (Pasture board with fee)" name="grainprovided">
				<label for="roundedOne10"></label>
			</div>
			<div class="roundedOne">
				No
				<input id="roundedOne11" type="radio" value="No" name="grainprovided">
				<label for="roundedOne11"></label>
			</div>
		</div>
	</div>
<!---  11th part  ---->	
	<div class="full-length-width"> 
		<span class="full-inner-title">Supplements given:</span>
		<div class="radio-outerbox">
			<div class="roundedOne">
				Yes
				<input id="roundedOne12" type="radio" value="Yes" name="supplementsgiven">
				<label for="roundedOne12"></label>
			</div>
			<div class="roundedOne">
				No
				<input id="roundedOne13" type="radio" value="No" name="supplementsgiven">
				<label for="roundedOne13"></label>
			</div>
		</div>
	</div>	
<!---  12th part  ---->	
	<div class="full-length-width"> 
		<span class="full-inner-title">Indoor arena:</span>
		<div class="radio-outerbox">
			<div class="roundedOne">
				Yes
				<input id="roundedOne14" type="radio" value="Yes" name="indoorarena">
				<label for="roundedOne14"></label>
			</div>
			<div class="roundedOne">
				No
				<input id="roundedOne15" type="radio" value="No" name="indoorarena">
				<label for="roundedOne15"></label>
			</div>
		</div>
	</div>	
<!---  13th part  ---->	
	<div class="full-length-width"> 
		<span class="full-inner-title">Outdoor arena:</span>
		<div class="radio-outerbox">
			<div class="roundedOne">
				Yes
				<input id="roundedOne16" type="radio" value="Yes" name="outdoorarena">
				<label for="roundedOne16"></label>
			</div>
			<div class="roundedOne">
				No
				<input id="roundedOne17" type="radio" value="No" name="outdoorarena">
				<label for="roundedOne17"></label>
			</div>
		</div>
	</div>	
<!---  14th part  ---->	
	<div class="full-length-width"> 
		<span class="full-inner-title">Round pen:</span>
		<div class="radio-outerbox">
			<div class="roundedOne">
				Yes
				<input id="roundedOne18" type="radio" value="Yes" name="roundpen">
				<label for="roundedOne18"></label>
			</div>
			<div class="roundedOne">
				No
				<input id="roundedOne19" type="radio" value="No" name="roundpen">
				<label for="roundedOne19"></label>
			</div>
		</div>
	</div>
<!---  15th part  ---->	
	<div class="full-length-width"> 
		<span class="full-inner-title">Trails:</span>
		<div class="radio-outerbox">
			<div class="roundedOne">
				On Farm 
				<input type="checkbox" name="trails[]" id="customcbutton45" value="On Farm">
				<label for="customcbutton45"></label>
			</div>
			<div class="roundedOne">
				Nearby
				<input type="checkbox" name="trails[]" id="customcbutton44" value="Nearby">
				<label for="customcbutton44"></label>
			</div>
			<div class="roundedOne">
				Dirt Roads 
				<input type="checkbox" name="trails[]" id="customcbutton43" value="Dirt Roads">
				<label for="customcbutton43"></label>
			</div>
			<div class="roundedOne">
				None
				<input type="checkbox" name="trails[]" id="customcbutton42" value="None">
				<label for="customcbutton42"></label>
			</div>
		</div>
	</div>	
<!---  16th part  ---->	
	<div class="full-length-width"> 
		<span class="full-inner-title">Wash Rack:</span>
		<div class="radio-outerbox">
			<div class="roundedOne">
				Yes, Hot & Cold
				<input id="roundedOne22" type="radio" value="Yes, Hot & Cold" name="washrackwithhot">
				<label for="roundedOne22"></label>
			</div>
                        <div class="roundedOne">
                              Yes, Cold Only
                               <input id="roundedOne65" type="radio" value="Yes, Cold Only" name="washrackwithhot">
                               <label for="roundedOne65"></label>
                        </div>
			<div class="roundedOne">
				No
				<input id="roundedOne23" type="radio" value="No" name="washrackwithhot">
				<label for="roundedOne23"></label>
			</div>
		</div>
	</div>	
<!---  17th part  ---->	
	<div class="full-length-width"> 
		<span class="full-inner-title">Gender Turnout:</span>
		<div class="radio-outerbox">
			<div class="roundedOne">
				Single Gender      
				<input type="radio" name="turnout" id="customcbuttonmm" value="Single Gender">
				<label for="customcbuttonmm"></label>
			</div>
			<div class="roundedOne">
				Mix Gender
				<input type="radio" name="turnout" id="customcbuttonmg" value="Mix Gender">
				<label for="customcbuttonmg"></label>
			</div>
			<div class="roundedOne">
				Both
				<input type="radio" name="turnout" id="customcbuttonboths" value="Both">
				<label for="customcbuttonboths"></label>
			</div>
		</div>
	</div>
<!---  18th part  ---->	
	<div class="full-length-width"> 
		<span class="full-inner-title">Turnout Environment:</span>
		<div class="radio-outerbox">
			<div class="roundedOne">
				Paddock       
				<input type="radio" name="turnouts" id="customcbuttonpaddock" value="Paddock">
				<label for="customcbuttonpaddock"></label>
			</div>
			<div class="roundedOne">
				Pasture
				<input type="radio" name="turnouts" id="customcbuttonpasture" value="Pasture">
				<label for="customcbuttonpasture"></label>
			</div>
			<div class="roundedOne">
				Both 
				<input type="radio" name="turnouts" id="customcbuttonboth" value="Both">
				<label for="customcbuttonboth"></label>
			</div>
		</div>
	</div>	
<!---  19th part  ---->	
	<div class="full-length-width"> 
		<span class="full-inner-title">Fencing:</span>
		<div class="radio-outerbox">
			<div class="roundedOne">
				Chicken wire 
				<input type="checkbox" name="fencing[]" id="customcbuttonchickenwire" value="Chicken wire">
				<label for="customcbuttonchickenwire"></label>
			</div>
			<div class="roundedOne">
				Cable fence
				<input type="checkbox" name="fencing[]" id="customcbuttoncablefence" value="Cable fence">
				<label for="customcbuttoncablefence"></label>
			</div>
			<div class="roundedOne">
				Hotwire 
				<input type="checkbox" name="fencing[]" id="customcbuttonhotwire" value="Hotwire">
				<label for="customcbuttonhotwire"></label>
			</div>
			<div class="roundedOne">
				Wood fencing
				<input type="checkbox" name="fencing[]" id="customcbuttonwoodfencing" value="Wood fencing">
				<label for="customcbuttonwoodfencing"></label>
			</div>
			<div class="roundedOne">
				Metal fecing
				<input type="checkbox" name="fencing[]" id="customcbuttonmetalfecing" value="Metal fecing">
				<label for="customcbuttonmetalfecing"></label>
			</div>
			<div class="roundedOne">
				Electrobraid
				<input type="checkbox" name="fencing[]" id="customcbuttonmetalfecing" value="Electrobraid">
				<label for="customcbuttonmetalfecing"></label>
			</div>
			<div class="roundedOne">
				Vinyl fencing
				<input type="checkbox" name="fencing[]" id="customcbuttonmetalfecing" value="Vinyl fencing">
				<label for="customcbuttonmetalfecing"></label>
			</div>
			<div class="roundedOne">
				Other
				<input type="checkbox" name="fencing[]" id="customcbuttonother" value="Other">
				<label for="customcbuttonother"></label>
			</div>
		</div>
	</div>	
<!---  20th part  ---->	
	<div class="full-length-width"> 
		<span class="full-inner-title">Stand for Vet, Farrier</span>
		<div class="radio-outerbox">
			<div class="roundedOne">
				Yes
				<input id="roundedOne30" type="radio" value="Yes" name="standforvet">
				<label for="roundedOne30"></label>
			</div>
			<div class="roundedOne">
				No
				<input id="roundedOne31" type="radio" value="No" name="standforvet">
				<label for="roundedOne31"></label>
			</div>
		</div>
	</div>
<!---  20th part  ---->	
	<div class="full-length-width"> 
		<span class="full-inner-title">Trailer parking:</span>
		<div class="radio-outerbox">
			<div class="roundedOne">
				Yes
				<input id="roundedOne32" type="radio" value="Yes" name="trailerparking">
				<label for="roundedOne32"></label>
			</div>
			<div class="roundedOne">
				No
				<input id="roundedOne33" type="radio" value="No" name="trailerparking">
				<label for="roundedOne33"></label>
			</div>
		</div>
	</div>
	<div class="full-length-width"> 
		<span class="full-inner-title">Worming Schedule:</span>
		<div class="radio-outerbox">
			<div class="roundedOne">
				Yes & You Supply
				<input id="roundedOne38" type="radio" value="Yes & You Supply" name="wormingschedule">
				<label for="roundedOne38"></label>
			</div>
			<div class="roundedOne">
				Yes & Farm Supplies
				<input id="roundedOne35" type="radio" value="Yes & Farm Supplies" name="wormingschedule">
				<label for="roundedOne35"></label>
			</div>			
			<div class="roundedOne">
				No
				<input id="roundedOne36" type="radio" value="No" name="wormingschedule">
				<label for="roundedOne36"></label>
			</div>			
			<div class="roundedOne">
				You Give on Your Schedule
				<input id="roundedOne37" type="radio" value="You Give on Your Schedule" name="wormingschedule">
				<label for="roundedOne37"></label>
			</div>
		</div>
	</div>


<div class="full-length-width"> 
		<span class="full-inner-title">Supplements:</span>
		<div class="radio-outerbox">
			<div class="roundedOne">
				Yes, stall board only
				<input id="roundedOne70" type="radio" value="Yesstallboardonly" name="Supplements">
				<label for="roundedOne70"></label>
			</div>
			<div class="roundedOne">
				Yes, stall and pasture board
				<input id="roundedOne71" type="radio" value="Yesstallandpastureboard" name="Supplements">
				<label for="roundedOne71"></label>
			</div>			
			<div class="roundedOne">
				No
				<input id="roundedOne72" type="radio" value="No" name="Supplements">
				<label for="roundedOne72"></label>
			</div>
		</div>
	</div>
	
	<div class="full-length-width"> 
		<span class="full-inner-title">Can work for board:</span>
		<div class="radio-outerbox">
			<div class="roundedOne">
				Yes
				<input id="roundedOne73" type="radio" value="Yes" name="Canworkforboard">
				<label for="roundedOne73"></label>
			</div>
			<div class="roundedOne">
				No
				<input id="roundedOne74" type="radio" value="No" name="Canworkforboard">
				<label for="roundedOne74"></label>
			</div>			
			<div class="roundedOne">
				Possible
				<input id="roundedOne75" type="radio" value="Possible" name="Canworkforboard">
				<label for="roundedOne75"></label>
			</div>
		</div>
	</div>
	
	<div class="full-length-width"> 
		<span class="full-inner-title">Blanketing / Sheets On & Off:</span>
		<div class="radio-outerbox">
			<div class="roundedOne">
				Stall Board only :
				<input id="roundedOne80" type="radio" value="Stall Board only" name="blanketingsheets">
				<label for="roundedOne80"></label>
			</div>
			<div class="roundedOne">
				Pasture Board w/inclement weather :
				<input id="roundedOne81" type="radio" value="Pasture Board w/inclement weather" name="blanketingsheets">
				<label for="roundedOne81"></label>
			</div>			
			<div class="roundedOne">
				Stall Board & Pasture Board w/fee:
				<input id="roundedOne82" type="radio" value="Stall Board & Pasture Board w/fee" name="blanketingsheets">
				<label for="roundedOne82"></label>
			</div>
			<div class="roundedOne">
				No, Except w/inclement weather:
				<input id="roundedOne83" type="radio" value="No, Except w/inclement weathers" name="blanketingsheets">
				<label for="roundedOne83"></label>
			</div>
		</div>
	</div>
	
	<div class="full-length-width"> 
		<span class="full-inner-title">Boarding Stall Cost:</span>
		<div class="radio-outerbox">
			<div class="roundedOne">
				$200-$350 Stall :
				<input id="roundedOne84" type="radio" value="$200-$350 Stall" name="boardingstallcost">
				<label for="roundedOne84"></label>
			</div>
			<div class="roundedOne">
				$350-$450 Stall :
				<input id="roundedOne85" type="radio" value="$350-$450 Stall" name="boardingstallcost">
				<label for="roundedOne85"></label>
			</div>			
			<div class="roundedOne">
				$450-550 Stall : 
				<input id="roundedOne86" type="radio" value="$450-550 Stall" name="boardingstallcost">
				<label for="roundedOne86"></label>
			</div>
			<div class="roundedOne">
				$550-650 Stall :
				<input id="roundedOne87" type="radio" value="$550-650 Stall" name="boardingstallcost">
				<label for="roundedOne87"></label>
			</div>
			<div class="roundedOne">
				$650 & Up :
				<input id="roundedOne88" type="radio" value="$650 & Up" name="boardingstallcost">
				<label for="roundedOne88"></label>
			</div>
		</div>
	</div>
	
	<div class="full-length-width"> 
		<span class="full-inner-title">Boarding Pasture Board Cost:</span>
		<div class="radio-outerbox">
			<div class="roundedOne">
				$150-$200 :
				<input id="roundedOne89" type="radio" value="$150-$200" name="boardingpastureboardcost">
				<label for="roundedOne89"></label>
			</div>
			<div class="roundedOne">
				$200-$250 :
				<input id="roundedOne90" type="radio" value="$200-$250" name="boardingpastureboardcost">
				<label for="roundedOne90"></label>
			</div>			
			<div class="roundedOne">
				$250-$300 : 
				<input id="roundedOne91" type="radio" value="$250-$300" name="boardingpastureboardcost">
				<label for="roundedOne91"></label>
			</div>
			<div class="roundedOne">
				$300-$350 :
				<input id="roundedOne92" type="radio" value="$300-$350" name="boardingpastureboardcost">
				<label for="roundedOne92"></label>
			</div>
			<div class="roundedOne">
				$350-$400 :
				<input id="roundedOne93" type="radio" value="$350-$400" name="boardingpastureboardcost">
				<label for="roundedOne93"></label>
			</div>
			<div class="roundedOne">
				$400 & Up :
				<input id="roundedOne94" type="radio" value="$400 & Up" name="boardingpastureboardcost">
				<label for="roundedOne94"></label>
			</div>
		</div>
	</div>
	
	<div class="full-length-width"> 
		<span class="full-inner-title">Layover Stays/Horse Hotel:</span>
		<div class="radio-outerbox">
			<div class="roundedOne">
				Yes :
				<input id="roundedOne95" type="radio" value="Yes" name="layoverStayshorsehotel">
				<label for="roundedOne95"></label>
			</div>
			<div class="roundedOne">
				No :
				<input id="roundedOne96" type="radio" value="No" name="layoverStayshorsehotel">
				<label for="roundedOne96"></label>
			</div>
		</div>
	</div>

	
	<li>
        <span class="add-PropertyForm-textfild">
		    <input type="submit" name="farmsubmitbutton" id="addlisting" class="paa_fieldaddlistion" value="Add Listing">
		</span>
    </li>
</ul>
</form>
