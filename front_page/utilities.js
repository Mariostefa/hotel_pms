function roomForm(event) {
  event.preventDefault();
  var formData = new FormData(event.target);
  var data = formData.get("room-choosed");
  document.cookie = "room=" + data;
  data = formData.get("initial-date");
  document.cookie = "initial-date=" + data;
  data = formData.get("final-date");
  document.cookie = "final-date=" + data;
  openModal();
}

function serviceForm(event) {
  event.preventDefault();
  var formData = new FormData(event.target);
  var data = formData.get("service-selected");
  document.cookie = "service=" + data;
  data = formData.get("service-date-time");
  document.cookie = "date-and-time=" + data;
  openModal();
}

function openModal() {
  const modal = document.querySelector("#customer-modal");
  modal.showModal();
}

function closeModal() {
  const modal = document.querySelector("customer-modal");
  const form = document.getElementById("customer-form");
  form.reset();
  modal.close();
}

function togglePaymentArea() {
  var paymentMethod = document.getElementById("payment-method");
  var paymentSection = document.getElementById("payment-section");
  console.log(paymentMethod.value);

  if (paymentMethod.value == "CARD") {
    paymentSection.classList.remove("hidden");
  } else {
    paymentSection.classList.add("hidden");
  }
}
