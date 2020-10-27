<?php 
$page_dir = '../';
require_once("includes/config.php");
$postresult = [];
if(isset($_GET['title']) && $_GET['title'] != "") {
  $post_title = str_replace("-" ," " , $_GET['title']);
  $postsql = mysqli_query($conn, "SELECT * FROM posts WHERE title='".$post_title."' and published='1'");
  if(mysqli_num_rows($postsql)){
    while($row = mysqli_fetch_assoc($postsql)){
      $postresult = $row;
    }
  }
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css/font-awesome.min.css" />
  <link rel="stylesheet" href="../css/style.css">
  <meta name="description" content="<?=$postresult['meta_description']?>">
  <meta name="url" content="<?=$postresult['meta_url']?>">
  <title>Motivational Blog</title>
</head>
<body>
  <div id="fb-root"></div>
  <script>
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src =
      'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId=285071545181837&autoLogAppEvents=1';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
  </script>
  <?php require_once("includes/header.php"); ?>
  <div class="page-wrapper">
    <div class="content clearfix">
      <div class="page-content single">
		<?php
			if(!empty($postresult)){
				?>
        <h2 style="text-align: center;"><?=$postresult['title'];?></h2>
        <br>
        <?=$postresult['body'];?>
        <?php
			}
		?>
      </div>
    </div>
  </div>
  <?php require_once("includes/footer.php"); ?>
</body>
</html>