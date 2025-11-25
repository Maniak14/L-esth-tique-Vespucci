# Instructions complètes pour Firestore

## 📋 Étapes à suivre

### Étape 1 : Vérifier que Firestore est activé

1. Allez sur https://console.firebase.google.com/project/vespucci-6b1be
2. Dans le menu de gauche, cliquez sur **"Firestore Database"**
3. Si vous voyez "Créer une base de données", cliquez dessus
4. Choisissez **"Commencer en mode test"** (vous pourrez changer les règles après)
5. Choisissez un emplacement (ex: `europe-west` ou celui le plus proche)
6. Cliquez sur **"Activer"**

### Étape 2 : Configurer les règles de sécurité

1. Dans Firestore Database, allez dans l'onglet **"Règles"** (en haut)
2. Remplacez les règles par :

```javascript
rules_version = '2';
service cloud.firestore {
  match /databases/{database}/documents {
    // Permettre la lecture et l'écriture pour tous (mode test)
    match /{document=**} {
      allow read, write: if true;
    }
  }
}
```

3. Cliquez sur **"Publier"**

⚠️ **Important** : Ces règles permettent à n'importe qui de lire et écrire. Pour un site en production, vous devriez implémenter une authentification Firebase.

### Étape 3 : Vérifier la configuration

1. Ouvrez le fichier `firebase-config.js`
2. Vérifiez que la configuration est correcte (elle devrait déjà l'être)
3. Le fichier ne doit **PAS** contenir de `databaseURL` (c'est pour Realtime Database, pas Firestore)

### Étape 4 : Tester

1. Ouvrez `admin.html` dans votre navigateur
2. Ouvrez la console du navigateur (F12)
3. Vérifiez qu'il n'y a pas d'erreurs Firebase
4. Modifiez une image dans l'admin (changez l'URL d'une image)
5. Ouvrez `index.html` dans un autre onglet ou navigateur
6. Les modifications devraient apparaître automatiquement

## 📊 Structure des données dans Firestore

Vos données seront organisées comme suit :

### Collection `images`
Chaque image est un document :
- Document ID : `julio`, `gallery1`, `hero1`, etc.
- Données : `{ url: "https://...", updatedAt: timestamp }`

### Collection `positions`
Chaque position est un document :
- Document ID : `julio`, `soren`, etc.
- Données : `{ position: "center 35%", updatedAt: timestamp }`

### Collection `data`
Contient plusieurs documents :
- `team_members` → `{ members: [...], updatedAt: timestamp }`
- `deleted_team_members` → `{ members: [...], updatedAt: timestamp }`
- `custom_gallery_images` → `{ images: [...], updatedAt: timestamp }`
- `femmes_images` → `{ images: [...], updatedAt: timestamp }`
- `hommes_images` → `{ images: [...], updatedAt: timestamp }`

## 🔍 Vérifier que ça fonctionne

1. Dans la console Firebase, allez dans **Firestore Database > Données**
2. Vous devriez voir les collections `images`, `positions`, et `data` apparaître quand vous modifiez quelque chose dans `admin.html`
3. Les documents seront créés automatiquement lors de la première sauvegarde

## ❌ Dépannage

### Erreur "Permission denied"
- Vérifiez que les règles de sécurité sont bien configurées (Étape 2)
- Assurez-vous d'avoir cliqué sur "Publier"

### Erreur "Firebase SDK non chargé"
- Vérifiez que vous avez une connexion internet
- Vérifiez que les scripts Firebase sont bien chargés dans les fichiers HTML

### Les modifications ne se synchronisent pas
- Ouvrez la console du navigateur (F12) et vérifiez les erreurs
- Vérifiez que Firestore est bien activé dans votre projet Firebase
- Vérifiez que les règles de sécurité permettent la lecture et l'écriture

## ✅ C'est tout !

Une fois ces étapes terminées, votre site utilisera Firestore pour synchroniser toutes les données entre tous les utilisateurs en temps réel.

