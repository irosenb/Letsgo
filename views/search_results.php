<?php foreach($results as $result): ?>
	<div class="event-wrapper">
		<a href="#" class="event-a" data-eid="<?php echo $result['eid']; ?>">
			<img class="event-photo" src="http://placehold.it/90x90" />
			<div class="event-title"><?php echo $result['title']; ?></div>
			<div class="event-date"><?php echo $result['time_start']; echo ($result['time_end']) ? ' to ' . $result['time_end'] : ''; ?></div>
			<div class="event-location"><?php echo nl2br($result['location']); ?></div>	
		</a>
	</div>
<?php endforeach ?>
<?php if(empty($results)) echo '<p>Sorry, no existing events match your search. Create a new event instead!</p>' ?>