// Potvrzení před smazáním produktu
document.addEventListener('DOMContentLoaded', function () {
  const deleteButtons = document.querySelectorAll('a.btn-danger');

  deleteButtons.forEach(function (button) {
    button.addEventListener('click', function (event) {
      const confirmed = confirm('Opravdu chcete smazat tento produkt?');
      if (!confirmed) {
        event.preventDefault();
      }
    });
  });
});
