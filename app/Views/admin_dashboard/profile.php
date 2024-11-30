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
    }

    .profile-card {
        max-width: 400px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .profile-picture img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 3px solid #6fa857;
        margin-bottom: 20px;
    }

    .profile-details h2 {
        margin: 10px 0;
        color: #225522;
    }

    .profile-details p {
        margin: 5px 0;
        color: #555;
    }

    .profile-actions .btn {
        padding: 10px 20px;
        margin: 5px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
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