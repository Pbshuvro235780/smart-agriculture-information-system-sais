document.addEventListener("DOMContentLoaded", () => {
  let alerts = document.querySelectorAll(".alert");
  alerts.forEach(alert => {
    setTimeout(() => {
      alert.classList.add("fade");
    }, 3000);
  });
});
