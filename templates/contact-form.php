<div class="my-plugin-form">
    <h3>Contact Us</h3>
    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <input type="hidden" name="action" value="my_plugin_save_contact">
        <p><input type="text" name="contact_name" placeholder="Your Name" required></p>
        <p><input type="email" name="contact_email" placeholder="Your Email" required></p>
        <p><textarea name="contact_message" placeholder="Your Message" required></textarea></p>
        <p><button type="submit">Send</button></p>
    </form>
</div>
