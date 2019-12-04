function postData($pseudo, $msg)
{
if (trim($pseudo)  && trim($msg) ) {
echo '<br /> --> postData<br />';
$bdd = connextionBdd('postData');
$new_msg = $bdd->prepare("INSERT INTO minichat(pseudo, msg) VALUES(:pseudo,:msg)");
$new_msg->execute(
array(
'pseudo' => nl2br(htmlspecialchars($pseudo))
, 'msg' => nl2br(htmlspecialchars($msg))
)
);
$new_msg->closeCursor();
$msg = "";
header("Location: index.php?pseudo=$pseudo");
return true;
}
return false;

}