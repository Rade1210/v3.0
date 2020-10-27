<?php require_once("includes/config.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <link rel="stylesheet" href="css/style.css?<?=time()?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" />
  <title>Awa Inspires Blog</title>
  <style>
    #trendingPosts {
      position: relative;
    }

    .posts-wrapper {
      height: 370px !important;
    }

    .slick-dots {
      bottom: -80px !important;
    }
  </style>
</head>

<body>
  <?php require_once("includes/header.php"); ?>
  <div class="page-wrapper">
    <div class="posts-slider">
      <h1 class="slider-title">Trending Posts</h1>
      <div class="posts-wrapper">
        <div id="trendingPosts">

          <?php
          if (isset($_GET['topicid']) && $_GET['topicid'] != "")
            $postsql = mysqli_query($conn, "SELECT * FROM posts WHERE topic_id='" . $_GET['topicid'] . "' and published='1' and trending='1' order by id desc");
          else
            $postsql = mysqli_query($conn, "SELECT * FROM posts WHERE published='1' and trending='1' order by id desc");
          $postscount = mysqli_num_rows($postsql);
          if ($postscount > 0) {
            while ($postresult = mysqli_fetch_assoc($postsql)) {
              $authorsql = mysqli_query($conn, "SELECT * FROM users WHERE id='" . $postresult['user_id'] . "'");
              $authorresult = mysqli_fetch_assoc($authorsql);
              $post_title = str_replace(" ", "-", $postresult['title']);
              $post_title = strtolower($post_title);
          ?>
              <div class="post">
                <div class="inner-post">
                  <img src="admin/posts/post_images/<?= $postresult['image']; ?>" alt="" style="height: 200px; width: 100%; border-top-left-radius: 5px; border-top-right-radius: 5px;">
                  <div class="post-info">
                    <h4><a href="post/<?= $post_title ?>"><?= $postresult['title']; ?></a></h3>
                      <div><i class="fa fa-user-o"></i> <?= $authorresult['username']; ?>&nbsp;
                        <i class="fa fa-calendar"></i> <?= date("M d, Y", strtotime($postresult['created_at'])); ?>
                      </div>
                  </div>
                </div>
              </div>
          <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
    <div class="content clearfix">
      <div class="page-content" style="float: left;">
        <h1 class="recent-posts-title">Recent Posts</h1>
        <?php
        if (isset($_GET['topicid']) && $_GET['topicid'] != "")
          $postsql = mysqli_query($conn, "SELECT * FROM posts WHERE topic_id='" . $_GET['topicid'] . "' and published='1' order by id desc");
        else
          $postsql = mysqli_query($conn, "SELECT * FROM posts WHERE published='1' order by id desc");
        $postscount = mysqli_num_rows($postsql);
        if ($postscount > 0) {
          while ($postresult = mysqli_fetch_assoc($postsql)) {
            $authorsql = mysqli_query($conn, "SELECT * FROM users WHERE id='" . $postresult['user_id'] . "'");
            $authorresult = mysqli_fetch_assoc($authorsql);
            
            $post_title = str_replace(" ", "-", $postresult['title']);
              $post_title = strtolower($post_title);
        ?>
            <div class="post clearfix">
              <img src="admin/posts/post_images/<?= $postresult['image']; ?>" class="post-image" alt="">
              <div class="post-content">
                <h2 class="post-title"><a href="post/<?= $post_title ?>"><?= $postresult['title']; ?></a></h2>
                <div class="post-info">
                  <i class="fa fa-user-o"></i> <?= $authorresult['username']; ?>
                  &nbsp;
                  <i class="fa fa-calendar"></i> <?= date("M d, Y", strtotime($postresult['created_at']));; ?>
                </div>
                <p class="post-body"><?= implode(' ', array_slice(explode(' ', strip_tags($postresult['body'])), 0, 50)); ?>...</p>
                <a href="post/<?= $post_title ?>" class="read-more">Read More</a>
              </div>
            </div>
        <?php
          }
        }
        ?>
      </div>
      <div class="sidebar">
        <div class="section topics">
          <h2>Topics</h2>
          <?php
          $topicsql = mysqli_query($conn, "SELECT * FROM topics");
          $topicsqlcount = mysqli_num_rows($topicsql);
          if ($topicsqlcount > 0) {
            echo "<ul>";
            while ($topicresult = mysqli_fetch_assoc($topicsql)) { ?>
              <a href="index.php?topicid=<?= $topicresult['id']; ?>">
                <li><?= $topicresult['name']; ?></li>
              </a>
          <?php
            }
            echo "</ul>";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <?php require_once("includes/footer.php"); ?>


  <script>
    $('#trendingPosts').slick({
      dots: true,
      infinite: true,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [{
          breakpoint: 1024,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
            infinite: true,
            dots: false
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
  </script>

</body>

</html>