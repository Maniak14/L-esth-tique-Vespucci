# 🔒 Sécurité - Instructions

## ⚠️ Fichiers sensibles

Les fichiers suivants contiennent des informations sensibles et sont **ignorés par Git** :

- `firebase-config.js` - Clés API Firebase
- `admin-login.html` - Mot de passe admin

## 📋 Première installation

### 1. Configuration Firebase

```bash
# Copier le fichier d'exemple
cp firebase-config.example.js firebase-config.js

# Éditer avec vos propres clés Firebase
# (Ouvrez firebase-config.js et remplacez les valeurs)
```

### 2. Configuration Admin

```bash
# Copier le fichier d'exemple
cp admin-login.example.html admin-login.html

# Éditer et changer le mot de passe
# (Ouvrez admin-login.html et modifiez ADMIN_PASSWORD)
```

## ✅ Vérification avant commit

Avant de commiter, vérifiez que les fichiers sensibles ne sont pas inclus :

```bash
git status
```

Si vous voyez `firebase-config.js` ou `admin-login.html`, **NE COMMITEZ PAS** !

Pour les retirer de Git (si déjà commités) :
```bash
git rm --cached firebase-config.js
git rm --cached admin-login.html
```

## 🛡️ Bonnes pratiques

1. **Ne jamais** commiter les fichiers sensibles
2. **Toujours** utiliser les fichiers `.example` comme modèles
3. **Changer** le mot de passe par défaut
4. **Configurer** les règles Firebase correctement

