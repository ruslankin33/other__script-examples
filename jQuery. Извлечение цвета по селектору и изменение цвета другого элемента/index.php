<!DOCTYPE html>
<html>
<head>
  <title>Календарь</title>
  <script src="js/jquery.min.js"></script>
</head>
<body>
	<div id="status_id_15175270">
		<div class="pipeline_status__head_title">
			<span>123</span>
		</div>
		<span style="background-color: red;">456</span>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			var x = $(".pipeline_status__head:eq(2)").children("span").css("background-color");
			console.dir(x);
			var y = $(".pipeline_status__head:eq(2) .pipeline_status__head_title span").css("color", x);
			console.dir(y);
		});
	</script>
</body>
</html>