<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$first = htmlspecialchars($_SESSION['user_firstname']);
$last = htmlspecialchars($_SESSION['user_lastname']);
$email = htmlspecialchars($_SESSION['user_email']);
$initials = strtoupper(substr($first, 0, 1) . substr($last, 0, 1));

$hide_nav = isset($_GET['nomdi']) && $_GET['nomdi'] == '1';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Profile</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f3f2ef; color: #000000e6; }
        .profile-container { max-width: 900px; margin: 2rem auto; }
        .card { background: white; border-radius: 12px; box-shadow: 0 0 0 1px rgba(0,0,0,0.08); border: none; overflow: hidden; margin-bottom: 1.5rem; }
        
        .cover-photo { height: 200px; width: 100%; object-fit: cover; background: linear-gradient(135deg, #a5b4fc, #6366f1); position: relative; }
        
        .profile-header { padding: 0 2rem 2rem; position: relative; }
        .profile-picture { 
            width: 150px; height: 150px; 
            border-radius: 50%; border: 4px solid white; 
            background: #fff; 
            margin-top: -75px; 
            margin-bottom: 1rem;
            display: flex; align-items: center; justify-content: center;
            font-size: 3.5rem; font-weight: 700; color: #6366f1;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .name-title { font-size: 1.5rem; font-weight: 600; margin: 0; line-height: 1.2; }
        .headline { font-size: 1rem; color: #00000099; margin: 5px 0 10px; }
        .location { font-size: 0.9rem; color: #00000099; font-weight: 400; }
        
        .contact-info { margin-top: 10px; font-size: 0.95rem; }
        .contact-info a { color: #0a66c2; text-decoration: none; font-weight: 600; }
        .contact-info a:hover { text-decoration: underline; }
        
        .section-title { font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem; }
        .card-body { padding: 2rem; }
        
        .about-text { font-size: 0.95rem; line-height: 1.6; color: #000000e6; }
        
        .timeline-item { display: flex; margin-bottom: 1.5rem; }
        .timeline-item:last-child { margin-bottom: 0; }
        .timeline-logo { width: 48px; height: 48px; background: #f3f2ef; border-radius: 4px; display: flex; align-items: center; justify-content: center; margin-right: 15px; color: #6366f1; font-size: 1.5rem; }
        .timeline-role { font-weight: 600; font-size: 1rem; margin-bottom: 2px; }
        .timeline-company { font-size: 0.95rem; color: #000000e6; margin-bottom: 4px; }
        .timeline-date { font-size: 0.85rem; color: #00000099; }
        
        .skill-chip { display: inline-block; background: #f3f2ef; color: #000000e6; padding: 6px 15px; border-radius: 20px; font-size: 0.9rem; font-weight: 600; margin: 0 10px 10px 0; transition: all 0.2s;}
        .skill-chip:hover { background: #e0dfdc; }

        .btn-edit { background: #0a66c2; color: white; border-radius: 20px; font-weight: 600; padding: 6px 20px; border: none; position: absolute; right: 2rem; top: 1.5rem; transition: background 0.2s; }
        .btn-edit:hover { background: #004182; color: white; }
    </style>
</head>
<body>

<?php if(!$hide_nav): ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">SwiftHire Portal</a>
    <div class="d-flex">
        <a href="user_dashboard.php" class="btn btn-outline-light me-2">Dashboard</a>
        <a href="user_logout.php" class="btn btn-danger">Logout</a>
    </div>
  </div>
</nav>
<?php endif; ?>

<div class="container profile-container">
    
    <!-- Hero Profile Card -->
    <div class="card">
        <div class="cover-photo"></div>
        <div class="profile-header">
            <button class="btn btn-edit"><i class="fas fa-pencil-alt me-2"></i>Edit Profile</button>
            <div class="profile-picture">
                <?php echo $initials; ?>
            </div>
            
            <div class="row">
                <div class="col-md-8">
                    <h1 class="name-title"><?php echo $first . ' ' . $last; ?></h1>
                    <div class="headline">Professional Candidate & Top Talent</div>
                    <div class="location mt-2">
                        San Francisco Bay Area · <a href="#" style="color: #0a66c2; font-weight: 600; text-decoration: none;">Contact info</a>
                    </div>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <div class="contact-info">
                        <i class="fas fa-envelope text-muted me-2"></i> <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-8">
            <!-- About Section -->
            <div class="card">
                <div class="card-body">
                    <h2 class="section-title">About</h2>
                    <div class="about-text">
                        Highly motivated and detail-oriented professional with a passion for delivering exceptional results. Experienced in fast-paced environments, capable of solving complex problems, and dedicated to continuous learning. Always looking for the next exciting opportunity to add value to a world-class team.
                    </div>
                </div>
            </div>

            <!-- Experience Section -->
            <div class="card">
                <div class="card-body">
                    <h2 class="section-title">Experience</h2>
                    
                    <div class="timeline-item">
                        <div class="timeline-logo"><i class="fas fa-building"></i></div>
                        <div>
                            <div class="timeline-role">Senior Associate</div>
                            <div class="timeline-company">Global Tech Innovations Inc. · Full-time</div>
                            <div class="timeline-date">Jan 2021 - Present · 3 yrs 4 mos</div>
                            <div class="timeline-date">San Francisco, California, United States</div>
                            <div class="about-text mt-2" style="font-size: 0.9rem;">Spearheaded major software integrations that increased team efficiency by 40% over two years.</div>
                        </div>
                    </div>
                    
                    <hr style="border-top: 1px solid rgba(0,0,0,0.08); margin: 1.5rem 0;">

                    <div class="timeline-item">
                        <div class="timeline-logo"><i class="fas fa-laptop-code"></i></div>
                        <div>
                            <div class="timeline-role">Analyst</div>
                            <div class="timeline-company">DataStream Analytics</div>
                            <div class="timeline-date">Jun 2018 - Dec 2020 · 2 yrs 7 mos</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-4">
            <!-- Skills Section -->
            <div class="card">
                <div class="card-body">
                    <h2 class="section-title">Top Skills</h2>
                    <div class="skill-chip">Project Management</div>
                    <div class="skill-chip">Data Analysis</div>
                    <div class="skill-chip">Problem Solving</div>
                    <div class="skill-chip">Communication</div>
                    <div class="skill-chip">Agile Methodologies</div>
                    <div class="skill-chip">Leadership</div>
                </div>
            </div>

            <!-- Education Section -->
            <div class="card">
                <div class="card-body">
                    <h2 class="section-title">Education</h2>
                    <div class="timeline-item mt-3">
                        <div class="timeline-logo" style="background: transparent; color: #00000099;"><i class="fas fa-university"></i></div>
                        <div>
                            <div class="timeline-role">University of Technology</div>
                            <div class="timeline-company">Bachelor of Science</div>
                            <div class="timeline-date">2014 - 2018</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>
