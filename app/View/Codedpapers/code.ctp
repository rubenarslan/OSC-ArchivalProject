<h1>Code paper</h1>
<h2><abbr title="Digital Object Identifier">DOI</abbr>: <?php  echo $this->data['Paper']['doi'] ?></h2> 

<script src="http://malsup.github.com/jquery.form.js"></script>	
<p>
<?php
echo $this->Form->create("Codedpaper");
echo $this->Session->flash();
echo $this->Form->hidden("Paper.id");
echo $this->Form->hidden("Paper.doi");
echo $this->Form->hidden("id");
echo $this->Form->hidden("paper_id");

echo $this->element('study', array(
	"data" => $this->data
));

echo $this->Form->submit('Save',array(
	'id' => 'CodedpaperCodeFormSubmit'
));
?>
</p>
<?php echo $this->Js->writeBuffer(); ?>
<script type="text/javascript">
//<![CDATA[
function addonblurtoallinputs () {
	$('#CodedpaperCodeForm input[type=text],#CodedpaperCodeForm input[type=select],#CodedpaperCodeForm input[type=radio],#CodedpaperCodeForm input[type=checkbox], #CodedpaperCodeForm textarea').each(function(i,elm) {
//		console.log(i,elm);
		$(elm).off('change','*');
		$(elm).on('change',function() {
			if(theQueue.queue().length==0) {
				$('#flashMessage').remove();
				$('<div id="flashMessage" class="message">Unsaved changes…<br>Autosave in <span>5.0</span> seconds</div>').appendTo('#main-content');
				var sec = $('#flashMessage span').text()
				var timer = setInterval(function() {
					sec = sec - 0.4;
					sec = parseFloat(sec).toFixed(1);
					if(sec.length==1) sec = sec + ".0";
				   $('#flashMessage span').text(sec);
				   if (sec < 0.5) {
				      clearInterval(timer);
				   } 
				}, 400);
				theQueue.delay(5000);
				theQueue.queue(submitcodingform);
			}
		});
	});
}
function submitcodingform() {
	focused = "#" + $('input:focus,textarea:focus').attr("id");
	theQueue.clearQueue();
	options = {
		data: $("#CodedpaperCodeFormSubmit").closest("form").serialize(), 
		dataType:"html", 
		success:
		function (data, textStatus) {
			$("#main-content").html(data);
		}, 
		type:"post", 
		url: $("#CodedpaperCodeFormSubmit").closest("form").attr('action')
	};
	if(typeof focused != 'undefined') {
		options.success = function(data, textStatus) {
			$.when($("#main-content").html(data)).done(
			$(focused).focus());
		}
	}
	$.ajax(options);
}
$(document).ready(function () {
	theQueue = $({}); // jQuery on an empty object - a perfect queue holder
	addonblurtoallinputs();
	$("#flashMessage").delay(2000).fadeOut(1000);
	$("#CodedpaperCodeFormSubmit").click( function (event) {
		submitcodingform();
	return false;
	});
	$(document).off('keydown');
	$(document).keydown(function(event) {
		if (event.keyCode === 10 || event.keyCode == 13 && event.ctrlKey) {
			submitcodingform();
		    event.preventDefault();
		    return false;
		} else return true;
	});
});
//]]>
</script>
<?php
debug($this->data);   
?>