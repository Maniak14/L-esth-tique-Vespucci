# 🤝 Gestion des Partenaires

## Fonctionnalités ajoutées

Les administrateurs peuvent maintenant gérer les partenaires directement depuis la page d'administration.

## Comment utiliser

### Accès à la gestion des partenaires

1. Connectez-vous à la page d'administration : `admin-login.html`
2. Scrollez jusqu'à la section **"🤝 Gestion des Partenaires"**

### Ajouter un partenaire

1. Dans le formulaire d'ajout :
   - **Nom du partenaire** : Entrez le nom de l'entreprise
   - **URL de l'image** : Collez l'URL complète de l'image (doit commencer par `https://`)
   - **Badge** : Personnalisez le badge (par défaut : "Partenaire Officiel")

2. Cliquez sur **"➕ Ajouter le partenaire"**

3. Le partenaire apparaît immédiatement dans la liste

### Supprimer un partenaire

1. Trouvez le partenaire à supprimer dans la liste
2. Cliquez sur le bouton **"🗑️ Supprimer"**
3. Confirmez la suppression

### Affichage des partenaires

Les partenaires sont automatiquement affichés sur la page publique `partenaires.html`.

## Synchronisation Firebase

- Tous les changements sont **automatiquement sauvegardés** dans Firebase
- Les modifications sont **synchronisées en temps réel** entre tous les onglets ouverts
- Si aucun partenaire n'est trouvé, les 5 partenaires par défaut sont affichés :
  - Auto Exotic
  - LTD SandyShore
  - Hen House
  - Delight
  - Life Invader

## Structure des données

Chaque partenaire contient :
```json
{
  "id": "identifiant_unique",
  "name": "Nom du Partenaire",
  "image": "https://url-de-l-image.com/image.png",
  "badge": "Partenaire Officiel"
}
```

## Fichiers modifiés

1. **firebase-db.js** : Ajout des fonctions `savePartnersToFirebase()`, `loadPartnersFromFirebase()`, et `watchPartners()`
2. **admin.html** : Ajout de la section de gestion des partenaires avec formulaire d'ajout et liste
3. **partenaires.html** : Conversion de l'affichage statique en affichage dynamique depuis Firebase

## Support

En cas de problème, vérifiez que :
- Firebase est correctement configuré
- Vous êtes connecté en tant qu'administrateur
- L'URL de l'image commence bien par `https://` ou `http://`
