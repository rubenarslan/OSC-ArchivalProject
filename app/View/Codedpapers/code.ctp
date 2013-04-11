<?php $this->start('sidebar'); ?>
<div class="well span3">
<h3>Tips</h3>
<p>You can save at any time with Ctrl+Enter (simply Enter works in single-line fields as well), <strong>use it</strong>, so you aren't interrupted by autosaves.</p>
<p>Autosaves should disturb you as little as possible, but when you're caught in the process of typing, they may be confusing. <br>
	<button type="button" id="toggle_autosave" class="btn btn-inverse" data-toggle="button">Toggle Autosave <i class="icon-refresh icon-white"></i></button></p>
<h4><?= $this->Html->link('Coding scheme', array('controller' => 'pages','action' => 'coding_scheme')); ?></h4>
<h4>Coded by others</h4>
<?php
echo $this->element('get_other_codings', array('paper_id' => $this->data['Paper']['id'],'user_name' => $this->data['User']['username']));
?>
<h4>Replication codes</h4>
<div class="accordion" id="accordion2">
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseNovel">Novel</a>
		</div>	
		<div id="collapseNovel" class="accordion-body collapse">
			<div class="accordion-inner">No replication mentioned.</div>
		</div>
	</div>
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseDirect">Direct</a>
		</div>
		<div id="collapseDirect" class="accordion-body collapse">
			<div class="accordion-inner">Direct replication. The stated goal is , at least in part of the design, to exactly reproduce the hypothesis and methods of the previous study, making only those changes that are necessary to achieve the same psychological meaning among the new participant population. Example 1:  A study of stereotypes in Canada that used ice hockey players as a target group might be directly replicated in Australia by changing the target group to rugby players and pretesting for new stereotypical associations, while keeping everything else the same. Example 2: A study of lexical decision times done in Romania using Romanian words is directly replicated in Spain, with the necessary alteration of using Spanish words. Example 3: A study of psychological resilience in the aftermath of the Hurricane Katrina disaster in the US is directly replicated among those affected by the 2011 tornado outbreak, changing only references to the event.</div>
		</div>
	</div>
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseConceptual">Conceptual</a>
		</div>
		<div id="collapseConceptual" class="accordion-body collapse">
			<div class="accordion-inner">Conceptual replication. The study’s stated goal is, at least in part of the design, to test the hypothesis of the previous study, using the same conceptual variables but changing their operationalization in ways that go beyond merely adapting the materials for a new population or occasion. <br>
		A conceptual replication can be done to increase internal validity (seeing if an effect replicates if the method excludes an alternate explanation), ecological validity (seeing if an effect replicates if an analogous procedure is followed using more naturalistic stimuli or setting), or external validity (seeing if the effect replicates across different conceptual incarnations of the same manipulations and measures). Note that a test of the same theory covered by previous research is not enough to warrant the “conceptual replication” label: the hypothesis (that is, a statement of relationships among variables) leading to a previous effect must be replicated.
			</div>
		</div>
	</div>
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseX">+X</a>
		</div>
		<div id="collapseX" class="accordion-body collapse">
			<div class="accordion-inner">The letter X goes into the code after E, C, or D if the study also contains elements of extension that go beyond the type of replication recorded (thus, EX, CX or DX). For example, a study may replicate a previous two-condition experiment but then add on a third condition; it may measure a new construct that serves as an additional dependent variable, mediator or moderator; it may cross a new manipulation with the design of the old study, in which case the control group of the manipulation is essentially a replication of the old study. 
			</div>
		</div>
	</div>
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseNr">+#</a>
		</div>
		<div id="collapseNr" class="accordion-body collapse">
			<div class="accordion-inner">After the letter code, a number code without brackets is placed to show that the study is presented as a replication/extension of an earlier study in the article itself, instead of, or in addition to, replicating another article.
			</div>
		</div>
	</div>

</div>
</div>
<?php $this->end(); ?>
<?php $this->start('more_nav'); ?>
<li class="divider-vertical"></li>
<li class="progress-nav">
	<div class="progress progress-striped span4">
    <div class="bar" style="width: 0%;" id="codingprogress"></div>
    </div>
</li>
<li class="divider-vertical"></li>
<li class="btn-nav">
	<button id="navSave" class="btn" disabled="disabled">Saved</button>
</li>
<?php $this->end(); 
echo $this->Session->flash();
?>
<h1>Code paper <?php echo $this->Html->link('View <span class="icon-eye-open"></span>', 
	array('controller' => 'papers','action' => 'view', $this->data['Paper']['id']), 
	array('escape' => false, 'class' => 'btn btn-large'));?></h1>

<p class="lead span8"><?php 
	echo $this->data['Paper']['title'];
	?></p> 
<p class="span6">
	<?php  echo $this->data['Paper']['abstract']; ?>
</p>
<?php
if(
	AuthComponent::user('Group.name')!=='admin' AND 
 	isset($onlyView) AND 
	!$this->data['Codedpaper']['completed']
) 
	{
	echo $this->element('alert-info',array(
		'bold' => 'Not yet complete',
		'message'=>'This paper has not yet been marked complete, so only admins can view it.'
	));
}
else 
{
	if(
		AuthComponent::user('Group.name')==='admin' AND 
	 	isset($onlyView) AND 
		!$this->data['Codedpaper']['completed']
	) 
		{
		echo $this->element('alert-info',array(
			'bold' => 'Not yet complete',
			'message'=>'You can view this paper, because you\'re an admin, but it has not been marked as complete yet.'
		));
	}
	
	if(isset($onlyView)) 
	{
		echo $this->Form->create("Codedpaper",array(
			'inputDefaults' => array('disabled' => 'disabled'),
			));
	}
	else 
	{
		echo $this->Form->create("Codedpaper");
	}
	echo $this->Form->hidden("Paper.id");
	echo $this->Form->hidden("Paper.DOI");
	echo $this->Form->hidden("id");
	echo $this->Form->hidden("paper_id");

	echo $this->element('study', array(
		"data" => $this->data
	));

	echo '<div class="form-actions"><div class="btn-group">';
	echo $this->Form->end(array(
	    'label' => 'Save!',
	    'id' => 'CodedpaperCodeFormSubmit',
		'class' => 'btn btn-large',
		'div' => false,
	));
	?>
		<input type="hidden" id="CodedpaperCompleted_" name="data[Codedpaper][completed]" value="0">
		<label id="CodedpaperCompletedLabel" class="btn btn-large btn-success<?=($this->data['Codedpaper']['completed']===true)?' active':''; ?>">
			<input type="checkbox" id="CodedpaperCompleted" name="data[Codedpaper][completed]" class="hidden" value="1" <?=($this->data['Codedpaper']['completed']===true)?'checked="checked"':''; ?>>
			Complete (for others to view)
		</label>
		</div>
	</div>
	<?php
	pr($this->validationErrors);
	?>
	<?php
}
	?>
<?php echo $this->Js->writeBuffer(); ?>
<script type="text/javascript">
//<![CDATA[
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
//		if($(this).val()=='') console.log($(this));
	  nonZ += ($(this).val()=='') ? 0 : 1;
	});
	var prog = 100 * (nonZ / (formelms.length - either_or_elms.length)) + '%';
	if(prog > 100) prog = 100;
	$('#codingprogress').css('width',prog);
}
function activateinputs () {
	var formelms = $('#CodedpaperCodeForm input[type=text],#CodedpaperCodeForm input[type=number],#CodedpaperCodeForm input[type=search],#CodedpaperCodeForm select,#CodedpaperCodeForm input[type=radio],#CodedpaperCodeForm input[type=checkbox], #CodedpaperCodeForm textarea');
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
	
	$("select.select2replication,select.select2replication_code, select.select2effect_size_statistic, select.select2inferential_test_statistic, select.select2analytic_design_code").select2({
		minimumResultsForSearch: 20,
		allowClear: true,
		placeholder: '',
	});
	$("select.select2studies").select2({
		minimumResultsForSearch: 10,
		allowClear: true,
		placeholder: 'Choose a coded study from this list'
	});
	$("input.select2pvalue").select2({
		minimumResultsForSearch: 20,
		tags: ['ns','†','p<.10','marginal','*','significant','p<.05','**','p<.01','***','p<.001'], 
		multiple: false, 
		allowClear: true,
		maximumSelectionSize: 1, 
		formatSelectionTooBig: function(maxSize) {
			return "Enter the p-value, its range or choose from these common representations.";
		} 
	});
	
	$("textarea.select2methodology_codes").select2({
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
	
	$("textarea.select2variables").select2({
		tags: [], 
		allowClear: true, 
		tokenSeparators : [',',', '],
		formatNoMatches: function (term) {
			return "Enter the variables, type 'comma' to add a new one.";
		}
	});
		
	$('a.selfdestroyer').each(function(i,elm) {
		$(elm).off('click','*');

		$(elm).confirmDialog({
			message: '<strong>Do you really want to delete this block?</strong>',
			cancelButton: 'Cancel',
			confirmButton: 'Delete',
		});
		
	});
	formelms.each(function(i,elm) {
		$(elm).on('change',unsavedChanges);
	});	
}
function saveform() {
	options = {
		data: $("#CodedpaperCodeFormSubmit").closest("form").serialize(), 
		dataType:"html", 
		success:
		function (data, textStatus) {
			focused = $(':focus').attr('id'); // pseudoselector for focused selects, inputs and textarea
			if(typeof focused == 'undefined') 
				select2focused = $(':focus').closest('[id]').attr('id');

			$.when($("#main-content").html(data)).done(function(){
				if(typeof focused != 'undefined') { // if a field was focused upon autosaving
					$("#" + focused).focus();
				} else if(select2focused != 'undefined') {
					$("#" + select2focused).select2('focus');
				}
				$('#navSave').removeClass('btn-info').attr('disabled', 'disabled').text('Saved');
				updateProgress();
				lastSave = $.now();
			}); // refocus it when the data has been replaced
		}, 
		type:"post", 
		url: $("#CodedpaperCodeFormSubmit").closest("form").attr('action'),
		timeout: 2000,
		error: 
        function(e, x, settings, exception) 
		{
            var message;
            var statusErrorMap = {
                '400' : "Server understood the request but request content was invalid.",
                '401' : "Unauthorised access.",
                '403' : "You were logged out while editing. Please open a new tab and login there, so that no data is lost.",
                '404' : "Page not found.",
                '500' : "Internal Server Error.",
                '503' : "Service Unavailable"
            };
            if (e.status) 
			{
                message =statusErrorMap[e.status];
				if(!message)
					message= (typeof e.statusText != 'undefined' && e.statusText != 'error') ? e.statusText : 'Unknown error. Check your internet connection.';
            }
			else if(exception=='parsererror')
                message="Parsing JSON Request failed.";
			else if(exception=='timeout')
                message="Request timed out.";
			else if(exception=='abort')
                message="Request was aborted by the server.";
			else
				message= (typeof e.statusText != 'undefined' && e.statusText != 'error') ? e.statusText : 'Unknown error. Check your internet connection.';
			
	        bootstrap_alert(message, 'Error!');
		}
	};
	$.ajax(options);
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
	
	activateinputs();
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
	$(document).off('keydown');
	$(document).keydown(function(event) { // add a key combo to save the form
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
	$("[rel=tooltip]").tooltip();
});
//]]>
</script>
<?php if(isset($onlyView)) {
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function () {
	console.log($('#CodedpaperViewForm .btn'));
	$('#CodedpaperViewForm .btn').each(function(i,elm) {
		$(elm).remove();
	});
});
//]]>
</script>
<?php } ?>