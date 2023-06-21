

        // Set the date we're counting down to
        var countDownDate = new Date("Jun 1, 2025 00:00:00").getTime();
        
        // Update the count down every 1 second
        var x = setInterval(function() {
        
        // Get today's date and time
        var now = new Date().getTime();
        
        // Find the distance between now and the count down date
        var distance = countDownDate - now;
        
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        //var daysh= (days*24)+hours;
        // Display the result in the element with id="timerJs"
        document.getElementById("timerJs").innerHTML = days + " Jours, heures : <span class='spanTimer'>" + hours + "</span> : <span class='spanTimer'>" 
          + minutes + "</span> : <span class='spanTimer'>" + seconds + "</span>";
        
        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("timerJs").innerHTML = "EXPIRED";
          }
        }, 1000);

