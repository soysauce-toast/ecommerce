function updatePriceDisplay(value) {
  document.getElementById("priceDisplay").innerText = "Minimum Rp " + new Intl.NumberFormat("id-ID").format(value);
}
