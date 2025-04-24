<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Field Request Approval</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div class="header">
        <h1>Field Request Management</h1>
        <div class="nav-bar">
            <a href="../login/logout.php" class="btn btn-reject">Logout</a>
        </div>
    </div>
    
    <div class="container">
        <h2>Pending Field Requests</h2>
        <table>
            <thead>
                <tr>
                    <th>Request ID</th>
                    <th>Employee</th>
                    <th>Field Name</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = new mysqli("localhost", "root", "", "jobconnect");
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $query = "SELECT * FROM field_req";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $status = $row['status'];
                        echo "<tr>
                            <td>{$row['field_id']}</td>
                            <td>{$row['company']}</td>
                            <td>{$row['field_name']}</td>
                            <td>{$row['date']}</td>
                            <td><span class='" . strtolower($status) . "'>" . ucfirst($status) . "</span></td>
                            <td>
                                <button class='btn btn-view' onclick=\"viewRequest('{$row['field_name']}', '{$row['description']}')\">View</button>";
                        if ($status === 'pending') {
                            echo "<button class='btn btn-approve' onclick=\"approveRequest({$row['field_id']}, '{$row['field_name']}')\">Approve</button>
                                  <button class='btn btn-reject' onclick=\"rejectRequest({$row['field_id']})\">Reject</button>";
                        }
                        echo "</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No pending requests.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    
    <!-- View Request Modal -->
    <div id="viewModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('viewModal')">&times;</span>
            <h2>Request Details</h2>
            <div class="form-group">
                <label>Field Name:</label>
                <div id="viewFieldName"></div>
            </div>
            <div class="form-group">
                <label>Description:</label>
                <div id="viewDescription"></div>
            </div>
            <div class="modal-buttons">
                <button class="btn btn-view" onclick="closeModal('viewModal')">Close</button>
            </div>
        </div>
    </div>
    
    <!-- Approve Request Modal -->
    <div id="approveModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('approveModal')">&times;</span>
            <h2>Approve Field Request</h2>
            <div class="form-group">
                <label>Request ID:</label>
                <div>REQ-001</div>
            </div>
            <div class="form-group">
                <label>Field Name:</label>
                <div>Tax Exemption Status</div>
            </div>
            <div class="form-group">
                <label for="database">Database:</label>
                <select id="database">
                    <option>Main Database</option>
                    <option>Reporting Database</option>
                </select>
            </div>
            <div class="form-group">
                <label for="comment">Comment (Optional):</label>
                <textarea id="comment" placeholder="Add any comments..."></textarea>
            </div>
            <div class="modal-buttons">
                <button class="btn btn-approve" onclick="approveRequest()">Confirm Approval</button>
                <button class="btn btn-view" onclick="closeModal('approveModal')">Cancel</button>
            </div>
        </div>
    </div>
    
    <!-- Reject Request Modal -->
    <div id="rejectModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('rejectModal')">&times;</span>
            <h2>Reject Field Request</h2>
            <div class="form-group">
                <label>Request ID:</label>
                <div>REQ-001</div>
            </div>
            <div class="form-group">
                <label>Field Name:</label>
                <div>Tax Exemption Status</div>
            </div>
            <div class="form-group">
                <label for="reason">Reason for Rejection:</label>
                <textarea id="reason" placeholder="Please provide a reason for rejecting this request..."></textarea>
            </div>
            <div class="modal-buttons">
                <button class="btn btn-reject" onclick="rejectRequest()">Confirm Rejection</button>
                <button class="btn btn-view" onclick="closeModal('rejectModal')">Cancel</button>
            </div>
        </div>
    </div>
    
    <script>
        function viewRequest(fieldName, description) {
            document.getElementById('viewFieldName').innerText = fieldName;
            document.getElementById('viewDescription').innerText = description;
            openModal('viewModal');
        }

        function openModal(modalId) {
            document.getElementById(modalId).style.display = "block";
        }
        
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = "none";
        }
        
        function approveRequest(requestId, fieldName) {
            if (confirm("Are you sure you want to approve this request?")) {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "process_request.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        alert(xhr.responseText);
                        location.reload();
                    } else {
                        alert("An error occurred while processing the request.");
                    }
                };
                xhr.send(`action=approve&request_id=${requestId}&field_name=${encodeURIComponent(fieldName)}`);
            }
        }

        function rejectRequest(requestId) {
            if (confirm("Are you sure you want to reject this request?")) {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "process_request.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        alert(xhr.responseText);
                        location.reload();
                    } else {
                        alert("An error occurred while processing the request.");
                    }
                };
                xhr.send(`action=reject&request_id=${requestId}`);
            }
        }
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.className === 'modal') {
                event.target.style.display = "none";
            }
        }
    </script>
</body>
</html>