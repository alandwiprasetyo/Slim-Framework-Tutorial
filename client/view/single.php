<html>
<body>
	
</body>
<h1>Show Cities</h1>
<a href="<?php echo $baseURL.'/cities' ?>">List ALL</a>
<table >
	<tr>
		<td>ID</td>
		<td width="300px" align="center">Name</td>	
		<td>Action</td>
		
	</tr>
	<td>
			<?php echo $city->id ?>
		</td>
				<td width="300px" align="center">
			<?php echo $city->name ?>
		</td>
			<td colspan="1">
		
		<a href="<?php echo $baseURL.'/cities/'.$city->id.'/edit' ?>">Edit</a>
		<a href="<?php echo $baseURL.'/cities/'.$city->id.'/delete' ?>">Delete</a>
	</td>
	<tr>
	</tr>
<tr>
</tr>
</table>
</html>