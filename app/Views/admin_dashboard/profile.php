<div class="profile-card">
    <div class="profile-picture">
        <img src="../public/images/user.jpg" alt="Admin Profile Picture">
    </div>
    <div class="profile-details">
        <h2>John Doe</h2> <!-- Example Name -->
        <div class="detail-item">
            <span class="detail-label">Email:</span>
            <span class="detail-value">johndoe@example.com</span> <!-- Example Email -->
        </div>
        <div class="detail-item">
            <span class="detail-label">Contact No:</span>
            <span class="detail-value">+1234567890</span> <!-- Example Contact -->
        </div>
    </div>
    <div class="profile-actions">
        <button class="btn">Edit Profile</button>
        <button class="btn">Change Password</button>
    </div>
</div>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f6f7;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .profile-card {
        max-width: 600px;
        margin: 80px auto;
        background-color: #fff;
        padding: 60px;
        border-radius: 15px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        text-align: center;
    }

    .profile-picture img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 4px solid #6fa857;
        margin-bottom: 10px;
    }

    .profile-details h2 {
        font-size: 28px;
        margin: 15px 0;
        color: #225522;
    }

    .profile-details .detail-item {
        display: flex;
        justify-content: start; 
        align-items: center;
        margin: 15px 0;
        font-size: 18px;
    }

    .profile-details .detail-label {
        width: 200px; 
        text-align: left;
        color: #555;
    }

    .profile-details .detail-value {
        text-align: center;
        color: #333;
        font-weight: bold;
    }

    .profile-actions .btn {
        padding: 12px 25px;
        margin: 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        background-color: #6fa857;
        color: #fff;
        transition: all 0.3s ease;
    }

    .profile-actions .btn:hover {
        background-color: #225522;
    }
</style>
