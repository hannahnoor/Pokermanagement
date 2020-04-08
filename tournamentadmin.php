<!DOCTYPE html>
<html lang="nl">
<head>
    <!--Make responsive-->
    <meta charset="utf-8"/>
    <title>Tournament</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/7dd5b04b57.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/stylesheet.css">

    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&family=Quicksand&display=swap" rel="stylesheet">

</head>
<body class="background">

  <div class="container centerScreen">

    <div class="row"> 
      <div class="col">
        <div class="card">
          <div class="card-body">
            <h1 class="card-title"><?= $_SESSION['tour_name'] ?></h1>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <h2>[Code]</h2>
          </div>
        </div>
      </div>
    </div>

    <!--Lijst van deelnemers-->
    <div class="row">
      <div class="col-5">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">Deelnemers</h2>

            <!--Tijdelijke lijst-->
            <ul>
              <p>Speler 1</p>
              <p>Speler 2</p>
              <p>Speler 3</p>
            </ul> 

          </div>
        </div>
      </div>
      <!--Toernooi instellingen-->
      <div class="col-7">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">Instellingen</h2>
            <!--Startbedrag invoeren-->
            <form method="POST">
              <div class="form-group">
                  <label for="startAmount">Startbedrag in euro's</label>
                  <input type="number" min="1" name="startAmount" class="form-control" id="startAmount"/>
              </div>
              <!--Aantal rondes invoeren-->
              <div class="form-group">
                <label for="rounds">Aantal rondes</label>
                <input type="number" min="1" name="rounds" class="form-control" id="rounds"/>
              </div>
              
              <!--Waarde van de fiches invoeren-->
              <div class="row">
                <div class="col-12">
                  Waarde fiches
                </div>
              </div>

              <div class="row">
                <div class="col-2">
                  <div class="chip"></div>
                  <input type="number" name="whiteChip" min="1"  id="whiteChip" class="form-control">
                </div>

                <div class="col-2">
                  <div class="chip" id="red"></div>
                  <input type="number" name="redChip" min="1" class="form-control inputNumber">
                </div>

                <div class="col-2">
                  <div class="chip" id="green"></div>
                  <input type="number" name="greenChip" min="1" class="form-control">
                </div>

                <div class="col-2">
                  <div class="chip" id="blue"></div>
                  <input type="number" name="blueChip" min="1" class="form-control">
                </div>

                <div class="col-2">
                  <div class="chip" id="black"></div>
                  <input type="number" name="blackChip" min="1" class="form-control">
                </div>

              </div>
              <div>
                <button class="btn" type="button" id="Starten">Start tournooi!</button> 
              </div>
            </form>          
          </div>
      </div>
    </div>
    </div>
  </div>
</body>
</html>