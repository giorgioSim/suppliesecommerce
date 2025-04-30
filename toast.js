function showToast(message, type = "success") {
  const toast = document.createElement("div");
  toast.className = `fixed top-5 right-5 bg-${type === "success" ? "green" : "red"}-500 text-white px-4 py-2 rounded shadow-md z-50 text-sm animate-fade`;
  toast.textContent = message;

  document.body.appendChild(toast);

  setTimeout(() => {
    toast.remove();
  }, 3000);
}
