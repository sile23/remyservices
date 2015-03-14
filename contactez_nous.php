<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>R&eacute;my Services</title>
<link rel="stylesheet" type="text/css" href="style.css" /> 
</head><body>
	<div id="corps_site">
    	<div id="banniere"><table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><ul class="menu-vertical">
    <li class="mv-item"><a href="index.html">Accueil</a></li>
    <li class="mv-item"><a href="a_propos.html">A propos</a></li>
    <li class="mv-item"><a href="nos_realisations.html">Nos r&eacute;alisations</a></li>
    <li class="mv-item"><a href="contactez_nous.php">Contactez-nous</a></li>

</ul></td>
    <td><img src="images/banniere.png" width="540" height="110" /></td>
  </tr>
</table>
</div>
		
        <div id="contenu">
<section id="main" role="main">
<h1>Contactez-nous</h1>

<p>Pour toutes demandes, t&eacute;l&eacute;phonez-moi ou &eacute;crivez-moi pour que nous puissions discuter ensemble de votre projet et d&eacute;terminer un premier rendez-vous et l'&eacute;tablissement d'un devis.</p>
<h2>Coordonn&eacute;es</h2>
<p>06 79 22 13 05  //  contact@remyservices.fr<br>Le perrier<br>
  61400 Mauves sur huisne</p>
<br><?php

$destinataire = 'contact@remyservices.fr';
$copie = 'oui';
$form_action = 'contactez_nous.php';
$message_envoye = "Votre message nous est bien parvenu !";
$message_non_envoye = "L'envoi du mail a &eacute;chou&eacute;, veuillez r&eacute;essayer SVP.";
$message_formulaire_invalide = "V&eacute;rifiez que tous les champs soient bien remplis et que l'email soit sans erreur.";

function text($text)
{
	$text = htmlspecialchars(trim($text), ENT_QUOTES);
	if (1 === get_magic_quotes_gpc())
	{
		$text = stripslashes($text);
	}
	
	$text = nl2br($text);
	return $text;
	
}

function IsEmail($email)
{
	$value = preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
	return (($value === 0) || ($value === false)) ? false : true;
}
 
$nom     = (isset($_POST['nom']))     ? text($_POST['nom'])     : '';
$email   = (isset($_POST['email']))   ? text($_POST['email'])   : '';
$objet   = (isset($_POST['objet']))   ? text($_POST['objet'])   : '';
$message = (isset($_POST['message'])) ? text($_POST['message']) : '';
 
$email = (IsEmail($email)) ? $email : '';
$err_formulaire = false; 
 
if (isset($_POST['envoi']))
{
	if (($nom != '') && ($email != '') && ($objet != '') && ($message != ''))
	{
		$headers  = 'From:'.$nom.' <'.$email.'>' . "\r\n";
		if ($copie == 'oui')
		{
			$cible = $destinataire.','.$email;
		}
		else
		{
			$cible = $destinataire;
		};
 
		$message = str_replace("&#039;","'",$message);
		$message = str_replace("&#8217;","'",$message);
		$message = str_replace("&quot;",'"',$message);
		$message = str_replace('&lt;br&gt;','',$message);
		$message = str_replace('&lt;br /&gt;','',$message);
		$message = str_replace("&lt;","&lt;",$message);
		$message = str_replace("&gt;","&gt;",$message);
		$message = str_replace("&amp;","&",$message);
 
		if (mail($cible, $objet, $message, $headers))
		{
			echo '<p>'.$message_envoye.'</p>';
		}
		else
		{
			echo '<p>'.$message_non_envoye.'</p>';
		};
	}
	else
	{
		echo '<p>'.$message_formulaire_invalide.'</p>';
		$err_formulaire = true;
	};
}; 
 
if (($err_formulaire) || (!isset($_POST['envoi'])))
{
	echo '
	<form id="contact" method="post" action="'.$form_action.'">
	<fieldset><legend>Vos coordonnées</legend>
		<p><label for="nom">Nom :</label><input type="text" id="nom" name="nom"  placeholder="Votre nom" value="'.stripslashes($nom).'" tabindex="1" /></p>
		<p><label for="email">Email :</label><input type="text" id="email" name="email"  placeholder="Votre email" value="'.stripslashes($email).'" tabindex="2" /></p>
	</fieldset>
 
	<fieldset><legend>Votre message :</legend>
		<p><label for="objet">Objet :</label><input type="text" id="objet" name="objet"  placeholder="Objet" value="'.stripslashes($objet).'" tabindex="3" /></p>
		<p><label for="message">Message :</label><textarea id="message" name="message" tabindex="4" cols="30" rows="8">'.stripslashes($message).'</textarea></p>
	</fieldset>
 
	<div style="text-align:center;"><input type="submit" name="envoi" value="Envoyer" /></div>
	</form>';
};
?></section>

</div>







        <div id="pied_de_page"><footer>REMY SERVICES R&eacute;my Galicher, Entreprise enregistr&eacute; au RCS <a href="https://www.infogreffe.fr/societes/entreprise-societe/407557438-galicher-remy-40755743800022.html">(i)</a>, Réalisation originale "Web vitrine" par <a href="http://galicher.fr" target="_blank">Galicher.fr</a>, Integrated script Juizy slideshow by Geoffrey Crofte.</footer></div>
    </div>

</body>
</html>