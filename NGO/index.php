<?php include 'includes/header.php'; ?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content" data-aos="fade-right">
            <h1>Giving Hope to those who need it most.</h1>
            <p>Every small contribution brings a big change. Join Compassion Hub in its mission to create a world where every individual has the opportunity to thrive.</p>
            <div class="hero-btns" data-aos="fade-up" data-aos-delay="200">
                <a href="donate.php" class="btn-primary">Donate Now</a>
                <a href="about.php" class="btn-secondary">Learn More</a>
            </div>
        </div>
    </div>
</section>

<!-- Impact Stats -->
<section class="container" style="margin-top: -80px;" data-aos="zoom-in" data-aos-delay="400">
    <div class="stats-grid">
        <div class="stat-item text-center">
            <h3>15k+</h3>
            <p>Lives Impacted</p>
        </div>
        <div class="stat-item text-center">
            <h3>50+</h3>
            <p>Active Projects</p>
        </div>
        <div class="stat-item text-center">
            <h3>200+</h3>
            <p>Volunteers</p>
        </div>
        <div class="stat-item text-center">
            <h3>12+</h3>
            <p>Cities Covered</p>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="section-padding">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 60px; align-items: center;">
            <div>
                <img src="https://images.unsplash.com/photo-1593113598332-cd288d649433?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Our Impact" style="border-radius: 20px; box-shadow: var(--shadow);">
            </div>
            <div data-aos="fade-left">
                <div class="section-title" style="text-align: left;">
                    <span style="color: var(--primary); font-weight: 600; text-transform: uppercase; letter-spacing: 2px;">About Compassion Hub</span>
                    <h2 style="margin-top: 10px;">Helping People in Need Since 2015</h2>
                    <div class="section-divider" style="margin: 20px 0;"></div>
                </div>
                <p style="margin-bottom: 25px; color: var(--text-muted);">
                    Compassion Hub is a non-governmental organization dedicated to improving the lives of underprivileged communities in India. Our holistic approach focuses on education, healthcare, and livelihood support.
                </p>
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    <div style="display: flex; gap: 15px; align-items: flex-start;" data-aos="fade-up" data-aos-delay="100">
                        <i class="fas fa-check-circle" style="color: var(--primary); margin-top: 5px;"></i>
                        <div>
                            <h4 style="color: var(--secondary);">Our Mission</h4>
                            <p style="font-size: 0.95rem; color: var(--text-muted);">To provide quality education and healthcare to children and families in need.</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 15px; align-items: flex-start;" data-aos="fade-up" data-aos-delay="200">
                        <i class="fas fa-check-circle" style="color: var(--primary); margin-top: 5px;"></i>
                        <div>
                            <h4 style="color: var(--secondary);">Our Vision</h4>
                            <p style="font-size: 0.95rem; color: var(--text-muted);">A society where every person lives with dignity and self-reliance.</p>
                        </div>
                    </div>
                </div>
                <a href="about.php" class="btn-primary" style="display: inline-block; margin-top: 35px;" data-aos="fade-up" data-aos-delay="300">Read Full Story</a>
            </div>
        </div>
    </div>
</section>

<!-- Featured Programs -->
<section class="section-padding" style="background: #fff;">
    <div class="container">
        <div class="section-title text-center">
            <h2>Our Core Programs</h2>
            <div class="section-divider"></div>
            <p style="margin-top: 20px; max-width: 600px; margin-left: auto; margin-right: auto; color: var(--text-muted);">
                We address the root causes of poverty through targeted interventions in key areas of human development.
            </p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-top: 50px;">
            <!-- Program 1 -->
            <div class="program-card" style="background: var(--bg-light); border-radius: 20px; overflow: hidden; transition: var(--transition);" data-aos="fade-up" data-aos-delay="100">
                <img src="https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Education">
                <div style="padding: 30px;">
                    <h3 style="color: var(--secondary); margin-bottom: 15px;">Education Support</h3>
                    <p style="color: var(--text-muted); margin-bottom: 20px;">Providing school supplies, coaching, and scholarships to children from low-income families.</p>
                    <a href="programs.php#education" style="color: var(--primary); font-weight: 600;">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            
            <!-- Program 2 -->
            <div class="program-card" style="background: var(--bg-light); border-radius: 20px; overflow: hidden; transition: var(--transition);" data-aos="fade-up" data-aos-delay="200">
                <img src="https://images.unsplash.com/photo-1532938911079-1b06ac7ceec7?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Healthcare">
                <div style="padding: 30px;">
                    <h3 style="color: var(--secondary); margin-bottom: 15px;">Health Camps</h3>
                    <p style="color: var(--text-muted); margin-bottom: 20px;">Regular medical check-ups, medicine distribution, and awareness programs in rural areas.</p>
                    <a href="programs.php#health" style="color: var(--primary); font-weight: 600;">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            
            <!-- Program 3 -->
            <div class="program-card" style="background: var(--bg-light); border-radius: 20px; overflow: hidden; transition: var(--transition);" data-aos="fade-up" data-aos-delay="300">
                <img src="https://images.unsplash.com/photo-1541976844346-f18aeac57b06?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Women Empowerment">
                <div style="padding: 30px;">
                    <h3 style="color: var(--secondary); margin-bottom: 15px;">Women Empowerment</h3>
                    <p style="color: var(--text-muted); margin-bottom: 20px;">Vocational training and micro-finance support for women to start their own small businesses.</p>
                    <a href="programs.php#women" style="color: var(--primary); font-weight: 600;">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="section-padding" style="background: var(--primary); color: white; text-align: center;">
    <div class="container">
        <h2 style="font-size: 2.5rem; margin-bottom: 20px;">Ready to help make a difference?</h2>
        <p style="font-size: 1.2rem; margin-bottom: 40px; opacity: 0.9; max-width: 700px; margin-left: auto; margin-right: auto;">
            Your support can provide education, healthcare, and a better future for those in need. Every contribution counts.
        </p>
        <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
            <a href="donate.php" class="btn-donate" style="padding: 18px 45px; font-size: 1.1rem; background: var(--white); color: var(--primary) !important;">Donate Today</a>
            <a href="volunteer.php" class="btn-secondary" style="padding: 18px 45px; font-size: 1.1rem; border-color: var(--white);">Join as Volunteer</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
