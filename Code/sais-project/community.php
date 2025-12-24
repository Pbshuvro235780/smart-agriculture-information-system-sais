<?php include "includes/header.php"; ?>
<?php include "includes/nav.php"; ?>

<div class="container mt-5">
  <h2 class="text-success">Community Chat</h2>
  <div class="card p-3 shadow">
    <form id="msgForm">
      <input type="text" name="message" class="form-control mb-2" placeholder="Type your message..." required>
      <button type="submit" class="btn btn-success">Send</button>
    </form>
  </div>

  <div class="mt-4">
    <h5>Messages</h5>
    <ul id="chatList" class="list-group"></ul>
  </div>
</div>

<script>
document.getElementById("msgForm").addEventListener("submit", async function(e) {
  e.preventDefault();
  let formData = new FormData(this);
  let res = await fetch("backend/add_message.php", {method:"POST", body:formData});
  let data = await res.json();
  if(data.success) loadMessages();
});

async function loadMessages() {
  let res = await fetch("backend/get_messages.php");
  let msgs = await res.json();
  let list = document.getElementById("chatList");
  list.innerHTML = "";
  msgs.forEach(m => {
    list.innerHTML += `<li class="list-group-item"><b>${m.user}:</b> ${m.message}</li>`;
  });
}
loadMessages();
setInterval(loadMessages, 5000);
</script>

<?php include "includes/footer.php"; ?>
