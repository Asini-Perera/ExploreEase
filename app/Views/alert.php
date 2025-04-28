<?php
if (isset($_SESSION['success']) || isset($_SESSION['error'])):
?>
    <div id="alertBox" class="<?php echo isset($_SESSION['success']) ? 'alert success' : 'alert error'; ?>">
        <?php
        echo isset($_SESSION['success']) ? '✅ ' . $_SESSION['success'] : '❌ ' . $_SESSION['error'];
        unset($_SESSION['success']);
        unset($_SESSION['error']);
        ?>
        <span class="closebtn" onclick="closeAlert()">&times;</span>
    </div>

    <style>
        /* Alert Box Style */
        .alert {
            padding: 20px;
            margin: 0 auto;
            border-radius: 5px;
            width: 90%;
            max-width: 600px;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in-out;
            z-index: 9999;
            /* Ensure it is on top of all other elements */
        }

        .alert.success {
            background-color: #6fa857;
            color: white;
        }

        .alert.error {
            background-color: #d9534f;
            color: white;
        }

        .closebtn {
            position: absolute;
            top: 10px;
            right: 20px;
            color: white;
            font-weight: bold;
            font-size: 22px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }
    </style>

    <script>
        function closeAlert() {
            const alertBox = document.getElementById('alertBox');
            if (alertBox) {
                alertBox.style.animation = "fadeOut 0.5s ease-in-out forwards";
                setTimeout(() => {
                    alertBox.style.display = 'none';
                }, 500); // Wait for animation to complete
            }
        }

        // Auto-close after 5 seconds
        window.onload = function() {
            setTimeout(() => {
                closeAlert();
            }, 5000); // 5 seconds
        };
    </script>
<?php endif; ?>