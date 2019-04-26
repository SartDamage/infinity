<?php include $_SERVER['DOCUMENT_ROOT']."/include/include_in_patho_report.php"; ?><body>
    <form method="post" action="" id="aspnetForm" class="section-to-print">
        <div class="hmms_report">
            <div class="hmms_hdr">
                <?php include $_SERVER['DOCUMENT_ROOT']."/include/patho_report_header_lbl.php";?>
            </div>
            <div>
    <div class="hmms_hdr">
        <div class="">
            <div class="hmms-reprtname">BLOOD C/S</div>
        </div>
        <div class="profile_tbl">
            <table class="width-100">
                <tr>
                    <td class="font-RobotoBold width-40">FINAL REPORT</td>
                    <td class="font-RobotoBold width-20 text-center"></td>
                    <td class="font-RobotoBold width-40"></td>
                </tr>
				 <tr>
                    <td class="width-40">SPECIMEN</td>
                    <td class="width-20 text-center">
                        <input name="ctl00_reportmaster_txtSpecimen" type="text" maxlength="100" id="ctl00_reportmaster_txtSpecimen" class="txtbox-css width-90px margin-left-97" /></td>
                    <td class="width-40">
                    </td>
                </tr>
				 <tr>
                    <td class="width-40">METHOD</td>
                    <td class="width-20 text-center">
                        <input name="ctl00_reportmaster_txtMethod" type="text" maxlength="100" id="ctl00_reportmaster_txtMethod" class="txtbox-css width-90px margin-left-97" /></td>
                    <td class="width-40">
                    </td>
                </tr>
				
				 <tr>
                    <td class="font-RobotoBold width-40">MICROSCOPIC EXAMINATION </td>
                    <td class="font-RobotoBold width-20 text-center"></td>
                    <td class="font-RobotoBold width-40"></td>
                </tr>
				<tr>
                    <td class="width-40">RESULT</td>
                    <td class="width-20 text-center">
                        <input name="ctl00_reportmaster_txresult1" type="text" maxlength="100" id="ctl00_reportmaster_txresult1" class="txtbox-css width-90px margin-left-97" /></td>
                    <td class="width-40">
                    </td>
                </tr>
				<tr>
                    <td class="font-RobotoBold width-40">SMEAR EXAMINATION </td>
                    <td class="font-RobotoBold width-20 text-center"></td>
                    <td class="font-RobotoBold width-40"></td>
                </tr>
				<tr>
                    <td class="width-40">Gram's Stain</td>
                    <td class="width-20 text-center">
                        <input name="ctl00_reportmaster_txGramsstain" type="text" maxlength="100" id="ctl00_reportmaster_txGramsstain" class="txtbox-css width-90px margin-left-97" /></td>
                    <td class="width-40">
                    </td>
                </tr>
				<tr>
                    <td class="font-RobotoBold width-40">ORGANISMS ISOLATED </td>
                    <td class="font-RobotoBold width-20 text-center"></td>
                    <td class="font-RobotoBold width-40"></td>
                </tr>
				<tr>
                    <td class="width-40">Result</td>
                    <td class="width-20 text-center">
                        <input name="ctl00_reportmaster_txResult2" type="text" maxlength="100" id="ctl00_reportmaster_txResult2" class="txtbox-css width-90px margin-left-97" /></td>
                    <td class="width-40">
                    </td>
                </tr>
				<tr>
                    <td class="width-40">Note</td>
                    <td class="width-20 text-center">
                        <input name="ctl00_reportmaster_txNote" type="text" maxlength="100" id="ctl00_reportmaster_txNote" class="txtbox-css width-90px margin-left-97" /></td>
                    <td class="width-40">
                    </td>
                </tr>
				
				
            </table>
        </div>
        <div class="hmms-rptnote">
            <span></span>
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

str=str.replace(/[^a-zA-Z\d0-9\s]/g, "");
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
	//alert("Clicked");
	var formData=$( this ).serialize();
	console.log(formData);
	if (validateForm()==true){
	$.ajax({
	   type: "GET",
	   url: "/set_p_BloodCSReport.php",
	   data: formData,// serializes the form's elements.
	   success: function(data)
	   {	
			//console.log(data);
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
    var a = document.forms["aspnetForm"]["ctl00_reportmaster_txtSpecimen"].value;
    var b = document.forms["aspnetForm"]["ctl00_reportmaster_txtMethod"].value;
    var c = document.forms["aspnetForm"]["ctl00_reportmaster_txresult1"].value;
    var d = document.forms["aspnetForm"]["ctl00_reportmaster_txGramsstain"].value;
    var e = document.forms["aspnetForm"]["ctl00_reportmaster_txResult2"].value;
    if (a == "" || a == null) {
        alert("Parameters must be filled must be filled out");
		$("#ctl00_reportmaster_txtSpecimen").focus();
		$("#ctl00_reportmaster_txtSpecimen").addClass('error').removeClass('noerror');
        return false;	
    }else if(b=="" || b==null){
		alert("Parameters must be filled must be filled out");
		$("#ctl00_reportmaster_txtMethod").focus();
		$("#ctl00_reportmaster_txtMethod").addClass('error').removeClass('noerror');
	}else if(c=="" || c==null){
		alert("Parameters must be filled must be filled out");
		$("#ctl00_reportmaster_txresult1").focus();
		$("#ctl00_reportmaster_txresult1").addClass('error').removeClass('noerror');
	}else if(d=="" || d==null){
		alert("Parameters must be filled must be filled out");
		$("#ctl00_reportmaster_txGramsstain").focus();
		$("#ctl00_reportmaster_txGramsstain").addClass('error').removeClass('noerror');
	}else if(e=="" || e==null){
		alert("Parameters must be filled must be filled out");
		$("#ctl00_reportmaster_txResult2").focus();
		$("#ctl00_reportmaster_txResult2").addClass('error').removeClass('noerror');
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
		
		
		setSelectValue('ctl00_reportmaster_txtSpecimen', jsonforindividual.Specimen);
		setSelectValue('ctl00_reportmaster_txtMethod', jsonforindividual.Method);
		setSelectValue('ctl00_reportmaster_txresult1', jsonforindividual.M_Result);
		setSelectValue('ctl00_reportmaster_txGramsstain', jsonforindividual.Grams_stain);
		setSelectValue('ctl00_reportmaster_txResult2', jsonforindividual.O_Result);
		setSelectValue('ctl00_reportmaster_txNote', jsonforindividual.Note);

	
	}
	else{}
}  	


	</script>
<?php include $_SERVER["DOCUMENT_ROOT"]."/include/include_in_patho_report_footer.php";?>