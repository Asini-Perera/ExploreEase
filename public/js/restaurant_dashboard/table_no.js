document.addEventListener("DOMContentLoaded", () => {
    const sendTableBtn = document.getElementById("sendTableBtn");
    const modal = document.getElementById("tableNoModal");
    const closeBtn = document.querySelector(".close-btn");
    const submitTableNo = document.getElementById("submitTableNo");
  
    // Show modal on button click
    sendTableBtn.addEventListener("click", () => {
      modal.style.display = "block";
    });
  
    // Close modal when "X" is clicked
    closeBtn.addEventListener("click", () => {
      modal.style.display = "none";
    });
  
    // Handle modal submit
    submitTableNo.addEventListener("click", () => {
      const tableNoInput = document.getElementById("tableNoInput").value;
  
      if (tableNoInput) {
        Email.send({
          SecureToken: "YOUR_SECURE_TOKEN", // Get this from SMTPJS
          To: "recipient@example.com",
          From: "your-email@example.com",
          Subject: "Table Number Confirmation",
          Body: `The table number entered is: ${tableNoInput}. Thank you!`,
        }).then((message) => {
          alert(message === "OK" ? "Email sent successfully!" : "Failed to send email.");
          modal.style.display = "none";
        });
      } else {
        alert("Please enter a table number!");
      }
    });
  
    // Close modal if clicking outside of the modal content
    window.addEventListener("click", (event) => {
      if (event.target === modal) {
        modal.style.display = "none";
      }
    });
  });
  