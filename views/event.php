<!-- Event Detail -->

<link rel="stylesheet" type="text/css" href="/resources/style-event.css">

<div class="event-detail-wrapper">
	<h3><?php echo $title; ?></h3>
	<h4>When:</h4>
	<div><?php echo $time_start; echo ($time_end) ? ' to ' . $time_end : ''; ?></div>
	<br />
	<h4>Where:</h4>
	<div><?php echo nl2br($location); ?></div>
	<br />
	<h4>Why:</h4>
	<div><?php echo nl2br($description); ?></div>
	<br />
	<h4>How:</h4>
	<div>Free</div>
	
	<h3>Who's coming?</h3>
	<div><?php echo implode(', ', $attendees); ?></div>
	
	<?php if(!$is_attendee): ?>
	<input type="button" class="button" id="signup" value="I'll Go!" data-eid="<?php echo $eid; ?>">
	<?php endif; ?>
	
</div>

<script>
	$(document).ready(function() {
		$('#signup').click(function(e){
			$this = $(this);
			$.get('/api/join_event/' + $this.data('eid'), true,
				function(data, status, xhr) {
					$('#eventdetail').load('/api/event/' + $this.data('eid'));
				});
		});
	});
</script>