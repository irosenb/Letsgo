<!-- Event Detail -->

<h3><?php echo $title; ?></h3>
<div><?php echo $time_start; echo ($time_end) ? ' to ' . $time_end : ''; ?></div>
<div><?php echo nl2br($location); ?></div>
<div><?php echo nl2br($description); ?></div>
<h3>Who's coming?</h3>
<div><?php echo implode(', ', $attendees); ?></div>