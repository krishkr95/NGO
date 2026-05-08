<?php include 'includes/header.php'; ?>

<!-- Page Header -->
<section class="section-padding" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1593113598332-cd288d649433?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center; color: white; padding-top: 150px; text-align: center;">
    <div class="container">
        <h1 style="font-size: 3.5rem; margin-bottom: 10px;">Our Impact Gallery</h1>
        <p style="font-size: 1.2rem; opacity: 0.9;">Capturing moments of hope and transformation.</p>
    </div>
</section>

<!-- Gallery Grid -->
<section class="section-padding">
    <div class="container">
        <!-- Filter Tabs -->
        <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; margin-bottom: 50px;">
            <button class="gallery-filter-btn" style="padding: 10px 25px; border-radius: 50px; border: 2px solid var(--primary); background: var(--primary); color: white; font-weight: 600; cursor: pointer;">All</button>
            <button class="gallery-filter-btn" style="padding: 10px 25px; border-radius: 50px; border: 1px solid #ddd; background: white; color: var(--text-dark); font-weight: 600; cursor: pointer;">Education</button>
            <button class="gallery-filter-btn" style="padding: 10px 25px; border-radius: 50px; border: 1px solid #ddd; background: white; color: var(--text-dark); font-weight: 600; cursor: pointer;">Health Camps</button>
            <button class="gallery-filter-btn" style="padding: 10px 25px; border-radius: 50px; border: 1px solid #ddd; background: white; color: var(--text-dark); font-weight: 600; cursor: pointer;">Volunteers</button>
            <button class="gallery-filter-btn" style="padding: 10px 25px; border-radius: 50px; border: 1px solid #ddd; background: white; color: var(--text-dark); font-weight: 600; cursor: pointer;">Events</button>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 30px;">
            <!-- Gallery Item 1 -->
            <div style="position: relative; border-radius: 20px; overflow: hidden; height: 300px; box-shadow: var(--shadow); group;">
                <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Education" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.8)); padding: 20px; color: white;">
                    <p style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">Education</p>
                    <h4 style="margin-top: 5px;">Books Distribution 2024</h4>
                </div>
            </div>

            <!-- Gallery Item 2 -->
            <div style="position: relative; border-radius: 20px; overflow: hidden; height: 300px; box-shadow: var(--shadow);">
                <img src="https://images.unsplash.com/photo-1532938911079-1b06ac7ceec7?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Health" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.8)); padding: 20px; color: white;">
                    <p style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">Health</p>
                    <h4 style="margin-top: 5px;">Rural Health Camp</h4>
                </div>
            </div>

            <!-- Gallery Item 3 -->
            <div style="position: relative; border-radius: 20px; overflow: hidden; height: 300px; box-shadow: var(--shadow);">
                <img src="https://images.unsplash.com/photo-1544717297-fa154da09f5b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Events" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.8)); padding: 20px; color: white;">
                    <p style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">Events</p>
                    <h4 style="margin-top: 5px;">Annual Day Celebration</h4>
                </div>
            </div>

            <!-- Gallery Item 4 -->
            <div style="position: relative; border-radius: 20px; overflow: hidden; height: 300px; box-shadow: var(--shadow);">
                <img src="https://images.unsplash.com/photo-1593113598332-cd288d649433?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Volunteers" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.8)); padding: 20px; color: white;">
                    <p style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">Volunteers</p>
                    <h4 style="margin-top: 5px;">Community Kitchen</h4>
                </div>
            </div>

            <!-- Gallery Item 5 -->
            <div style="position: relative; border-radius: 20px; overflow: hidden; height: 300px; box-shadow: var(--shadow);">
                <img src="https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Education" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.8)); padding: 20px; color: white;">
                    <p style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">Education</p>
                    <h4 style="margin-top: 5px;">School for All Initiative</h4>
                </div>
            </div>

            <!-- Gallery Item 6 -->
            <div style="position: relative; border-radius: 20px; overflow: hidden; height: 300px; box-shadow: var(--shadow);">
                <img src="https://images.unsplash.com/photo-1541976844346-f18aeac57b06?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Women" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.8)); padding: 20px; color: white;">
                    <p style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">Empowerment</p>
                    <h4 style="margin-top: 5px;">Tailoring Workshop</h4>
                </div>
            </div>
        </div>
        
        <div style="margin-top: 60px; text-align: center;">
            <button class="btn-secondary" style="color: var(--secondary); border-color: var(--secondary);">Load More Moments</button>
        </div>
    </div>
</section>

<!-- Video Highlights -->
<section class="section-padding" style="background: var(--bg-light);">
    <div class="container">
        <div class="section-title text-center">
            <h2>Video Highlights</h2>
            <div class="section-divider"></div>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 40px; margin-top: 50px;">
            <div style="position: relative; border-radius: 20px; overflow: hidden; background: #000; height: 300px;">
                <img src="https://images.unsplash.com/photo-1526778548025-fa2f459cd5c1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Video Placeholder" style="width: 100%; height: 100%; object-fit: cover; opacity: 0.6;">
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; text-align: center;">
                    <i class="fas fa-play-circle fa-5x" style="cursor: pointer; opacity: 0.8; transition: var(--transition);"></i>
                    <h4 style="margin-top: 20px;">Impact Journey 2024</h4>
                </div>
            </div>
            <div style="position: relative; border-radius: 20px; overflow: hidden; background: #000; height: 300px;">
                <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Video Placeholder" style="width: 100%; height: 100%; object-fit: cover; opacity: 0.6;">
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; text-align: center;">
                    <i class="fas fa-play-circle fa-5x" style="cursor: pointer; opacity: 0.8; transition: var(--transition);"></i>
                    <h4 style="margin-top: 20px;">Volunteer Stories</h4>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
