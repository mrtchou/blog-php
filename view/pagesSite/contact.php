<?php require_once 'view/header.php'; ?>

<!-- FORMULAIRE DE CONTACT, FUNCTION email() EST APPELÉ DE Controller, QUI ELLE APPELLE LA FUNCTION PHP mail()
    probleme de xampp a regler avant soumission pour soutenance AAAAAAAAAAAAAAAAAA
-->
<h2>Formulaire pour me contacter</h2>
  <p>
      Vous pouvez me contactez via ce formulaire que vous voyez sur cette page.
      Ou bien si vous souhaitez, vous pouvez me joindre via les reseaux sociaux (liens en pied de page).
  </p>

<h5 class="text-center mt-5 mb-5 text-white">Formulaire de contact</h5>
<form id="form-contact" action="" method="post">
    <div class="form-row">
        <div class="form-group col-12 col-md-6">
            <label for="firstnameEmail" class="text-white">Votre prénom</label>
            <input type="text" class="form-control" name="firstnameEmail" id="firstnameEmail" placeholder="Prénom" required>
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="nameEmail" class="text-white">Votre nom</label>
            <input type="text" class="form-control" name="nameEmail" id="name" placeholder="Nom">
        </div>
    </div>
    <div class="form-group">
        <label for="emailSubject" class="text-white">Objet de votre message</label>
        <input type="text" class="form-control" name="emailSubject" id="emailSubject" placeholder="donnez un titre a votre message" required>
    </div>
    <div class="form-group">
        <label for="email" class="text-white">Votre adresse e-mail</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="votre adresse@mail.com" required>
    </div>
    <div class="form-group">
        <label for="emailContent" class="text-white mt-2">Votre message</label>
        <textarea class="form-control" name="emailContent" id="emailContent" rows="3" placeholder="Votre message" required></textarea>
    </div>
    <div class="form-check text-center mt-4">
        <input class="form-check-input" type="checkbox" name="checkboxRobot" id="checkboxRobot" required>
        <label class="form-check-label text-black" for="checkboxRobot">Je ne suis pas un Robot</label>
    </div>
    <div class="col-lg-12 text-center">
        <button type="submit" name="submitEmail" class="btn btn-primary mt-4 px-4">Envoyer</button>
    </div>
</form>

<?php require_once 'view/footer.php'; ?>
