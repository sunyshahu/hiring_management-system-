<?php
session_start();
if (!isset($_SESSION['user_id']) && !isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
$hide_nav = isset($_GET['nomdi']) && $_GET['nomdi'] == '1';
$nomdi_param = $hide_nav ? '&nomdi=1' : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SwiftHire - Job Board</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f0f2f5; color: #1e1e2d; }
        .hero-header { background: linear-gradient(135deg, #1e1e2d 0%, #3f4254 100%); padding: 4rem 0 5rem; color: white; border-radius: 0 0 25px 25px; margin-bottom: 2rem; position: relative;}
        .search-box { background: white; padding: 10px; border-radius: 50px; display: flex; align-items: center; box-shadow: 0 10px 30px rgba(0,0,0,0.1); max-width: 700px; margin: 0 auto; position: absolute; bottom: 0; left: 50%; transform: translate(-50%, 50%); width: 90%; }
        .search-box input { border: none; outline: none; flex-grow: 1; padding: 10px 20px; font-size: 1.1rem; }
        .search-box i { color: #a1a5b7; margin-left: 15px; font-size: 1.2rem; }
        .search-box .btn-search { background: #6366f1; color: white; border-radius: 50px; padding: 10px 30px; font-weight: 600; }
        
        .filter-sidebar { background: white; padding: 1.5rem; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.03); }
        .filter-title { font-weight: 700; font-size: 1.1rem; margin-bottom: 1rem; color: #1e1e2d; }
        .form-check-label { color: #565674; font-weight: 400; }
        
        .job-card { background: white; border-radius: 15px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 5px 15px rgba(0,0,0,0.03); border: 1px solid transparent; transition: all 0.2s; display: flex; align-items: center; justify-content: space-between; }
        .job-card:hover { transform: translateY(-3px); border-color: #a5b4fc; box-shadow: 0 10px 25px rgba(99, 102, 241, 0.15); }
        .company-logo { width: 60px; height: 60px; border-radius: 12px; object-fit: contain; background: #f8f9fa; padding: 5px; margin-right: 1.5rem; border: 1px solid #eef0f8;}
        .job-title { font-weight: 700; font-size: 1.2rem; color: #1e1e2d; margin-bottom: 5px; }
        .company-name { color: #6366f1; font-weight: 600; font-size: 0.95rem; margin-bottom: 8px;}
        .job-meta span { background: #f4f6f9; color: #565674; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; margin-right: 8px; }
        
        .btn-apply { background: white; color: #6366f1; border: 2px solid #6366f1; font-weight: 600; border-radius: 10px; padding: 8px 25px; transition: all 0.2s;}
        .btn-apply:hover { background: #6366f1; color: white; }

        .nomatch-msg { display: none; text-align: center; padding: 3rem; color: #a1a5b7; }
    </style>
</head>
<body>

<?php if(!$hide_nav): ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">SwiftHire Portal</a>
    <div class="d-flex">
        <a href="user_dashboard.php" class="btn btn-outline-light me-2">Dashboard</a>
        <a href="user_logout.php" class="btn btn-danger">Logout</a>
    </div>
  </div>
</nav>
<?php endif; ?>

<div class="hero-header text-center">
    <div class="container">
        <h1 style="font-weight: 700;">Discover your next career</h1>
        <p style="color: #a1a5b7; font-size: 1.1rem; margin-bottom: 2rem;">Explore thousands of roles from world-class teams</p>
    </div>
    <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" id="searchInput" placeholder="Search by job title, company, or keywords...">
        <button class="btn btn-search">Search</button>
    </div>
</div>

<div class="container" style="margin-top: 5rem;">
    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-md-3">
            <div class="filter-sidebar">
                <div class="filter-group mb-4">
                    <div class="filter-title">Work Mode</div>
                    <div class="form-check mb-2">
                        <input class="form-check-input filter-type" type="checkbox" value="Remote" id="mode1">
                        <label class="form-check-label" for="mode1">Remote</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input filter-type" type="checkbox" value="Hybrid" id="mode2">
                        <label class="form-check-label" for="mode2">Hybrid</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input filter-type" type="checkbox" value="On-site" id="mode3">
                        <label class="form-check-label" for="mode3">On-site</label>
                    </div>
                </div>

                <div class="filter-group">
                    <div class="filter-title">Industry Category</div>
                    <div class="form-check mb-2">
                        <input class="form-check-input filter-cat" type="checkbox" value="Engineering" id="cat1">
                        <label class="form-check-label" for="cat1">Engineering</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input filter-cat" type="checkbox" value="Design" id="cat2">
                        <label class="form-check-label" for="cat2">Design UI/UX</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input filter-cat" type="checkbox" value="Marketing" id="cat3">
                        <label class="form-check-label" for="cat3">Marketing</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Job Grid -->
        <div class="col-md-9" id="jobGrid">
            
            <div class="job-card" data-title="senior full stack software engineer spotify technology" data-type="Remote" data-cat="Engineering">
                <div class="d-flex align-items-center">
                    <img src="https://logo.clearbit.com/spotify.com" onerror="this.src='images/logo.png'" class="company-logo">
                    <div>
                        <div class="company-name">Spotify Technology</div>
                        <div class="job-title">Senior Full Stack Engineer</div>
                        <div class="job-meta">
                            <span><i class="fas fa-map-marker-alt"></i> Remote</span>
                            <span><i class="fas fa-briefcase"></i> Full-Time</span>
                            <span>$130k - $160k</span>
                        </div>
                    </div>
                </div>
                <div>
                    <a href="apply.php?job=Senior Full Stack Engineer (Spotify)<?php echo $nomdi_param; ?>" class="btn btn-apply">Apply Now</a>
                </div>
            </div>

            <div class="job-card" data-title="product designer ui ux apple inc" data-type="Hybrid" data-cat="Design">
                <div class="d-flex align-items-center">
                    <img src="https://logo.clearbit.com/apple.com" onerror="this.src='images/logo.png'" class="company-logo">
                    <div>
                        <div class="company-name">Apple Inc.</div>
                        <div class="job-title">Product Designer (UI/UX)</div>
                        <div class="job-meta">
                            <span><i class="fas fa-map-marker-alt"></i> Hybrid, Cupertino</span>
                            <span><i class="fas fa-briefcase"></i> Full-Time</span>
                            <span>$150k - $180k</span>
                        </div>
                    </div>
                </div>
                <div>
                    <a href="apply.php?job=Product Designer (Apple)<?php echo $nomdi_param; ?>" class="btn btn-apply">Apply Now</a>
                </div>
            </div>

            <div class="job-card" data-title="front end web developer netflix" data-type="Remote" data-cat="Engineering">
                <div class="d-flex align-items-center">
                    <img src="https://logo.clearbit.com/netflix.com" onerror="this.src='images/logo.png'" class="company-logo">
                    <div>
                        <div class="company-name">Netflix</div>
                        <div class="job-title">Front-End Web Developer</div>
                        <div class="job-meta">
                            <span><i class="fas fa-map-marker-alt"></i> Remote</span>
                            <span><i class="fas fa-briefcase"></i> Contract</span>
                            <span>$90k - $120k</span>
                        </div>
                    </div>
                </div>
                <div>
                    <a href="apply.php?job=Front End Developer (Netflix)<?php echo $nomdi_param; ?>" class="btn btn-apply">Apply Now</a>
                </div>
            </div>

            <div class="job-card" data-title="global brand marketing manager nike" data-type="On-site" data-cat="Marketing">
                <div class="d-flex align-items-center">
                    <img src="https://logo.clearbit.com/nike.com" onerror="this.src='images/logo.png'" class="company-logo">
                    <div>
                        <div class="company-name">Nike</div>
                        <div class="job-title">Global Brand Marketing Manager</div>
                        <div class="job-meta">
                            <span><i class="fas fa-map-marker-alt"></i> On-site, Oregon</span>
                            <span><i class="fas fa-briefcase"></i> Full-Time</span>
                            <span>$110k - $130k</span>
                        </div>
                    </div>
                </div>
                <div>
                    <a href="apply.php?job=Brand Marketing Manager (Nike)<?php echo $nomdi_param; ?>" class="btn btn-apply">Apply Now</a>
                </div>
            </div>

            <div class="nomatch-msg" id="noMatchMsg">
                <h4><i class="fas fa-search me-2"></i> No jobs found matching your filters.</h4>
            </div>

        </div>
    </div>
</div>

<script>
    // Filtering Logic
    const searchInput = document.getElementById('searchInput');
    const checkboxesType = document.querySelectorAll('.filter-type');
    const checkboxesCat = document.querySelectorAll('.filter-cat');
    const jobCards = document.querySelectorAll('.job-card');
    const noMatchMsg = document.getElementById('noMatchMsg');

    function filterJobs() {
        const query = searchInput.value.toLowerCase();
        
        let activeTypes = Array.from(checkboxesType).filter(i => i.checked).map(i => i.value);
        let activeCats = Array.from(checkboxesCat).filter(i => i.checked).map(i => i.value);

        let visibleCount = 0;

        jobCards.forEach(card => {
            const title = card.getAttribute('data-title');
            const type = card.getAttribute('data-type');
            const cat = card.getAttribute('data-cat');
            
            let matchesSearch = title.includes(query) || query === '';
            let matchesType = activeTypes.length === 0 || activeTypes.includes(type);
            let matchesCat = activeCats.length === 0 || activeCats.includes(cat);

            if (matchesSearch && matchesType && matchesCat) {
                card.style.display = "flex";
                visibleCount++;
            } else {
                card.style.display = "none";
            }
        });

        if(visibleCount === 0) {
            noMatchMsg.style.display = "block";
        } else {
            noMatchMsg.style.display = "none";
        }
    }

    searchInput.addEventListener('keyup', filterJobs);
    checkboxesType.forEach(cb => cb.addEventListener('change', filterJobs));
    checkboxesCat.forEach(cb => cb.addEventListener('change', filterJobs));
</script>

</body>
</html>
