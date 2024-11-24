document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("purchaseOrderForm");
  const notification = document.getElementById("notification");

  form.addEventListener("submit", (e) => {
    e.preventDefault();

    const formData = new FormData(form);
    const data = {};
    formData.forEach((value, key) => {
      data[key] = value;
    });

    // Simulate sending data to server
    console.log("Data submitted:", data);

    // Show success message
    notification.classList.remove("hidden");
    setTimeout(() => {
      notification.classList.add("hidden");
    }, 3000);

    // Optionally reset the form
    form.reset();
  });
});
