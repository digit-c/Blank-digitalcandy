(function ($, root, undefined) {
	
	$(function () {
		
		'use strict';
		

//CREATE PROJECT

		var isSpaceCreated = false;
		var isDesignCreated = false;
		var isFileUploadInProgress = false;

		var currentUserID="";



	//Project selection
	jQuery("#projectSelection li").on("click", function() {
		var currentProjectCliked = jQuery(this);
		var currentProjectData = currentProjectCliked.attr("data-pType");
		currentProjectCliked.toggleClass("active");
		
		if(currentProjectCliked.hasClass("active")){
			//selection is active
			
			//show form
		        jQuery(currentProjectData).show();

			switch(currentProjectData) {
		    case "#spaceProject":
		    //duplicated fields
		        jQuery("#group-space-design").show();
		        break;

		    case "#designProject":
		    //duplicated fields
		        jQuery("#group-space-design").show();
		        break;
			}
		}
		else{
			//show form
		        jQuery(currentProjectData).hide();

			switch(currentProjectData) {
		    case "#spaceProject":
   		    //duplicated fields
		        if(jQuery("#selectionDesign").hasClass("active")){}
		        else{
		        	jQuery("#group-space-design").hide();
		        }
		        break;
		    case "#designProject":
		    //duplicated fields
		    	if(jQuery("#selectionSpace").hasClass("active")){}
		        else{
		        	jQuery("#group-space-design").hide();
		        }
		        break;
			}		}
		
	})

	// jQuery("#field_yw2713-1").prop('checked',true)

	//Duplicated fields
	jQuery("#duplicateFields input").on('input', function() {
		if(jQuery(this).attr("type")==="text"){
			var masterInputLabel = jQuery("label[for='"+jQuery(this).attr('id')+"']");
			//get element label text
			var masterFieldLabel = masterInputLabel.text();
			var masterInputVal = jQuery(this).val();
			//find other labels with same text
			jQuery("label:contains("+masterFieldLabel+")").each(function(){
				//get the attribut FOR
		        var labelForTxt = jQuery(this).attr("for");
		        //set input value to master value
		        var inputVal = jQuery("#"+labelForTxt).attr("value",masterInputVal);
	    	});	
		}
		else{
			if(jQuery(this).attr('id')==="Field_3"){
				var masterDateVal = jQuery(this).val();
				//HTML5 val returns the dates with DASHES where Jquery UI date returns it with / so we convert the value to use /
				masterDateVal = masterDateVal.replace(/\-/g, '/');
				jQuery("#field_2lfnu").attr("value",masterDateVal)
				jQuery("#field_2lfnu3").attr("value",masterDateVal)
			}
		}
		
	})

	// Submit forms

		var submitFormGetResponse = function (form,successDivID, successFunction,errorFunction){

		//submit requested form
		jQuery(form).find(':submit').trigger("click");
		//wait for account creation response
		var timer0 = setInterval(function() {
		    console.log("waiting for "+successDivID+" success message");
				if (jQuery(successDivID).length){
					console.log(form+" successfull");
					clearInterval(timer0);
					successFunction(form);
			    }
			    else{
			    	if (jQuery(".frm_error").length){
			    	console.log(form+" error");
			    	clearInterval(timer0);
			    	errorFunction(form);
			    	}
			    }
		}, 100);

		}

		//Submit all forms button
		jQuery("#customSubmitAll").on("click",function(){
		    // Submit account creation form and wait for response. submit projects once successful
		    if(isFileUploadInProgress){
		    	console.log("wait for upload to complete!")
		    }
		    else{
		    	// Submit account creation form and wait for response. submit projects once successful
		    	submitFormGetResponse('#form_frmprocontact2','#accountCreated',submitProjects,accountCreationFailed);
		    }
		})
		var submitProjects = function (){
			//check if user is logged in and userID is available on the page (checking on space creation form's userID field.)
			if (jQuery("#field_iz839").attr("value") ===""){
				console.log("UserID unknown!");
				//get UserID from ajaxuserid data page
				jQuery("#data").load("/poplet/data/ajaxuserid/ #userID", function() {
				currentUserID = jQuery("#data").text();
					//fill UserID fields on all forms
					//space
					jQuery("#field_iz839").attr("data-frmval", currentUserID);
					jQuery("#field_iz839").attr("value", currentUserID);
					//design
					jQuery("#field_iz8393").attr("data-frmval", currentUserID);
					jQuery("#field_iz8393").attr("value", currentUserID);
					console.log("UserID inserted on all forms. Submitting forms");
					//TO BE ADDED - depending on project creation request checkboxes, submit required forms
					//submit design forms
					submitFormGetResponse('#form_l6nqm3','#designCreated',projectCreationSuccess,projectCreationError)
					//submit space forms
					submitFormGetResponse('#form_l6nqm','#spaceCreated',projectCreationSuccess,projectCreationError)

				});
			}

		}

		var accountCreationFailed = function(form){
			console.log("account creation failed. Projects won't be submitted. FORM = "+form);
		}

		var projectCreationSuccess = function(form){
			console.log("Project "+form+" created");
		}
		var projectCreationError = function(form){
			console.log("Project "+form+" created");
		}


	//file upload
		
		//bind click events on upload file buttons
		jQuery("#upload_1").on("click",function(){
			waitForFileUpload('#wordpress_file_upload_block_1','#field_u14om')
		})
				jQuery("#upload_2").on("click",function(){
			waitForFileUpload('#wordpress_file_upload_block_2','#field_i5fiz')
		})

		var waitForFileUpload = function (form,filesField){
			var currentForm = jQuery(form);
			//make sure there is a file to be uploaded (file_input_textbox class is only used if there is a file)
			if (currentForm.find('.file_input_textbox').length){
				// the field can be empty so we also check that it is not
				if (currentForm.find('.file_input_textbox').val()!=""){
				console.log("there is a file")
					isFileUploadInProgress = true;
					//wait for file upload response
					var timerFile = setInterval(function() {
					    console.log("waiting for "+form+" success message");
							if (currentForm.find('#fileUploadSuccess').length){
								console.log(form+" successfull");
								//get file input content
								var fileNameString = currentForm.find('.file_messageblock_fileheader_label').html()
								//get filename without the rest of the success message
								var fileName= fileNameString.substr(0, fileNameString.indexOf(' '));
								//add year and month in name for path created when using the WP media library
								var fileName= currentYear+"/"+currentMonth+"/"+fileName;
								jQuery(filesField).val(jQuery(filesField).val() + fileName + ",");
								//file is now uploaded. Upload process completed
								isFileUploadInProgress = false;
								clearInterval(timerFile);
						    }
						    else{
						    	if (jQuery(form).find('#fileUploadError').length){
						    	console.log(form+" error");
						    	//file is cancelled. upload process completed
						    	isFileUploadInProgress = false;
						    	clearInterval(timerFile);
						    	}
						    }
					}, 100);

				}
				else{console.log("there is NO file!!!")}
			}
			else{console.log("there is NO file!!!")}
		}



//DASHBOARD

	//Project files
	jQuery('.filesList').each(function(){
		var projects_files_array = jQuery(this).html().split(",");
		jQuery(this).html('');
		for (var i=0;i<projects_files_array.length-1;i++){
			var fileNameWithoutPath = projects_files_array[i].split('/').pop();
		     jQuery(this).append("<a class='fileUploadLink' target='_blank' href='http://www.digitalcandy.agency/poplet/wp-content/uploads/"+projects_files_array[i]+"'>"+fileNameWithoutPath+"</a>");
		     
		}	
	});







	});
	
})(jQuery, this);
