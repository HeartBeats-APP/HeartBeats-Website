// Code JavaScript pour la validation du formulaire d'inscription
document.getElementById("register-form").addEventListener("submit", function(e) {
    e.preventDefault();
    
    // Récupérer les valeurs des champs de formulaire
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const passwordConfirm = document.getElementById("password-confirm").value;
    
    // Valider les données du formulaire
    if (!name || !email || !password || !passwordConfirm) {
      // Afficher une erreur si les champs sont vides
      return alert("Tous les champs sont requis.");
    }
    
    if (password !== passwordConfirm) {
      // Afficher une erreur si les mots de passe ne correspondent pas
      return alert("Les mots de passe ne correspondent pas.");
    }
    
    // Envoyer les données de formulaire au serveur pour l'enregistrement
    // ...
  });
  