function addWatchList() {
    console.log("piou");
    const watchlistIcon = document.querySelector('#watchlisticon');
    fetch(watchlistIcon.dataset.url)
        .then(function(response) {
            // console.log("youpi j'ai recu ma reponse");
            // console.log(response);
            return response.json();
        })
        .then(function(tableauAsso) {
            console.log(tableauAsso);
             if (tableauAsso.isWatched) {
                watchlistIcon.classList.remove('far'); // Remove the .far (empty heart) from classes in <i> element
                watchlistIcon.classList.add('fas'); // Add the .fas (full heart) from classes in <i> element
            } else {
                watchlistIcon.classList.remove('fas'); // Remove the .fas (full heart) from classes in <i> element
                watchlistIcon.classList.add('far'); // Add the .far (empty heart) from classes in <i> element
            }
        });
}


const bouton = document.querySelector('#watchlist');

bouton.addEventListener("click", addWatchList)

