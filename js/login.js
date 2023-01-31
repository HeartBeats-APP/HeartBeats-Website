// Code JavaScript pour la validation du formulaire de connexion
document.getElementById("login-form").addEventListener("submit", function(e) {
    e.preventDefault();
    
    // Récupérer les valeurs des champs de formualaire
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    
    // Valider les données du formulaire
    if (!email || !password) {
      // Afficher une erreur si les champs sont vides
      return alert("Tous les champs sont requis.");
    }
    
    // Envoyer les données de formulaire au serveur pour la vérification
    // ...
  });
  