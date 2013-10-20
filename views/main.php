<link href="/resources/style-main.css" rel="stylesheet" type="text/css">
<script src="/resources/jquery.searchbox.js"></script>
<!-- <script src="/resources/jquery.autocomplete.js"></script> -->

<div class="search-wrapper">
	<div class="search">
			I want to go to <input id="search-box" type="text" placeholder="a movie">.
	</div>
	<div class="create">
		<input type="button" class="button" id="create-button" value="Create a New Event">
	</div>
</div>

<div class="stream-wrapper">
	<div id="results"></div>
	<div id="eventdetail"></div>
	<div id="newevent">
		<form>
			<h3>Create a new event!</h3>
			<label for="newevent-title">Name:</label> <input type="text" name="title" id="newevent-title"><br />
			<label for="newevent-timestart">Start time:</label> <input type="datetime-local" name="time_start" id="newevent-timestart"><br />
			<label for="newevent-timeend">End time (optional):</label> <input type="datetime-local" name="time_end" id="newevent-timeend"><br />
			<label for="newevent-location">Location:</label> <textarea name="location" id="newevent-location"></textarea><br />
			<label for="newevent-description">Description:</label> <textarea name="description" id="newevent-description"></textarea><br />
			<input type="submit" value="Create Event">
		</form>
	</div>
	<a href="#" id="returntosearch">Return to search</a>
</div>

<script>
	$(document).ready(function() {
		$('#newevent, #eventdetail, #returntosearch').hide();
		$('#newevent form').submit(function(e) {
			return false;
		});

		$('#create-button').click(function(e) {
			e.preventDefault();
			$('#newevent :input, #newevent textarea').not(':button, :submit, :reset, :hidden').val('');
			$('#newevent-title').val($('#search-box').val());
			$('.stream-wrapper > *').hide();
			$('#newevent, #returntosearch').show();
			$('#newevent-title').focus();
		});

		$('#newevent :submit').click(function(e) {
			form = $('#newevent form').serialize();
			$.post('/api/create_event', form,
				function(data, status, xhr) {
					if(data) {
						$('.stream-wrapper > *').hide();
						$('#eventdetail').load('/api/event/' + parseInt(data)).show();
						$('#returntosearch').show();
					}
				});
		});

		$('#results').on('click', '.event-a', function(e) {
			e.preventDefault();
			$this = $(this);
			$('.stream-wrapper > *').hide();
			$('#eventdetail').load('/api/event/' + parseInt($this.data('eid'))).show();
			$('#returntosearch').show();
		});

		$('#returntosearch').click(function(e) {
			e.preventDefault();
			$('.stream-wrapper > *').hide();
			$('#eventdetail').html('');
			$('#results').show();
			$('#search-box').focus();
		});

		$('#results').load('/api/search');
		$('#search-box').searchbox();

		// $('#search-box').autocomplete({
		// 	serviceUrl: '/api/get_events'
		// });
	});
</script>