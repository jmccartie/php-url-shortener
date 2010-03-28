<?php
// Load config and connect to database
require_once('config.php');
require_once('connect.php');
require_once('functions.php');

// Grab all views
$sql = "
	SELECT links.id, links.url, links.created_at as link_created, COUNT(views.view_id) as count
	FROM links 
	LEFT JOIN views ON links.id = views.link_id
	GROUP BY links.id
	ORDER BY count desc
";

$data = mysql_query($sql) or die(mysql_error());
?>
<html>
<head>
	<title>My Short URL Links</title>
</head>
<body>
<table cellpadding="5" cellspacing="5" width="100%">
<tr bgcolor="#cccccc">
	<td>URL</td>
	<td>Views</td>
	<td>Created</td>
	<td>Short URL</td>
</tr>
<?php while ($row = mysql_fetch_assoc($data))   : ?>
<tr>
	<td><a href="<?php echo $row['url']?>" target="_blank"><?php echo $row['url']?></a></td>
	<td><?php echo $row['count']?></td>
	<td><?php echo date("M jS, Y", $row['link_created'])?>
	<td><?php echo HOST.encode($row['id'])?></td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>