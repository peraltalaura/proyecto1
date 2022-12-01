<?php
// assign defaults
$error = array(
	'email' 	=> '',
	'firstname' => '',
	'lastname'  => '',
	'city'	    => '',
	'stateProv' => '',
	'country'	=> '',
	'postcode'  => '',
	'telephone' => '',
	'password'  => '',
	'imagen'    => ''
);

if (isset($_POST['submit'])) {

	include_once("funtzioak.php");
	$errores=false;
	$imagen=null;
	$user = array(
		'email'     => escape($_POST['email']),
		'firstname' => escape($_POST['firstname']),
		'lastname' 	=> escape($_POST['lastname']),
		'postcode' 	=> escape($_POST['postcode']),
		'city' 		=> escape($_POST['city']),
		'stateProv' => escape($_POST['stateProv']),
		'country'	=> escape($_POST['country']),
		'telephone' => escape($_POST['telephone']),
		'password' 	=> escape($_POST['password']),
		'password2' => escape($_POST['password2']),
		'imagen'    => escape($_FILES['imagen']['name'])
	  );

	$error = array(
		'email' 	=> '',
		'firstname' => '',
		'lastname'  => '',
		'city'	    => '',
		'stateProv' => '',
		'country'	=> '',
		'postcode'  => '',
		'telephone' => '',
		'password'  => '',
		'imagen'    => ''
	);

	if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $user['email'])){
		$error['email']="Email-a ez da zuzena izena@izena.com formatua izan behar du.";
		$errores=true;
	} elseif(userExists($user['email'])){
		$error['email']="Badago erabiltzaile bat mail honekin erregistratuta.";
		$errores=true;
	}

	if(!testuaDa($user['firstname'])){
		$error['firstname']= "Izenaren formatua gaizki dago.";
		$errores=true;
	}

	if(!testuaDa($user['lastname'])){
		$error['lastname']="Abizenaren formatua gaizki dago.";
		$errores=true;
	}

	if(!testuaDa($user['city'])){
		$error['city']="Hiriaren formatua gaizki dago.";
		$errores=true;
	}

	if(!testuaDa($user['stateProv'])){
		$error['stateProv']="Probintziaren formatua gaizki dago.";
		$errores=true;
	}

	if(!testuaDa($user['country'])){
		$error['country']="Nazioaren formatua gaizki dago.";
		$errores=true;
	}

	if(!preg_match("/^[0-9]{5}+$/",$user['postcode'])){
		$error['postcode']="Posta kodearen formatua gaizki dago 5 zenbaki izan behar dira.";
		$errores=true;
	}

	if(!preg_match("/^[0-9]{9}+$/",$user['telephone'])){
		$error['telephone']="Telefono zenbakiaren formatua gaizki dago 9 zenbaki izan behar dira.";
		$errores=true;
	}
	
	if($user['password']!=$user['password2']){
		$error['password']="Pasahitzak ez dira berdinak.";
		$errores=true;
	}

	if(!empty($user['imagen'])){
	
		if(irudiaDa($user['imagen'])){
			$user['imagen'] = basename($user['imagen']);
		} else {
			$error['imagen']="Igo duzun fitxategia irudi bat izan behar da .jpg edo .png";
			$errores=true;
		}
	}

	if(!$errores){

		$path = "perfiles/".basename($user['imagen']);
		move_uploaded_file($user['imagen'], $path);

		$sql = "INSERT INTO users(username, password, izena, abizena, hiria, lurraldea, herrialdea, postakodea, telefonoa, irudia) VALUES (";
		$sql .= "'" . $user['email'] . "', ";
		$sql .= "'" . md5($user['password'] ). "', ";
		$sql .= "'" . $user['firstname'] . "', ";
		$sql .= "'" . $user['lastname'] . "', ";
		$sql .= "'" . $user['city'] . "', ";
		$sql .= "'" . $user['stateProv'] . "', ";
		$sql .= "'" . $user['country'] . "', ";
		$sql .= "'" . $user['postcode'] . "', ";
		$sql .= "'" . $user['telephone'] . "', ";
		$sql .= "'" . $user['imagen']. "')";
		if (!mysqli_query($conx,"$sql"))
		{
			die('Error: ' . mysqli_error());
		}
		else {
			header("Location: index.php");
		}
	}
}
?>
	<div class="content">
	<br/>
	<div class="register">

		<h2>Erregistroa egin</h2>
		<br/>

		<b>Introduce la información.</b>
		<br/>
		<form action="<?php echo $_SERVER['PHP_SELF']."?action=register"; ?>" method="POST" enctype="multipart/form-data">
			<p>
				<label>Email/username: </label>
				<input type="email" name="email" placeholder="Email" value="<?php if(isset($user)){ echo $user['email']; }?>" required />
				<?php if ($error['email']) echo "<p style='color:red'>", $error['email']; ?>
			<p>
			<p>
				<label>Izena: </label>
				<input type="text" name="firstname" placeholder="Izena" value="<?php if(isset($user)){echo $user['firstname']; }?>" required />
				<?php if ($error['firstname']) echo "<p style='color:red'>", $error['firstname']; ?>
			<p>
			<p>
				<label>Abizena: </label>
				<input type="text" name="lastname" placeholder="Abizena" value="<?php if(isset($user)){ echo $user['lastname']; }?>" required/>
				<?php if ($error['lastname']) echo "<p style='color:red'>", $error['lastname']; ?>
			<p>
			<p>
				<label>Hiria: </label>
				<input type="text" name="city" placeholder="Hiria" value="<?php if(isset($user)){ echo $user['city']; }?>" required/>
				<?php if ($error['city']) echo "<p style='color:red'>", $error['city']; ?>
			<p>
			<p>
				<label>Lurraldea: </label> 
				<input type="text" name="stateProv" placeholder="Lurraldea" value="<?php if(isset($user)){ echo $user['stateProv']; }?>" required/>
				<?php if ($error['stateProv']) echo "<p style='color:red'>", $error['stateProv']; ?>
			<p>
			<!-- // *** validation: implement a database lookup -->
			<p>
				<label>Herrialdea: </label>
				<input type="text" name="country" placeholder="Herrialdea" value="<?php if(isset($user)){echo $user['country'];} ?>" required/>
				<?php if ($error['country']) echo "<p style='color:red'>", $error['country']; ?>
			<p>
			<p>
				<label>Postakodea: </label>
				<input type="text" name="postcode" placeholder="Posta kodea" value="<?php if(isset($user)){ echo $user['postcode'];} ?>" required/>
				<?php if ($error['postcode']) echo "<p style='color:red'>", $error['postcode']; ?>
			<p>
			<p>
				<label>Telefonoa: </label>
				<input type="tel" name="telephone" placeholder="Telefonoa" value="<?php if(isset($user)){ echo $user['telephone'];} ?>" required/>
				<?php if ($error['telephone']) echo "<p style='color:red'>", $error['telephone']; ?>
			<p>
			<p>
				<label>Pasahitza: </label>
				<input type="password" name="password" placeholder="Pasahitza" value="<?php if(isset($user)){ echo $user['password']; }?>" required/>
				<?php if ($error['password']) echo "<p style='color:red'>", $error['password']; ?>
			<p>
            <p>
                <label>Pasahitza errepikatu: </label>
                <input type="password" name="password2" placeholder="Pasahitza errepikatu" value="<?php if(isset($user)){ echo $user['password2'];} ?>" required/>
            <p>
            <p>
                <label>Irudia aukeratu:</label>
                <input name="imagen" accept="imagen\jpeg,imagen\png" type="file" value="<?php if(isset($user)){ echo $user['imagen'];} ?>" />
				<?php if ($error['imagen']) echo "<p style='color:red'>", $error['imagen']; ?>
            <p>
			<p>
				<input type="reset" name="clear" value="Clear" class="button"/>
				<input type="submit" name="submit" value="Submit" class="button marL10"/>
			<p>
		</form>
	</div>
</div>
