<?php include 'includes/header.php'; ?>

<!-- Page Header -->
<section class="section-padding" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1423666639041-f56000c27a9a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center; color: white; padding-top: 150px; text-align: center;">
    <div class="container">
        <h1 style="font-size: 3.5rem; margin-bottom: 10px;">Contact Us</h1>
        <p style="font-size: 1.2rem; opacity: 0.9;">We'd love to hear from you. Get in touch with our team.</p>
    </div>
</section>

<!-- Contact Content -->
<section class="section-padding">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 50px;">
            
            <!-- Contact Info -->
            <div style="display: flex; flex-direction: column; gap: 40px;">
                <div>
                    <h2 style="color: var(--secondary); margin-bottom: 25px;">Get in Touch</h2>
                    <p style="color: var(--text-muted); margin-bottom: 30px;">Have questions about our programs or want to support us? Reach out through any of these channels.</p>
                </div>
                
                <div style="display: flex; gap: 20px;">
                    <div style="width: 50px; height: 50px; background: var(--bg-light); color: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <h4 style="margin-bottom: 5px;">Our Office</h4>
                        <p style="color: var(--text-muted); font-size: 0.95rem;">123 Peace Street, NGO Colony, City Name, State - 400001, India.</p>
                    </div>
                </div>
                
                <div style="display: flex; gap: 20px;">
                    <div style="width: 50px; height: 50px; background: var(--bg-light); color: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div>
                        <h4 style="margin-bottom: 5px;">Phone</h4>
                        <p style="color: var(--text-muted); font-size: 0.95rem;">Primary: +91 98765 43210<br>Secondary: +91 98765 01234</p>
                    </div>
                </div>
                
                <div style="display: flex; gap: 20px;">
                    <div style="width: 50px; height: 50px; background: var(--bg-light); color: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <h4 style="margin-bottom: 5px;">Email</h4>
                        <p style="color: var(--text-muted); font-size: 0.95rem;">General Info: hello@compassionhub.org<br>Donations: help@compassionhub.org</p>
                    </div>
                </div>

                <div style="padding: 30px; background: var(--bg-light); border-radius: 20px; display: flex; align-items: center; gap: 20px;">
                    <div style="width: 60px; height: 60px; background: #25d366; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; flex-shrink: 0;">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div>
                        <h4 style="margin-bottom: 5px;">WhatsApp Support</h4>
                        <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 10px;">Chat with us for quick queries.</p>
                        <a href="https://wa.me/919876543210" target="_blank" style="color: #25d366; font-weight: 700;">Start Chat <i class="fas fa-external-link-alt"></i></a>
                    </div>
                </div>
            </div>

            <div style="background: white; padding: 40px; border-radius: 20px; box-shadow: var(--shadow);">
                <h3 style="margin-bottom: 30px; color: var(--secondary);">Send us a Message</h3>
                <div id="contact-response" style="margin-bottom: 20px; padding: 15px; border-radius: 8px; display: none;"></div>
                
                <form id="contact-form" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem;">Full Name</label>
                        <input type="text" name="name" placeholder="Your Name" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-family: inherit;">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem;">Email Address</label>
                        <input type="email" name="email" placeholder="example@email.com" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-family: inherit;">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem;">Subject</label>
                        <input type="text" name="subject" placeholder="How can we help?" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-family: inherit;">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem;">Message</label>
                        <textarea name="message" rows="5" placeholder="Write your message here..." required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-family: inherit; resize: vertical;"></textarea>
                    </div>
                    <button type="submit" class="btn-primary" style="border: none; cursor: pointer; padding: 15px; font-size: 1rem;">Send Message</button>
                </form>
            </div>

<script>
document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const responseDiv = document.getElementById('contact-response');
    
    fetch('contact_process.php', {
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

        </div>
    </div>
</section>

<!-- Map Section -->
<section style="height: 450px; background: #eee; position: relative; overflow: hidden;">
    <!-- Map Placeholder -->
    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: url('https://images.unsplash.com/photo-1526778548025-fa2f459cd5c1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover;">
        <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: var(--shadow); text-align: center; max-width: 300px; position: relative; z-index: 10;">
            <i class="fas fa-map-marker-alt fa-2x" style="color: var(--accent); margin-bottom: 15px;"></i>
            <h4 style="margin-bottom: 10px;">Our Headquarters</h4>
            <p style="font-size: 0.9rem; color: var(--text-muted);">Compassion Hub, 123 Peace Street, City Name.</p>
            <a href="https://maps.google.com" target="_blank" style="display: inline-block; margin-top: 15px; color: var(--primary); font-weight: 600;">Open in Maps</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
