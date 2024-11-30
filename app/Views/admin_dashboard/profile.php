<div class="profile-card">
    <div class="profile-picture">
        <img src="../public/images/user.jpg" alt="Admin Profile Picture">
    </div>
    <div class="profile-details">
        <h2>John Doe</h2> <!-- Example Name -->
        <p>Email: johndoe@example.com</p> <!-- Example Email -->
        <p>Contact No: +1234567890</p> <!-- Example Contact -->
    </div>
    <div class="profile-actions">
        <button class="btn btn-primary">Edit Profile</button>
        <button class="btn btn-secondary">Change Password</button>
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
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        text-align: center;
    }

    .profile-picture img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 4px solid #6fa857;
        margin-bottom: 25px;
    }

    .profile-details h2 {
        font-size: 28px;
        margin: 15px 0;
        color: #225522;
    }

    .profile-details p {
        font-size: 18px;
        margin: 8px 0;
        color: #555;
    }

    .profile-actions .btn {
        padding: 12px 25px;
        margin: 10px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background-color: #225522;
        color: #fff;
    }

    .btn-primary:hover {
        background-color: #6fa857;
    }

    .btn-secondary {
        background-color: #f1c232;
        color: #000;
    }

    .btn-secondary:hover {
        background-color: #d9d9d9;
    }
</style>
