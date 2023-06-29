        //On prend la donnée grace à la value d'un input hidden
        let dateFin = document.getElementById('idDateFin').value;

        let countDownDate = new Date(dateFin).getTime();
        
        // On mets à jour le compte à rebours toutes les 1 secondes
        let x = setInterval(function() {
        
        // On demande l'heure et la date actuelles
        let now = new Date().getTime();
        
        /*On cherche à connaitre la valeur du temps qui s'ecoule entre le temps du
        timer et la date actuelle*/
        let distance = countDownDate - now;
        
        // on calcule le temps pour les jours, les heures et les secondes
        let days = Math.floor(distance / (1000 * 60 * 60 * 24));
        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);
        //let daysh= (days*24)+hours;
        // On affiche le résultat dans l'élément avec id="timerJs »
        document.getElementById("timerJs").innerHTML = days + " Jours, heures : <span class='spanTimer'>" + hours + "</span> : <span class='spanTimer'>" 
          + minutes + "</span> : <span class='spanTimer'>" + seconds + "</span>";
        
        //Si le timer est fini on affiche un texte
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("timerJs").innerHTML = "L'événement est en cour !";
          }
        }, 1000);

