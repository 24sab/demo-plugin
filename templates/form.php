<div class="my-plugin-form">
    <h3>Simple Form</h3>
    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <input type="hidden" name="action" value="my_plugin_save_form">
        <input type="text" name="my_name" placeholder="Your Name" required>
        <button type="submit">Submit</button>
    </form>
</div>
