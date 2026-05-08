<?php include 'includes/header.php'; ?>

<!-- Page Header -->
<section class="section-padding" style="background: linear-gradient(var(--secondary), #2d4a53); color: white; padding-top: 150px; text-align: center;">
    <div class="container">
        <h1 style="font-size: 3.5rem; margin-bottom: 10px;">Support Our Mission</h1>
        <p style="font-size: 1.2rem; opacity: 0.9;">Your gift today creates a better tomorrow.</p>
    </div>
</section>

<!-- Donation Section -->
<section class="section-padding">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 60px;">
            
            <!-- Payment Form / Options -->
            <div>
                <div class="section-title" style="text-align: left;">
                    <h2 style="margin-top: 10px;">Choose a Donation Category</h2>
                    <div class="section-divider" style="margin: 20px 0;"></div>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px;">
                    <button style="padding: 20px; border: 2px solid var(--primary); border-radius: 15px; background: white; text-align: center; cursor: pointer; transition: var(--transition);">
                        <h4 style="color: var(--primary);">₹ 1,000</h4>
                        <p style="font-size: 0.8rem; color: var(--text-muted);">Edu kit for 1 Child</p>
                    </button>
                    <button style="padding: 20px; border: 1px solid #ddd; border-radius: 15px; background: white; text-align: center; cursor: pointer; transition: var(--transition);">
                        <h4 style="color: var(--secondary);">₹ 2,500</h4>
                        <p style="font-size: 0.8rem; color: var(--text-muted);">Medical Checkup Camp</p>
                    </button>
                    <button style="padding: 20px; border: 1px solid #ddd; border-radius: 15px; background: white; text-align: center; cursor: pointer; transition: var(--transition);">
                        <h4 style="color: var(--secondary);">₹ 5,000</h4>
                        <p style="font-size: 0.8rem; color: var(--text-muted);">Vocational Training</p>
                    </button>
                    <button style="padding: 20px; border: 1px solid #ddd; border-radius: 15px; background: white; text-align: center; cursor: pointer; transition: var(--transition);">
                        <h4 style="color: var(--secondary);">Custom</h4>
                        <p style="font-size: 0.8rem; color: var(--text-muted);">Enter Amount</p>
                    </button>
                </div>

                <div style="background: var(--bg-light); padding: 30px; border-radius: 20px;">
                    <h4 style="margin-bottom: 20px;">Secure Online Payment</h4>
                    <p style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 25px;">Pay via Razorpay, UPI, or Credit/Debit Card.</p>
                    <a href="#" class="btn-donate" style="display: block; text-align: center; padding: 18px;">Proceed to Pay Securely</a>
                    
                    <div style="margin-top: 25px; display: flex; justify-content: center; gap: 20px; opacity: 0.5;">
                        <i class="fab fa-cc-visa fa-2x"></i>
                        <i class="fab fa-cc-mastercard fa-2x"></i>
                        <i class="fab fa-google-pay fa-2x"></i>
                        <i class="fas fa-university fa-2x"></i>
                    </div>
                </div>
            </div>

            <!-- Alternative Methods -->
            <div>
                <div style="background: white; padding: 40px; border-radius: 20px; box-shadow: var(--shadow); border: 1px solid var(--bg-light);">
                    <h3 style="margin-bottom: 30px; color: var(--secondary);">Bank Transfer / UPI</h3>
                    
                    <div style="text-align: center; margin-bottom: 30px;">
                        <!-- Placeholder for QR Code -->
                        <div style="width: 200px; height: 200px; background: #eee; border-radius: 10px; margin: 0 auto 15px; display: flex; align-items: center; justify-content: center; border: 2px dashed #ccc;">
                            <i class="fas fa-qrcode fa-5x" style="color: #999;"></i>
                        </div>
                        <p style="font-weight: 600;">Scan to Pay via UPI</p>
                        <p style="color: var(--primary); font-family: monospace;">compassionhub@upi</p>
                    </div>

                    <div style="border-top: 1px solid #eee; padding-top: 30px;">
                        <h4 style="margin-bottom: 15px;">Direct Bank Deposit:</h4>
                        <table style="width: 100%; font-size: 0.95rem; line-height: 2;">
                            <tr>
                                <td style="color: var(--text-muted);">Bank Name:</td>
                                <td style="font-weight: 600;">HDFC Bank</td>
                            </tr>
                            <tr>
                                <td style="color: var(--text-muted);">Account Name:</td>
                                <td style="font-weight: 600;">Compassion Hub Foundation</td>
                            </tr>
                            <tr>
                                <td style="color: var(--text-muted);">Account No:</td>
                                <td style="font-weight: 600;">50100123456789</td>
                            </tr>
                            <tr>
                                <td style="color: var(--text-muted);">IFSC Code:</td>
                                <td style="font-weight: 600;">HDFC0001234</td>
                            </tr>
                            <tr>
                                <td style="color: var(--text-muted);">Branch:</td>
                                <td style="font-weight: 600;">Central Park, City Name</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Transparency Info -->
<section class="section-padding" style="background: var(--bg-light);">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px;">
            <div style="text-align: center;">
                <i class="fas fa-shield-alt fa-3x" style="color: var(--primary); margin-bottom: 20px;"></i>
                <h3>100% Tax Benefit</h3>
                <p style="color: var(--text-muted); margin-top: 10px;">All donations are exempt under section 80G of the Income Tax Act.</p>
            </div>
            <div style="text-align: center;">
                <i class="fas fa-chart-line fa-3x" style="color: var(--primary); margin-bottom: 20px;"></i>
                <h3>Transparent Spending</h3>
                <p style="color: var(--text-muted); margin-top: 10px;">92% of all donations go directly towards our community programs.</p>
            </div>
            <div style="text-align: center;">
                <i class="fas fa-envelope-open-text fa-3x" style="color: var(--primary); margin-bottom: 20px;"></i>
                <h3>Auto-Generated Receipts</h3>
                <p style="color: var(--text-muted); margin-top: 10px;">Receive your donation receipt instantly via email for tax purposes.</p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
