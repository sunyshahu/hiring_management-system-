<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user's applications
$stmt = $conn->prepare("SELECT * FROM job_applications WHERE user_id = ? ORDER BY applied_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application History</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f3f4f6; color: #1f2937; }
        .dashboard-header { background: linear-gradient(135deg, #4f46e5, #7c3aed); padding: 3rem 0; color: white; border-radius: 0 0 25px 25px; margin-bottom: 3rem; text-align: center; }
        .dashboard-header h2 { font-weight: 700; font-size: 2rem; margin-bottom: 0.5rem; }
        .dashboard-header p { color: #e0e7ff; font-size: 1.1rem; margin: 0; }
        
        .history-card { background: white; border: none; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.03); padding: 1.5rem; transition: transform 0.2s; position: relative; overflow: hidden; margin-bottom: 1.5rem; }
        .history-card:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(99, 102, 241, 0.1); }
        .history-card::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px; background: #6366f1; border-radius: 4px 0 0 4px; }
        
        .status-badge { position: absolute; top: 1.5rem; right: 1.5rem; padding: 6px 15px; border-radius: 20px; font-weight: 600; font-size: 0.85rem; }
        .status-review { background: #fff7ed; color: #c2410c; border: 1px solid #ffedd5; } /* Orange under review */
        .status-received { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; } /* Green received */
        
        .job-id { color: #111827; font-weight: 700; font-size: 1.25rem; margin-bottom: 1rem; }
        .meta-info { color: #4b5563; font-size: 0.95rem; margin-bottom: 0.5rem; display: flex; align-items: center; }
        .meta-info i { width: 25px; text-align: center; margin-right: 5px; color: #8b5cf6; font-size: 1.1rem; }
        
        .cover-snippet { background: #f9fafb; padding: 1rem; border-radius: 10px; font-size: 0.95rem; color: #4b5563; font-style: italic; margin-top: 1rem; }
        
        .btn-apply { background: #6366f1; color: white; border-radius: 50px; padding: 10px 25px; font-weight: 600; transition: all 0.2s; text-decoration: none; display: inline-block; }
        .btn-apply:hover { background: #4f46e5; color: white; box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3); }
        
        /* Navbar specifically for non-MDI view */
        .navbar-custom { background: rgba(30, 41, 59, 1); }
    </style>
</head>
<body>

<?php $hide_nav = isset($_GET['nomdi']) && $_GET['nomdi'] == '1'; ?>

<?php if(!$hide_nav): ?>
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom mb-0">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#">SwiftHire Portal</a>
    <div class="d-flex align-items-center">
        <span class="text-light me-3">Welcome, <?php echo htmlspecialchars($_SESSION['user_firstname']); ?>!</span>
        <a href="job_board.php" class="btn btn-apply me-2" style="padding: 6px 20px;">Find Jobs</a>
        <a href="user_logout.php" class="btn btn-outline-light rounded-pill px-3">Logout</a>
    </div>
  </div>
</nav>
<?php endif; ?>

<div class="dashboard-header">
    <div class="container">
        <h2>Application Tracking History</h2>
        <p>Monitor your active submissions and pipeline statuses in real-time.</p>
    </div>
</div>

<div class="container pb-5">
    
    <?php if ($result->num_rows > 0): ?>
        <div class="row">
        <?php 
        $counter = 0;
        while($row = $result->fetch_assoc()): 
            $counter++;
            // Mock dynamic status: make first one "In Review", others "Received"
            $status_class = ($counter === 1) ? 'status-review' : 'status-received';
            $status_text = ($counter === 1) ? '<i class="fas fa-hourglass-half me-1"></i> Under Review' : '<i class="fas fa-check-circle me-1"></i> Application Received';
        ?>
            <div class="col-md-6">
                <div class="history-card">
                    <div class="status-badge <?php echo $status_class; ?>">
                        <?php echo $status_text; ?>
                    </div>
                    
                    <div class="job-id">
                        Application #<?php echo $row['id']; ?>
                    </div>
                    
                    <div class="meta-info">
                        <i class="fas fa-calendar-alt"></i> 
                        <strong>Submitted On:</strong> &nbsp; <?php echo date("F j, Y, g:i a", strtotime($row['applied_at'])); ?>
                    </div>
                    <div class="meta-info">
                        <i class="fas fa-phone-alt"></i> 
                        <strong>Contact Number:</strong> &nbsp; <?php echo htmlspecialchars($row['areacode'] . '-' . $row['phone']); ?>
                    </div>
                    
                    <div class="cover-snippet">
                        "<?php echo htmlspecialchars(substr($row['message'], 0, 120)); ?><?php echo strlen($row['message']) > 120 ? '...' : ''; ?>"
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="card border-0 shadow-sm text-center p-5" style="border-radius: 20px;">
            <div class="text-muted mb-3" style="font-size: 3rem;"><i class="fas fa-folder-open"></i></div>
            <h4 class="fw-bold">No applications found</h4>
            <p class="text-muted mb-4">You haven't submitted any job applications yet down your pipeline.</p>
            <div>
                <a href="job_board.php<?php echo $hide_nav ? '?nomdi=1' : ''; ?>" class="btn-apply"><i class="fas fa-search me-2"></i> Browse Job Vacancies</a>
            </div>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
<?php 
$stmt->close(); 
$conn->close(); 
?>
