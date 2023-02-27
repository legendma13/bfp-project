<?php 
  include_once "../../php/config.php";
  session_start();
  $uid = htmlspecialchars($_SESSION['uid']);
  $user = $link->query("SELECT * FROM bfp_users 
  WHERE (username LIKE '%" . $_GET['q'] . "%' OR location LIKE '%" . $_GET['q'] . "%' OR municipal LIKE '%" . $_GET['q'] . "%') 
  AND uid != '$uid'");
?>
<?php while ($shuser = $user->fetch_assoc()) { ?>
<a href="chat.php?chatuid=<?php echo $shuser['uid']?>" class="list-group-item list-group-item-action border-0">
  <?php if($shuser['active'] == "Online"){?>
    <div class="badge bg-success float-right text-success">*</div>
  <?php }else{?>
    <div class="badge bg-danger float-right text-danger">*</div>
  <?php }?>
  <div class="d-flex align-items-start">
    <img src="../assets/img/<?php echo $shuser['profile_img']?>" class="rounded-circle me-3" alt="Vanessa Tucker" width="40" height="40">
    <div class="flex-grow-1 ml-3">
      <?php echo $shuser['username']?>
      <div class="small">
        <small><?php echo $shuser['location']?></small>
        <span class="fas fa-circle chat-online"></span> (<?php echo $shuser['position']?>)
      </div>
    </div>
  </div>
</a>
<?php }?>