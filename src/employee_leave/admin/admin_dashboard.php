    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard Navigation</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <style>
            body {
                margin: 0;
                font-family: Arial, sans-serif;
                background-color: #f9f9f9;
                display: flex;
                height: 100vh;
                overflow: hidden;
            }

            /* Sidebar Styles */
            .sidebar {
                height: 100%;
                width: 220px;
                background-color: #004d1a;
                color: #fff;
                position: fixed;
                top: 0;
                left: 0;
                padding-top: 10px;
                overflow-y: auto;
                transition: height 0.1s ease, background-color 0.3s ease;
            }

            .sidebar.minimized {
                height: 40px; /* Reduced height when minimized */
                background-color: #006400;
                overflow: hidden;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
            }

            .nav-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding-left: 10px;
                padding-bottom: 20px;
                font-size: 20px;
                font-weight: bold;
                color: #fddb3a;
                position: sticky;
                top: 0;
                z-index: 10;
            }

            .hamburger {
                font-size: 24px;
                color: #fddb3a;
                cursor: pointer;
                background: none;
                border: none;
                z-index: 20;
                padding-right: 30px;
            }

            .nav-links {
                display: flex;
                flex-direction: column;
                gap: 10px;
                padding: 0 10px;
            }

            .nav-links a, .dropdown-btn, .nav-btn {
                color: #fff;
                text-decoration: none;
                padding: 12px;
                border-radius: 4px;
                background-color: #006400;
                transition: background-color 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: flex-start;
                width: 100%;
            }

            .nav-links a i, .dropdown-btn i, .nav-btn i {
                margin-right: 10px;  
                flex-shrink: 0; 
            }

            .nav-links a:hover, .dropdown-btn:hover, .nav-btn:hover {
                background-color: #003d1a;
            }

            .dropdown {
                position: relative;
                display: flex;
                flex-direction: column;
            }

            .dropdown-btn {
                background-color: #006400;
                color: #fff;
                padding: 12px;
                border: none;
                text-align: left;
                font-size: 16px;
                cursor: pointer;
                border-radius: 4px;
                transition: background-color 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .dropdown-btn:hover {
                background-color: #003d1a;
            }

            .dropdown-content {
                display: none; 
                flex-direction: column;
                background-color: #004d1a;
                padding: 0;
                margin-top: 5px;
                border-radius: 4px;
                overflow: hidden;
            }

            .dropdown-content a {
                color: #fff;
                text-decoration: none;
                padding: 10px 12px;
                background-color: #004d1a;
                transition: background-color 0.3s ease;
            }

            .dropdown-content a:hover {
                background-color: #003d1a;
            }

            .dropdown.active .dropdown-content {
                display: flex;
            }

            /* Top Bar Styles */
            .top-bar {
                height: 50px;
                width: 100%;
                color: black;
                display: flex;
                align-items: center;
                justify-content: space-between;
                position: fixed;
                margin-left: 200px;
                top: 0;
                left: 0;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
                padding: 0 20px;
            }

            .top-bar .left-icons {
                display: flex;
                gap: 20px;
                align-items: center;
                padding-left: 10px;
            }

            /* Content Styles */
            .content {
                margin-left: 220px;
                margin-top: 50px;
                padding: 20px;
                overflow: auto;
                width: calc(100% - 200px);
            }

            .sidebar.minimized + .content {
                margin-left: 0;
                width: 100%;
            }
        </style>
    </head>
    <body>

        <!-- Top Bar -->
        <div class="top-bar">
            <!-- Left Icons -->
            <div class="left-icons">
                <i class="fas fa-search" style="cursor: pointer;"></i>
                <i class="fas fa-expand" style="cursor: pointer;"></i>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="nav-header">
                Navigation
                <button class="hamburger" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="nav-links">
                <a href="#" onclick="loadPage('dashboard')"><i class="fas fa-tachometer-alt"></i> Dashboard</a>

                <!-- Dropdown for Staff -->
                <div class="dropdown">
                    <button class="dropdown-btn"><i class="fas fa-users"></i><span>Staff</span> <i class="fas fa-caret-down"></i></button>
                    <div class="dropdown-content">
                        <a href="#" onclick="loadPage('add_staff')">Add Staff</a>
                        <a href="#" onclick="loadPage('manage_staff')">Manage Staff</a>
                    </div>
                </div>

                <!-- Dropdown for Leave -->
                <div class="dropdown">
                    <button class="dropdown-btn"><i class="fas fa-calendar-day"></i><span>Leave</span> <i class="fas fa-caret-down"></i></button>
                    <div class="dropdown-content">
                        <a href="#" onclick="loadPage('apply_leave')">Apply Leave</a>
                        <a href="#" onclick="loadPage('my_leave')">My Leave</a>
                        <a href="#" onclick="loadPage('all_leaves')">All Leaves</a>
                    </div>
                </div>

                <!-- Leave Type button with Add Leave Type option -->
                <div class="dropdown">
                    <button class="dropdown-btn"><i class="fas fa-cogs"></i><span>Leave Type</span> <i class="fas fa-caret-down"></i></button>
                    <div class="dropdown-content">
                        <a href="#" onclick="loadPage('add_leave_type')">Add Leave Type</a>
                    </div>
                </div>

                <!-- Updated Payroll dropdown with Manage Payroll -->
                <div class="dropdown">
                    <button class="dropdown-btn"><i class="fas fa-file-invoice-dollar"></i><span>Payroll</span> <i class="fas fa-caret-down"></i></button>
                    <div class="dropdown-content">
                        <a href="#" onclick="loadPage('view_payroll')">View Payroll</a>
                        <a href="#" onclick="loadPage('manage_payroll')">Manage Payroll</a>
                    </div>
                </div>

                <!-- Dropdown for Attendance -->
                <div class="dropdown">
                    <button class="dropdown-btn"><i class="fas fa-clock"></i><span>Attendance</span> <i class="fas fa-caret-down"></i></button>
                    <div class="dropdown-content">
                        <a href="#" onclick="loadPage('attendance')">Attendance</a>
                        <a href="#" onclick="loadPage('my_attendance')">My Attendance</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content" id="content">
            <h1>Welcome to the Admin Dashboard</h1>
            <p>Manage your tasks and users from here.</p>
        </div>

        <script>
            function toggleSidebar() {
                const sidebar = document.getElementById('sidebar');
                sidebar.classList.toggle('minimized');
            }

            // Function to load pages dynamically
            function loadPage(page) {
                const content = document.getElementById('content');
                const xhr = new XMLHttpRequest();
                xhr.open('GET', page + '.php', true); 
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        content.innerHTML = xhr.responseText; 
                    } else {
                        content.innerHTML = `<p>Error loading ${page}.php: ${xhr.status}</p>`;
                    }
                };
                xhr.onerror = function() {
                    content.innerHTML = `<p>Failed to load ${page}.php.</p>`;
                };
                xhr.send();
            }

            // JavaScript to toggle dropdown on click
            document.querySelectorAll('.dropdown-btn').forEach(function(dropdownBtn) {
                dropdownBtn.addEventListener('click', function(e) {
                    const dropdown = this.closest('.dropdown'); 

                    dropdown.classList.toggle('active');
                    document.querySelectorAll('.dropdown').forEach(function(otherDropdown) {
                        if (otherDropdown !== dropdown) {
                            otherDropdown.classList.remove('active');
                        }
                    });
                });
            });
        </script>

    </body>
    </html>
