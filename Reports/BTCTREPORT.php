

<?php include $_SERVER['DOCUMENT_ROOT']."/include/include_in_patho_report.php"; ?><body>
    <form method="post" action="" id="aspnetForm" class="section-to-print">
</div>
        <div class="hmms_report">
            <div class="hmms_hdr">
                <?php include $_SERVER['DOCUMENT_ROOT']."/include/patho_report_header_lbl.php";?>
            </div>
            <div>
    <div class="hmms_hdr">
        <div class="">
            <div class="hmms-reprtname">BT & CT</div>
        </div>
        <div class="profile_tbl">
            <table class="width-100">
                <tr>
                    <td class="font-RobotoBold width-40">TEST DESCRIPTION</td>
                    <td class="font-RobotoBold width-20 text-center">RESULT</td>
                    <td class="font-RobotoBold width-40">REFERENCE RANGE</td>
                </tr>
                <tr>
                    <td class="width-40">Bleeding Time</td>
                    <td class="width-20 text-center">
                        <input name="ctl00_reportmaster_txtBleedingTime" type="text" value="" maxlength="100" id="ctl00_reportmaster_txtBleedingTime"  class=" txtbox-css width-90px margin-left-97" /></td>
                    <td class="width-40"> < 6 min</td>
                </tr>
                <tr>
                    <td class="width-40">Clotting Time</td>
                    <td class="width-20 text-center">
                        <input name="ctl00_reportmaster_txtClottingTime" type="text" value="" maxlength="100" id="ctl00_reportmaster_txtClottingTime" class=" txtbox-css width-90px margin-left-97" /></td>
                    <td class="width-40"> 2 to 6 mins </td>
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
	   url: "/set_p_BTCTReport.php",
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
    var a = document.forms["aspnetForm"]["ctl00_reportmaster_txtBleedingTime"].value;
    var b = document.forms["aspnetForm"]["ctl00_reportmaster_txtClottingTime"].value;
    /*var c = document.forms["aspnetForm"]["ctl00_reportmaster_txtUrineAcetone"].value;
    /*var d = document.forms["aspnetForm"]["ctl00_reportmaster_txGramsstain"].value;
    var e = document.forms["aspnetForm"]["ctl00_reportmaster_txResult2"].value; */
    if (a == "" || a == null) {
        alert("Parameters must be filled must be filled out");
		$("#ctl00_reportmaster_txtBleedingTime").focus();
		$("#ctl00_reportmaster_txtBleedingTime").addClass('error').removeClass('noerror');
        return false;	
    }else if(b=="" || b==null){
		alert("Parameters must be filled must be filled out");
		$("#ctl00_reportmaster_txtClottingTime").focus();
		$("#ctl00_reportmaster_txtClottingTime").addClass('error').removeClass('noerror');
	}/*else if(c=="" || c==null){
		alert("Parameters must be filled must be filled out");
		$("#ctl00_reportmaster_txtUrineAcetone").focus();
		$("#ctl00_reportmaster_txtUrineAcetone").addClass('error').removeClass('noerror');
	}/*else if(d=="" || d==null){
		alert("Parameters must be filled must be filled out");
		$("#ctl00_reportmaster_txGramsstain").focus();
		$("#ctl00_reportmaster_txGramsstain").addClass('error').removeClass('noerror');
	}else if(e=="" || e==null){
		alert("Parameters must be filled must be filled out");
		$("#ctl00_reportmaster_txResult2").focus();
		$("#ctl00_reportmaster_txResult2").addClass('error').removeClass('noerror');
	}*/else{ return true;}
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
		
		
		setSelectValue('ctl00_reportmaster_txtBleedingTime', jsonforindividual.Bleeding_time);
setSelectValue('ctl00_reportmaster_txtClottingTime', jsonforindividual.Clotting_time);
}
	else{}
}  	
	</script>
<?php include $_SERVER["DOCUMENT_ROOT"]."/include/include_in_patho_report_footer.php";?>
