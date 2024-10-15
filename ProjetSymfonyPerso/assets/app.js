import './bootstrap.js';

import './styles/app.css';

///// ADDEVENTLISTENER ET REQUETE AJAX

// document.addEventListener('DOMContentLoaded', function () {
//     // Sélectionner tous les boutons de suppression
//     const deleteButtons = document.querySelectorAll('.delete-btn');

//     // Ajouter un EventListener à chaque bouton
//     deleteButtons.forEach(button => {
//         button.addEventListener('click', function () {
//             // Récupérer l'ID de l'exercice et du patient
//             const exerciceId = this.getAttribute('data-exercice-id');
//             const patientId = this.getAttribute('data-patient-id');

//             // Appel AJAX pour assigner l'exercice au patient
//             fetch(`/exercice/${exerciceId}/assigner`, {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-Requested-With': 'XMLHttpRequest'
//                 },
//                 body: JSON.stringify({ patient_id: patientId })  // Envoie l'ID du patient au serveur
//             })
//             .then(response => {
//                 if (response.ok) {
//                     // Si l'exercice a été assigné, retirer l'élément de la vue
//                     const exerciceElement = document.getElementById(`exercice-${exerciceId}`);
//                     if (exerciceElement) {
//                         exerciceElement.remove(); // Supprimer l'exercice du DOM
//                     }
//                 } else {
//                     console.error('Erreur lors de l\'assignation');
//                 }
//             })
//             .catch(error => {
//                 console.error('Erreur réseau', error);
//             });
//         });
//     });
// });
