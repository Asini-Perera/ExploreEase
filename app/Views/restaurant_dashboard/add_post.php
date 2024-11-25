
    <style>
        label{
            font-size: 20px;
            
        }

        .form-group{
            display: flex;
            justify-content: space-between;
            padding: 5px;

        }

        form{
            margin-top: 2vh;  
            margin-left: 15vw; 
            width: 75vw; 
            height:72vh; 
            background-color:#D9D9D9; 
            padding: 60px;
        }
    </style>

    <section class="post-editor">
        <form action="" method="POST" style=" ">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" style="width: 91%; height: 40px; font-size: 20px;">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="form-control" cols="91" rows="18" style="overflow: hidden; font-size: 20px;  overflow-y:scroll; scroll-snap-type: y mandatory; scroll-behavior:smooth;"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control" style="margin-right:440px; height:40px;width:600px; background-color:#ffffff;">

            </div>
            <button type="submit" id="publish" style="font-size: 18px; width:10vw; border-radius:20px; height: 4vh;margin-top:4vh; background-color: #F1C232; float: right;">Publish</button>
        </form>
          
    </section>