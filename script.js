const chatMessages = document.querySelector(".chat-messages");
const chatInput = document.querySelector(".chat-input input[type='text']");
const chatButton = document.querySelector(".chat-input button");

function sendMessage() {
  const message = chatInput.value;
  if (message.trim() === "") {
    return;
  }
  const timestamp = new Date().toLocaleTimeString();
const html = `<p><strong>You:</strong> ${message} <span>${timestamp}</span></p>`;
chatMessages.insertAdjacentHTML("beforeend", html);
chatInput.value = "";
}

chatButton.addEventListener("click", sendMessage);
chatInput.addEventListener("keydown", (event) => {
if (event.key === "Enter") {
sendMessage();
}
});
