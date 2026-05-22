//  Règles
const REGLES = { 
  prenom: { regex: /^[A-Za-zÀ-ÿ\-' ]{2,50}$/, message: "Le prénom doit contenir entre 2 et 50 lettres (pas de chiffres).",},
  nom: { regex: /^[A-Za-zÀ-ÿ\-' ]{2,50}$/, message: "Le nom doit contenir entre 2 et 50 lettres (pas de chiffres).",},
  tel: { regex: /^(\+33|0033|0)[1-9](\s?\d{2}){4}$/, message: "Numéro de téléphone invalide. Exemples valides : 0612345678 ou +33612345678",},
  adresse: { regex: /^.{5,200}$/, message: "L'adresse doit contenir au moins 5 caractères.",},
  // Min 8 caractères, au moins 1 majuscule, 1 minuscule, 1 chiffre
  mdp: { regex: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/, message:"Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre.",},
};
//  Affiche ou efface un message d'erreur sous un champ donné. 
function setErreur(input, msg) {
  let span = input.parentNode.querySelector(".erreur-champ");
  // Creer une balise span juste en dessous de l'input
  if(!span){
    span = document.createElement("span");
    span.className = "erreur-champ";
  }
  // Insère le span juste après l'input
  input.insertAdjacentElement("afterend", span);
  // Affiche le message
  if (msg) {
    span.textContent = msg;
    span.style.display = "block";
    input.setAttribute("aria-invalid", "true");
    input.classList.add("input-invalide");
    input.classList.remove("input-valide");
  } else {
    span.textContent = "";
    span.style.display = "none";
    input.removeAttribute("aria-invalid");
    input.classList.remove("input-invalide");
    input.classList.add("input-valide");
  }
}
// Valide un seul champ <input> selon les REGLES. 
function validerChamp(input,regles) {
  const nom = input.name;
  const valeur = input.value.trim();
  // Champ vide
  if (valeur === "") {
    setErreur(input, "Ce champ est obligatoire.");
    return false;
  }
  // Règle spécifique au champ
  if (regles[nom]) {
    if (!regles[nom].regex.test(valeur)) {
      setErreur(input, regles[nom].message);
      return false;
    }
  }
  // Pas d'erreur
  setErreur(input, null); 
  return true;
}

// Validation
  //  Validation en temps réel
  function attacherValidationTempsReel(form,regles) {
    // Séléctionne tt les élément input[name] 
    const champs = form.querySelectorAll("input[name]");
    champs.forEach((champ) => {
      // Valide quand l'utilisateur quitte le champ
      champ.addEventListener("blur", () => validerChamp(champ,regles));
      // Efface l'erreur dès que l'utilisateur retape
      champ.addEventListener("input", () => {
        const span = champ.parentElement.querySelector(".erreur-champ");
        if (span) {
          span.textContent = "";
          // span.style.display = "none";
        }
        champ.classList.remove("input-invalide");
        champ.removeAttribute("aria-invalid");
      });
    });
  }
  // Validation quand on submit
    // Valide tous les champs d'un formulaire d'un coup.
  function validerFormulaire(form, regles) {
    const champs = form.querySelectorAll("input[name]");
    let estValide = true;

    champs.forEach((champ) => {
      if (!validerChamp(champ, regles)) {
        estValide = false;
      }
    });

    return estValide;
  }

// Initialisation   
  //  Initialisation — Connexion
  (function initConnexion() {
    const form = document.querySelector('form[action*="login.php"]');
    if (!form) return;
    const REGLES_CONNEXION = {
      tel: { regex: /^(\+33|0033|0)[1-9](\s?\d{2}){4}$/, message: "Téléphone invalide. Ex : 0612345678, +33612345678." },
    };
    attacherValidationTempsReel(form,REGLES_CONNEXION);
    form.addEventListener("submit", function (e) {
      // Bloque l'envoi systématiquement d'abord
      e.preventDefault(); 
      // Envoie uniquement si tout est valide
      if (validerFormulaire(form, REGLES_CONNEXION)) {
        form.submit();
      }
    });
  })();
  //  Initialisation — Inscription
    // Même chose que initConnexion() mais pour l'inscription
  (function initInscription() {
    const form = document.querySelector('form[action*="proce.php"]');
    if (!form) return;
    attacherValidationTempsReel(form, REGLES);
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      if (validerFormulaire(form, REGLES)) {
        form.submit();
      }
    });
  })();
  //  Initialisation — Notation
  (function initNotation() {
    const form = document.querySelector("form.rating-form");
    if (!form) return;
    // Crée (ou récupère) la zone de feedback inline sous le bouton Envoyer
    let feedback = form.querySelector(".erreur-notation");
    if (!feedback) {
      feedback = document.createElement("p");
      feedback.className = "erreur-notation erreur-champ";
      form.appendChild(feedback);
    }
    function validerNotation() {
      const groupes = ["plat", "livraison", "accessibilite"];
      const manquants = groupes.filter(
        (g) => !form.querySelector(`input[name="${g}"]:checked`)
      );
      if (manquants.length > 0) {
        const labels = { plat: "Plat", livraison: "Livraison", accessibilite: "Accessibilité" };
        const noms = manquants.map((g) => labels[g]).join(", ");
        feedback.textContent = `Veuillez attribuer une note pour : ${noms}.`;
        feedback.style.display = "block";
        return false;
      }
      feedback.textContent = "";
      feedback.style.display = "none";
      return true;
    }
    // Efface le message dès qu'un radio est coché
    form.querySelectorAll('input[type="radio"]').forEach((radio) => {
      radio.addEventListener("change", () => {
        feedback.textContent = "";
        feedback.style.display = "none";
      });
    });
    // Intercepte le clic sur le bouton Envoyer (qui appelle GET_Notations via onclick)
    // On surcharge GET_Notations pour y injecter la validation
    const GET_Notations_original = window.GET_Notations;
    window.GET_Notations = async function (event) {
      event.preventDefault();
      if (!validerNotation()) return; // Bloque si invalide
      await GET_Notations_original(event);
    };
  })();
  //  Initialisation — Profil
  (function initProfil() {
    // Le formulaire de profil est un div#form_profil, pas un <form>
    const formProfil = document.getElementById("form_profil");
    if (!formProfil) return;
    const REGLES_PROFIL = {
      intput_nom: { regex: /^[A-Za-zÀ-ÿ\-' ]{2,50}$/, message: "Le nom doit contenir entre 2 et 50 lettres." },
      intput_prenom: { regex: /^[A-Za-zÀ-ÿ\-' ]{2,50}$/, message: "Le prénom doit contenir entre 2 et 50 lettres." },
      intput_adresse: { regex: /^.{5,200}$/, message: "L'adresse doit contenir au moins 5 caractères." },
      intput_tel: { regex: /^(\+33|0033|0)[1-9](\s?\d{2}){4}$/, message: "Téléphone invalide. Ex : 0612345678, +33612345678." },
      intput_mdp: { regex: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/, message: "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre.",},
    };
    function setErreurProfil(id, msg) {
      const input = document.getElementById(id);
      if (!input) return;
      let span = input.parentElement.querySelector(".erreur-champ");
      if (!span) {
        span = document.createElement("span");
        span.className = "erreur-champ";
        input.insertAdjacentElement("afterend", span);
      }
      if (msg) {
        span.textContent = msg;
        span.style.display = "block";
        input.classList.add("input-invalide");
        input.classList.remove("input-valide");
      } else {
        span.textContent = "";
        span.style.display = "none";
        input.classList.remove("input-invalide");
        input.classList.add("input-valide");
      }
    }
    //Valide tous les champs du formulaire de profil.
    function validerProfil() {
      let estValide = true;
      Object.entries(REGLES_PROFIL).forEach(([id, regle]) => {
        const input = document.getElementById(id);
        if (!input) return;
        const valeur = input.value.trim();
        // L'adresse est facultative — on ne valide que si elle est remplie
        if (id === "intput_adresse" && valeur === "") {
          setErreurProfil(id, null);
          return;
        }
        if (id === "intput_mdp" && valeur === "") {
            setErreurProfil(id, null);
            return;
        }
        if (valeur === "") {
          setErreurProfil(id, "Ce champ est obligatoire.");
          estValide = false;
        } else if (!regle.regex.test(valeur)) {
          setErreurProfil(id, regle.message);
          estValide = false;
        } else {
          setErreurProfil(id, null);
        }
      });
      return estValide;
    }
    // Validation en temps réel sur chaque champ du profil
    Object.keys(REGLES_PROFIL).forEach((id) => {
      const input = document.getElementById(id);
      if (!input) return;
      input.addEventListener("blur",  () => validerProfil());
      input.addEventListener("input", () => setErreurProfil(id, null));
    });
    // Surcharge de sauvegarder() pour y injecter la validation
    const sauvegarder_original = window.sauvegarder;
    window.sauvegarder = async function () {
      // Bloque si invalide
      if (!validerProfil()) return;
      await sauvegarder_original();
    };
  })();
