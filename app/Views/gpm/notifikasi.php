<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/gpm.css">
    <link rel="stylesheet" href="/css/notifikasi_gpm.css">
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-header-judul">
                <p>MONEV RPS</p>
            </div>
            <div class="sidebar-header">
                <p>Tahun Ajaran : 2024/2025 Ganjil</p>
            </div>
            <a href="<?= base_url('/gpm') ?>" class="menu-item">
                <i class="bi bi-speedometer2"></i><span>Halaman Utama</span>
            </a>
            <a href="<?= base_url('/dashboard/gpm_rps') ?>" class="menu-item">
                <i class="bi bi-file-earmark"></i><span>RPS</span>
            </a>
            <a href="<?= base_url('/gpm/bap') ?>" class="menu-item ">
                <i class="bi bi-file-earmark"></i><span>BAP</span>
            </a>
            <a href="<?= base_url('/gpm/notifikasi') ?>" class="menu-item">
                <i class="bi bi-bell-fill"></i><span>Notifikasi</span>
            </a>
            <a href="<?= base_url('/logout') ?>" class="menu-item">
                <i class="bi bi-box-arrow-left"></i><span>Keluar</span>
            </a>
        </nav>

        <div class="admin-info">
            <span class="toggle-sidebar">&#9776;</span>

            <!-- Right-aligned container for profile and notification icons -->
            <div class="right-icons">
                <a href="/gpm/profile" class="profile-link">
                    <span class="admin-name"><?= user()->username ?></span>
                    <i class="bi bi-person-fill"></i>
                </a>
                <a href="/gpm/notifikasi" class="notif">
                    <i class="bi bi-bell-fill"></i>
                </a>
            </div>
        </div>

        <!-- Main content -->
        <div class="admin-info">
            <span class="toggle-sidebar">&#9776;</span>

            <!-- Right-aligned container for profile and notification icons -->
            <div class="right-icons">
                <a href="/gpm/profile" class="profile-link">
                    <span class="admin-name"><?= user()->username ?></span>
                    <i class="bi bi-person-fill"></i>
                </a>
                <a href="/gpm/notifikasi" class="notif">
                    <i class="bi bi-bell-fill"></i>
                </a>
            </div>
        </div>

        <div class="main-content">
            <!-- Administrator Info Container -->

            <header class="main-header">
                <h1 class="h4">Home / Notifikasi</h1>
            </header>

            <!-- Notification List -->
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title d-flex align-items-center">
                            <button class="custom-btn d-flex align-items-center" type="button" id="dropdownToggle">
                                <input type="checkbox" id="selectAllCheckbox" class="custom-checkbox me-2">
                                <i class="bi bi-caret-down-fill custom-chevron"></i>
                            </button>
                            <button id="deleteSelected" class="btn-red ms-2 d-flex align-items-center">
                                <i class="bi bi-trash3-fill me-2"></i> <span class="delete-text">Hapus</span>
                            </button>
                            <div class="input-group ms-2" style="margin-left: auto;">
                                <i class="bi bi-search input-group-text search-icon"></i>
                                <input type="text" id="searchInput" class="form-control" placeholder="Cari Notifikasi" style="width: 150px;" autocomplete="off">
                                <ul class="dropdown-menu" id="searchDropdown" style="display: none;"></ul>
                            </div>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="dropdownMenu" style="display: none;">
                                <li><a class="dropdown-item" href="#" data-filter="all">Semua</a></li>
                                <li><a class="dropdown-item" href="#" data-filter="read">Sudah Dibaca</a></li>
                                <li><a class="dropdown-item" href="#" data-filter="unread">Belum Dibaca</a></li>
                                <li><a class="dropdown-item" href="#" data-filter="none">Tak Satu Pun</a></li>
                            </ul>
                        </h2>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <!-- Example Notification -->
                            <li class="list-group-item notification unread">
                                <input type="checkbox" class="select-notif large-checkbox">
                                <span class="sender-name">GPM</span>
                                <span class="message-content" data-full-message="Kalkulus - RPS belum mengandung capaian pembelajaran yang sesuai">Kalkulus - RPS belum mengandung capaian pembelajaran yang sesuai...</span>
                                <span class="time" data-time="2024-11-26T18:57:04">Just now</span>
                            </li>
                            <li class="list-group-item notification unread">
                                <input type="checkbox" class="select-notif large-checkbox">
                                <span class="sender-name">Kajur</span>
                                <span class="message-content" data-full-message="Kalkulus - Bahan ajar belum lengkap dan tidak mencakup referensi">Kalkulus - Bahan ajar belum lengkap dan tidak mencakup referensi...</span>
                                <span class="time" data-time="2024-11-10T08:00:00Z">Just now</span>
                            </li>
                            <li class="list-group-item notification unread">
                                <input type="checkbox" class="select-notif large-checkbox">
                                <span class="sender-name">GPM</span>
                                <span class="message-content" data-full-message="Kalkulus - Evaluasi pembelajaran kurang mencakup aspek keterampilan">Kalkulus - Evaluasi pembelajaran kurang mencakup aspek keterampilan...</span>
                                <span class="time" data-time="2024-11-09T08:00:00Z">Just now</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Fakultas Teknik. All rights reserved.</p>
    </footer>

    <script>
        // Convert timestamps to "time ago" format
        document.addEventListener('DOMContentLoaded', function() {
            function updateTimeAgo() {
                document.querySelectorAll('.time').forEach(element => {
                    const timeString = element.getAttribute('data-time');
                    const time = new Date(timeString);
                    const now = new Date();
                    const diffInSeconds = Math.floor((now - time) / 1000);
                    let timeAgo = "";

                    if (diffInSeconds < 60) {
                        timeAgo = "Baru saja";
                    } else if (diffInSeconds < 3600) {
                        const minutes = Math.floor(diffInSeconds / 60);
                        timeAgo = `${minutes} menit lalu`;
                    } else if (diffInSeconds < 86400) {
                        const hours = Math.floor(diffInSeconds / 3600);
                        timeAgo = `${hours} jam lalu`;
                    } else {
                        const days = Math.floor(diffInSeconds / 86400);
                        timeAgo = `${days} hari lalu`;
                    }

                    element.textContent = timeAgo;
                });
            }

            updateTimeAgo();
            setInterval(updateTimeAgo, 60000); // Update every minute

            // Handle dropdown filter actions
            document.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const filter = this.getAttribute('data-filter');
                    document.querySelectorAll('.list-group-item.notification').forEach(notification => {
                        switch (filter) {
                            case 'all':
                                notification.style.backgroundColor = '#d0e7ff';
                                break;
                            case 'read':
                                if (notification.classList.contains('read')) {
                                    notification.style.backgroundColor = '#d0e7ff';
                                } else {
                                    notification.style.backgroundColor = '';
                                }
                                break;
                            case 'unread':
                                if (notification.classList.contains('unread')) {
                                    notification.style.backgroundColor = '#d0e7ff';
                                } else {
                                    notification.style.backgroundColor = '';
                                }
                                break;
                            case 'none':
                                notification.style.backgroundColor = '';
                                break;
                        }
                    });
                    // Hide dropdown after selection
                    document.getElementById('dropdownMenu').style.display = 'none';
                });
            });

            // Toggle dropdown visibility
            document.getElementById('dropdownToggle').addEventListener('click', function() {
                const dropdownMenu = document.getElementById('dropdownMenu');
                dropdownMenu.style.display = dropdownMenu.style.display === 'none' ? 'block' : 'none';
            });

            const selectAllCheckbox = document.getElementById('selectAllCheckbox');
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const checkboxes = document.querySelectorAll('.select-notif');
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                        const notificationItem = checkbox.closest('.list-group-item.notification');
                        if (this.checked) {
                            notificationItem.classList.add('selected');
                        } else {
                            notificationItem.classList.remove('selected');
                        }
                    });
                });
            }

            document.querySelectorAll('.list-group-item.notification').forEach(notification => {
                notification.addEventListener('click', function() {
                    // Mark notification as read
                    this.classList.remove('unread');
                    this.classList.add('read');

                    // Update the status text to "Read"
                    const status = this.querySelector('.status');
                    if (status) {
                        status.textContent = 'Read';
                    }
                });
            });

            document.querySelectorAll('.select-notif').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const notificationItem = this.closest('.list-group-item.notification');
                    if (this.checked) {
                        notificationItem.classList.add('selected');
                        notificationItem.style.backgroundColor = '#d0e7ff';
                    } else {
                        notificationItem.classList.remove('selected');
                        notificationItem.style.backgroundColor = '';
                    }
                });
            });

            const deleteButton = document.getElementById('deleteSelected');
            if (deleteButton) {
                deleteButton.addEventListener('click', function() {
                    const selectedNotifications = document.querySelectorAll('.list-group-item.notification.selected');
                    selectedNotifications.forEach(notification => notification.remove());
                });
            }

            function truncateMessages() {
                document.querySelectorAll('.message-content').forEach(element => {
                    const fullMessage = element.getAttribute('data-full-message');
                    const containerWidth = element.offsetWidth;
                    const textWidth = element.scrollWidth;

                    if (textWidth > containerWidth) {
                        let truncatedMessage = fullMessage; // Start with the full message
                        while (element.scrollWidth > containerWidth && truncatedMessage.length > 0) {
                            truncatedMessage = truncatedMessage.slice(0, -1);
                            element.textContent = `${truncatedMessage.trim()}...`;
                        }
                    } else {
                        element.textContent = fullMessage;
                    }
                });
            }

            truncateMessages();
            window.addEventListener('resize', truncateMessages); // Re-truncate on window resize

            const searchInput = document.getElementById('searchInput');
            const searchDropdown = document.getElementById('searchDropdown');
            const notifications = Array.from(document.querySelectorAll('.list-group-item.notification'));

            searchInput.addEventListener('input', function() {
                const query = this.value.toLowerCase();
                searchDropdown.innerHTML = ''; // Clear previous results

                if (query.length > 0) {
                    const filteredNotifications = notifications.filter(notification => {
                        const senderName = notification.querySelector('.sender-name').textContent.toLowerCase();
                        const messageContent = notification.querySelector('.message-content').textContent.toLowerCase();
                        return senderName.includes(query) || messageContent.includes(query);
                    });

                    filteredNotifications.forEach(notification => {
                        const listItem = document.createElement('li');
                        listItem.classList.add('dropdown-item');

                        // Highlight the search term in bold for both sender name and message content
                        const senderName = notification.querySelector('.sender-name').textContent;
                        const messageContent = notification.querySelector('.message-content').textContent;
                        const highlightedSender = senderName.replace(new RegExp(`(${query})`, 'gi'), '<strong>$1</strong>');
                        const highlightedMessage = messageContent.replace(new RegExp(`(${query})`, 'gi'), '<strong>$1</strong>');

                        listItem.innerHTML = `${highlightedSender}: ${highlightedMessage}`; // Combine sender and message

                        listItem.addEventListener('click', function() {
                            searchInput.value = messageContent; // Set input to selected item
                            searchDropdown.style.display = 'none'; // Hide dropdown
                        });
                        searchDropdown.appendChild(listItem);
                    });

                    if (filteredNotifications.length > 0) {
                        searchDropdown.style.display = 'block'; // Show dropdown if there are results
                    } else {
                        searchDropdown.style.display = 'none'; // Hide dropdown if no results
                    }
                } else {
                    searchDropdown.style.display = 'none'; // Hide dropdown if input is empty
                }
            });

            // Hide dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !searchDropdown.contains(e.target)) {
                    searchDropdown.style.display = 'none';
                }
            });
        });
    </script>

    <script src="/js/gpm.js"></script>

    <!-- Scripts for Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>