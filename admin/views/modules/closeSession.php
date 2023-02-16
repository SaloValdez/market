<?php
session_start();
 session_destroy();

// echo "Se cerro session correctamente";
// echo "<script>top.window.location = '/mynewpage.php'</script>";
header('Location:../../../index.php');
// echo "<meta content='0;URL=index.php?content=Formularioresgistro.php' http-equiv='REFRESH'> </meta>";
//
//  index.php?content=Formularioresgistro.php
 ?>