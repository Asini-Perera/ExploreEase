<style>
    .verify-container {
        padding-top: 30px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }

    th,
    td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f9f9f9;
    }

    .profile-img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 10px;
    }

    .profile-info {
        display: flex;
        align-items: center;
    }

    .action-buttons button {
        padding: 5px 10px;
        margin: 0 5px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .verify-btn {
        background-color: #006600;
        color: white;
    }

    .reject-btn {
        background-color: #d8000c;
        color: white;
    }
</style>

<div class="verify-container">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Contact No</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="profile-info">
                    <img src="../public/images/user.jpg" class="profile-img">
                    John Doe
                </td>
                <td>john.doe@example.com</td>
                <td>+123 456 7890</td>
                <td class="action-buttons">
                    <button class="verify-btn">Verify</button>
                    <button class="reject-btn">Reject</button>
                </td>
            </tr>
            <tr>
                <td class="profile-info">
                    <img src="../public/images/user.jpg" class="profile-img">
                    Jane Smith
                </td>
                <td>jane.smith@example.com</td>
                <td>+987 654 3210</td>
                <td class="action-buttons">
                    <button class="verify-btn">Verify</button>
                    <button class="reject-btn">Reject</button>
                </td>
            </tr>
            <tr>
                <td class="profile-info">
                    <img src="../public/images/user.jpg" class="profile-img">
                    Alice Johnson
                </td>
                <td>alice.johnson@example.com</td>
                <td>+456 789 1230</td>
                <td class="action-buttons">
                    <button class="verify-btn">Verify</button>
                    <button class="reject-btn">Reject</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>