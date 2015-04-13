<html>
<body>
	
</body>
<h1>List Of Cities</h1>
<a href="<?php echo $baseURL.'/cities/' ?>"> Create an new Cities</a>
<table>
	<tr>
		<th>No</th>
		<th>Nama</th>
		<th></th>
	</tr>
	<?php
	$i =1;
	 foreach ($cities as $city ) : ?>
		<tr>
			<td>
				<?php echo $i ; $i++;?>
			</td>
			<td>
				<?php echo $city->name ?>
			</td>
			<td>
				<a href="<?php echo $baseURL.'/cities/'.$city->id ?>">View</a>
				<a href="<?php echo $baseURL.'/cities/'.$city->id.'/delete' ?>">Delete</a>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
</html>
