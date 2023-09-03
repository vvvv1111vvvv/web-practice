<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
</head>
<body>
  <h1>Javascript</h1>
  <ul>
  <script type="text/javascript">
    list=new Array("alpha","beta","gama","delta","esilon");
    i=0;
    while(i<list.length){
      document.write("<li>"+list[i]+"</li>");
      i++;
    }
  </script>
  </ul>
  <h1>php</h1>
  <ul>
  <?php
    $list= array("alpha","beta","gama","delta","esilon");
    $i=0;
    while($i<count($list)){
      echo "<li>".$list[$i]."</li>";
      $i++;
    }
  ?>
  </ul>
</body>
</html>
