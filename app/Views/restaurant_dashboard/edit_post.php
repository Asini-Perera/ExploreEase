<link rel="stylesheet" href="../public/css/restaurant_dashboard/edit_post.css">

<div class="form-content">
    <h1>Edit Post</h1>
    
    <form method="POST" action=" " enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" name="title" id="title" class="form-control"  placeholder="Enter post title"   required>
        </div>

        <div class="form-group">
            <textarea id="description" cols="60" rows="40" class="form-control" placeholder="Enter description" required> </textarea>
        </div>
        
        <div class="form-group">
            <input type="file" name="image" id="image" class="form-control" value="">
        </div>

        <div class="action-buttons">
            <button type="button" class="discard-btn" onclick="window.history.back()">Discard</button>
            <button type="submit" class="save-btn" onclick="">Save</button>     
        </div>

    </form>
</div>