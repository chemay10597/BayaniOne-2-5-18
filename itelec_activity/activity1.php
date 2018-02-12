<html>
  <head>
    <title>Acitivity 1</title>
    <script src="../jquery/jquery.min.js"></script>
  </head>
  <body>
    <div>
      <form action="activity1.php" method="post">
        <fieldset>
          <label>Email: </label>
          <input id="email" name="email" type="email" placeholder="user@domain.com" required/>
          </br></br>
          <label>Username: </label>
          <input id="username" name="username" type="text" placeholder="username ..." required/>
          </br></br>
          <label>Password: </label>
          <input id="password" name="password" type="password" placeholder="password ..." required/>
          </br></br>
          <button type="submit" class="signupbtn" height="59px"width="341px" id="adduser" name="adduser" >Add</button>
        </fieldset>
      </form>
      <?php include_once("add.php");?>
    </div>
    <div>
      <?php include_once("select.php");?>
    </div>
  </body>
</html>
