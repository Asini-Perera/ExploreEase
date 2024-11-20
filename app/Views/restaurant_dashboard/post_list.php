
    <style>
        td{
            align-content: flex-start;
            padding: 5px ;
            font-size: 22px;
            height: 10vh;
            
        }

        img{
            height: 20vh; width: 15vw; padding: 5px;
        }

        .buttons{
            padding: 30px;
            
        }

        .buttons .edit , .delete{
            width: 10vw;
            height: 3vh;
            margin-top: 20px;
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


        .content{
            /* padding: 10px; */
            overflow: hidden; overflow-y:scroll; scroll-snap-type: y mandatory; scroll-behavior:smooth;scrollbar-color: #046c33 #f5f5f5;
        }
    </style>



<!-- post_list -->
<section class="post_list" id="post_list" style="margin-top: 2vh;  margin-left: 15vw; width: 84vw; height:82vh; background-color: #D9D9D9;  overflow: hidden; overflow-y:scroll;
scroll-snap-type: y mandatory; scroll-behavior:smooth;scrollbar-color: #046c33 #f5f5f5; scroll-snap-align: start;border-radius: 30px;">
    <table border="1" class="post-table" style=" padding: 25px; width: 84vw; ">
        <thead style="font-size: 24px;">
            <tr >
                <th style="width:5vw; display: fixed; padding: 6px; background-color: #6FA857;">Post ID</th>
                <th style="width:15vw; display: fixed; padding: 6px; background-color: #6FA857;">Post Image</th>
                <th style="width:25vw; display: fixed; padding: 6px; background-color: #6FA857;">Title</th>
                <th style="width:25vw; display: fixed; padding: 6px; background-color: #6FA857;">Content</th>
                <th style="width:10vw; display: fixed; padding: 6px; background-color: #6FA857;">Date</th>
                <th style="width:12vw; display: fixed; padding: 6px; background-color: #6FA857;">Actions</th>
            </tr>

        </thead>
        <tbody>
            <tr >
                <td>1</td>
                <td><img src="../../../public/images/2.jpg" alt="post-image" ></td>
                <td>Post Title</td>
                <td  class="content">Post Content</td>
                <td>2024.10.18</td>
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
                <td>2024.10.18</td>
                <td class="buttons">
                    <button class="edit">Edit</button>
                    <button class="delete">Delete</button>
                </td>
            </tr>

            <tr>
                <td>3</td>
                <td><img src="../../../public/images/2.jpg" alt="post-image" ></td>
                <td>Post Title</td>
                <td class="content">Post Content</td>
                <td>2024.10.18</td>
                <td class="buttons">
                    <button class="edit">Edit</button>
                    <button class="delete">Delete</button>
                </td>
            </tr>

            <tr>
                <td>4</td>
                <td><img src="../../../public/images/2.jpg" alt="post-image" ></td>
                <td>Post Title</td>
                <td class="content">Post Content</td>
                <td>2024.10.18</td>
                <td class="buttons">
                    <button class="edit">Edit</button>
                    <button class="delete">Delete</button>
                </td>
            </tr>

            <tr>
                <td>5</td>
                <td><img src="../../../public/images/2.jpg" alt="post-image" ></td>
                <td>Post Title</td>
                <td class="content">Post Content</td>
                <td>2024.10.18</td>
                <td class="buttons">
                    <button class="edit">Edit</button>
                    <button class="delete">Delete</button>
                    
                </td>
            </tr>

            <tr>
                <td>6</td>
                <td><img src="../../../public/images/2.jpg" alt="post-image" ></td>
                <td>Post Title</td>
                <td class="content">Post Content</td>
                <td>2024.10.18</td>
                <td class="buttons">
                    <button class="edit">Edit</button>
                    <button class="delete">Delete</button>
                </td>
            </tr>
        </tbody>
        </table>
</section>

</body>
</html>