<?php
  session_start();
  $to = htmlspecialchars($_SESSION['uid']);
  if(isset($_SESSION['chatuid']))
  $from = htmlspecialchars($_SESSION['chatuid']);
else
  $from = "";
  include_once "../../php/config.php";
  
  $chat_message = $link->query("SELECT * FROM chat LEFT JOIN bfp_users ON 
  bfp_users.uid = chat.chat_uid WHERE (chat_to = '$to' AND chat_uid = '$from')
  OR (chat_to = '$from' AND chat_uid = '$to') ORDER BY chat_time"); 
?>
  <?php if($chat_message->num_rows>0){?>
    <?php while($sh_message = $chat_message->fetch_assoc()){?>
      <?php if ($sh_message['chat_uid'] == $to) { ?>
      <!--ME-->
      <div class="chat-message-right pb-4">
        <div>
          <img src="../assets/img/<?php echo $sh_message['profile_img']?>" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
        </div>
        <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3 shadow me-3">
          <div class="font-weight-bold mb-1 fw-bold"> You</div>
          <p class="text-break">
            <?php echo $sh_message['message']?><br>
            <small class="text-muted small text-nowrap mt-2 d-flex justify-content-between">
              <?php echo date('h:i:s A', strtotime($sh_message['chat_time']))?>
              <button type="button" value="<?php echo $sh_message['chat_id']?>" class="deletemsg border border-0 bg-transparent text-danger fs-6" title="Delete this Message"><i class="mdi mdi-delete-forever"></i></button>
            </small>
          </p>
        </div>
      </div>
      <?php } else { ?>
      <!--ME-->
      <!--THEM-->
      <div class="chat-message-left pb-4">
        <div>
          <img src="../assets/img/<?php echo $sh_message['profile_img']?>" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
        </div>
        <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3 ms-3 shadow">
          <div class="font-weight-bold mb-1 fw-bold">
          <?php
          if ($sh_message['position'] == "Provincial") {
            echo $sh_message['location'].' ('.$sh_message['position'].')';
          } elseif($sh_message['position'] == "Municipal") {
            echo $sh_message['location'] . "," .$sh_message['municipal'] .' ('.$sh_message['position'].')';
          } else {
            echo "Regional";
          }
          ?>  
          </div>
          <p class="text-break">
            <?php echo $sh_message['message']?> <br>
            <small class="text-muted small text-nowrap mt-2">
              <?php echo date('h:i:s', strtotime($sh_message['chat_time']))?>
            </small>
          </p>
        </div>
      </div>
      <!--THEM-->
      <?php }?>
    <?php }?>
  <?php } else { ?>
  <h5 class="text-center">No Conversation</h5>
  <?php }?>