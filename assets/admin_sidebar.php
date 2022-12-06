  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
          <li class="header">
              <center><img src="../images/logo.png" width="80"></center>
          </li>
        <li class="header">MAIN NAVIGATION</li>
        <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
<?php if($_SESSION['user_role'] == '0'):?>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Manage Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="student.php"><i class="fa fa-circle-o"></i> Student Accounts</a></li>
            <li class="active"><a href="unvStudent.php"><i class="fa fa-circle-o"></i> Unverified Student Accounts</a></li>
            <li class="active"><a href="unvProf.php"><i class="fa fa-circle-o"></i> Unverified Professor Accounts</a></li>
            <li><a href="professor.php"><i class="fa fa-circle-o"></i> Teacher Accounts</a></li>
            <li><a href="adminList.php"><i class="fa fa-circle-o"></i> Admin Accounts</a></li>
            <li><a href="professor.php"><i class="fa fa-circle-o"></i> Guidance User Accounts</a></li>
            <!--
            <li><a href="dean.php"><i class="fa fa-circle-o"></i> Dean Account</a></li>
          -->
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i> <span>File Manager</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="subjects.php"><i class="fa fa-circle-o"></i> <span> Subjects</span></a></li>
            <li><a href="course.php"><i class="fa fa-circle-o"></i> <span> Course</span></a></li>
            <!--
            <li><a href="rooms.php"><i class="fa fa-circle-o"></i> <span> Rooms</span></a></li>
            <li><a href="school-year.php"><i class="fa fa-circle-o"></i> <span> School Year</span></a></li>
            <li><a href="days.php"><i class="fa fa-circle-o"></i> <span> Days</span></a></li>
          -->
          </ul>
        </li>
      
        <li><a href="questions.php"><i class="fa fa-file"></i> <span> Questions</span></a></li>
        <li><a href="add-announcement.php"><i class="fa fa-bullhorn"></i> <span> Announcement</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pencil"></i> <span>Manage IPCRF </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="ipcrf.php"><i class="fa fa-circle-o"></i> IPCRFs </a></li>
            <?php if ($_SESSION['ipcrf'] == 99) {
            ?>
            <li class="active"><a href="ipcrf-cats.php"><i class="fa fa-circle-o"></i> IPCRF Categories </a></li>
            <li class="active"><a href="ipcrf-strat.php"><i class="fa fa-circle-o"></i> IPCRF Strategic Prioties</a></li>
            <li><a href="ipcrf-measures.php"><i class="fa fa-circle-o"></i>IPCRF Measures</a></li>
            <li><a href="ipcrf-targets.php"><i class="fa fa-circle-o"></i> IPCRF Targets</a></li>
            <?php }
            ?>
            <!--
            <li><a href="dean.php"><i class="fa fa-circle-o"></i> Dean Account</a></li>
          -->
          </ul>
        </li>
        <li class="treeview"> 
          <a href="#">
            <i class="fa fa-pencil"></i> <span>IPCRF Submissions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="ipcrf-assign.php"><i class="fa fa-circle-o"></i> Pre-reviewed Submissions</a></li>
            <li class="active"><a href="ipcrf-approve.php"><i class="fa fa-circle-o"></i> Post-reviewed Submissions</a></li>
            <li class="active"><a href="ipcrf-final.php"><i class="fa fa-circle-o"></i> Approved Submissions</a></li>
          </ul>
        </li>
        <li><a href="comments.php"><i class="fa fa-comment"></i> Generate Comment</span></a></li>
        <li><a href="logs.php"><i class="fa fa-calendar"></i> <span> Logs</span></a></li>
        <li><a href="myevaluation.php"><i class="fa fa-book"></i> <span>Evaluation Results</span></a></li>
        <li><a href="deliverables.php"><i class="fa fa-upload"></i> Deliverables</span></a></li>
        <li><a href="evaluation.php"><i class="fa fa-calendar-o"></i> <span>Evaluation Status</span></a></li>
<!--
        <li><a href="reports.php"><i class="fa fa-calendar-o"></i> <span>Evaluation Reports</span></a></li>
      -->

        
<?php elseif($_SESSION['user_role'] == '1'):
  
  if ($_SESSION['ipcrf'] != 99) {
 ?>
<li><a href="add-ipcrf-ans.php?<?php echo "user_id=".$_SESSION['user_id']; ?>"><i class="fa fa-file"></i> IPCRF</span></a></li>
<?php  }?>
<li><a href="deliverables.php"><i class="fa fa-upload"></i> Upload Deliverables</span></a></li>
<li><a href="myevaluation.php"><i class="fa fa-print"></i> Evaluation Results </span></a></li>
<!--
  <li><a href="myevaluation.php"><i class="fa fa-book"></i> <span> My Evaluation</span></a></li>
  <li><a href="evaluation.php"><i class="fa fa-calendar-o"></i> <span> Evaluation Sheet</span></a></li>
-->
<!--
  <li><a href="transactions.php"><i class="fa fa-calendar-o"></i> <span>My Transactions</span></a></li>
  <li><a href="track.php"><i class="fa fa-search"></i> <span>Track Order</span></a></li>
<?php endif;?>
-->
<?php if($_SESSION['user_role'] == '2'):?>
<!--
  <li><a href="track.php"><i class="fa fa-search"></i> <span>Track Order</span></a></li>
-->
<?php endif;?>
<?php if($_SESSION['user_role'] == '3'):?>
  <!--
  <li><a href="reports.php"><i class="fa fa-calendar-o"></i> <span>Reports</span></a></li>
  -->
<?php endif;?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>