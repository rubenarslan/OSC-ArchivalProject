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
function updateOrder()
{
	
}
function updateProgress () {
	formelms = $('#CodedpaperCodeForm input[type=text]:not([class*="select2-input"]), #CodedpaperCodeForm input[type=number], #CodedpaperCodeForm input[type=search], #CodedpaperCodeForm select, #CodedpaperCodeForm input[type=radio], #CodedpaperCodeForm input[type=checkbox],	#CodedpaperCodeForm textarea').filter(':visible').filter(':not([class*="hidden"])').filter(function() {
   return !($(this).css('visibility') == 'hidden'); // this shit is necessary for visibility: hidden. the pseudo-selector is about display:none (because vis.hidden still takes space)
});;
	either_or_elms = formelms.filter('[class*="study-freetext"]');
	

	var formelm_names = {};
	formelms.map(function() {
		var done = 0;
		if($(this).attr('type') == 'radio' || $(this).attr('type') == 'checkbox')
			done = ($(this).prop('checked')=='') ? 0 : 1;
		else
			done = ($(this).val()=='') ? 0 : 1;
			
		if($(this).attr('name') && ! formelm_names[$(this).attr('name')] )
			formelm_names[$(this).attr('name')] = done;
	});
	var done = 0; var not_done = 0;
	$.each(formelm_names,function(elm,val){
		if(parseFloat(this))
			done += 1
		else
			not_done += 1;
	});

	var prog = 100 * (done / (done + not_done - either_or_elms.length)) + '%';
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
			if($(event.target).prop('value')>0) {
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
			
			if(!isNaN(parseFloat(n_total.prop('value'))) && !isNaN(parseFloat(n_excluded.prop('value'))))
				n_used.prop('value', n_total.prop('value') - n_excluded.prop('value') );
		});
		$(elm).trigger('change');
	});
	
	formelms.filter('input[type=radio][name*=hypothesized]').each(function(i,elm) {
		$(elm).on('change',function (event) {
			var val = $("input[name='" + $(event.target).attr('name') + "']:checked").prop('value');
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
			opt_hide2 = $(event.target).closest('div.row-fluid').find('div.replication_optional');
			if($(event.target).prop('value') != 'Novel' && $(event.target).prop('value') != '') {
				opt_hide2.removeClass('hidden');
			} else {
				opt_hide2.addClass('hidden');
			}
		});
		$(elm).trigger('change');
	});
	
	formelms.filter("select.select2replication,select.select2replication_code, select.select2effect_size_statistic, select.select2inferential_test_statistic, select.select2analytic_design_code").select2({
		minimumResultsForSearch: 20,
		allowClear: true,
		placeholder: '',
	});
	
	formelms.filter("select.select2studies").select2({
		minimumResultsForSearch: 10,
		allowClear: true,
		placeholder: 'Choose a previous study in this paper'
	});
	
	var pvalue_stats = 
		[
		{id: 'ns', 			text: 'ns'},
		{id: '†', 			text: '†'},
		{id: 'p<.10', 		text: 'p<.10'},
		{id: 'marginal', 	text: 'marginal'},
		{id: '*', 			text: '*'},
		{id: 'significant', text: 'significant'},
		{id: 'p<.05', 		text: 'p<.05'},
		{id: '**',			text: '**'},
		{id: 'p<.01',		text: 'p<.01'},
		{id: '***', 		text: '***'},
		{id: 'p<.001', 		text: 'p<.001'}
		];
	formelms.filter("input.select2pvalue").select2({
		createSearchChoice:function(term, data)
		{ 
			if ($(data).filter(function() 
			{ 
				return this.text.localeCompare(term)===0; 
			}).length===0) 
			{
				return {id:term, text:term};
			}
		},
	    initSelection : function (element, callback) {
			var data = {id: element.val(), text: element.val()};
			$.each(pvalue_stats, function(k, v) {
			                       if(v.id ==  element.val()) {
			                           data = v;
			                           return false;
			                       } 
            });
	        callback(data);
	    },
		data: pvalue_stats, 
		multiple: false, 
		allowClear: true,
		maximumSelectionSize: 1, 
		placeholder: "Enter the p-value, its range or choose from these common representations."
	});
	var effect_stats = [
	{'id': 'r', text: 'r'},
	{'id': 'partial.r', text: 'partial r'},
	{'id': 'r.squared', text: 'R²'},
	{'id': 'delta.r.squared', text: 'ΔR²'},
	{'id': 'regression.b', text: 'B (regression coefficient)'},
	{'id': 'regression.beta', text: 'b* (standardized regression coefficient)'},
	{'id': 'cohens.d', text: 'Cohen\'s d\' (t-test)'},
	{'id': 'anova.d', text: 'd (ANOVA)'},
	{'id': 'f.squared', text: 'f²'},
	{'id': 'eta.squared', text: 'η²'},
	{'id': 'partial.eta.squared', text: 'partial η²'},
	{'id': 'omega.squared', text: 'ω²'},
	{'id': 'odds.ratio', text: 'Odds Ratio'},
	{'id': 'spearmans.rho', text: 'Spearman\'s rho (rank order correlation)'},
	{'id': 'phi.coefficient', text: 'Phi coefficient'},
	{'id': 'cramers.v', text: 'Cramer\'s v'},
	{'id': 'sem.coefficient', text: 'SEM coefficient (details in comments please)'},
	{'id': 'multilevel.coefficient', text: 'Multilevel coefficient (details in comments please)'}
	];
	formelms.filter("input.select2effect_size_statistic").select2({
		createSearchChoice:function(term, data)
		{ 
			if ($(data).filter(function() 
			{ 
				return this.text.localeCompare(term)===0; 
			}).length===0) 
			{
				return {id:term, text:term};
			}
		},
	    initSelection : function (element, callback) {
			var data = {id: element.val(), text: element.val()};
			$.each(effect_stats, function(k, v) {
			                       if(v.id ==  element.val()) {
			                           data = v;
			                           return false;
			                       } 
            });
	        callback(data);
	    },
		data: effect_stats, 
		multiple: false, 
		allowClear: true,
		maximumSelectionSize: 1, 
		placeholder: "Choose an effect size statistic or type your own.",
	});
	
	var test_stats = [ 
		{id: 'chi.sq', text: 'χ²'}, 
		{id: 't', text: 't'},
		{id: 'z', text: 'z'},
		{id: 'F', text: 'F'}
	];
	
	formelms.filter("input.select2inferential_test_statistic").select2({
		createSearchChoice:function(term, data)
			{ 
				if ($(data).filter(function() 
				{ 
					return this.text.localeCompare(term)===0; 
				}).length===0) 
				{
					return {id:term, text:term};
				}
			},
	    initSelection : function (element, callback) {
			var data = {id: element.val(), text: element.val()};
			$.each(test_stats, function(k, v) {
			                       if(v.id ==  element.val()) {
			                           data = v;
			                           return false;
			                       } 
            });
	        callback(data);
	    },
		data: test_stats, 
		multiple: false, 
		allowClear: true,
		maximumSelectionSize: 1, 
		placeholder: "Choose a test statistic or type your own.",
	});
	
	formelms.filter("textarea.select2methodology_codes").select2({
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
	
	formelms.filter("textarea.select2variables").select2({
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
	
	$container.find("a.btn.adder").on("click", function (event) 
	{
		var oldlink = this.href;
		var adder_elm = $(this).closest('.adder_elm');
		$.ajax( 
		{
			url: oldlink,
			dataType:"html", 
		})
		.done(function (data, textStatus) 
		{
			var dat = $(data);
			adder_elm.replaceWithPolyfill(dat);
			activateInputs(dat);
			updateProgress();
		})
		.fail(ajaxErrorHandling);
		return false;
	});
	
	$(".hastooltip").tooltip({
		container: 'body', 
		html:true
	});
	
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

	bootstrap_alert(message, 'Error.');
}