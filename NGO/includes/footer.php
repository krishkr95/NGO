<footer class="section-padding" style="background: var(--secondary); color: var(--white);">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 50px;">
            <!-- Column 1 -->
            <div>
                <a href="index.php" class="logo" style="color: var(--white); margin-bottom: 20px;">
                    <i class="fas fa-hand-holding-heart"></i>
                    <span>Compassion Hub</span>
                </a>
                <p style="opacity: 0.8; margin-top: 20px;">
                    Empowering marginalized communities through education, health, and sustainable development projects.
                </p>
                <div style="margin-top: 25px; display: flex; gap: 15px;">
                    <a href="#" style="font-size: 1.2rem;"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" style="font-size: 1.2rem;"><i class="fab fa-instagram"></i></a>
                    <a href="#" style="font-size: 1.2rem;"><i class="fab fa-twitter"></i></a>
                    <a href="#" style="font-size: 1.2rem;"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            
            <!-- Column 2 -->
            <div>
                <h4 style="margin-bottom: 25px;">Quick Links</h4>
                <ul style="display: flex; flex-direction: column; gap: 12px; opacity: 0.8;">
                    <li><a href="about.php">Our Story</a></li>
                    <li><a href="programs.php">Our Programs</a></li>
                    <li><a href="volunteer.php">Become a Volunteer</a></li>
                    <li><a href="blog.php">Latest News</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                </ul>
            </div>
            
            <!-- Column 3 -->
            <div>
                <h4 style="margin-bottom: 25px;">Newsletter</h4>
                <p style="opacity: 0.8; margin-bottom: 20px;">Join our mailing list for updates on our impact.</p>
                <form id="newsletter-form" style="display: flex; gap: 10px;">
                    <input type="email" placeholder="Email Address" required style="flex: 1; padding: 12px; border-radius: 5px; border: none;">
                    <button type="submit" style="background: var(--primary); color: white; border: none; padding: 12px 20px; border-radius: 5px; cursor: pointer;">Join</button>
                </form>
            </div>
            
            <!-- Column 4 -->
            <div>
                <h4 style="margin-bottom: 25px;">Contact Info</h4>
                <ul style="display: flex; flex-direction: column; gap: 12px; opacity: 0.8;">
                    <li><i class="fas fa-map-marker-alt" style="margin-right: 10px;"></i> 123 Peace Street, City, State</li>
                    <li><i class="fas fa-phone" style="margin-right: 10px;"></i> +91 98765 43210</li>
                    <li><i class="fas fa-envelope" style="margin-right: 10px;"></i> hello@compassionhub.org</li>
                </ul>
                <div style="margin-top: 20px;">
                    <a href="https://wa.me/919876543210" target="_blank" style="background: #25d366; color: white; padding: 10px 20px; border-radius: 50px; display: inline-flex; align-items: center; gap: 10px;">
                        <i class="fab fa-whatsapp"></i> Chat with Us
                    </a>
                </div>
            </div>
        </div>
        
        <div style="margin-top: 70px; padding-top: 30px; border-top: 1px solid rgba(255,255,255,0.1); text-align: center; opacity: 0.6; font-size: 0.9rem;">
            <p>&copy; <?php echo date('Y'); ?> Compassion Hub NGO. All Rights Reserved. | <a href="privacy.php">Privacy Policy</a></p>
        </div>
    </div>
</footer>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000,
    once: true,
    offset: 100
  });
</script>
<script src="assets/js/main.js"></script>
</body>
</html>
