# Configuration Firestore

Votre site utilise maintenant **Cloud Firestore** pour synchroniser les données.

## Structure des données dans Firestore

Les données sont organisées en collections et documents :

```
firestore/
├── images/ (collection)
│   ├── julio (document) → { url: "...", updatedAt: timestamp }
│   ├── gallery1 (document) → { url: "...", updatedAt: timestamp }
│   └── ...
├── positions/ (collection)
│   ├── julio (document) → { position: "center 35%", updatedAt: timestamp }
│   └── ...
└── data/ (collection)
    ├── team_members (document) → { members: [...], updatedAt: timestamp }
    ├── deleted_team_members (document) → { members: [...], updatedAt: timestamp }
    ├── custom_gallery_images (document) → { images: [...], updatedAt: timestamp }
    ├── femmes_images (document) → { images: [...], updatedAt: timestamp }
    └── hommes_images (document) → { images: [...], updatedAt: timestamp }
```

## Configuration des règles de sécurité

Dans votre console Firebase, allez dans **Firestore Database > Règles** et configurez :

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

⚠️ **Note de sécurité** : Ces règles permettent à n'importe qui de lire et écrire. Pour un site en production, vous devriez implémenter une authentification Firebase.

## Tester

1. Ouvrez `admin.html` dans votre navigateur
2. Ouvrez la console (F12) pour voir s'il y a des erreurs
3. Modifiez une image dans l'admin
4. Ouvrez `index.html` dans un autre onglet
5. Les modifications devraient apparaître automatiquement

## Avantages de Firestore

- ✅ Structure organisée en collections/documents
- ✅ Requêtes plus puissantes
- ✅ Meilleure scalabilité
- ✅ Timestamps automatiques
- ✅ Synchronisation en temps réel

