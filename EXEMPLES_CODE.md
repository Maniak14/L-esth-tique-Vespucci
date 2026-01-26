# 💻 Exemples de Code - Système Toast & Modal

## 🎯 Comment utiliser les nouvelles fonctionnalités

### 1. 📢 Afficher une notification Toast

#### Succès
```javascript
showToast('success', 'Bravo !', 'L\'opération a réussi');
```

#### Erreur
```javascript
showToast('error', 'Oups !', 'Une erreur est survenue');
```

#### Avertissement
```javascript
showToast('warning', 'Attention', 'Veuillez remplir tous les champs');
```

#### Information
```javascript
showToast('info', 'Information', 'Voici une information utile');
```

### 2. ❓ Demander une confirmation

```javascript
showConfirm(
  'Supprimer l\'élément',
  'Êtes-vous sûr de vouloir supprimer cet élément ?',
  () => {
    // Code à exécuter si l'utilisateur confirme
    console.log('Utilisateur a confirmé');
    deleteItem();
  }
);
```

### 3. 🎨 Créer un toast personnalisé

#### Avec fermeture automatique rapide (2s)
```javascript
function showQuickToast(message) {
  const container = document.getElementById('toastContainer');
  const toast = document.createElement('div');
  toast.className = 'toast info';
  
  toast.innerHTML = `
    <span class="toast-icon">⚡</span>
    <div class="toast-content">
      <div class="toast-title">${message}</div>
    </div>
  `;
  
  container.appendChild(toast);
  
  setTimeout(() => {
    toast.classList.add('removing');
    setTimeout(() => toast.remove(), 300);
  }, 2000); // 2 secondes au lieu de 5
}

// Utilisation
showQuickToast('Sauvegarde rapide !');
```

#### Avec action personnalisée
```javascript
function showActionToast(message, actionText, actionCallback) {
  const container = document.getElementById('toastContainer');
  const toast = document.createElement('div');
  toast.className = 'toast info';
  
  toast.innerHTML = `
    <span class="toast-icon">ℹ️</span>
    <div class="toast-content">
      <div class="toast-title">${message}</div>
    </div>
    <button onclick="${actionCallback}" style="background: var(--primary); color: white; border: none; padding: 0.5rem 1rem; border-radius: 5px; cursor: pointer; margin-left: 1rem;">
      ${actionText}
    </button>
    <button class="toast-close" onclick="this.parentElement.remove()">×</button>
  `;
  
  container.appendChild(toast);
}

// Utilisation
showActionToast('Nouveau message reçu', 'Voir', 'openMessage()');
```

### 4. 🎭 Créer une modal personnalisée

```javascript
function showCustomModal(title, content, buttons) {
  const modal = document.createElement('div');
  modal.className = 'confirm-modal active';
  
  let buttonsHtml = '';
  buttons.forEach(btn => {
    const btnClass = btn.type === 'danger' ? 'confirm-btn-confirm' : 'confirm-btn-cancel';
    buttonsHtml += `
      <button class="confirm-btn ${btnClass}" onclick="${btn.action}; this.closest('.confirm-modal').remove()">
        ${btn.text}
      </button>
    `;
  });
  
  modal.innerHTML = `
    <div class="confirm-modal-content">
      <div class="confirm-modal-header">
        <span class="confirm-modal-icon">💬</span>
        <h3 class="confirm-modal-title">${title}</h3>
      </div>
      <div class="confirm-modal-message">${content}</div>
      <div class="confirm-modal-actions">
        ${buttonsHtml}
      </div>
    </div>
  `;
  
  document.body.appendChild(modal);
}

// Utilisation
showCustomModal(
  'Choisir une action',
  'Que voulez-vous faire ?',
  [
    { text: 'Annuler', type: 'cancel', action: '' },
    { text: 'Éditer', type: 'normal', action: 'editItem()' },
    { text: 'Supprimer', type: 'danger', action: 'deleteItem()' }
  ]
);
```

### 5. 🎨 Styles CSS réutilisables

#### Toast avec icône personnalisée
```css
.toast.custom {
  --toast-color: #8b5cf6; /* Violet */
}

.toast.custom .toast-icon {
  font-size: 2rem;
}
```

```javascript
const toast = document.createElement('div');
toast.className = 'toast custom';
// ... reste du code
```

#### Modal avec animation différente
```css
@keyframes modalFadeIn {
  from {
    opacity: 0;
    transform: scale(0.9);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

.confirm-modal.active .confirm-modal-content {
  animation: modalFadeIn 0.3s ease;
}
```

### 6. 🔧 Utilitaires pratiques

#### Validator helper
```javascript
function validateForm(fields) {
  for (const field of fields) {
    const input = document.getElementById(field.id);
    const value = input.value.trim();
    
    if (field.required && !value) {
      showToast('warning', 'Champ requis', field.message);
      input.focus();
      return false;
    }
    
    if (field.pattern && !field.pattern.test(value)) {
      showToast('error', 'Format invalide', field.message);
      input.focus();
      return false;
    }
  }
  return true;
}

// Utilisation
const isValid = validateForm([
  { 
    id: 'email', 
    required: true, 
    pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/, 
    message: 'Veuillez entrer un email valide' 
  },
  { 
    id: 'name', 
    required: true, 
    message: 'Le nom est requis' 
  }
]);

if (isValid) {
  // Soumettre le formulaire
  showToast('success', 'Succès', 'Formulaire validé !');
}
```

#### Loading toast
```javascript
function showLoadingToast(message) {
  const container = document.getElementById('toastContainer');
  const toast = document.createElement('div');
  toast.className = 'toast info';
  toast.id = 'loadingToast';
  
  toast.innerHTML = `
    <span class="toast-icon">⏳</span>
    <div class="toast-content">
      <div class="toast-title">${message}</div>
    </div>
  `;
  
  container.appendChild(toast);
  return toast;
}

function hideLoadingToast() {
  const toast = document.getElementById('loadingToast');
  if (toast) {
    toast.classList.add('removing');
    setTimeout(() => toast.remove(), 300);
  }
}

// Utilisation
const loading = showLoadingToast('Chargement en cours...');

// Simuler un chargement async
setTimeout(() => {
  hideLoadingToast();
  showToast('success', 'Terminé', 'Chargement réussi !');
}, 2000);
```

#### Progress toast
```javascript
function showProgressToast(message, current, total) {
  const container = document.getElementById('toastContainer');
  let toast = document.getElementById('progressToast');
  
  if (!toast) {
    toast = document.createElement('div');
    toast.className = 'toast info';
    toast.id = 'progressToast';
    container.appendChild(toast);
  }
  
  const percentage = Math.round((current / total) * 100);
  
  toast.innerHTML = `
    <span class="toast-icon">📊</span>
    <div class="toast-content">
      <div class="toast-title">${message}</div>
      <div class="toast-message">${current} / ${total} (${percentage}%)</div>
      <div style="width: 100%; height: 4px; background: var(--bg-dark); border-radius: 2px; margin-top: 0.5rem; overflow: hidden;">
        <div style="width: ${percentage}%; height: 100%; background: var(--primary); transition: width 0.3s ease;"></div>
      </div>
    </div>
  `;
  
  if (current >= total) {
    setTimeout(() => {
      toast.classList.add('removing');
      setTimeout(() => toast.remove(), 300);
    }, 1000);
  }
}

// Utilisation
let uploaded = 0;
const total = 10;

const interval = setInterval(() => {
  uploaded++;
  showProgressToast('Upload en cours', uploaded, total);
  
  if (uploaded >= total) {
    clearInterval(interval);
    showToast('success', 'Upload terminé', 'Tous les fichiers ont été uploadés !');
  }
}, 500);
```

### 7. 🎯 Intégration avec formulaires

#### Validation en temps réel
```javascript
function setupRealtimeValidation(inputId, validationRules) {
  const input = document.getElementById(inputId);
  
  input.addEventListener('blur', () => {
    const value = input.value.trim();
    
    for (const rule of validationRules) {
      if (rule.required && !value) {
        input.style.borderColor = '#ef4444';
        showToast('warning', 'Attention', rule.message);
        return;
      }
      
      if (rule.pattern && !rule.pattern.test(value)) {
        input.style.borderColor = '#ef4444';
        showToast('error', 'Erreur', rule.message);
        return;
      }
    }
    
    input.style.borderColor = '#10b981';
  });
  
  input.addEventListener('focus', () => {
    input.style.borderColor = 'var(--border)';
  });
}

// Utilisation
setupRealtimeValidation('partnerImage', [
  { 
    required: true, 
    message: 'L\'URL est requise' 
  },
  { 
    pattern: /^https?:\/\/.+/, 
    message: 'L\'URL doit commencer par http:// ou https://' 
  }
]);
```

### 8. 🚀 Exemples avancés

#### Multi-step process avec toasts
```javascript
async function multiStepProcess() {
  // Étape 1
  showToast('info', 'Étape 1/3', 'Validation des données...');
  await sleep(1000);
  
  // Étape 2
  showToast('info', 'Étape 2/3', 'Sauvegarde en cours...');
  await sleep(1000);
  
  // Étape 3
  showToast('info', 'Étape 3/3', 'Synchronisation Firebase...');
  await sleep(1000);
  
  // Terminé
  showToast('success', 'Terminé !', 'Toutes les étapes sont complètes');
}

function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}
```

#### Confirmation avec timer
```javascript
function showTimedConfirm(title, message, timeoutSeconds, onConfirm, onCancel) {
  const modal = document.getElementById('confirmModal');
  const modalTitle = document.getElementById('confirmModalTitle');
  const modalMessage = document.getElementById('confirmModalMessage');
  const confirmBtn = document.getElementById('confirmModalConfirm');
  
  let timeLeft = timeoutSeconds;
  
  const updateText = () => {
    confirmBtn.textContent = `Confirmer (${timeLeft}s)`;
    if (timeLeft > 0) {
      timeLeft--;
      setTimeout(updateText, 1000);
    } else {
      modal.classList.remove('active');
      if (onCancel) onCancel();
      showToast('info', 'Temps écoulé', 'Action annulée automatiquement');
    }
  };
  
  modalTitle.textContent = title;
  modalMessage.textContent = message;
  confirmCallback = onConfirm;
  
  modal.classList.add('active');
  updateText();
}

// Utilisation
showTimedConfirm(
  'Confirmation requise',
  'Cette action expirera dans 10 secondes',
  10,
  () => {
    showToast('success', 'Confirmé', 'Action exécutée à temps');
  },
  () => {
    console.log('Utilisateur n\'a pas confirmé à temps');
  }
);
```

## 📚 Documentation API

### showToast(type, title, message)
| Paramètre | Type | Description |
|-----------|------|-------------|
| type | string | 'success', 'error', 'warning', 'info' |
| title | string | Titre du toast |
| message | string | Message (optionnel) |

### showConfirm(title, message, onConfirm)
| Paramètre | Type | Description |
|-----------|------|-------------|
| title | string | Titre de la modal |
| message | string | Message de confirmation |
| onConfirm | function | Callback si confirmé |

### Retour
Aucun retour. Les fonctions manipulent directement le DOM.

---

**Documentation technique** - Version 2.0
**Date** : 26 janvier 2026
