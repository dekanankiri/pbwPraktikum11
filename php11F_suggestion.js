function showHint(str) {
    // Clear suggestions if input is empty
    if (str.length === 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    }

    // Create XMLHttpRequest object
    const xhttp = new XMLHttpRequest();
    
    // Setup callback for when response is received
    xhttp.onload = function() {
        if (this.status === 200) {
            try {
                const response = JSON.parse(this.responseText);
                let suggestions = '';
                
                if (response && response.length > 0) {
                    suggestions = response.map(item => item.name).join(', ');
                } else {
                    suggestions = 'No suggestions found';
                }
                
                document.getElementById("txtHint").innerHTML = suggestions;
            } catch (e) {
                console.error('Error parsing response:', e);
                document.getElementById("txtHint").innerHTML = 'Error loading suggestions';
            }
        } else {
            document.getElementById("txtHint").innerHTML = 'Error loading suggestions';
        }
    };

    // Setup callback for network errors
    xhttp.onerror = function() {
        document.getElementById("txtHint").innerHTML = 'Network error occurred';
    };

    // Send request
    xhttp.open("GET", "php11F_gethint.php?keyword=" + encodeURIComponent(str), true);
    xhttp.send();
}
