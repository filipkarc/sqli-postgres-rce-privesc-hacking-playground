<html><head><title>SQL Injection Training App</title><style>body {margin: 90px; background-color: #e0e0e0; background-repeat: no-repeat; background-image: url('static/bg.jpg');}</style></head><body>
<h1 style="font-size: 38px; margin-bottom: 40px;">SQL Injection Training App</h1>
<?php 

$dbhost = 'localhost';
$dbname = 'devdb';
$dbuser = 'devuser';
$dbpass = 'devpass';

$form = '
<form action="/" method="post" autocomplete="off">
<input name="username" style="border: 2px solid #C21010; padding: 16px; font-size: 17px; border-radius: 10px; margin-bottom: 25px;" value="" required><br>
<input name="password" type="password" style="border: 2px solid #C21010; padding: 16px; font-size: 17px; border-radius: 10px; margin-bottom: 25px;" value="" required> <br>
<br>
<input type="submit" value="Log In" style="border: 0px; padding: 7px 24px; font-size: 17px; font-weight: bold; color: #C21010;">
</form>
';

$footer = '
<br><p style="margin-top: 40px;">
Follow me: <a href="https://www.linkedin.com/in/filip-karczewski/" target="_blank" style="color: #C21010">LinkedIn</a>&nbsp;&nbsp;
<a href="https://twitter.com/FilipKarc"  target="_blank" style="color: #C21010">Twitter</a>
';


$dbconn = pg_connect("host=$dbhost dbname=$dbname user=$dbuser password=$dbpass") or die('Could not connect: '.pg_last_error());
$query = "SELECT password FROM accounts WHERE username = '".$_POST['username']."'";
$result = pg_query($query) or die('Error message: ' . pg_last_error());

if (pg_num_rows($result) > 0)
{
    while ($row = pg_fetch_row($result)) {
	if ($_POST['password'] == $row[0]) {
         echo "Welcome admin :) Good to see you.<br>&nbsp;<br><img src='static/cake.gif'><br>&nbsp;<br>&nbsp;<br>";
         echo $footer;
	}
        else { echo $form; echo $footer; }
    }
}
else { echo $form; echo $footer; }

pg_free_result($result);
pg_close($dbconn);

?>
