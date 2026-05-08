<?php include 'includes/header.php'; ?>

<!-- Page Header -->
<section class="section-padding" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center; color: white; padding-top: 150px; text-align: center;">
    <div class="container">
        <h1 style="font-size: 3.5rem; margin-bottom: 10px;">NGO Blog & News</h1>
        <p style="font-size: 1.2rem; opacity: 0.9;">Latest updates, success stories, and our activities.</p>
    </div>
</section>

<!-- Blog Section -->
<section class="section-padding">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 40px;">
            
            <!-- Blog Card 1 -->
            <article style="background: white; border-radius: 20px; overflow: hidden; box-shadow: var(--shadow); transition: var(--transition);">
                <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Success Story" style="width: 100%; height: 250px; object-fit: cover;">
                <div style="padding: 30px;">
                    <div style="display: flex; gap: 15px; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 15px;">
                        <span><i class="fas fa-calendar-alt"></i> March 15, 2024</span>
                        <span><i class="fas fa-tag"></i> Success Story</span>
                    </div>
                    <h3 style="margin-bottom: 15px; color: var(--secondary);"><a href="#">How Education Changed Rohan's Life Forever</a></h3>
                    <p style="color: var(--text-muted); margin-bottom: 20px;">Rohan, a former street child, is now pursuing his dreams of becoming an engineer thanks to our scholarship program...</p>
                    <a href="#" style="color: var(--primary); font-weight: 700;">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>

            <!-- Blog Card 2 -->
            <article style="background: white; border-radius: 20px; overflow: hidden; box-shadow: var(--shadow); transition: var(--transition);">
                <img src="https://images.unsplash.com/photo-1544717297-fa154da09f5b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Activity" style="width: 100%; height: 250px; object-fit: cover;">
                <div style="padding: 30px;">
                    <div style="display: flex; gap: 15px; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 15px;">
                        <span><i class="fas fa-calendar-alt"></i> March 10, 2024</span>
                        <span><i class="fas fa-tag"></i> NGO Activity</span>
                    </div>
                    <h3 style="margin-bottom: 15px; color: var(--secondary);"><a href="#">Mega Health Camp Conducted in 5 Villages</a></h3>
                    <p style="color: var(--text-muted); margin-bottom: 20px;">Our medical team successfully reached out to over 1,200 people during the intensive three-day health drive...</p>
                    <a href="#" style="color: var(--primary); font-weight: 700;">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>

            <!-- Blog Card 3 -->
            <article style="background: white; border-radius: 20px; overflow: hidden; box-shadow: var(--shadow); transition: var(--transition);">
                <img src="https://images.unsplash.com/photo-1541976844346-f18aeac57b06?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Awareness" style="width: 100%; height: 250px; object-fit: cover;">
                <div style="padding: 30px;">
                    <div style="display: flex; gap: 15px; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 15px;">
                        <span><i class="fas fa-calendar-alt"></i> March 01, 2024</span>
                        <span><i class="fas fa-tag"></i> Awareness</span>
                    </div>
                    <h3 style="margin-bottom: 15px; color: var(--secondary);"><a href="#">Empowering Women Through Digital Literacy</a></h3>
                    <p style="color: var(--text-muted); margin-bottom: 20px;">Understanding the digital world has opened new doors for women artisans in our small business collective...</p>
                    <a href="#" style="color: var(--primary); font-weight: 700;">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>
        </div>
        
        <!-- Pagination -->
        <div style="display: flex; justify-content: center; gap: 10px; margin-top: 60px;">
            <a href="#" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 5px; background: var(--primary); color: white;">1</a>
            <a href="#" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 5px; border: 1px solid #ddd; color: var(--text-dark);">2</a>
            <a href="#" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 5px; border: 1px solid #ddd; color: var(--text-dark);"><i class="fas fa-chevron-right"></i></a>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="section-padding" style="background: var(--bg-light);">
    <div class="container">
        <div style="background: var(--primary); padding: 60px; border-radius: 30px; color: white; display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px; align-items: center;">
            <div>
                <h2 style="font-size: 2.5rem; margin-bottom: 15px;">Stay Informed</h2>
                <p style="opacity: 0.9;">Subscribe to our newsletter and get monthly updates on our impact and stories from the field.</p>
            </div>
            <form style="display: flex; gap: 15px; flex-wrap: wrap;">
                <input type="email" placeholder="Your Email Address" required style="flex: 1; min-width: 250px; padding: 18px 25px; border-radius: 50px; border: none; outline: none;">
                <button type="submit" class="btn-donate" style="padding: 18px 35px; background: var(--secondary); border: none; cursor: pointer;">Subscribe</button>
            </form>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
