
for (item of listItems) {
  item.onclick = function (e) {
    span.innerText = e.target.innerText;
    if (e.target.innerText == "Everything") {
      input.placeholder = "Search Anything...";
    } else {
      input.placeholder = "Search in " + e.target.innerText + "...";
    }
  };
}
document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector(".search-bar"); // Sélectionne la barre de recherche
  const titleInput = form.querySelector('input[name="title"]');
  const locationInput = form.querySelector('input[name="location"]');
  const dateInput = form.querySelector('input[name="event_date"]');
  const eventCards = document.querySelectorAll(".event-card"); // Sélectionne toutes les cartes d'événements

  function filterEvents() {
      const titleFilter = titleInput.value.toLowerCase().trim();
      const locationFilter = locationInput.value.toLowerCase().trim();
      const dateFilter = dateInput.value;

      eventCards.forEach((card) => {
          const cardTitle = card.getAttribute("data-title").toLowerCase();
          const cardLocation = card.getAttribute("data-location").toLowerCase();
          const cardDate = card.getAttribute("data-date");

          const matchesTitle = cardTitle.includes(titleFilter);
          const matchesLocation = cardLocation.includes(locationFilter);
          const matchesDate = !dateFilter || cardDate.startsWith(dateFilter);

          // Affiche ou masque les cartes en fonction des filtres
          if (matchesTitle && matchesLocation && matchesDate) {
              card.style.display = "block";
          } else {
              card.style.display = "none";
          }
      });
  }

  // Ajoute un événement "input" pour filtrer dynamiquement lorsque l'utilisateur saisit des données
  titleInput.addEventListener("input", filterEvents);
  locationInput.addEventListener("input", filterEvents);
  dateInput.addEventListener("change", filterEvents); // Utilise "change" pour les champs de date
});

