(function ($, root, undefined) {
	
	$(function () {
		
		'use strict';
		
//-------
//CREATE PROJECT
//-------
	var debugMode = false;

	var amountProjectToSubmit = 0;
		
	var isSpaceCreated = false;
	var isRenovationCreated = false;
	var isDesignCreated = false;
	var isMarketingCreated = false;
	var isStaffCreated = false;
	var isAccountCreated = false;

	
	var spaceFormID = "#form_l6nqm";
	var spaceFormInputUID = "#field_iz839";

	var renovationFormID = "#form_l6nqm2";
	var renovationFormInputUID = "#field_iz8392";
	
	var designFormID = "#form_l6nqm3";
	var designFormInputUID = "#field_iz8393";
	
	var marketingFormID = "#form_l6nqm4";
	var marketingFormInputUID = "#field_iz8394";
	
	var staffFormID = "#form_l6nqm42";
	var staffFormInputUID = "#iz83942";


	var isTandCAgreed = false;
	var AccountLoginMode = "createAccount"; //logIntoAccount



	var isFileUploadInProgress = false;

	var currentUserID="";
	var amountOfProjectSelected = 0;
	//function allowing to get field type even if it does not exist i.e. SELECT inputs
	jQuery.fn.getType = function(){ return this[0].tagName == "INPUT" ? this[0].type.toLowerCase() : this[0].tagName.toLowerCase(); }

	//-------
	//Project selection actions
	//-------	
		jQuery("#projectSelection li").on("click", function() {
			var currentProjectCliked = jQuery(this);
			var currentProjectID = currentProjectCliked.attr("data-pType");
			currentProjectCliked.toggleClass("active");
			
			if(currentProjectCliked.hasClass("active")){
			//selection is active
				//show selected sub-project form
				jQuery(currentProjectID).show();
				//show duplicate field form only if it was hidden i.e 0 projects selected
					if(amountOfProjectSelected===0)
					{
						jQuery("#duplicateFields").show();
						
					}
				amountOfProjectSelected+=1;
			}
			else{
			//selection is not active
				//show selected sub-project form
				jQuery(currentProjectID).hide();
				//hide duplicate field form if the only selected project is going to be hidden
					if(amountOfProjectSelected===1)
					{
						// jQuery("#duplicateFields").hide();
					}
				amountOfProjectSelected-=1;
				}
			//duplicated fields specific to first 3 projects only. show if any of the top 3 project is active
			if(jQuery("#selectionSpace").hasClass("active")||jQuery("#selectionRenovation").hasClass("active")||jQuery("#selectionDesign").hasClass("active")){
				jQuery(".show_1-2-3").show()
			}
			else{jQuery(".show_1-2-3").hide()}
		})

		// jQuery("#field_yw2713-1").prop('checked',true)

		

		//--------------
		//hide duplicated fields in the individual sub-project forms (look for same labels and hide parent div of result)
		//--------------
		jQuery("#duplicateFields label").each(function(){
			var FieldLabel = jQuery(this).text();

			//do not select labels from checkboxes as the use labels for each checkboxes rather than one for the question
			// the OTHER field works differently so we need to remove it as well
			if (FieldLabel===" "||FieldLabel==="Other"||FieldLabel==="Others"){
				console.log("not hiding the empty label from checkbox");	
			}
			else{
			// console.log("hiding:"+FieldLabel);

			//hide only the fields from sub
			jQuery("#subProjects").find("label:contains("+FieldLabel+")").parent().hide();
			//un-hide only the duplicate fields
			jQuery("#duplicateFields label").show();
			}
		})

		



		// Duplicated fields
		var duplicateTheField = function(theInput){
console.log(" ###### EVENT ###### ");
				var theInputID = theInput.attr('id');

				//if input is a OTHER input, the ID has -otext in it so it needs to be removed
				//also, if input is a OTHER input within a checkbox, the ID has -otext in it so it needs to be removed
					if(theInput.hasClass("frm_other_input ")||theInput.parent().hasClass('frm_checkbox')){
						theInputID = theInputID.slice(0,-6)
						}
					var masterInputLabel = jQuery("label[for='"+theInputID+"']");
				//get element label text
				var masterFieldLabel = masterInputLabel.text();
				console.log("masterFieldLabel:"+masterFieldLabel);
				
console.log("-------EVENT TYPE"+theInput.getType());
					//there are different ways to retrieve data based on input type
					if(theInput.getType()==="text" || theInput.getType()==="range" ){
						var masterInputVal = theInput.val();
						
						//checkbox other option text field 
						// if(theInput.parent().hasClass('frm_checkbox')){
						// 	console.log(theInput.attr('id'));
						// }
						// else{}
						// console.log('masterInputVal:'+masterInputVal);

					}
					else{
						if(theInput.getType()==="select"){
						var masterInputVal = theInput.children('option:selected').val();
						
						}
						else{
							if(theInput.getType()==="checkbox"){
								//need to know if it s checked rather than a value
								if(theInput.prop("checked")){
									//find input in other forms and check
									masterInputVal = "checked";
								}
								else{
									//find input in other forms and uncheck
									masterInputVal = "notChecked";
								}

							}

						}
					}
					console.log('masterInputVal:'+masterInputVal);
					//find other labels with same text
					jQuery("label:contains("+masterFieldLabel+")").each(function(){
						// console.log(jQuery(this).attr("for"));
							//get the attribut FOR
					        var labelForTxt = jQuery(this).attr("for");
					        //value is needed for text value only, not checkboxes where we need to set to check or unchecked
						        if(masterInputVal==="checked"||masterInputVal==="notChecked"){
						        //set checkbox status
						        	if(masterInputVal==="checked"){jQuery("#"+labelForTxt).prop('checked', true);}
						        	else{jQuery("#"+labelForTxt).prop('checked', false);}
						        }
						        else{
						        	//set input value to master value for OTHER inputs which as they have -otext in their IDs
									if(theInput.hasClass("frm_other_input ")||theInput.parent().hasClass('frm_checkbox')){
									jQuery("#"+labelForTxt+"-otext").attr("value",masterInputVal);
									}
									else{
						        	//set input value to master value
						        	jQuery("#"+labelForTxt).attr("value",masterInputVal);
						        	console.log("duplicating text / range on: #"+labelForTxt);
						        	}
						   		}
				   	});
		}

		jQuery("#duplicateFields input").on('input', function() {
			duplicateTheField(jQuery(this));
		})
		jQuery("#duplicateFields select").on('change', function() {
				duplicateTheField(jQuery(this));
		})
		jQuery("#duplicateFields :checkbox").on('change', function() {
				duplicateTheField(jQuery(this));
		})


		//wait until user clicks on datepicker parent before binding event on date pickers as datepicker needs to init first.
		//User click on parent is a way to wait for the initialisation to happen
		jQuery("#duplicateFields #field_6j02x").parent().on('click', function(){
				    	if(jQuery("#ui-datepicker-div").length){
							jQuery(".hasDatepicker").on('change', function() {
								duplicateTheField(jQuery(this));
							})
						}
						else{console.log("data UI not yet initialised");}
		})


		//-------
		//Account area on create project page
		//-------
		var checkAccountType = function() {
				if(jQuery("#radio01").is(':checked')){
					jQuery("#loginReturningUser").hide();
					jQuery("#loginNewUser").show();
					jQuery("#tcWrapper").css({'visibility':'visible'});
					AccountLoginMode = "createAccount";
				}
				else{
					jQuery("#loginReturningUser").show();
					jQuery("#loginNewUser").hide();
					jQuery("#tcWrapper").css({'visibility':'hidden'});
					AccountLoginMode = "logIntoAccount";
				}
		}

		jQuery("#accountType input").on('click', function(){
			checkAccountType();
		});

		jQuery('#radioTandC').on("click",function(){
			isTandCAgreed = true;
			jQuery("label[for='radioTandC']").css({'border':'none'})
		});

		checkAccountType();

		//-------
		//Submit forms
		//-------

		var submitFormGetResponse = function (form,successDivID, successFunction,errorFunction,isFormCreated){
		//submit requested form
		jQuery(form).find(':submit').trigger("click");
		//wait for account creation response
		var timer0 = setInterval(function() {
		    console.log("waiting for "+successDivID+" success message");
				if (jQuery(successDivID).length){
					console.log(form+" successfull");

					clearInterval(timer0);
					isFormCreated = true;
					successFunction(form);
			    }
			    else{
			    	if (jQuery(".frm_error").length){
			    	console.log(form+" error");
			    	clearInterval(timer0);
			    	isFormCreated = false;
			    	errorFunction(form);
			    	}
			    }
		}, 100);
		}

		var CheckForUserIDAndSubmit = function (){
			//check if user is logged in and userID is available on the page (checking on space creation form's userID field.)
			if (jQuery("#field_iz839").attr("value") ===""){
				console.log("UserID unknown!");
				//get UserID from ajaxuserid data page
				jQuery("#data").load("/poplet/data/ajaxuserid/ #userID", function() {
				currentUserID = jQuery("#data").text();
					if(currentUserID==="No Entries Found"){
						//user did not log in or account was not created.
						console.log("user must be LOGGED IN");
						jQuery("#customSubmitAll").before("<div class='frm_error mustBeLoggedIn'>You must be logged in</div>");
						// jQuery("#wp-submit").before("<div class='frm_error mustBeLoggedIn'>You must be logged in</div>");
					}
					else{
						jQuery(".mustBeLoggedIn").remove();


					//fill UserID fields on all forms

					//space
					// jQuery("#field_iz839").attr("data-frmval", currentUserID);
					// jQuery("#field_iz839").attr("value", currentUserID);
					jQuery(spaceFormInputUID).attr("data-frmval", currentUserID);
					jQuery(spaceFormInputUID).attr("value", currentUserID);

					//design
					jQuery(renovationFormInputUID).attr("data-frmval", currentUserID);
					jQuery(renovationFormInputUID).attr("value", currentUserID);

					//design
					jQuery(designFormInputUID).attr("data-frmval", currentUserID);
					jQuery(designFormInputUID).attr("value", currentUserID);

					//design
					jQuery(marketingFormInputUID).attr("data-frmval", currentUserID);
					jQuery(marketingFormInputUID).attr("value", currentUserID);

					//design
					jQuery(staffFormInputUID).attr("data-frmval", currentUserID);
					jQuery(staffFormInputUID).attr("value", currentUserID);
					
					console.log("UserID inserted on all forms. Submitting forms");

					submitSelectedProjects();						
					}
				});
			}
			//if user was loged in on page load all userID would be already available. Same if user hit submit with errors outside of project creation
			else{
				console.log("UserID already inserted on all forms. Submitting forms");
					submitSelectedProjects();
			}
		}

		//last step submit projects
		var submitSelectedProjects = function(){
				amountProjectToSubmit = jQuery("#projectSelection li.active").length;
				if(amountProjectToSubmit === 0){jQuery("#customSubmitAll").before("<div class='frm_error'>You must select at least 1 service</div>");}
				console.log("there are "+amountProjectToSubmit+" projects to submit");
					//submit space forms
					if (!isSpaceCreated && jQuery("#selectionSpace").hasClass("active")){
					submitFormGetResponse(spaceFormID,'#spaceCreated',projectCreationSuccess,projectCreationError,isSpaceCreated)
					}
					else{if(isSpaceCreated){amountProjectToSubmit -=1;}}
					
					//submit renovation forms
					if (!isRenovationCreated && jQuery("#selectionRenovation").hasClass("active")){
					submitFormGetResponse(renovationFormID,'#renovationCreated',projectCreationSuccess,projectCreationError,isDesignCreated)
					}
					else{if(isRenovationCreated){amountProjectToSubmit -=1;}}

					//submit design forms
					if (!isDesignCreated && jQuery("#selectionDesign").hasClass("active")){
					submitFormGetResponse(designFormID,'#designCreated',projectCreationSuccess,projectCreationError,isDesignCreated)
					}
					else{if(isDesignCreated){amountProjectToSubmit -=1;}}

					//submit marketing forms
					if (!isMarketingCreated && jQuery("#selectionMarketing").hasClass("active")){
					submitFormGetResponse(marketingFormID,'#marketingCreated',projectCreationSuccess,projectCreationError,isDesignCreated)
					}
					else{if(isMarketingCreated){amountProjectToSubmit -=1;}}

					//submit staff forms
					if (!isStaffCreated && jQuery("#selectionStaff").hasClass("active")){
					submitFormGetResponse(staffFormID,'#staffCreated',projectCreationSuccess,projectCreationError,isDesignCreated)
					}
					else{if(isStaffCreated){amountProjectToSubmit -=1;}}
		}

		//Submit all forms button
		jQuery("#customSubmitAll").on("click",function(){
		    // Submit account creation form and wait for response. submit projects once successful
		    if(isFileUploadInProgress){
		    	console.log("wait for upload to complete!")
		    }
		    else{
		    	// Submit account creation form and wait for response. submit projects once successful
		    	//account has not been created yet or is not available--> create account and submit all projects
		    	if (jQuery("#field_iz839").attr("value") ===""){
		    		if(AccountLoginMode==="createAccount"){
			    		if(isTandCAgreed===true)
			    		{
			    			submitFormGetResponse('#form_frmprocontact2','#accountCreated',CheckForUserIDAndSubmit,accountCreationFailed,isAccountCreated);	
			    		}
			    		else{
			    			jQuery("label[for='radioTandC']").css({'border':'2px solid #fc391d'})
			    		}
			    	}
			    	else{
			    		//login mode selected. no need to create account so we launch the next function directly
			    		CheckForUserIDAndSubmit();
			    	}

		    	}
		    	//if account is already created
		    	else{submitSelectedProjects()}
		    }
		})

		var accountCreationFailed = function(form){
			console.log("account creation failed. Projects won't be submitted. FORM = "+form);
		}

		var projectCreationSuccess = function(form){
			console.log("Project "+form+" created");
			if(form === spaceFormID){
			console.log("Space Project created");
			isSpaceCreated = true;
			}
			else{
					if(form === renovationFormID){
					console.log("renovation Project created");
					isRenovationCreated = true;
					}
					else{
						if(form === designFormID){
						console.log("design Project created");
						isDesignCreated = true;
						}
						else{
							if(form === marketingFormID){
							console.log("marketing Project created");
							isMarketingCreated = true;
							}
							else{
								if(form === staffFormID){
								console.log("staff Project created");
								isStaffCreated = true;
								}
							}
						}
					}
				}

			amountProjectToSubmit -=1;
			if(amountProjectToSubmit === 0){
				window.location.href = "dashboard/";
			}
			
		}
		var projectCreationError = function(form){
			console.log("Project "+form+" error");
		}

		//-------
		//file upload
		//-------

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


//-------
//DASHBOARD
//-------
	
	//Project files
			//below needed for another file upload plugin.

	// jQuery('.filesList').each(function(){
	// 	var projects_files_array = jQuery(this).html().split(",");
	// 	jQuery(this).html('');
	// 	for (var i=0;i<projects_files_array.length-1;i++){
	// 		var fileNameWithoutPath = projects_files_array[i].split('/').pop();
	// 	     jQuery(this).append("<a class='fileUploadLink' target='_blank' href='http://www.digitalcandy.agency/poplet/wp-content/uploads/"+projects_files_array[i]+"'>"+fileNameWithoutPath+"</a>");
		     
	// 	}	
	// });

	//convert file URLs to links with file name as label
	jQuery(".fileURL").each(function(){
		var projects_files_array = jQuery(this).html().split(",");
		jQuery(this).html('');
		if(projects_files_array!=""){
			for (var i=0;i<projects_files_array.length;i++){
				var fileNameWithoutPath = projects_files_array[i].split('/').pop();
			     jQuery(this).append("<a class='fileUploadLink' target='_blank' href='"+projects_files_array[i]+"'>"+fileNameWithoutPath+"</a>");
			}
		}	
	});


//-------
//UI
//-------
	
	//make sure that checkboxes which are already cheked are highlighted
	jQuery('input:checkbox:checked').parent("label").addClass("active");

	//custom checkbox class for styling
	jQuery('input:checkbox').on("click",function(){
		var currentCheckbox = jQuery(this);
		if (currentCheckbox.prop("checked")){
			currentCheckbox.parent().addClass("active");
		}else{currentCheckbox.parent().removeClass("active")}
	});

	//place holders for account creation fields
	jQuery('#field_wwtp302').attr( 'placeholder', 'User name' );
	jQuery('#field_xnkv8k2').attr( 'placeholder', 'Email address' );
	jQuery('#field_tnz6v').attr( 'placeholder', 'Phone Number' );

	// login page
	jQuery('#user_login').attr( 'placeholder', 'Email address' );
	jQuery('input:password').attr( 'placeholder', 'Password' );

	// all submit buttons to use the buttons class
	jQuery("input:submit").addClass("btn btn-important");

	//collapse UI dashboard
	jQuery(".collapsableWithIcon").on("click",function(){
		var currentCollapseHeader = jQuery(this);
		currentCollapseHeader.toggleClass("active");
		// if(currentCollapseHeader.hasClass("active")){
		// 	currentCollapseHeader.next('.collapseInner').hide();
		// }
		// else{currentCollapseHeader.next('.collapseInner').show();}
	})

	//range UI
	var updateRangeTooltip = function (range){
		var value = jQuery('.range-slider__value');
		var max = parseInt(range.attr('max'));
	      var min = parseInt(range.attr('min'));
	      var current_val = parseInt(range.attr('value'));
	      var tooltipWidthX2 = -20;
	      var percentTooltipPos = 100/((max-min)/(current_val-min));
	      var compensatePlacement = (percentTooltipPos/100*tooltipWidthX2-(tooltipWidthX2/2))-35;
		  range.next(value).html(current_val);
		  range.next(value).css({'left':percentTooltipPos+'%','margin-left':+compensatePlacement});
	}
	var rangeSlider = function(){
	  var slider = jQuery('.range-slider'),
      range = jQuery('.range-slider input'),
      value = jQuery('.range-slider__value')

	  slider.each(function(){
	 	//init
	    var max = parseInt(jQuery(this).find(range).attr('max'));
	    var min = parseInt(jQuery(this).find(range).attr('min'));
	    var default_val = parseInt(jQuery(this).find(range).attr('value'));
	    jQuery(this).find('.range-slider__min').html(min);
	    jQuery(this).find('.range-slider__max').html(max);
	    jQuery(this).find(value).html(max);
	    range.each(function(){
	    	updateRangeTooltip(jQuery(this));
	    });
	    //end init
	    value.each(function(){
	      var value = jQuery(this).prev().attr('value');
	      jQuery(this).html(value);
	    });
	    range.on('input', function(){
	      updateRangeTooltip(jQuery(this));
	    });
	  });
	};
	rangeSlider();





//-------
//USER 1 dashboard
//-------

	//Filter project
	var projectList = [];
	var currentProjectName = "";
	var previousDateInteger = "";
	var currentDateInteger = "";
	//
	// should specify parent div in case other h4 are available on the page. Should use something else instead of H5..
	//
	//create array containing all projects without duplicates and sorted by 'updated' date
	jQuery(".data-div h4").each(function(){
		var currentProjectName = jQuery(this).text();
		var currentDateInteger = jQuery(this).next("h5").text();
		// console.log(currentProjectName+currentDateInteger+"/////");
		//push project if not already in projectList array
		if(jQuery.inArray( currentProjectName, projectList )=== -1)
		{
			// console.log("adding project. current date:"+currentDateInteger+"prev date:"+previousDateInteger)
			if(previousDateInteger ===""){
				// console.log("no prev date ")
				projectList.push(jQuery(this).text());
				previousDateInteger = currentDateInteger;
			}
			else{
				// previous date is earlyier so current project is pushed last in the array
				if(previousDateInteger > currentDateInteger){
					projectList.push(jQuery(this).text());
				}
				else{
					projectList.unshift(jQuery(this).text());
				}
			}
		}
	})
	//generating select options
	jQuery.each(projectList, function(index, item) {
	    jQuery("#projectDropDown").append('<option>'+item+'</option>');
	});
	//function add class VISIBLE to div containing a h4 with selected project name
	var selectedProjectName = "";
	var filterProjects = function(){
			selectedProjectName = jQuery("#projectDropDown option:selected").text();
		jQuery(".data-div h4").each(function(){
			if (jQuery(this).text() === selectedProjectName)
			{
				jQuery(this).parent().parent().addClass("visible");
			}
			else{jQuery(this).parent().parent().removeClass("visible");}
		})
		//hide project type if there is no project to show
		jQuery('#dashboard-1 .projectWrapper').each(function(){
			if(jQuery(this).children('.visible').length){
				jQuery(this).prev("h2").show()}
			else{
				jQuery(this).prev("h2").hide();}
		})
	}
	//listen to drop down selection. Filter when selected project changes.
	jQuery("#projectDropDown").on('change', function() {
		filterProjects();
	})

	//initialise filter on page load
	filterProjects();

	//---------Update bid status----------/ remove old status text because the page needs to refresh to show correct status.
	jQuery(".frm_update_field_link").on("click",function(e){
		var timer1 = setInterval(function() {
				if (jQuery("td:contains('updated')").length){
					jQuery("td:contains('updated')").html("Updated");
					clearInterval(timer1);
			    }
		}, 100);
	})


//-------
//USER 2 dashboard
//-------
	jQuery(".btn-newBid").on('click', function(e) {
		e.preventDefault();
		//create container div for new bid form
		jQuery("#newBidFrame").remove();
		var currentLinkURL = jQuery(this).attr("href");
		var redirectURLID = jQuery(this).siblings("h2").attr("id");
	//iframe
		//hide NO BID message
		jQuery(this).prev(".bid-wrapper").children(".frm_no_entries").hide()
		//scroll to current button
		$('html, body').animate({
        	scrollTop: $(this).offset().top
    	}, 500);
		//load iframe
		jQuery(this).after("<iframe name='newBidFrame' src='"+currentLinkURL+"' id='newBidFrame' frameborder='0'> <h5 class='loading'>Loading</h5> </iframe>")

	//ajax
		// currentLinkURL = currentLinkURL+" .frm_forms";
		// jQuery(this).after("<div id='newBidFrame'> <h5 class='loading'>Loading</h5> </div>")
		// 	jQuery("#newBidFrame").load(currentLinkURL, function() {
		// 		console.log("done");
		// 		//init range sliders
		// 		rangeSlider();
		// 	});
	//refresh page after submission
			var timer3 = setInterval(function() {
				var successDiv = jQuery("iframe").contents().find("#bidCreated");
				console.log(successDiv.length);
				if (successDiv.length){
					clearInterval(timer3);
					window.location.href = "#"+redirectURLID;
					location.reload();
			    }
			    else{
			    	if (jQuery(".frm_error").length){
			    	console.log("bid error");
			    	clearInterval(timer3);
			    	}
			    }
		}, 1000);

	})


//-------
//pages loaded in iFrames
//-------
	//these pages have their body hidden to avoid flickering once their custom css is loaded so we need to show the hidden content on page load
	jQuery("body").css({"display":"block"});

//-------
//for debug
//-------
	if (debugMode){
		dmode();
	}

//END of JQUERY
	});
	
})(jQuery, this);

	//for debug
	var dmode = function(){
		jQuery("body").prepend('<h1 style="background:red;color:white;padding-top:0">Debug mode is on</h1>')
		showallfields()
	}

	var showallfields = function(){
		jQuery("#duplicateFields label").each(function(){
		var FieldLabel = jQuery(this).text();
		//hide only the fields from sub
		jQuery("#subProjects").find("label:contains("+FieldLabel+")").parent().show();
		})


			jQuery('input:checkbox:checked').parent("label").addClass("active");
			jQuery('input:submit').css({'display':'block'});
	}



