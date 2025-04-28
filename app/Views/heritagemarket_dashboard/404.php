<div class="error-container">
    <div class="error-content">
        <h1>404 - Page Not Found</h1>
        <p>The page you are looking for does not exist or may have been moved.</p>
        <a href="?page=dashboard" class="btn-return">Return to Dashboard</a>
    </div>
</div>

<style>
    .error-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 70vh;
    }
    
    .error-content {
        text-align: center;
        padding: 30px;
        background-color: #f8f8f8;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        max-width: 500px;
    }
    
    .error-content h1 {
        font-size: 2.5rem;
        color: #e74c3c;
        margin-bottom: 20px;
    }
    
    .error-content p {
        font-size: 1.2rem;
        color: #555;
        margin-bottom: 30px;
    }
    
    .btn-return {
        display: inline-block;
        padding: 10px 20px;
        background-color: #3498db;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }
    
    .btn-return:hover {
        background-color: #2980b9;
    }
</style>
