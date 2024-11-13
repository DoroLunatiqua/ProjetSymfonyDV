import './bootstrap.js';

import './styles/app.css';

///// ADDEVENTLISTENER ET REQUETE AJAX

document.addEventListener('DOMContentLoaded', function () {
    // Sélectionner tous les boutons de suppression
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const exercicesContainer=document.getElementById('exercicesContainer');
    const patientId=exercicesContainer.dataset.patientid;
    console.log(exercicesContainer);
    console.log(patientId);
    const exercices = document.querySelectorAll('.exercices');
    
    // Ajouter un EventListener à chaque bouton
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            // alert('bloub');
            const exerciceElement = this.closest('.exercices'); // Trouve l'élément parent de l'exercice lié au bouton cliqué
            console.log(exerciceElement);
            const exerciceId = exerciceElement.id.split('-')[1];
            

            console.log(exerciceId);
           
            // Appel AJAX pour assigner l'exercice au patient
            fetch(`/exercice/attribuer/${patientId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ patient_id: patientId, exercice_id: exerciceId })  // Envoie l'ID du patient au serveur
            })
            .then(response => {
                console.log(response);
                // exercices.forEach(exercice=> {
                //     const exerciceId = exercice.id.split('-')[1];
                //     // console.log(exerciceId);
                    
                // })
                if (response.ok) {
                    // Si l'exercice a été assigné, retirer l'élément de la vue
                    const exercice=document.getElementById(`exercice-${exerciceId}`);
                    if (exercice) {
                        // exercice.remove(); // Supprimer l'exercice du DOM
                        window.location.href=`/exercice/attribuer/${patientId}/${exerciceId}`;
                    }
                } else {
                    console.error('Erreur lors de l\'assignation');
                }

                
            })
            .catch(error => {
                console.error('Erreur réseau', error);
            });
        });
    });
});
