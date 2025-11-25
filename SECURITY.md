# 🔒 Sécurité - Configuration

## ⚠️ IMPORTANT : Fichiers sensibles

Ce dépôt est public. Ne commitez **JAMAIS** les fichiers suivants qui contiennent des informations sensibles :

- `firebase-config.js` - Contient vos clés API Firebase
- `admin-login.html` - Contient le mot de passe admin

Ces fichiers sont dans `.gitignore` et ne seront pas commités.

## 📋 Configuration requise

### 1. Configuration Firebase

1. Copiez `firebase-config.example.js` en `firebase-config.js`
2. Remplacez les valeurs par votre configuration Firebase :
   ```javascript
   const firebaseConfig = {
     apiKey: "VOTRE_API_KEY",
     authDomain: "VOTRE_PROJECT_ID.firebaseapp.com",
     projectId: "VOTRE_PROJECT_ID",
     storageBucket: "VOTRE_PROJECT_ID.firebasestorage.app",
     messagingSenderId: "VOTRE_MESSAGING_SENDER_ID",
     appId: "VOTRE_APP_ID"
   };
   ```

### 2. Configuration Admin

1. Copiez `admin-login.example.html` en `admin-login.html`
2. Modifiez le mot de passe dans le fichier :
   ```javascript
   const ADMIN_PASSWORD = 'VOTRE_MOT_DE_PASSE_FORT';
   ```

## 🛡️ Bonnes pratiques de sécurité

1. **Mot de passe fort** : Utilisez un mot de passe complexe pour l'admin (minimum 12 caractères, majuscules, minuscules, chiffres, symboles)

2. **Firebase Rules** : Configurez des règles de sécurité strictes dans Firebase Firestore pour limiter l'accès

3. **Ne partagez jamais** :
   - Vos clés API Firebase
   - Le mot de passe admin
   - Les tokens d'authentification

4. **En production** : Pour plus de sécurité, utilisez Firebase Authentication au lieu d'un simple mot de passe

## 📝 Fichiers à ne jamais commiter

- ✅ `firebase-config.js` (déjà dans .gitignore)
- ✅ `admin-login.html` (déjà dans .gitignore)
- ❌ Ne commitez jamais ces fichiers même s'ils sont modifiés

## 🔍 Vérification

Avant de commiter, vérifiez que :
```bash
git status
```

Ne montre **PAS** `firebase-config.js` ou `admin-login.html` dans les fichiers modifiés.

