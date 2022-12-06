<?php $user = single_get("*","user_id","user_account",$_SESSION['user_id']); ?>
<header class="main-header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Logo -->
    <a href="index.php" class="logo"  style="background:#d8b242; ">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>I</b>T</span>
      <!-- logo for regular state and mobile devices -->

      <span class="logo-lg">
        DFCAMCLP - IT
      </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background: #d8b242; ">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              
              <i class="fa fa-user"></i> <span class="hidden-xs"><?php echo $_SESSION['fname']?> <?php echo $_SESSION['lname']?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li style="background-color:#D9013A;" class="user-header">
                <p>
                  <?php echo $_SESSION['fname']?> <?php echo $_SESSION['lname']?>
                  <small>Member since <?php echo date("Y-m-d H:i a",strtotime($user['DateCreated']));?></small>
                </p>
              </li> 
              <li class="user-footer">
                <div class="pull-left">
                  <a href="change.php" class="btn btn-default btn-flat">Change Password</a>
                </div>
                <div class="pull-right">
                <?php if(isset($_SESSION['login_user']) == 'login_user'):?>
                 <a href="logout2.php" class="btn btn-default btn-flat">Sign out</a>
                <?php else:?>
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                <?php endif;?>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>