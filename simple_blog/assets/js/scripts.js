$(document).ready(function() {
    // Delete post using Ajax
    $(document).on('click', '.delete-post', function() {
        var postId = $(this).data('id');
        if (confirm('Are you sure you want to delete this post?')) {
            $.ajax({
                url: 'admin/delete_post.php',
                type: 'POST',
                data: { id: postId },
                success: function(response) {
                    if (response == 'success') {
                        location.reload();
                    } else {
                        alert('Failed to delete the post.');
                    }
                }
            });
        }
    });
});
