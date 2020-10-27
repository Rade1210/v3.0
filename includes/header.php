<style>
  nav ul{
    margin-right:30px !important;
  }

  #searchBar {
    position: absolute;
    right: 12px;;
    top: 21px;
    cursor:pointer;
  }
  .search-div {
    position:absolute;
    right:0;
    top:46px;
    width:300px;
    z-index:9999;
    display:none;
  }
</style>
<header class="clearfix">
    <div class="fa fa-reorder menu-toggle"></div>
    <div class="logo">
      <a href="<?=isset($page_dir)?$page_dir:''?>index.php">
        <h1 class="logo-text"><span>Personal</span>BusinessBlog</h1>
      </a>
    </div>
    <nav>
      <ul>		
        <li><a href="<?=isset($page_dir)?$page_dir:''?>index.php">Home</a></li>
		<?php if($_SESSION['user_id'] == "") { ?>
        <li><a href="<?=isset($page_dir)?$page_dir:''?>register.php">Sign up</a></li>
        <li><a href="<?=isset($page_dir)?$page_dir:''?>login.php">Login</a></li>
		<?php } ?>
		<?php if($_SESSION['username'] != "") { ?>
        <li>
          <a href="#" class="userinfo">
            <i class="fa fa-user"></i> <?=$_SESSION['username'];?> <i class="fa fa-chevron-down"></i>
          </a>
          <ul class="dropdown">
			<?php if($_SESSION['admin'] != "") { ?>
            <li><a href="<?=isset($page_dir)?$page_dir:''?>admin/posts/index.php">Dashboard</a></li>
			<?php } ?>
            <li><a href="<?=isset($page_dir)?$page_dir:''?>logout.php" class="logout">Logout</a></li>
          </ul>
        </li>
		<?php } ?>
      </ul>
    </nav>
    <div id="searchBar">
      <i id="searchIcon" class="fa fa-search"></i>
      <div class="search-div">
        <form action="<?=isset($page_dir)?$page_dir:''?>search.php" method="get">
          <div class="search">			
            <input type="text" name="query" class="text-input" placeholder="Search..."> 
            <button type="submit"><i class="fa fa-search"></i></button>
          </div> 
        </form>
      </div>
    </div>
  </header>