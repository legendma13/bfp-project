

function searchuser(v){
    if(v != ""){
      $("#search-user").addClass("Active");
    } else{
      $("#search-user").removeClass("Active");
    } 
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
    document.getElementById("chat-users").innerHTML = this.responseText;
    }
    xhttp.open("GET", "chat/search.php?q="+v, true);
    xhttp.send();
}
function userschat(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
    document.getElementById("chat-users").innerHTML = this.responseText;
    }
    xhttp.open("GET", "chat/users.php", true);
    xhttp.send();
}

function chatmessage(){
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
  document.getElementById("chat-messages").innerHTML = this.responseText;
  }
  xhttp.open("GET", "chat/chat-message.php", true);
  xhttp.send();
}

function scrollToBottom() {
  $("#chat-messages").scrollTop($("#chat-messages")[0].scrollHeight);
}
setInterval(function () {
  chatmessage();
  if (!$('#search-user').hasClass('Active')) {
    userschat();
  }
  if (!$('#chat-messages').hasClass('Active')) {
    scrollToBottom();
  }
}, 500);

