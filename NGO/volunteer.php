<?php include 'includes/header.php'; ?>

<!-- Page Header -->
<section class="section-padding" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1559027615-cd99713b2148?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center; color: white; padding-top: 150px; text-align: center;">
    <div class="container">
        <h1 style="font-size: 3.5rem; margin-bottom: 10px;">Become a Volunteer</h1>
        <p style="font-size: 1.2rem; opacity: 0.9;">Join our community of change-makers and make an impact.</p>
    </div>
</section>

<!-- Volunteer Content -->
<section class="section-padding">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 80px; align-items: start;">
            
            <!-- Form -->
            <div style="background: white; padding: 40px; border-radius: 20px; box-shadow: var(--shadow);">
                <h3 style="margin-bottom: 30px; color: var(--secondary);">Volunteer Registration</h3>
                <div id="volunteer-response" style="margin-bottom: 20px; padding: 15px; border-radius: 8px; display: none;"></div>
                
                <form id="volunteer-form" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem;">Full Name *</label>
                        <input type="text" name="full_name" placeholder="John Doe" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-family: inherit;">
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem;">Email Address *</label>
                            <input type="email" name="email" placeholder="john@example.com" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-family: inherit;">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem;">Phone Number *</label>
                            <input type="tel" name="phone" placeholder="+91 00000 00000" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-family: inherit;">
                        </div>
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem;">Area of Interest *</label>
                        <select name="interests" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-family: inherit; background: white;">
                            <option value="">Select an option</option>
                            <option value="education">Teaching / Education</option>
                            <option value="health">Health Camps Support</option>
                            <option value="content">Content Writing / Social Media</option>
                            <option value="events">Event Coordination</option>
                            <option value="admin">Administrative Work</option>
                        </select>
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem;">Tell us about yourself & why you want to join</label>
                        <textarea name="message" rows="4" placeholder="Briefly describe your skills and motivation..." style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-family: inherit; resize: vertical;"></textarea>
                    </div>
                    
                    <button type="submit" class="btn-primary" style="border: none; cursor: pointer; padding: 15px; font-size: 1rem;">Submit Application</button>
                    <p style="font-size: 0.8rem; color: var(--text-muted); text-align: center;">We will review your application and get back to you within 3-5 working days.</p>
                </form>
            </div>

<script>
document.getElementById('volunteer-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const responseDiv = document.getElementById('volunteer-response');
    
    fetch('volunteer_process.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        responseDiv.style.display = 'block';
        responseDiv.innerText = data.message;
        if(data.status === 'success') {
            responseDiv.style.background = '#d4edda';
            responseDiv.style.color = '#155724';
            this.reset();
        } else {
            responseDiv.style.background = '#f8d7da';
            responseDiv.style.color = '#721c24';
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
</script>

            <!-- Opportunities & Info -->
            <div>
                <div class="section-title" style="text-align: left;">
                    <h2 style="margin-top: 10px;">Why Volunteer with Us?</h2>
                    <div class="section-divider" style="margin: 20px 0;"></div>
                </div>
                
                <div style="display: flex; flex-direction: column; gap: 30px; margin-top: 40px;">
                    <div style="display: flex; gap: 20px;">
                        <div style="flex-shrink: 0; width: 50px; height: 50px; background: rgba(45, 106, 79, 0.1); color: var(--primary); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <div>
                            <h4 style="color: var(--secondary);">Get Certified</h4>
                            <p style="color: var(--text-muted); font-size: 0.95rem;">Receive an official volunteer certificate and letter of recommendation representing your contribution.</p>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 20px;">
                        <div style="flex-shrink: 0; width: 50px; height: 50px; background: rgba(45, 106, 79, 0.1); color: var(--primary); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <h4 style="color: var(--secondary);">Community & Networking</h4>
                            <p style="color: var(--text-muted); font-size: 0.95rem;">Connect with like-minded individuals and professionals committed to social change.</p>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 20px;">
                        <div style="flex-shrink: 0; width: 50px; height: 50px; background: rgba(45, 106, 79, 0.1); color: var(--primary); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div>
                            <h4 style="color: var(--secondary);">Internship Opportunities</h4>
                            <p style="color: var(--text-muted); font-size: 0.95rem;">Dedicated internship programs for students looking for ground-level experience in social work.</p>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 60px; padding: 40px; background: var(--secondary); color: white; border-radius: 20px;">
                    <h3 style="margin-bottom: 20px;">Current Requirements</h3>
                    <ul style="opacity: 0.8; display: flex; flex-direction: column; gap: 15px;">
                        <li><i class="fas fa-check-circle" style="margin-right: 10px;"></i> Weekend teaching assistants (City Center)</li>
                        <li><i class="fas fa-check-circle" style="margin-right: 10px;"></i> Social media content creators (Remote)</li>
                        <li><i class="fas fa-check-circle" style="margin-right: 10px;"></i> Field health workers (Rural Outreach)</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
