<?php
// Load config and connect to database
require_once('config.php');
require_once('connect.php');
require_once('functions.php');

// Determine sort order based on current page
if ($_GET['sort_by'])
{
	$sort_by = mysql_escape_string($_GET['sort_by']);
}
else
{
	$sort_by = 'link_views';
}

$dir = (isset($_GET['dir'])) ? mysql_escape_string($_GET['dir']) : 'desc';

// Grab all views
$sql = "
	SELECT links.id as link_id, links.url as link_url, links.created_at as link_created, COUNT(views.view_id) as link_views
	FROM links 
	LEFT JOIN views ON links.id = views.link_id
	GROUP BY links.id
	ORDER BY ".$sort_by." ".$dir."
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
	<td><a href="?sort_by=link_id&dir=<?php echo ($sort_by === 'link_id' && $dir === 'desc') ? 'asc' : 'desc'; ?>">ID</a> <?php if ($sort_by === 'link_id') echo ($dir === 'desc') ? '&darr;' : '&uarr;'; ?></td>
	<td><a href="?sort_by=link_url&dir=<?php echo ($sort_by === 'link_url' && $dir === 'desc') ? 'asc' : 'desc'; ?>">URL</a> <?php if ($sort_by === 'link_url') echo ($dir === 'desc') ? '&darr;' : '&uarr;'; ?></td>
	<td><a href="?sort_by=link_views&dir=<?php echo ($sort_by === 'link_views' && $dir === 'desc') ? 'asc' : 'desc'; ?>">Views</a> <?php if ($sort_by === 'link_views') echo ($dir === 'desc') ? '&darr;' : '&uarr;'; ?></td>
	<td>Last View</td>
	<td><a href="?sort_by=link_created&dir=<?php echo ($sort_by === 'link_created' && $dir === 'desc') ? 'asc' : 'desc'; ?>">Created</a> <?php if ($sort_by === 'link_created') echo ($dir === 'desc') ? '&darr;' : '&uarr;'; ?></td>
	<td>Short URL</td>
</tr>

<?php while ($row = mysql_fetch_assoc($data))   : ?>
	<?php 
		// Get the latest view for this entry
		$sql = "
			SELECT view_id, link_id, created_at as created
			FROM views
			WHERE link_id = ".$row['link_id']."
			ORDER BY created DESC
			LIMIT 1
		";
		$temp = mysql_query($sql) or die(mysql_error());
		$latest = mysql_fetch_array($temp);	
	?>
<tr>
	<td><?php echo $row['link_id']?></td>
	<td><a href="<?php echo $row['link_url']?>" target="_blank"><?php echo $row['link_url']?></a></td>
	<td><?php echo $row['link_views']?></td>
	<td><?php echo date("M jS, Y g:ia", $latest['created'])?></td>
	<td><?php echo date("M jS, Y g:ia", $row['link_created'])?>
	<td><?php echo HOST.encode($row['link_id'])?></td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>