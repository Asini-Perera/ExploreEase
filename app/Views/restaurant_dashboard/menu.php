

<?php 

  $conn = mysqli_connect('localhost', 'root', '', 'exploreease');
  if(isset($_POST['add_manu'])) {
      $food_name = $_POST['food_name'];
      $food_price = $_POST['food_price'];
      $category = $_POST['category'];
      $food_image = $_FILES['food_image']['name'];
      $food_image_temp = $_FILES['food_image']['tmp_name'];

      move_uploaded_file($food_image_temp, "../../../public/images/$food_image"); 
      
      if(empty($food_name) || empty($food_price) || empty($category) || empty($food_image)) {
          echo "<script>alert('All fields are required')</script>";
      } else {
          $query = "INSERT INTO menu (FoodName, Price, FoodCategory, food_image) VALUES ('$food_name', '$food_price', '$category', '$food_image')";
          $result = mysqli_query($conn, $query);
          if($result) {
              echo "<script>alert('Menu added successfully')</script>";
          } else {
              echo "<st>alert('Failed to add menu')</script>";
          }
      }
  }
?>


<?php 
  $select = mysqli_query($conn, "SELECT * FROM menu");
?>

<style>
    label{
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }
    
        form div{
            margin-top: 10px;
        }
        input , select{
            font-size: 16px;
            padding: 2px;
            
        }
       .name-box{
            width: 30vw;
            /* height: 30px; */
            margin-top: 10px;
            margin-left: 25px;
        }

        
        .price-box{
            width: 10vw;
            /* height: 30px; */
            margin-top: 10px;
            margin-left: 75px;
        }

        .category-box{
            width: 10vw;
            /* height: 30px; */
            margin-top: 10px;
            margin-left: 45px;
        }

        .image-box{
            width: 17vw;
            background-color: #ffffff;
            /* height: 30px; */
            margin-top: 10px;
            margin-left: 70px;
            border: 1px solid #000000;  
        }

        .menu_btn{
            width: 7vw;
            height: 32px;
            margin-top: 10px;
            float:right;
            /* margin-right: 15px; */
            /* margin-left: 250px; */
            background-color: #F1C232;
            color: #000000;
            font-size: 16px;
            /* font-weight: bold; */
            border-radius: 20px;
        }

        .buttons .edit , .delete{
            width: 9vw;
            height: 3vh;
            margin-top: 10px;  
            font-size: 16px;
            border-radius: 10px;
        }

        .edit{
            background-color: #225522;
            color: #F5F5F5;
        }

        .delete{
            background-color: red;
            color: #F5F5F5;
        }

        td{
            align-content: flex-start;
            padding: 5px ;
            font-size: 16px;
            height: 10vh;
            
        }

        .buttons{
            padding: 30px;
            
        }
</style>
  <section class="menu-conatiner" style=" background-color: #D9D9D9; width: 82vw; height:82;margin-left: 15vw; justify-items: center; margin-top:2vh;padding: 10px; ">
  <div class="container" style="width: 40vw;
            height: 26vh;
            padding: 20px; align-items: center;
            background-color: #f5f5f5;
            border: #225522 1px solid;margin-top: 1vh;
            justify-items: center; border-radius:10px;">
      <div class="add-menu" style="padding-bottom:10px;">
          <form action="" method="post" enctype="multipart/form-data">
          <div>
              <label for="food_name">Food Name</label>
              <input type="text" name="food_name" placeholder="Name" class="name-box">
          </div>
          <div>
              <label for="price">Price</label>
              <input type="text" name="food_price" placeholder="Rs. 100.00" class="price-box">
          </div>
          <div>
              <label for="category">Category</label>
                  <select name="category" id="category" class="category-box">
                      <option value="1">Breakfast</option>
                      <option value="2">Lunch</option>
                      <option value="3">Tea-time</option>
                      <option value="4">Dinner</option>
                      <option value="5">Drinks</option>
                  </select>
          </div>
          <div>
              <label for="menu_image">Image</label>
              <input type="file" name="food_image" accept="image/png, image/jpeg, image/jpg" class="image-box">
          </div>
              <button type="submit" name="add_manu" class="menu_btn">Add Menu</button>
          </form>   
      </div>
  </div>

  <div class="menu_list" id="menu_list" style="margin-top: 2vh;   width: 82vw; height:74vh;   overflow: hidden; overflow-y:scroll;
scroll-snap-type: y mandatory; scroll-behavior:smooth;scrollbar-color: #046c33 #f5f5f5; scroll-snap-align: start;">
  <table border="1" class="menu-table" style=" padding: 20px; width: 81vw; ">
      <thead style="font-size: 20px;">
          <tr >
              <th style="width:25vw; display: fixed; padding: 6px; background-color: #6FA857;">Food Name</th>
              <th style="width: 15vw; display: fixed; padding: 6px; background-color: #6FA857;">Food Image</th>
              <th style="width: 10vw; display: fixed; padding: 6px; background-color: #6FA857;">Price</th>
              <th style="width: 15vw; display: fixed; padding: 6px; background-color: #6FA857;">Category</th>
              <th style="width: 12vw;  padding: 6px; background-color: #6FA857;">Actions</th>
          </tr>

      </thead>

      <?php
          while($row = mysqli_fetch_assoc($select)) {
          }
      ?>
      <tbody>
          <tr >
              <td>1</td>
              <td><img src="../../../public/images/2.jpg" alt="post-image" ></td>
              <td>Post Title</td>
              <td  class="content">Post Content</td>
              
              <td class="buttons">
                  <button class="edit" >Edit</button>
                  <button class="delete">Delete</button>
              </td>
          </tr>

          <tr>
              <td>2</td>
              <td><img src="../../../public/images/2.jpg" alt="post-image" ></td>
              <td>Post Title</td>
              <td class="content">Post Content</td>
             
              <td class="buttons">
                  <button class="edit">Edit</button>
                  <button class="delete">Delete</button>
              </td>
          </tr>
      </tbody>
      </table>
  </div>

  </section>
