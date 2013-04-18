$.webshims.setOptions({waitReady: false});
$.webshims.polyfill('forms forms-ext');

function toggleAutosave() {
	autosaveglobal = !autosaveglobal;
	icon = autosaveglobal ? ' <i class="icon-refresh icon-white"></i>' : '';
	$("#toggle_autosave").button('toggle').html('Toggle Autosave' + icon);
	return false;
}
function unsavedChanges () {
	$('#navSave').addClass('btn-info').removeAttr('disabled').text('Unsaved changes…');
	if(autosaveglobal) {
		if( ($.now() - lastSave ) > 7000) {
			saveform();
		}
	}
}
function updateProgress () {
	formelms = $('#CodedpaperCodeForm input[type=text]:not([class*="select2-input"]),	#CodedpaperCodeForm input[type=number],			#CodedpaperCodeForm input[type=search],	#CodedpaperCodeForm select,	#CodedpaperCodeForm input[type=radio],	#CodedpaperCodeForm input[type=checkbox],	#CodedpaperCodeForm textarea').filter(':visible').filter(':not([class*="hidden"])');
	either_or_elms = formelms.filter('[class*="study-freetext"]');
	
	var nonZ = 0;
	formelms.map(function() {
	  nonZ += ($(this).val()=='') ? 0 : 1;
	});
	var prog = 100 * (nonZ / (formelms.length - either_or_elms.length)) + '%';
	if(prog > 100) prog = 100;
	$('#codingprogress').css('width',prog);
}
function activateInputs ($container) {
	var formelms = $container.find('input[type=text], input[type=number], input[type=search], select, input[type=radio], input[type=checkbox],  textarea');
	formelms.each(function(i,elm) {
		$(elm).off('change','*'); // deactivate all handlers
	});
	formelms.filter("input[name*='data_points_excluded']").each(function(i,elm) {
		$(elm).on('change',function (event) {
			opt_hide = $(event.target).closest('div.row-fluid').find('textarea[name*=reasons_for_exclusions]').parent('div');
			if($(event.target).attr('value')>0) {
				opt_hide.removeClass('hidden');
			} else {
				opt_hide.addClass('hidden');
			}
		});
		$(elm).trigger('change');
	});
	formelms.filter("input[name*='data_points_excluded'],input[name*='N_total']").each(function(i,elm) {
		$(elm).on('change',function (event) {
			n_used = $(event.target).closest('div.row-fluid').find('input[name*=N_used_in_analysis]');
			n_excluded = $(event.target).closest('div.row-fluid').find('input[name*=data_points_excluded]');
			n_total = $(event.target).closest('div.row-fluid').find('input[name*=N_total]');
			
			if(!isNaN(parseFloat(n_total.attr('value'))) && !isNaN(parseFloat(n_excluded.attr('value'))))
				n_used.attr('value', n_total.attr('value') - n_excluded.attr('value') );
		});
		$(elm).trigger('change');
	});
	formelms.filter('input[type=radio][name*=hypothesized]').each(function(i,elm) {
		$(elm).on('change',function (event) {
			var val = $("input[name='" + $(event.target).attr('name') + "']:checked").attr('value');
			opt_hide1 = $(event.target).closest('div.row-fluid').find("div.prior_hypothesis");
			opt_hide2 = $(event.target).closest('div.formblock').find("input[type=radio][id*='HypothesisSupportedYes']").parent('div').parent('div');			
			if(val != 'No, no hypothesis') {
				opt_hide1.removeClass('hidden');
				opt_hide2.removeClass('hidden');
			} else {
				opt_hide1.addClass('hidden');
				opt_hide2.addClass('hidden');
			}
		});
		$(elm).trigger('change');
	});
	formelms.filter("select[name*='[replication]']").each(function(i,elm) {
		$(elm).on('change',function (event) {
			opt_hide1 = $(event.target).closest('div.row-fluid').find("select[name*='replicates_study_id']").parent('div');
			opt_hide2 = $(event.target).closest('div.row-fluid').find('div.replication_optional');
			if($(event.target).attr('value') != 'Novel' && $(event.target).attr('value') != '') {
				opt_hide1.removeClass('hidden');
				opt_hide2.removeClass('hidden');
			} else {
				opt_hide1.addClass('hidden');
				opt_hide2.addClass('hidden');
			}
		});
		$(elm).trigger('change');
	});
	
	$container.find("select.select2replication,select.select2replication_code, select.select2effect_size_statistic, select.select2inferential_test_statistic, select.select2analytic_design_code").select2({
		minimumResultsForSearch: 20,
		allowClear: true,
		placeholder: '',
	});
	$container.find("select.select2studies").select2({
		minimumResultsForSearch: 10,
		allowClear: true,
		placeholder: 'Choose a coded study from this list'
	});
	$container.find("input.select2pvalue").select2({
		minimumResultsForSearch: 20,
		tags: ['ns','†','p<.10','marginal','*','significant','p<.05','**','p<.01','***','p<.001'], 
		multiple: false, 
		allowClear: true,
		maximumSelectionSize: 1, 
		formatSelectionTooBig: function(maxSize) {
			return "Enter the p-value, its range or choose from these common representations.";
		} 
	});
	
	$container.find("textarea.select2methodology_codes").select2({
		tags: [
			{id:'A',text:'archival measures'},
			{id:'BI', text:'brain imaging measures' },
			{id:'J', text:'judgment of the participant' }, 
			{id:'P', text:'non-imaging physiological measures'},
			{id:'SR', text:'self-report measures'},
			{id:'I', text:'indirect verbal or response-time measures'},
			{id:'BC', text:'behavioral/choice measures'}],
		placeholder: "Choose or write as many as apply",
		allowClear: true, 
		tokenSeparators : [',',', '] 
	});
	
	$container.find("textarea.select2variables").select2({
		tags: [], 
		allowClear: true, 
		tokenSeparators : [',',', '],
		formatNoMatches: function (term) {
			return "Enter the variables, type 'comma' to add a new one.";
		}
	});
		
	$container.find('a.selfdestroyer').each(function(i,elm) {
		var $elm = $(elm);
		$elm.off('click','*')
		.click(function () 
		{
			var oldlink = $elm[0].href;
			var delete_this = $elm.closest('.formblock');
			delete_this.hide();
			$.ajax( 
			{
				url: oldlink,
				dataType:"html"
			})
			.done(function(data)
			{
				if(! (data.indexOf('error') >= 0) ) 
				{
					updateProgress();
					delete_this.remove();
				}			
				else
				{				
					var $alert = $(data);
					$('#main-content').prepend( $alert.fadeIn() );
					$alert[0].scrollIntoView();
					delete_this.show();
				}
			})
			.fail(function(e) {
				delete_this.show();
				ajaxErrorHandling(e);
			});
			
			return false;
		});
		$elm.confirmDialog({
			message: '<strong>Do you really want to delete this block?</strong>',
			cancelButton: 'Cancel',
			confirmButton: 'Delete',
		});
		
	});
	
	$container.find('a.copysample').each(function(i,elm) { // copy the sample information from the preceding test if it exists
		$(elm).off('click','*');
		$(elm).on('click', function(evnt) {
			currenttestinputs = $(evnt.target).closest('.sampleinfo').find('input,textarea');
			prevtestinputs = $(evnt.target).closest('.formblock').prev('.formblock').find('.sampleinfo input,.sampleinfo textarea');
			for(i=0; i < prevtestinputs.length; i++) { // only if a previous test exists
				currenttestinputs[i].value = prevtestinputs[i].value;
				$(currenttestinputs[i]).trigger('change'); // so the textarea may be shown
			}
			return false;
		});
	});
		
	$container.find(".adder_elm a.btn").bind("click", function (event) 
	{
		var oldlink = this.href;
		var test_adder = $(this).closest('.adder_elm');
		$.ajax( 
		{
			url: oldlink,
			dataType:"html", 
			success:function (data, textStatus) 
			{
				var dat = $(data);
				activateInputs(dat);
				test_adder.replaceWithPolyfill(dat);
			}
		});
		return false;
	});
	$("[rel=tooltip]").tooltip();
	
	formelms.each(function(i,elm) {
		$(elm).on('change',unsavedChanges);
	});	
}
function saveform() {
	options = {
		data: $("#CodedpaperCodeFormSubmit").closest("form").serialize(), 
		dataType:"html", 
		type:"post", 
		url: $("#CodedpaperCodeFormSubmit").closest("form").attr('action'),
		timeout: 5000
	};
	$.ajax(options)
	.fail(ajaxErrorHandling)
	.done(function(data, textStatus)
	{
		if(! (data.indexOf('error') >= 0) ) 
		{
			$('#navSave').removeClass('btn-info').attr('disabled', 'disabled').text('Saved');
			updateProgress();
			lastSave = $.now();
		}			
		else
		{				
			var $alert = $(data);
			$('#main-content').prepend( $alert.fadeIn() );
			$alert[0].scrollIntoView();
//			window.setTimeout(function() { $alert.alert('close').remove(); }, 20000);
		}
	});
}
function bootstrap_alert(message,bold) {
	var $alert = $('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>' + (bold ? bold:'Problem' ) + '</strong> ' + message + '</div>');
	$('#main-content').prepend( $alert);
	$alert[0].scrollIntoView(false);
}
$(document).ready(function () {
	if(typeof autosaveglobal == 'undefined') {
		lastSave = $.now(); // only set when loading the first time
		autosaveglobal = true;
		$("#toggle_autosave").button('toggle').on('click', toggleAutosave);
	}
	
	activateInputs($('#CodedpaperCodeForm'));
	
	$("#CodedpaperCodeFormSubmit").click( function (event) {
		saveform();
		return false;
	});
	$("#navSave").attr('disabled','disabled').off('click').click( function (event) {
		saveform();
		return false;
	});
	
	updateProgress();
	$('#CodedpaperCompletedLabel').click(function() {
		$('#CodedpaperCompletedLabel').toggleClass('active', $('#CodedpaperCompleted').prop('checked') ); // switch to checkbox state 
	});
	$(document).off('keydown')
	.keydown(function(event) { // add a key combo to save the form
		if (event.keyCode === 10 || event.keyCode == 13 && event.ctrlKey) {
			saveform();
		    event.preventDefault();
		    return false;
		} else return true;
	});
	
	window.onbeforeunload = function() {
		if ( $('#navSave').text() != 'Saved' ) {
			return 'You have unsaved changes.'
		}
	};
});
function ajaxErrorHandling (e, x, settings, exception) 
{
	var message;
	var statusErrorMap = 
	{
	    '400' : "Server understood the request but request content was invalid.",
	    '401' : "You don't have access.",
	    '403' : "You were logged out while coding, please open a new tab and login again. This way no data will be lost.",
	    '404' : "Page not found.",
	    '500' : "Internal Server Error.",
	    '503' : "Server can't be reached."
	};
	if (e.status) 
	{
	    message =statusErrorMap[e.status];
		if(!message)
			message= (typeof e.statusText != 'undefined' && e.statusText != 'error') ? e.statusText : 'Unknown error. Check your internet connection.';
	}
	else if(e.statusText=='parsererror')
	    message="Parsing JSON Request failed.";
	else if(e.statusText=='timeout')
	    message="The attempt to save timed out. Are you connected to the internet?";
	else if(e.statusText=='abort')
	    message="The request was aborted by the server.";
	else
		message= (typeof e.statusText != 'undefined' && e.statusText != 'error') ? e.statusText : 'Unknown error. Check your internet connection.';

	bootstrap_alert(message, 'Fehler.');
}