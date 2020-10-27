<?php require_once("../../includes/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../../css/font-awesome.min.css" />
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/admin.css">
  <title>Admin - Manage Topics</title>
</head>
<body>
  <?php require_once("../header.php"); ?>
  <div class="admin-wrapper clearfix">
    <div class="left-sidebar">
      <ul>
        <li><a href="../posts/index.php">Manage Posts</a></li>
        <li><a href="index.php">Manage Topics</a></li>
        <li><a href="../users/index.php">Manage Users</a></li>
      </ul>
    </div>
    <div class="admin-content clearfix">
      <div class="button-group">
        <a href="create.php" class="btn btn-sm">Add Topic</a>
        <a href="index.php" class="btn btn-sm">Manage Topics</a>
      </div>
      <div class="">
        <h2 style="text-align: center;">Manage Topic</h2>
        <?php if($_SESSION['success'] != "") { ?>
		<div class="msg success">
			<li><?php echo $_SESSION['success']; ?></li>
		</div>
		<?php } unset($_SESSION['success']); ?>
        <table>
          <thead>
            <th>N</th>
            <th>Name</th>
            <th colspan="2">Action</th>
          </thead>
          <tbody>
            <?php
			$topicssql = mysqli_query($conn, "SELECT * FROM topics");
			$topicscount = mysqli_num_rows($topicssql);
			if($topicscount > 0)
			{
				$count = 1;
				while($topicsresult = mysqli_fetch_assoc($topicssql))
				{ ?>
					<tr class="rec">
					  <td><?=$count;?></td>
					  <td><a href="edit.php?id=<?=$topicsresult['id'];?>"><?=$topicsresult['name'];?></a></td>
					  <td><a href="edit.php?id=<?=$topicsresult['id'];?>" class="edit">Edit</a></td>
					  <td><a href="delete.php?id=<?=$topicsresult['id'];?>" class="delete">Delete</a></td>
					</tr>
			<?php
				$count++;
				} 
			}
			else
			{ ?>
				<tr class="rec">
					<td colspan="4" style="text-align: center;"><b>No Topics yet.</b></td>
				</tr>
			<?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="../../js/jquery.min.js"></script>
  <script type="text/javascript" src="../../js/slick.min.js"></script>
  <script type="text/javascript" src="../../js/scripts.js"></script>
</body>
</html>