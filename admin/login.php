<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../main.css">
</head>
<body>
	<div id="body">
		<!-- header -->
		<a id="logo">Ourblog</a>
		<hr style="margin-bottom: 50px;">
		<!-- content -->
		<div>
			<form action="../config/functions.php?action=login" method="post">
				<table style="width: 300px;margin: 0 auto;">
					<tr>
						<td width="80px;">E-mail:</td>
						<td><input type="email" name="email"><br></td>
					</tr>
					<tr>
						<td>密   码:</td>
						<td><input type="password" name="password"></td>
					</tr>
					<tr>
						<td colspan="2">
							<div style="width: 100px; margin: 0 auto;">
								<button type="submit" style="height: 20px;width: 100px;border: 1px solid black; border-radius: 2px;">登录</button>
							</div>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>
</html>
