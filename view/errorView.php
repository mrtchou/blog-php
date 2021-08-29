<?php include 'view/header.php';
//PAGE POUR AFFICHER DIFFERENTS MESSAGE
// AFFICHE MESSAGE A SUCCES $successMessage (page a part? ou laisser dans page errorview?)
if (!empty($successMessage)) {
  echo "<br><br><br><br> " . $successMessage. '<br><br><br><br>';
}
// AFFICHE MESSAGE ERROR $errorMessage
if (!empty($errorMessage)) {
  echo "cette erreur a ete detecté : <br><br><br><br> " . $errorMessage. '<br><br><br><br>';
}
include 'view/footer.php'; ?>
