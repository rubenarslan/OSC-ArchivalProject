if(typeof PFGlobal=="undefined")var PFGlobal={SourceLoad:{FindADoctor:false}};else if(typeof PFGlobal.SourceLoad=="undefined")PFGlobal.SourceLoad={FindADoctor:false};else if(typeof PFGlobal.SourceLoad.FindADoctor=="undefined")PFGlobal.SourceLoad.FindADoctor=false;var instancefd,globalCountryRegion="US",SpecialtyObj="",plansfd="",planvision="",plandental="",positionvision,positiondental,isLoginLinkClicked=false,isSearchButtonclick=false;function PF_FindADoctor_Class(){FindADoctor.prototype=new ControlBase;FindADoctor.prototype.constructor=FindADoctor;FindADoctor.prototype.Init=function(a){ControlBase.prototype.Init.call(this,a);FindADoctor.prototype.PFPath=a.SourceUrl};FindADoctor.prototype.Load=function(){ControlBase.prototype.LoadWithParams.call(this,this.SourceUrl,this.ControlPath,null)};PFGlobal.SourceLoad.FindADoctor=true}if(typeof PFGlobal.SourceLoad.ControlBase=="undefined"||!PFGlobal.SourceLoad.ControlBase)setTimeout(function(){if(typeof PFGlobal.SourceLoad.ControlBase=="undefined"||!PFGlobal.SourceLoad.ControlBase)setTimeout(arguments.callee,100);else PF_FindADoctor_Class()},100);else PF_FindADoctor_Class();function FindADoctor(){ControlBase.call(this);this.ResponseContainer="divFindADoctor";if(IsSecure)this.ControlPath="/navigate.aspx?site=providerfinderconsumer&cat=providerdirectory&page=findadoctor";else this.ControlPath="/navigate.aspx?site=providerfinderpublic&cat=provider-directory&page=finda-doctor";this.Ready=function(){$("#Specialty_helpIcon").tooltip({track:true,delay:0,showURL:false,showBody:" - ",fade:250,bodyHandler:function(){return $("#divSpecialtyhelp").html()}});$("#DentalSpecialty_helpIcon").tooltip({track:true,delay:0,showURL:false,showBody:" - ",fade:250,bodyHandler:function(){return $("#divSpecialtyhelp").html()}});$("#VisionSpecialty_helpIcon").tooltip({track:true,delay:0,showURL:false,showBody:" - ",fade:250,bodyHandler:function(){return $("#divSpecialtyhelp").html()}});var a=this;instancefd=this;var b;CheckLoginMPPF(a.SourceUrl);$("a[id$='linkLogin']").live("click",function(){isLoginLinkClicked=true;isSearchButtonclick=false;a.setSessionValues(a,b);a.login()});$('input[id$="BtnNewSearch"]').click(function(){$("div#divFindADoctor").css({display:"block"});$("div#divNewSearch").css({display:"none"})});$.updnWatermark.attachAll();$(".updnWatermark").each(function(){if($.browser.mozilla&&($(":first-child",this).attr("for").search(/ZipCodeBS/gi)>0||$(":first-child",this).attr("for").search(/txtDistance1/gi)>0||$(":first-child",this).attr("for").search(/txtDistance/gi)>0)){$(":first-child",this).css("padding-left","10px");$(":first-child",this).css("padding-top","0px");$(":first-child",this).css("top","-15px");$(":first-child",this).css("display","inline")}else{$(":first-child",this).css("padding-left","5px");$(":first-child",this).css("padding-top","0px");$(":first-child",this).css("top","2px");$(":first-child",this).css("display","inline")}});FindADoctor_ControlReady();$("#btnBasicSearch").attr("disabled",true);$("#btnBasicSearch").removeClass("activebsbutton").addClass("inactivebsbutton");$('input[id$="btnBasicSearch"]').click(function(){isSearchButtonclick=true;isLoginLinkClicked=false;if($("input[name$=LocationGroupBS]:checked").val()=="rbLocation")GeoCodeValidation();else GeoCodeValidationZip()});$("#FindADoctorContainer").keypress(function(b){if(b.keyCode==13)if(a.validation()){$("#btnBasicSearch").attr("disabled",false);$("#btnBasicSearch").removeClass("inactivebsbutton").addClass("activebsbutton");$("#btnBasicSearch").click();return false}else{$("#btnBasicSearch").attr("disabled",true);$("#btnBasicSearch").removeClass("activebsbutton").addClass("inactivebsbutton");return false}});$(".validbs").keyup(function(){if(a.validation()){$("#btnBasicSearch").attr("disabled",false);$("#btnBasicSearch").removeClass("inactivebsbutton").addClass("activebsbutton")}else{$("#btnBasicSearch").attr("disabled",true);$("#btnBasicSearch").removeClass("activebsbutton").addClass("inactivebsbutton")}});$(".validbs").click(function(){if(a.validation()){$("#btnBasicSearch").attr("disabled",false);$("#btnBasicSearch").removeClass("inactivebsbutton").addClass("activebsbutton")}else{$("#btnBasicSearch").attr("disabled",true);$("#btnBasicSearch").removeClass("activebsbutton").addClass("inactivebsbutton")}});$("input[name$=LocationGroupBS]").click(function(){if($(this).val()=="rbLocation"){$("div#divCityState").css({display:"block"});$("div#divZip").css({display:"none"});$("div#divRadius").css({display:"block"});$("div#divRadius1").css({display:"none"});$("div#errValidZip").css({display:"none"});if(a.validation()){$("#btnBasicSearch").attr("disabled",false);$("#btnBasicSearch").removeClass("inactivebsbutton").addClass("activebsbutton")}else{$("#btnBasicSearch").attr("disabled",true);$("#btnBasicSearch").removeClass("activebsbutton").addClass("inactivebsbutton")}}if($(this).val()=="rbZip"){$("div#divCityState").css({display:"none"});$("div#divRadius").css({display:"none"});$("div#divRadius1").css({display:"block"});$("div#divZip").css({display:"inline"});$("div#errCityVal").css({display:"none"});if(a.validation()){$("#btnBasicSearch").attr("disabled",false);$("#btnBasicSearch").removeClass("inactivebsbutton").addClass("activebsbutton")}else{$("#btnBasicSearch").attr("disabled",true);$("#btnBasicSearch").removeClass("activebsbutton").addClass("inactivebsbutton")}}});$("#searchwizardpop #btnChange").click(function(){isSearchButtonclick=false;isLoginLinkClicked=false;b=false;a.setSessionValues(a,b,null,null)});$("#divDentistNotes #advsearchlink").click(function(){isSearchButtonclick=false;isLoginLinkClicked=false;var c=new SearchWizard,d={Container:a.Container,SourceUrl:a.SourceUrl};b=false;a.setSessionValues(a,b,null,null);a.Navigate("searchwizard",c,d)});$("#divVisionNotes #advsearchlink").click(function(){isSearchButtonclick=false;isLoginLinkClicked=false;var c=new SearchWizard,d={Container:a.Container,SourceUrl:a.SourceUrl};b=false;a.setSessionValues(a,b,null,null);a.Navigate("searchwizard",c,d)});$("#lnkAdvancedSpan #linkAdvancedSearch").click(function(){isSearchButtonclick=false;isLoginLinkClicked=false;var c=new SearchWizard,d={Container:a.Container,SourceUrl:a.SourceUrl};b=false;a.setSessionValues(a,b,null,null);a.Navigate("searchwizard",c,d)});$("select[id$='selDistance']").change(function(){var b=$(this).val();if($("input[name$=LocationGroupBS]:checked").val()=="rbLocation")if(b=="Others"){$("div#distanceDiv").css({display:"block"});if(a.validation()){$("#btnBasicSearch").attr("disabled",false);$("#btnBasicSearch").removeClass("inactivebsbutton").addClass("activebsbutton")}else{$("#btnBasicSearch").attr("disabled",true);$("#btnBasicSearch").removeClass("activebsbutton").addClass("inactivebsbutton")}}else{$("div#distanceDiv").css({display:"none"});if(a.validation()){$("#btnBasicSearch").attr("disabled",false);$("#btnBasicSearch").removeClass("inactivebsbutton").addClass("activebsbutton")}else{$("#btnBasicSearch").attr("disabled",true);$("#btnBasicSearch").removeClass("activebsbutton").addClass("inactivebsbutton")}}else if(b=="Others"){$("div#distanceDiv1").css({display:"block"});if(a.validation()){$("#btnBasicSearch").attr("disabled",false);$("#btnBasicSearch").removeClass("inactivebsbutton").addClass("activebsbutton")}else{$("#btnBasicSearch").attr("disabled",true);$("#btnBasicSearch").removeClass("activebsbutton").addClass("inactivebsbutton")}}else{$("div#distanceDiv1").css({display:"none"});if(a.validation()){$("#btnBasicSearch").attr("disabled",false);$("#btnBasicSearch").removeClass("inactivebsbutton").addClass("activebsbutton")}else{$("#btnBasicSearch").attr("disabled",true);$("#btnBasicSearch").removeClass("activebsbutton").addClass("inactivebsbutton")}}});$("select[id$='selDistance1']").change(function(){var b=$(this).val();if($("input[name$=LocationGroupBS]:checked").val()=="rbLocation")if(b=="Others"){$("div#distanceDiv").css({display:"block"});if(a.validation()){$("#btnBasicSearch").attr("disabled",false);$("#btnBasicSearch").addClass("activebsbutton")}else{$("#btnBasicSearch").attr("disabled",true);$("#btnBasicSearch").removeClass("activebsbutton").addClass("inactivebsbutton")}}else{$("div#distanceDiv").css({display:"none"});if(a.validation()){$("#btnBasicSearch").attr("disabled",false);$("#btnBasicSearch").removeClass("inactivebsbutton").addClass("activebsbutton")}else{$("#btnBasicSearch").attr("disabled",true);$("#btnBasicSearch").removeClass("activebsbutton").addClass("inactivebsbutton")}}else if(b=="Others"){$("div#distanceDiv1").css({display:"block"});if(a.validation()){$("#btnBasicSearch").attr("disabled",false);$("#btnBasicSearch").removeClass("inactivebsbutton").addClass("activebsbutton")}else{$("#btnBasicSearch").attr("disabled",true);$("#btnBasicSearch").removeClass("activebsbutton").addClass("inactivebsbutton")}}else{$("div#distanceDiv1").css({display:"none"});if(a.validation()){$("#btnBasicSearch").attr("disabled",false);$("#btnBasicSearch").removeClass("inactivebsbutton").addClass("activebsbutton")}else{$("#btnBasicSearch").attr("disabled",true);$("#btnBasicSearch").removeClass("activebsbutton").addClass("inactivebsbutton")}}});setTimeout(function(){$("input:text[value!='']").trigger("focus");$("select:option[title!='']").trigger("focus")},2e3)};this.setSessionValues=function(x,v,E,D){if($("select[id$='PFSearchCategoryBS']").val()=="D"&&isSearchButtonclick)if($("input[name$=DentalGroupBS]:checked").val()=="DentalDoctorRBfd"){var w=$("select[id$='ddlplandentalbs'] :selected").text();if(typeof w!="undefined"&&w.toLowerCase()=="liberty dental"){window.open("https://www.libertydentalplan.com/wellpoint/");return false}}var a=$("select[id$='PFSearchCategoryBS']").val(),B=$("select[id$='PFSearchCategoryBS']").find(":selected").text(),e="",j="",r="",d="",m="",u="",i=false,h="",l="",c="",f="",t=false,s=false,n="",p="",g="";h=getUrlVarsFA().netid;if(typeof h!="undefined"&&h!=null)h=h.replace("#","");else h="";if(a=="V")if($("input[name$=VisionGroupBS]:checked").val()=="VisionDoctorRB"){j=$("select[id$='_SpecialityVisionDoctor']").val();m=$("select[id$='_SpecialityVisionDoctor']").find(":selected").text();e=$("input[id$='VisionDoctorLastNameBS']").val();i=true;l="M"}else{e=$("input[id$='VisionCenterLastNameBS']").val();l="V";c=$("select[id$='ddlplanvisionbs']").val();if($("input[name$=VisioncenterGroupbs]:checked").val()=="rbvisiondoctorbs")i=true;if(c!=""){if(Brand.toLowerCase()=="abcbs")g="CO";else if(Brand.toLowerCase()=="bcbsga")g="GA";else if(Brand.toLowerCase()=="abc")g="CA";p=plansfd[positionvision].PlanName;for(var b=0;b<plansfd[positionvision].Plans.length;b++)if(plansfd[positionvision].Plans[b].PlanId==c){n=plansfd[positionvision].Plans[b].PlanName;t=plansfd[positionvision].Plans[b].nationalPlanIndicatorField;s=plansfd[positionvision].Plans[b].nationalPlanIndicatorFieldSpecified;for(var k=0;k<plansfd[positionvision].Plans[b].NetworkIds.length;k++)f=f+plansfd[positionvision].Plans[b].NetworkIds[k]+"-"}}}else if(a=="D")if($("input[name$=DentalGroupBS]:checked").val()=="DentalDoctorRBfd"){j=$("select[id$='_SpecialitydentalDoctorfd']").val();m=$("select[id$='_SpecialitydentalDoctorfd']").find(":selected").text();e=$("input[id$='dentalDoctorLastNameBS']").val();i=true;l="D";c=$("select[id$='ddlplandentalbs']").val();if(c!=""){if(Brand.toLowerCase()=="abcbs")g="CO";else if(Brand.toLowerCase()=="bcbsga")g="GA";else if(Brand.toLowerCase()=="abc")g="CA";p=plansfd[positiondental].PlanName;for(var b=0;b<plansfd[positiondental].Plans.length;b++)if(plansfd[positiondental].Plans[b].PlanId==c){n=plansfd[positiondental].Plans[b].PlanName;t=plansfd[positiondental].Plans[b].nationalPlanIndicatorField;s=plansfd[positiondental].Plans[b].nationalPlanIndicatorFieldSpecified;for(var k=0;k<plansfd[positiondental].Plans[b].NetworkIds.length;k++)f=f+plansfd[positiondental].Plans[b].NetworkIds[k]+"-"}}}else{e=$("input[id$='DentalCenterLastNameBS']").val();i=true;l="M"}else if(a=="P"||a=="D"||a=="O"||a=="B"||a=="H"||a=="U"||a=="R"||a=="L"||a=="G"||a=="M"){j=$("select[id$='SpecialityMainBS']").val();m=escape($("select[id$='SpecialityMainBS'] :selected").text()).replace(/%/g,"-0-");e=$("input[id$='LastNameBS']").val()}else if(a=="G"){j="";u=$("select[id$='SpecialityMainBS']").val();m=escape($("select[id$='SpecialityMainBS'] :selected").text()).replace(/%/g,"-0-");e=$("input[id$='LastNameBS']").val()}else{u="";j=""}if(a=="P"||a=="D"||a=="B")i=true;if(a=="V"&&$("#VisionSubSpldiv").is(":visible")&&$("input[name$=VisionGroupBS]:checked").val()=="VisionDoctorRB"){r=$("select[id$='SubSpecialityVisionDoctor']").val();if($("select[id$='SubSpecialityVisionDoctor']").val()=="")d="Sub-Specialties";else d=escape($("select[id$='SubSpecialityVisionDoctor'] :selected").text()).replace(/%/g,"-0-")}else if(a=="D"&&$("#dentalSubSpldivbs").is(":visible")){r=$("select[id$='SubSpecialityDentalDoctorBS']").val();if($("select[id$='SubSpecialityDentalDoctorBS']").val()=="")d="Sub-Specialties";else d=escape($("select[id$='SubSpecialityDentalDoctorBS'] :selected").text()).replace(/%/g,"-0-")}else if($("#subSpecialityDiv").is(":visible")){r=$("select[id$='SpecialitySub']").val();if($("select[id$='SpecialitySub']").val()=="")d="Sub-Specialties";else d=escape($("select[id$='SpecialitySub'] :selected").text()).replace(/%/g,"-0-")}var o="",z="",A="",y="";if($("input[name$=LocationGroupBS]:checked").val()=="rbLocation"){z=$("input[id$='txtCities']").val();y=$("select[id$='selState']").find(":selected").text();if($("select[id$='selDistance']").val()=="Others")o=$("input[id$='txtDistance']").val();else o=$("select[id$='selDistance']").val()}else{A=$("input[id$='ZipCodeBS']").val();if($("select[id$='selDistance1']").val()=="Others")o=$("input[id$='txtDistance1']").val();else o=$("select[id$='selDistance1']").val()}c=escape(c).replace(/%/g,"-0-");f=escape(f).replace(/%/g,"-0-");n=escape(n).replace(/%/g,"-0-");p=escape(p).replace(/%/g,"-0-");var C={ProviderType:a,ProviderTypeName:B,ProviderName:e,Specialty:j,SubSpecialty:r,SubspecialtyName:d,SpecialtyName:m,MedicalCenterType:u,Distance:o,City:z,State:y,Zip:A,isProfessional:i,latitude:E,longitude:D,netidqs:h,coveragetypecode:l,plancode:c,networkids:f,plantype:p,plancodeName:n,wlpstate:g,nationalplanindicator:t,nationalplanindicatorspecified:s,branding:getParameterByName("branding")},q=this;$.ajax({url:this.SourceUrl+"/webcontrols/providerfinder/Services/Providerfinder_wcf.svc/SetSearchCriteria?callback=?",data:C,dataType:"json",success:function(){if(v&&!isLoginLinkClicked)if(IsSecure)ShowPFModal();else{var a=new FindADoctor,c={Container:x.Container,SourceUrl:x.SourceUrl};q.Navigate("SearchResults",a,c)}else if(!v&&!isLoginLinkClicked){var b=new SearchWizard,d={Container:q.Container,SourceUrl:q.SourceUrl};q.Navigate("searchwizard",b,d)}}})};this.validation=function(){var a=true,b=$("select[id$='PFSearchCategoryBS']").val();if(b==null||b=="select"||b==""){a=false;$('[id$="ErrorProvider"]').hide()}else $('[id$="ErrorProvider"]').hide();if($("input[name$=VisionGroupBS]:checked").val()!="VisionDoctorRB"&&b=="V"){var f=$("select[id$='ddlplanvisionbs']").val();if(f=="")a=false}else if($("input[name$=DentalGroupBS]:checked").val()=="DentalDoctorRBfd"&&b=="D"){var f=$("select[id$='ddlplandentalbs']").val();if(f=="")a=false}var c="";if($("input[name$=LocationGroupBS]:checked").val()=="rbLocation"){var e=$("select[id$='selState']").find(":selected").text();if(e==null||e=="state"||e==""){a=false;$('[id$="ErrorState"]').hide()}else $('[id$="ErrorState"]').hide();if($("input[id$='txtCities']").val()==null||$("input[id$='txtCities']").val()==""||cityVliation($("input[id$='txtCities']").val())){a=false;$('[id$="ErrorCity"]').hide()}else $('[id$="ErrorCity"]').hide();c=$("select[id$='selDistance']").val();if(c=="Others"){var d=parseFloat($("input[id$='txtDistance']").val());if($("input[id$='txtDistance']").val()==null||$("input[id$='txtDistance']").val()==""||isNaN($("input[id$='txtDistance']").val())||d<0||d>100){a=false;$('[id$="ErrorDistanceText"]').hide()}else $('[id$="ErrorDistanceText"]').hide()}}else{if($("input[id$='ZipCodeBS']").val()==null||$("input[id$='ZipCodeBS']").val()==""||!validateZipCode($("input[id$='ZipCodeBS']").val())){a=false;$('[id$="ErrorZip"]').hide()}else $('[id$="ErrorZip"]').hide();c=$("select[id$='selDistance1']").val();if(c=="Others"){var d=parseFloat($("input[id$='txtDistance1']").val());if($("input[id$='txtDistance1']").val()==null||$("input[id$='txtDistance1']").val()==""||isNaN($("input[id$='txtDistance1']").val())||d<0||d>100){a=false;$('[id$="ErrorDistanceText1"]').hide()}else $('[id$="ErrorDistanceText1"]').hide()}}return!a?false:true}}function FindADoctor_ControlReady(){var b=$("input[id$='hSiteCulture']").val();if(getParameterByName("culture")!=null&&getParameterByName("culture")!=""&&getParameterByName("culture")=="mx"||b=="mx"){$("td#nyPrintTD").hide();$("td#nyZoomTD").hide()}$("input[name$=VisionGroupBS]").click(function(){if($(this).val()=="VisionDoctorRB"){$("div#VisionDoctorDiv").css({display:"block"});$("div#VisionCenterDiv").css({display:"none"})}if($(this).val()=="VisionCenterRB"){$("div#VisionDoctorDiv").css({display:"none"});$("div#VisionCenterDiv").css({display:"block"})}});$("input[name$=DentalGroupBS]").click(function(){if($(this).val()=="DentalDoctorRBfd"){$("div#DentalDoctorDivfd").css({display:"block"});$("div#DentalCenterDivBS").css({display:"none"})}if($(this).val()=="OtherDentalRB"){$("div#DentalDoctorDivfd").css({display:"none"});$("div#DentalCenterDivBS").css({display:"block"})}});var a=$("select[id$='PFSearchCategoryBS']").val();ManageQueryStringElementFD(a);populateplantypefd()}function ManageQueryStringElementFD(a){switch(a){case"V":$("div#DrAndDentstDivBS").css({display:"none"});$("div#VisionDiv").css({display:"block"});$("div#divHospital").css({display:"none"});$("div#Dentaldivfd").css({display:"none"});GetSpeciality(a);break;case"P":case"O":case"B":case"H":case"U":case"L":case"G":case"M":$("div#VisionDiv").css({display:"none"});$("div#DrAndDentstDivBS").css({display:"block"});$("div#specialitydiv").css({display:"block"});$("div#divHospital").css({display:"none"});$("div#Dentaldivfd").css({display:"none"});GetSpeciality(a);break;case"D":$("div#VisionDiv").css({display:"none"});$("div#DrAndDentstDivBS").css({display:"none"});$("div#specialitydiv").css({display:"none"});$("div#divHospital").css({display:"none"});$("div#Dentaldivfd").css({display:"block"});GetSpeciality(a);break;case"R":$("div#VisionDiv").css({display:"none"});$("div#DrAndDentstDivBS").css({display:"block"});$("div#specialitydiv").css({display:"none"});$("div#divHospital").css({display:"none"});$("div#Dentaldivfd").css({display:"none"});break;default:$("div#VisionDiv").css({display:"none"});$("div#DrAndDentstDivBS").css({display:"none"});$("div#divHospital").css({display:"none"});$("div#DentalDivfd").css({display:"none"})}$("span[id$='lblHelpText']").text("All Speciality")}function validateZipCode(b){var a=/^\d{5}([\-]\d{4})?$/;return!a.test(b)?false:true}function isInteger(b){var a;b=b.toString();for(a=0;a<b.length;a++){var c=b.charAt(a);if(isNaN(c))return false}}(function(a){a.fn.updnWatermark=function(b){b=a.extend({},a.fn.updnWatermark.defaults,b);return this.each(function(){var d=a(this),c=d.data("updnWatermark");if(!c&&this.title){var c=a("<span/>").attr("display","inline").addClass(b.cssClass).css("padding-top","0px").css("padding-left","5px").insertBefore(this).hide().bind("show",function(){a(this).children().fadeIn("fast")}).bind("hide",function(){a(this).children().hide()});if(a(this).attr("duptitle")!="undefined"&&a(this).attr("duptitle")!=null)a("<label/>").appendTo(c).text(a(this).attr("duptitle")).attr("for",this.id);else a("<label/>").appendTo(c).text(this.title).attr("for",this.id)}if(c){d.focus(function(){c.trigger("hide")}).blur(function(){!a(this).val()&&c.trigger("show")});if(!d.val()){a("span.updnWatermark").css({display:"inline"});c.show()}else{a("span.updnWatermark").css({display:"inline"});a("span.updnWatermark label").css({display:"none"})}}})};a.fn.updnWatermark.defaults={cssClass:"updnWatermark"};a.updnWatermark={attachAll:function(b){a("input:text[title!='']").updnWatermark(b)}}})(jQuery);function HideVisionSpl(){$("#VisionSubSpldiv").is(":visible")&&$("#VisionSubSpldiv").hide()}function HideSpl(){$("#subSpecialityDiv").is(":visible")&&$("#subSpecialityDiv").hide()}function populateSubSpecilty(d){var e=$("select'[id$=PFSearchCategoryBS]'").val();if(e=="V"){d==""&&$("#VisionSubSpldiv").hide();for(var a=0;a<SpecialtyObj.length;a++)if(d==SpecialtyObj[a].SpecialtyCodeField.CodeField){$("span[id$='lblHelpText']").text(SpecialtyObj[a].SpecialtyCodeField.DescriptionField);var c="<option value=''>Select a Specialty Above</option>";if(SpecialtyObj[a].SubSpecialty!=null&&SpecialtyObj[a].SubSpecialty.length>0){for(var b=0;b<SpecialtyObj[a].SubSpecialty.length;b++)c+="<option value='"+SpecialtyObj[a].SubSpecialty[b].CodeField+"'>"+SpecialtyObj[a].SubSpecialty[b].NameField+"</option>";$("#VisionSubSpldiv").show();$("select[id$='SubSpecialityVisionDoctor']").html(c)}else $("#VisionSubSpldiv").hide();break}}else if(e=="D"){d==""&&$("#dentalSubSpldivbs").hide();for(var a=0;a<SpecialtyObj.length;a++)if(d==SpecialtyObj[a].SpecialtyCodeField.CodeField){$("span[id$='lblHelpText']").text(SpecialtyObj[a].SpecialtyCodeField.DescriptionField);var c="<option value=''>Select a Specialty Above</option>";if(SpecialtyObj[a].SubSpecialty!=null&&SpecialtyObj[a].SubSpecialty.length>0){for(var b=0;b<SpecialtyObj[a].SubSpecialty.length;b++)c+="<option value='"+SpecialtyObj[a].SubSpecialty[b].CodeField+"'>"+SpecialtyObj[a].SubSpecialty[b].NameField+"</option>";$("#dentalSubSpldivbs").show();$("select[id$='SubSpecialityDentalDoctorBS']").html(c)}else $("#dentalSubSpldivbs").hide();break}}else{d==""&&$("#subSpecialityDiv").hide();for(a=0;a<SpecialtyObj.length;a++)if(d==SpecialtyObj[a].SpecialtyCodeField.CodeField){$("span[id$='lblHelpText']").text(SpecialtyObj[a].SpecialtyCodeField.DescriptionField);var c="<option value=''>Select a Specialty Above</option>";if(SpecialtyObj[a].SubSpecialty!=null&&SpecialtyObj[a].SubSpecialty.length>0){for(var b=0;b<SpecialtyObj[a].SubSpecialty.length;b++)c+="<option value='"+SpecialtyObj[a].SubSpecialty[b].CodeField+"'>"+SpecialtyObj[a].SubSpecialty[b].NameField+"</option>";$("#subSpecialityDiv").show();$("select[id$='SpecialitySub']").html(c)}else $("#subSpecialityDiv").hide();break}}}function GetSpeciality(a){var b=true;if(typeof PF_Speciality!="undefined"&&PF_Speciality!="")if(PF_Speciality.length>0)PF_Speciality[0].Key!="error"&&$(PF_Speciality).each(function(){if($(this)[0].Key==a){b=false;DropDownFormation(a,$(this)[0].Value);return false}});if(b){LoadAllSpeciality();var c={ProviderType:a};$.ajax({url:FindADoctor.prototype.PFPath+"/webcontrols/providerfinder/Services/Providerfinder_wcf.svc/GetSpecialtyList?callback=?",data:c,dataType:"json",success:function(b){b.length>0&&DropDownFormation(a,b)}})}}function DropDownFormation(c,d){SpecialtyObj=d;if(c=="V"){for(var a="<option value=''>All Specialties</option>",b=0;b<d.length;b++)a+="<option value='"+d[b].SpecialtyCodeField.CodeField+"'>"+d[b].SpecialtyCodeField.NameField+"</option>";$("select[id$='SpecialityVisionDoctor']").html(a)}else if(c=="D"){for(var a="<option value=''>All Specialties</option>",b=0;b<d.length;b++)a+="<option value='"+d[b].SpecialtyCodeField.CodeField+"'>"+d[b].SpecialtyCodeField.NameField+"</option>";$("select[id$='SpecialitydentalDoctorfd']").html(a)}else{var a;if(c=="P")a="<option value=''>All Specialties</option>";else if(c=="G")a="<option value=''>All Specialties</option>";else if(c=="H")a="<option value=''>All Specialties</option>";else if(c=="U")a="<option value=''>All Specialties</option>";else if(c=="L")a="<option value=''>All Specialties</option>";else if(c=="R")a="<option value=''>All Specialties</option>";else if(c=="O")a="<option value=''>All Specialties</option>";else if(c=="B")a="<option value=''>All Specialties</option>";else if(c=="M")a="<option value=''>All Specialties</option>";for(var b=0;b<d.length;b++)a+="<option value='"+d[b].SpecialtyCodeField.CodeField+"'>"+d[b].SpecialtyCodeField.NameField+"</option>";$("select[id$='SpecialityMainBS']").html(a)}}function GeoCodeValidation(){var a=$("select[id$='selState']").find(":selected").text(),c=$("input[id$='txtCities']").val(),d=$("input[id$='txtMapKey']").val();if(a=="PR")globalCountryRegion="Puerto Rico";else if(a=="VI")globalCountryRegion="U.S. Virgin Islands";else if(a=="GU")globalCountryRegion="Guam";else if(a=="AS")globalCountryRegion="American Samoa";else globalCountryRegion="US";var b;if(IsSecure)b="https://dev.virtualearth.net/REST/v1/Locations?countryRegion="+globalCountryRegion;else b="http://dev.virtualearth.net/REST/v1/Locations?countryRegion="+globalCountryRegion;if(globalCountryRegion=="US")b+="&adminDistrict="+a+"&locality="+c+"&jsonp=GeocodeCallback&key="+d;else b+="&District="+a+"&locality="+c+"&jsonp=GeocodeCallback&key="+d;CallRestService(b)}function CallRestService(b){var a=document.createElement("script");a.setAttribute("type","text/javascript");a.setAttribute("src",b);document.body.appendChild(a)}function GeocodeCallback(a){var b=false,d=null,c=null;a&&a.resourceSets&&a.resourceSets.length>0&&a.resourceSets[0].resources&&a.resourceSets[0].resources.length>0&&$(a.resourceSets[0].resources).each(function(e,a){if(a.confidence=="High"&&a.point.coordinates[0]!=0&&a.point.coordinates[1]!=0&&a.address.locality.toLowerCase()==$("input[id$='txtCities']").val().toLowerCase()&&a.address.adminDistrict.toLowerCase()==$("select[id$='selState']").find(":selected").text().toLowerCase()&&!b){b=true;d=a.point.coordinates[0];c=a.point.coordinates[1]}});Location(b,d,c)}function GeocodeCallbackZip(a){var b=false,d=null,c=null;a&&a.resourceSets&&a.resourceSets.length>0&&a.resourceSets[0].resources&&a.resourceSets[0].resources.length>0&&$(a.resourceSets[0].resources).each(function(e,a){if(a.confidence=="High"&&a.point.coordinates[0]!=0&&a.point.coordinates[1]!=0&&a.address.postalCode==$("input[id$='ZipCodeBS']").val()&&!b){b=true;d=a.point.coordinates[0];c=a.point.coordinates[1]}});ZipRedirect(b,d,c)}function Location(a,c,b){if(a){globalCountryRegion="US";$("div#errCityVal").css({display:"none"});SearchResults=true;instancefd.setSessionValues(instancefd,SearchResults,c,b)}else{globalCountryRegion="US";$("div#errCityVal").css({display:"block"});$("div#errCityVal").html("City not found in the selected state");return false}}function GeoCodeValidationZip(){var b=$("input[id$='ZipCodeBS']").val(),c=$("input[id$='txtMapKey']").val(),a;if(IsSecure)a="https://dev.virtualearth.net/REST/v1/Locations?countryRegion="+globalCountryRegion+"&postalCode="+b+"&jsonp=GeocodeCallbackZip&key="+c;else a="http://dev.virtualearth.net/REST/v1/Locations?countryRegion="+globalCountryRegion+"&postalCode="+b+"&jsonp=GeocodeCallbackZip&key="+c;CallRestService(a)}function ZipRedirect(a,c,b){if(a){globalCountryRegion="US";$("div#errValidZip").css({display:"none"});SearchResults=true;instancefd.setSessionValues(instancefd,SearchResults,c,b)}else if(globalCountryRegion=="US"){globalCountryRegion="Puerto Rico";GeoCodeValidationZip();return false}else if(globalCountryRegion=="Puerto Rico"){globalCountryRegion="U.S. Virgin Islands";GeoCodeValidationZip();return false}else if(globalCountryRegion=="U.S. Virgin Islands"){globalCountryRegion="Guam";GeoCodeValidationZip();return false}else if(globalCountryRegion=="Guam"){globalCountryRegion="American Samoa";GeoCodeValidationZip();return false}else{globalCountryRegion="US";$("div#errValidZip").css({display:"block"});return false}}function cityVliation(b){var a=new RegExp(/^-?\d+$/);return!a.test(b)?false:true}function getQuerystring(b,a){if(a==null)a="";b=b.replace(/[\[]/,"\\[").replace(/[\]]/,"\\]");var d=new RegExp("[\\?&]"+b+"=([^&#]*)"),c=d.exec(window.location.href);return c==null?a:c[1]}function getUrlVarsFA(){for(var b=[],a,d=window.location.href.slice(parent.window.location.href.indexOf("?")+1).split("&"),c=0;c<d.length;c++){a=d[c].split("=");b.push(a[0]);b[a[0]]=a[1]}return b}function CheckLoginMPPF(g){var d=g.split("/"),e=d[2].split("."),c=document.URL,h;if(e[0].toUpperCase()=="LOCALHOST"){var f=c.split("&"),b=f[1].split("=");if(b[1].toUpperCase()=="PROVIDERDIRECTORY"||b[1].toUpperCase()=="PROVIDER-DIRECTORY"){$("div#divFindADoctor").css({display:"none"});$("div#divNewSearch").css({display:"block"})}else{$("div#divFindADoctor").css({display:"block"});$("div#divNewSearch").css({display:"none"})}}else{var a=c.split("/");if(a[4].toUpperCase()=="PROVIDERDIRECTORY"||a[4].toUpperCase()=="PROVIDER-DIRECTORY"){$("div#divFindADoctor").css({display:"none"});$("div#divNewSearch").css({display:"block"})}else{$("div#divFindADoctor").css({display:"block"});$("div#divNewSearch").css({display:"none"})}}}function populateplantypefd(){if(typeof PF_PlanByState!="undefined")$(PF_PlanByState).each(function(){if($(this)[0].Key.toLowerCase()==Brand.toLowerCase()){var a=$(this);$(a[0].Value).each(function(){var b=$(this),a="";if(Brand.toLowerCase()=="abcbs")a="CO";else if(Brand.toLowerCase()=="bcbsga")a="GA";else if(Brand.toLowerCase()=="abc")a="CA";if(typeof b[0]!="undefined"){typeof b[0][a]!="undefined"&&GeneratePlanByStateDropDownfd(b[0][a]);return false}});return false}});else{LoadAllPlanByState();var c,b,d=false;if(window.location.href.search("nationalonly")>=0)d=getParameterByName("nationalonly");var a="";if(Brand.toLowerCase()=="abcbs")a="CO";else if(Brand.toLowerCase()=="bcbsga")a="GA";else if(Brand.toLowerCase()=="abc")a="CA";b={state:a};c="/webcontrols/providerfinder/Services/Providerfinder_wcf.svc/GetPlanByState?callback=?";$.ajax({url:FindADoctor.prototype.PFPath+c,data:b,dataType:"json",success:function(b){var a=b;a.length>0&&GeneratePlanByStateDropDownfd(a)}})}}function GeneratePlanByStateDropDownfd(a){plansfd=a;for(var e="<option value=''>Select your plan </option>",d="<option value=''>Select your plan </option>",f=0,b=0;b<a.length;b++)if(a[b].PlanName.trim()=="Dental"){plandental=a[b].PlanName;positiondental=b}else if(a[b].PlanName.trim()=="Vision"){planvision=a[b].PlanName;positionvision=b}for(var c=0;c<a[positiondental].Plans.length;c++)e+="<option value='"+a[positiondental].Plans[c].PlanId+"'>"+a[positiondental].Plans[c].PlanName+"</option>";for(var c=0;c<a[positionvision].Plans.length;c++)d+="<option value='"+a[positionvision].Plans[c].PlanId+"'>"+a[positionvision].Plans[c].PlanName+"</option>";$("select[id$='ddlplandentalbs']").html(e);$("select[id$='ddlplanvisionbs']").html(d)}