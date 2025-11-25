// Firebase Configuration
// IMPORTANT: Copiez ce fichier en firebase-config.js et remplissez vos propres valeurs
// Pour obtenir votre configuration :
// 1. Allez sur https://console.firebase.google.com/
// 2. Créez un nouveau projet (ou utilisez un projet existant)
// 3. Allez dans Project Settings > General > Your apps
// 4. Ajoutez une app Web si nécessaire
// 5. Copiez les valeurs de configuration ci-dessous

const firebaseConfig = {
  apiKey: "YOUR_API_KEY",
  authDomain: "YOUR_PROJECT_ID.firebaseapp.com",
  projectId: "YOUR_PROJECT_ID",
  storageBucket: "YOUR_PROJECT_ID.firebasestorage.app",
  messagingSenderId: "YOUR_MESSAGING_SENDER_ID",
  appId: "YOUR_APP_ID"
};

// Initialiser Firebase
let firebaseApp;
let firebaseFirestore;

function initFirebase() {
  try {
    if (typeof firebase !== 'undefined' && firebase.apps.length === 0) {
      firebaseApp = firebase.initializeApp(firebaseConfig);
      firebaseFirestore = firebase.firestore();
      return true;
    } else if (typeof firebase !== 'undefined' && firebase.apps.length > 0) {
      firebaseApp = firebase.app();
      firebaseFirestore = firebase.firestore();
      return true;
    }
    return false;
  } catch (error) {
    console.error('Erreur d\'initialisation Firebase:', error);
    return false;
  }
}

