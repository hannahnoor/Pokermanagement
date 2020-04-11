<!DOCTYPE html>
<html lang="nl">
<head>
  <title>Speelscherm</title>
   <!--Make responsive-->
   <meta charset="utf-8"/>
   <title>Speelscherm</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://kit.fontawesome.com/7dd5b04b57.js" crossorigin="anonymous"></script>
   <link rel="stylesheet" type="text/css" href="assets/css/stylesheet.css">

 
</head>

<body class="background">

  <div class="container centerScreen">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-3">
                <button class="btn" type="button" id="spelregels">Spelregels</button>
              </div>
              <div class="col-3">
                <button class="btn" type="button" id="fiches">Fiches</button>
              </div>
              <div class="col-3">
                <button class="btn" type="button" id="rebuy">Rebuy</button>
              </div>
              <div class="col-3">
                <button class="btn" type="button" id="quit">Quit</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-3">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title">Players</h3>
            <div>
              <ul>
                <li>Player 1: 430</li>
                <li>Player 2: 580</li>
                <li>Player 3: 310</li>
                <li>Player 4: 640</li>
                <li>Player 5: 495</li>
              </ul>
            </div>

          </div>
        </div>
      </div>
      <div class="col-9">
        <div class="card">
          <div class="card-body">
            <h1 class="card-title">POKERTAFEL</h1>
            <div> <img src="https://previews.123rf.com/images/jsddesign/jsddesign1412/jsddesign141200170/34750183-realistic-poker-table.jpg" alt="poker table"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

      

<!--Doen we er een chat in?-->
<!--<div class="chat-popup" id="myForm">
  <form action="/action_page.php" class="form-container">
    <h1>Chat</h1>

    <label for="msg"><b>Message</b></label>
    <textarea placeholder="Type message.." name="msg" required></textarea>

    <button type="submit" class="btn">Send</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>-->

<!--<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>-->


</body>
</html>
