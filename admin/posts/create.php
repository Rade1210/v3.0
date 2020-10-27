<?php
require_once("../../includes/config.php");
session_start();
if(isset($_POST['save-post']))
{
	if(empty($_POST['title']))
    $errors[] = "Title is required";
  if(empty($_POST['body']))
    $errors[] = "Body is required";
	if(empty($_FILES['postimage']['name']))
    $errors[] = "Post Image is required";
	if(count($errors) == 0)
	{
		$poststitlesql = "SELECT * FROM posts WHERE title='" . $_POST['title'] . "'";
		$posttitleresults = mysqli_query($conn, $poststitlesql);
		if(mysqli_num_rows($posttitleresults) > 0)
			$errors[] = "Post Title already exists.";
		else
		{
			if($_POST['publish'] != "") { $published = 1; } else { $published = 0; }
			if($_POST['trending'] != "") { $trendingpost = 1; } else { $trendingpost = 0; }
			mysqli_query($conn, "INSERT INTO posts SET user_id='".$_SESSION['user_id']."', topic_id='".$_POST['topic']."', title='".$_POST["title"]."', body='".$_POST["body"]."', trending='".$trendingpost."', published='".$published."' , description='".$_POST['description']."' , meta_description='".$_POST['meta_description']."' , meta_url='".$_POST['meta_url']."' ");
			$p_id = mysqli_insert_id($conn);

			move_uploaded_file($_FILES['postimage']['tmp_name'],"post_images/".$p_id."_".$_FILES['postimage']['name']);
			mysqli_query($conn, "UPDATE posts SET image = '".$p_id."_".$_FILES['postimage']['name']."' WHERE id = '".$p_id."'");
			$_SESSION['success'] = "Post Created Successfully.";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../../css/font-awesome.min.css" />
  <link rel="stylesheet" href="../../css/style.css">
  <link href="../../css/summernote-lite.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../css/admin.css">
  <title>Admin - Create Post</title>
</head>
<body>
  <?php require_once("../header.php"); ?>
  <div class="admin-wrapper clearfix">
    <div class="left-sidebar">
      <ul>
        <li><a href="index.php">Manage Posts</a></li>
        <li><a href="../topics/index.php">Manage Topics</a></li>
        <li><a href="../users/index.php">Manage Users</a></li>
      </ul>
    </div>
    <div class="admin-content clearfix">
      <div class="button-group">
        <a href="create.php" class="btn btn-sm">Add Post</a>
        <a href="index.php" class="btn btn-sm">Manage Posts</a>
		<a href="drafts.php" class="btn btn-sm">Manage Drafts</a>
      </div>
      <div class="">
        <h2 style="text-align: center;">Create Post</h2>
		<?php
			require_once("../print_errors.php");
			require_once("../show_messages.php");
		?>
        <form action="create.php" method="post" enctype="multipart/form-data">
          <div class="input-group">
            <label>Title</label>
            <input type="text" name="title" class="text-input">
          </div>
          <div class="input-group">
            <label>Body</label>
            <textarea class="text-input" name="body" id="body"></textarea>
          </div>
          <div class="input-group">
            <label>Topic</label>
            <select class="text-input" name="topic">
				<?php
					$topicssql = mysqli_query($conn, "SELECT * FROM topics");
					while($topicsresult = mysqli_fetch_assoc($topicssql)) { ?>
					<option value="<?=$topicsresult['id'];?>"><?=$topicsresult['name'];?></option>
				<?php } ?>
            </select>
          </div>
		  <div class="input-group">
            <label>
              <input type="file" name="postimage" id="postimage" />
            </label>
          </div>
          <div class="input-group">
            <label>
              <input type="checkbox" name="publish" /> Publish
            </label>
          </div>
	       <div class="input-group">
            <label>
              <input type="checkbox" name="trending" /> Trending Post
            </label>
          </div>
          
          <div class="input-group">
            <label>Post Description</label>
            <textarea name="description" class="text-input" rows="3"></textarea>
          </div>
          
          <div class="input-group">
            <label>Meta Description</label>
            <textarea name="meta_description" class="text-input" rows="4"></textarea>
          </div>

          <div class="input-group">
            <label>Meta URL</label>
            <input type="text" name="meta_url" class="text-input">
          </div>

          <div class="input-group">
            <button type="submit" name="save-post" class="btn">Save Post</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="../../js/jquery.min.js"></script>
  <script src="../../js/summernote-lite.min.js"></script>
  <!-- <script type="text/javascript" src="../../js/ckeditor.js"></script> -->
  <script type="text/javascript" src="../../js/scripts.js"></script>
  
</body>
</html>