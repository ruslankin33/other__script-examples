<!DOCTYPE html>
<html>
<head>
  <title>Календарь</title>
  <script src="js/jquery.min.js"></script>
  <script src="js/glDatePicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/glDatePicker.flatwhite.css">
</head>
<body>
	 <div id="form-container">
    <form action="action.php">
      <input type="text" id="mydate" name="date" />
      <input type="submit" value="Забронировать" class="btn-submit" />
    </form>
  </div>
  <script type="text/javascript">
    $(window).on('load', function() {
  		  $.ajax({
          url: 'script.php',
          cache: false,
          type: "post",
          success: function(data) {
            console.dir(data);
            var info = JSON.parse(data);
            console.dir(info);
            var dates = [];
            var d = {};
            for (var value in info) {
              if (typeof info[value] != 'undefined' && typeof info[value] == 'string') {
                d = { date: new Date(info[value]) },
                dates.push(d);
              }
            }     
            console.dir(dates);
            $('#mydate').glDatePicker(
              {
                  showAlways: false,
                  hideOnClick: true, 
                  cssName: 'flatwhite',
                  selectedDate: null,
                  selectableDates: dates,
              });
              }
        }); 
        
    });
  </script>

  <style>
    #form-container {
      width: 800px;
      height: 400px;
      margin: 0 auto;
    }
    input { 
      width: 320px; 
      height: 36px; 
      font-size: 19px; 
      padding-left: 7px;
    }
    .btn-submit {
      background: linear-gradient(#648880, #293f50);
      border-radius: 4px;
      border: none;
      outline: none;
      color: white;
      cursor: pointer;
    }
  </style>
</body>
</html>