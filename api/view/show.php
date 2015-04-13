<html>
<body>
	
</body>
<h1>Show Cities</h1>
<table>
	<tr>
		<td>ID</td>
		<td>
			<?php echo $city->id ?>
		</td>
	</tr>
	<tr>
		<td>Name</td>
		<td>
			<?php echo $city->name ?>
		</td>
	</tr>
<tr>
	<td colspan="2">
		<a href="<?php echo $baseURL.'/cities' ?>">List ALL</a>
		<a href="<?php echo $baseURL.'/cities/'.$city->id.'/edit' ?>">Edit</a>
		<a href="<?php echo $baseURL.'/cities/'.$city->id.'/delete' ?>">Delete</a>
	</td>
</tr>

</table>


</html>



