<html>
	<head>
		
	</head>
	<body>
		<script type="text/javascript">
			eraseCookie("timezone");
			
			function createCookie(name,value,days) {
				if (days) {
					var date = new Date();
					date.setTime(date.getTime()+(days*24*60*60*1000));
					var expires = "; expires="+date.toGMTString();
				}
				else var expires = "";
				document.cookie = name+"="+value+expires+"; path=/";
			}

			function eraseCookie(name) {
				createCookie(name,"",-1);
			}
			
		</script>
		
	</body>
</html>