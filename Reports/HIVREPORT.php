

<?php include $_SERVER['DOCUMENT_ROOT']."/include/include_in_patho_report.php"; ?><body>
    <form method="post" action="./HIVReport.aspx" id="aspnetForm" class="section-to-print">
        <div class="hmms_report">
            <div class="hmms_hdr">
                <?php include $_SERVER['DOCUMENT_ROOT']."/include/patho_report_header_lbl.php";?>
            </div>
            <div>
                
    <div class="hmms_hdr">
        <div class="">
            <div class="hmms-reprtname">HIV</div>
        </div>
        <div class="profile_tbl">
            <table class="width-100">
                <tr>
                    <td class="font-RobotoBold width-40">TEST DESCRIPTION</td>
                    <td class="font-RobotoBold width-20 text-center">RESULT</td>
                    <td class="font-RobotoBold width-40">REFERENCE RANGE</td>
                </tr>
                <tr>
                    <td class="width-40">H.I.V. Antibody</td>
                    <td class="width-20 text-center">
                        <!--<input name="ctl00_reportmaster_txtHIVAntibody" type="text" maxlength="100" id="ctl00_reportmaster_txtHIVAntibody" class="txtbox-css width-90px margin-left-97" />-->
						<select name="ctl00_reportmaster_txtHIVAntibody" id="ctl00_reportmaster_txtHIVAntibody"  class="txtbox-css width-90px margin-left-97">
						  <option value="">Select Value</option>
						  <option value="reactive">Reactive</option>
						  <option value="nonreactive">Non-Reactive</option>
						</select>	
						
						</td>
                    <td class="width-40">
                    </td>
                </tr>
                <tr>
                    <td class="width-40">H.I.V. 1</td>
                    <td class="width-20 text-center">
                        <!--<input name="ctl00_reportmaster_txtHIV1" type="text" maxlength="100" id="ctl00_reportmaster_txtHIV1" class="txtbox-css width-90px margin-left-97" />-->
						<select name="ctl00_reportmaster_txtHIV1" id="ctl00_reportmaster_txtHIV1"  class="txtbox-css width-90px margin-left-97">
						  <option value="">Select Value</option>
						  <option value="reactive">Reactive</option>
						  <option value="nonreactive">Non-Reactive</option>
						</select>
						</td>
                    <td class="width-40">
                    </td>
                </tr>
                 <tr>
                    <td class="width-40">H.I.V. 11</td>
                    <td class="width-20 text-center">
                        <!--<input name="ctl00_reportmaster_txtHIV11" type="text" maxlength="100" id="ctl00_reportmaster_txtHIV11" class="txtbox-css width-90px margin-left-97" />-->
							<select name="ctl00_reportmaster_txtHIV11" id="ctl00_reportmaster_txtHIV11"  class="txtbox-css width-90px margin-left-97">
							  <option value="">Select Value</option>
							  <option value="reactive">Reactive</option>
							  <option value="nonreactive">Non-Reactive</option>
							</select>
					</td>
                    <td class="width-40">
                    </td>
                </tr>
                 <tr>
                    <td class="width-40">Interpretation</td>
                    <td class="width-20 text-center">
                        <!--<input name="ctl00_reportmaster_txtInterpretation" type="text" maxlength="100" id="ctl00_reportmaster_txtInterpretation" class="txtbox-css width-90px margin-left-97" />-->
						<select name="ctl00_reportmaster_txtInterpretation" id="ctl00_reportmaster_txtInterpretation"  class="txtbox-css width-90px margin-left-97">
						  <option value="">Select Value</option>
						  <option value="positive">Positive</option>
						  <option value="negative">Negative</option>
						</select>
						</td>
                    <td class="width-40">
                    </td>
                </tr>
            </table>
        </div>
        <div class="hmms-rptnote">
            <span>Method : Dot Immunoassay.<br />
Positive test should be confirmed by Western Blot method.<br />
Negative result does not exclude the possibility of exposer to,or infection with HIV 1 & 11.<br />
Please confirm the test with three seperate kit at intervals according to WHO criteria.<br />
Material Used - TRIDOT (J. MITRA)<br /></span>
            <span class="text-center margin-bottom-60 ">--END OF REPORT--</span>

        </div>
        <div class="hmms-click section-notto-print"><input type="submit" name="ctl00_reportmaster_btnSave" value="Save" id="ctl00_reportmaster_btnSave" class="btn-css primry-colr" /><?php $db = getDB();  $statement=$db->prepare("SELECT  *  FROM `pathopatientregistrationmaster`  WHERE  `PatientId`=:PathoRegID  AND `payment`=0" );  $statement->bindParam(':PathoRegID', $ID, PDO::PARAM_INT); $statement->execute();  if ( $statement->rowCount() <= 0){ echo '<input type="button"   name="ctl00_reportmaster_btnPrint" value="Print" id="ctl00_reportmaster_btnPrint" class="btn-css primry-colr pull-right" />';}?>
        </div>
    </div>

            </div>
        </div>
    </form>
</body>
	<script>
		
var ID = "<?PHP echo $ID ?>";
var str = $( ".hmms-reprtname" ).text();

str=str.replace(/[^a-zA-Z\d0-9\/-\s]/g, "");
str = str.toLowerCase();

str=str.replace(/[^a-zA-Z\d0-9]/g, "_");
str = "p_"+str;

console.log("str name :"+str);
str= encode(str);
//var url="";
$.ajax({
	   type: "GET",
	   url: "/get_p_ReportData.php?ID="+ID+"&test="+str+"",
	   //data: 'ID='+ID+'',// serializes the form's elements.
	   success: function(data)
	   {	
			console.log(" jsonforindividual :"+data);
			jsonforindividual = JSON.parse(data);
			parseJsonToFormIndividual(jsonforindividual);  
	   },
		cache: false,
		contentType: false,
		processData: false
	 });

	$( "form#aspnetForm" ).on( "submit", function(event) {
	event.preventDefault();
	// alert("Clicked");
	var formData=$( this ).serialize();
	console.log(formData);
	if (validateForm()==true){
	$.ajax({
	   type: "GET",
	   url: "/set_p_HIVReport.php",
	   data: formData,// serializes the form's elements.
	   success: function(data)
	   {	
			// console.log(data);
			//var json2 = JSON.parse(data);
			parseJsonToForm2(data);
	   },
	   error: function(xhr, textStatus, errorThrown){
       alert('request failed');
		},
		cache: false,
		contentType: false,
		processData: false
	});
	}else{}
});
function validateForm() {
    var a = document.forms["aspnetForm"]["ctl00_reportmaster_txtHIVAntibody"].value;
    var b = document.forms["aspnetForm"]["ctl00_reportmaster_txtHIV1"].value;
    var c = document.forms["aspnetForm"]["ctl00_reportmaster_txtHIV11"].value;
    var d = document.forms["aspnetForm"]["ctl00_reportmaster_txtInterpretation"].value;
    if (a == "" || a == null) {
        alert("Parameters must be filled must be filled out");
		$("#ctl00_reportmaster_txtHIVAntibody").focus();
		$("#ctl00_reportmaster_txtHIVAntibody").addClass('error').removeClass('noerror');
        return false;	
    }else if(b=="" || b==null){
		alert("Parameters must be filled must be filled out");
		$("#ctl00_reportmaster_txtHIV1").focus();
		$("#ctl00_reportmaster_txtHIV1").addClass('error').removeClass('noerror');
	}else if(c=="" || c==null){
		alert("Parameters must be filled must be filled out");
		$("#ctl00_reportmaster_txtHIV11").focus();
		$("#ctl00_reportmaster_txtHIV11").addClass('error').removeClass('noerror');
	}else if(d=="" || d==null){
		alert("Parameters must be filled must be filled out");
		$("#ctl00_reportmaster_txtInterpretation").focus();
		$("#ctl00_reportmaster_txtInterpretation").addClass('error').removeClass('noerror');
	}else{ return true;}
}

function setSelectValue (id, val) {
	console.log("ID is : "+id+" :::  value is : "+val);
    document.getElementById(id).value = val;
}
function parseJsonToForm2(json2){
		/* $('#First-name-input').val(json.firstname); */
		//setSelectValue('ctl00_reportmaster_txtPatientTime', json.RegID);
		//setSelectValue('patID', json.patientID)
		if(json2=="no insert"){alert(json2);}else{$("#myModal_report .close").click();/*;window.location='/list_all_tests_registered_pathology.php#2b';*/}
}

function parseJsonToFormIndividual(jsonforindividual){
	console.log("json for ind in parse "+jsonforindividual);
	if (jsonforindividual){
		setSelectValue("ctl00_reportmaster_btnSave","Update");
		
		
		setSelectValue('ctl00_reportmaster_txtHIVAntibody', jsonforindividual.Hiv_antibody);
		setSelectValue('ctl00_reportmaster_txtHIV1', jsonforindividual.Hiv_1);
		setSelectValue('ctl00_reportmaster_txtHIV11', jsonforindividual.Hiv11);
		setSelectValue('ctl00_reportmaster_txtInterpretation', jsonforindividual.Interpretation);
}
	else{}
}  	

	</script>
<?php include $_SERVER["DOCUMENT_ROOT"]."/include/include_in_patho_report_footer.php";?>
