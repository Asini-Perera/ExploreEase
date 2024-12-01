<link rel="stylesheet" href="../public/css/hotel_dashboard/post_list.css">

<div class="menu-container">
    <div class="top">
            <h1>Post List</h1><span></span>

            <div class="action-buttons">
                <a class="add-btn" href="?page=post&action=add">Add Post</a>
            </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>11.11 offer</td>
                <td>Enjoy a special discount on 11.11 with our exclusive offer. Don't miss out on this limited-time deal!</td>
                <td>2024.12.01</td>
                <td><img src="../public/images/food.jpg" class="food-img"></td>
                <td class="action-buttons">
                    <button class="edit-btn"><a href="?page=post&action=edit">Edit</a></button>
                    <button class="delete-btn">Delete</button>
                </td>
            </tr>
            <tr>
                <td>Seasonal Offer</td>
                <td>Celebrate the season with our special menu and discounts. Perfect for a cozy meal with loved ones.</td>
                <td>2024.10.25</td>
                <td><img src="../public/images/food.jpg" class="food-img"></td>
                <td class="action-buttons">
                <button class="edit-btn"><a href="?page=post&action=edit">Edit</a></button>
                <button class="delete-btn">Delete</button>
                </td>
            </tr>
            <tr>
                <td>Package offer</td>
                <td>Take advantage of our package offer and enjoy a variety of dishes at a great price. Ideal for group dining.</td>
                <td>2024.10.10</td>
                <td><img src="../public/images/food.jpg" class="food-img"></td>
                <td class="action-buttons">
                <button class="edit-btn"><a href="?page=post&action=edit">Edit</a></button>
                <button class="delete-btn">Delete</button>
                </td>
            </tr>
           
        </tbody>
    </table>
</div>