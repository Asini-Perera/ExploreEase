
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="public/css/contactus.css?v=1"> 
    <link rel="stylesheet" href="public/css/logedFooter.css?v=1">
    
    
    
</head>
<body>
     
    <main>
        
        <section class="contact_us" id="contact">
  <!-- Google Maps Location -->
  <div class="map-container">
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.902976812423!2d79.86115290000001!3d6.9022055!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25963120b1509%3A0x2db2c18a68712863!2sUniversity%20of%20Colombo%20School%20of%20Computing%20(UCSC)!5e0!3m2!1sen!2slk!4v1745447399839!5m2!1sen!2slk" 
      width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy">
    </iframe>
  </div>

  <!-- Contact Heading -->
  <div class="contact-heading">
    <h2>Contact ExploreEase</h2>
    <p>We’re here to help! Whether you’re a traveler looking for your next adventure or a service provider ready to collaborate, get in touch with us today.</p>
  </div>

  <!-- Contact Info -->
  <div class="contact">
    <div class="contact-info">
      <img class="contact_img" alt="Location" src="public/images/location.png">
      <h3>Our Office</h3>
      <p>456 Explore Street,<br> Travel City, EX 12345</p>
    </div>
    <div class="contact-info">
      <img class="contact_img" alt="Hours" src="public/images/time-management.png">
      <h3>Support Hours</h3>
      <p>Mon–Fri: 9 a.m – 6 p.m</p>
      <p>Sat: 10 a.m – 4 p.m</p>
    </div>
    <div class="contact-info">
      <img class="contact_img" alt="Email" src="public/images/email.png">
      <h3>Email</h3>
      <p>support@exploreease.com</p>
    </div>
    <div class="contact-info">
      <img class="contact_img" alt="Phone" src="public/images/phone-call.png">
      <h3>Phone</h3>
      <p>+1 (800) 123-4567</p>
    </div>
  </div>

  <!-- Contact Form -->
  <div class="expert-contact-form">
    <h3>Contact with an Expert</h3>
    <p>If you have any questions, please feel free to get in touch with us.<br>We will reply to you as soon as possible. Thank you!</p>
    <form>
      <input type="text" class="input-field" placeholder="Name" required>
      <input type="email" class="input-field" placeholder="Email" required>
      <textarea class="input-field textarea-field" rows="5" placeholder="Write your message..." required></textarea>
      <button type="submit" class="book-btn">Send Message</button>
    </form>
  </div>

  <!-- FAQ Section -->
<section class="faq-section">
  <h3>Frequently Asked Questions</h3>

  <details class="faq-item">
    <summary>What is ExploreEase and how does it work?</summary>
    <p>ExploreEase is a platform where travelers can find highly-rated service providers like hotels, restaurants, cultural events, and heritage shops. Providers can collaborate to offer group packages for more visibility and benefits.</p>
  </details>

  <details class="faq-item">
    <summary>Can I register as both a traveler and a service provider? </summary>
    <p>Currently, you need to register separately for each role to get the relevant features and tools designed for that user type.</p>
  </details>

  <details class="faq-item">
    <summary>How are service providers reviewed?</summary>
    <p>Travelers can leave reviews after using services. Those with better ratings show up higher in searches for better exposure.</p>
  </details>

  <details class="faq-item">
    <summary>Can service providers collaborate with each other?</summary>
    <p>Yes! ExploreEase allows providers to form groups, create packages together, and offer bundled experiences to attract more travelers.</p>
  </details>
</section>


    </main>

        <?php require_once __DIR__ . '/logedFooter.php'; ?>
    
</body>
</html>