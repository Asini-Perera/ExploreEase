
    <style>
        label{
            font-size: 24px;
            
        }

        .form-group{
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }
    </style>

    <section class="post-editor">
        <form action="" method="POST" entype="multipart/form-data" style=" margin-top: 2vh;  margin-left: 15vw; width: 76vw; height:82vh; background-color: #F5F5F5; padding: 80px;">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" style="width: 90.5%; height: 40px; font-size: 24px;">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="form-control" cols="180" rows="40" style="overflow: hidden;  overflow-y:scroll; scroll-snap-type: y mandatory; scroll-behavior:smooth;"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control">

            </div>
            <button type="submit" id="publish" style="font-size: 20px; width:10vw; height: 4vh; background-color: #F1C232; float: right;">Publish Post</button>
        </form>
          
    </section>