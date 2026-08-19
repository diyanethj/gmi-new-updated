<?php use Gmg\Events\Core\Auth; ?>
<div class="panel">
    <div class="panel-head">
        <div>
            <h2>Footer Contact Details</h2>
            <div class="hint">Update the contact information and social media links displayed in the home.php footer.</div>
        </div>
        <a class="btn btn-secondary" href="<?= e(base_url('index.php')) ?>" target="_blank" rel="noopener">
            <i class="fas fa-eye"></i>View Homepage
        </a>
    </div>

    <div class="panel-body">
        <form method="post" action="<?= e(admin_url('footer-contact-update')) ?>">
            <?= csrf_field() ?>

            <style>
                .footer-contact-admin-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:20px}
                .footer-contact-admin-field{display:flex;flex-direction:column;gap:8px}
                .footer-contact-admin-field.full{grid-column:1/-1}
                .footer-contact-admin-field label{font-weight:700}
                .footer-contact-admin-field input,.footer-contact-admin-field textarea{width:100%;padding:12px 14px;border:1px solid #d9e1ea;border-radius:8px;background:#fff;font:inherit}
                .footer-contact-admin-field textarea{min-height:110px;resize:vertical}
                .footer-contact-admin-section{grid-column:1/-1;margin-top:6px;padding-top:18px;border-top:1px solid #e8edf2}
                .footer-contact-admin-section h3{margin:0 0 5px}
                .footer-contact-admin-section p{margin:0;color:#738091;font-size:13px}
                @media(max-width:760px){.footer-contact-admin-grid{grid-template-columns:1fr}.footer-contact-admin-field.full,.footer-contact-admin-section{grid-column:auto}}
            </style>

            <div class="footer-contact-admin-grid">
                <div class="footer-contact-admin-field full">
                    <label for="footer-address">Address</label>
                    <textarea id="footer-address" name="address" maxlength="500" required><?= e($contact['address']) ?></textarea>
                </div>

                <div class="footer-contact-admin-field">
                    <label for="footer-phone">Phone</label>
                    <input id="footer-phone" type="text" name="phone" maxlength="80" required value="<?= e($contact['phone']) ?>">
                </div>

                <div class="footer-contact-admin-field">
                    <label for="footer-email">Email</label>
                    <input id="footer-email" type="email" name="email" maxlength="190" required value="<?= e($contact['email']) ?>">
                </div>

                <div class="footer-contact-admin-field full">
                    <label for="footer-hours">Office Hours</label>
                    <input id="footer-hours" type="text" name="office_hours" maxlength="190" required value="<?= e($contact['office_hours']) ?>">
                </div>

                <div class="footer-contact-admin-section">
                    <h3>Social Media Links</h3>
                    <p>Leave a field empty if you do not want that social icon displayed in the footer.</p>
                </div>

                <div class="footer-contact-admin-field">
                    <label for="footer-linkedin">LinkedIn URL</label>
                    <input id="footer-linkedin" type="url" name="linkedin_url" maxlength="500" placeholder="https://www.linkedin.com/company/..." value="<?= e($contact['linkedin_url'] ?? '') ?>">
                </div>

                <div class="footer-contact-admin-field">
                    <label for="footer-facebook">Facebook URL</label>
                    <input id="footer-facebook" type="url" name="facebook_url" maxlength="500" placeholder="https://www.facebook.com/..." value="<?= e($contact['facebook_url'] ?? '') ?>">
                </div>

                <div class="footer-contact-admin-field">
                    <label for="footer-instagram">Instagram URL</label>
                    <input id="footer-instagram" type="url" name="instagram_url" maxlength="500" placeholder="https://www.instagram.com/..." value="<?= e($contact['instagram_url'] ?? '') ?>">
                </div>

                <div class="footer-contact-admin-field">
                    <label for="footer-tiktok">TikTok URL</label>
                    <input id="footer-tiktok" type="url" name="tiktok_url" maxlength="500" placeholder="https://www.tiktok.com/@..." value="<?= e($contact['tiktok_url'] ?? '') ?>">
                </div>

                <div class="footer-contact-admin-field full">
                    <label for="footer-youtube">YouTube URL</label>
                    <input id="footer-youtube" type="url" name="youtube_url" maxlength="500" placeholder="https://www.youtube.com/@..." value="<?= e($contact['youtube_url'] ?? '') ?>">
                </div>
            </div>

            <div class="form-actions">
                <?php if (Auth::can('footer_contact.edit')): ?>
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-floppy-disk"></i>Save Footer Contact Details
                    </button>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>