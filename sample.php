<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">


  <style type="text/css">
      #sub3 {
      position: absolute;
      left: 250px;
      top: 100px;
      background-color: #f1f1f1;
      width: 280px;
      padding: 10px;
      color: black;
      border: #0000cc 2px dashed;
      display: none;
      }
</style>
</head>
<body>
  <script language="JavaScript">
  function setVisibility(id) {
  if(document.getElementById('bt1').value=='Hide Layer'){
  document.getElementById('bt1').value = 'Show Layer';
  document.getElementById(id).style.display = 'none';
  }else{
  document.getElementById('bt1').value = 'Hide Layer';
  document.getElementById(id).style.display = 'inline';
  }
  }
  </script>
  <input type=button name=type id='bt1' value='Show Layer' onclick="setVisibility('sub3');";>
  <div id="sub3">Message Box</div>
</body>
</html>
