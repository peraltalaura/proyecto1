<?php

if(isset($_SESSION['admin']) && ($_SESSION['admin']==1)){


  echo "<div align=center><h5>You are already logged in</h5></div>";

}
else{
    if(isset($_POST['submit'])){
      echo escape($_POST['username']);
      if((!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", escape($_POST['username']))) && (escape($_POST['username'])!="admin@bdweb")){
          header("Location: ".$_SERVER['PHP_SELF']."?action=login");
      } else {
        $creds = mysqli_query($conx,"SELECT * FROM users WHERE username='".escape($_POST['username'])."' AND password='".escape(md5($_POST['password']))."'");
        $creds = mysqli_fetch_array($creds);
        if($creds){
            $_SESSION['username'] = $creds['username'];
            $_SESSION['password'] = $creds['password'];
            $_SESSION['admin'] = 1;
            header("Location: ".$_SERVER['PHP_SELF']);
        }
      
      }

    }
    else{

  ?>

  <div align=center>
    <fieldset style=width:300;>
    <legend><b>Login</b></legend>
        <form action="<?php echo $_SERVER['PHP_SELF']."?action=login"; ?>" method="post">
            <br>
            Username/Email: <input type=text name=username required><br>
            Password: <input type=password name=password required><br>
            <br><input type=submit name="submit" value=Login><br>
        </form>
    </fieldset>
  </div>

  <?php

    }
}

?>