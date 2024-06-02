$(document).ready(function() {
    loadTasks();

    $('#taskForm').on('submit', function(e) {
        e.preventDefault();
        const task = $('#taskInput').val();
        $.ajax({
            url: 'php/add_task.php',
            type: 'POST',
            data: { task: task },
            success: function(response) {
                $('#taskInput').val('');
                loadTasks();
            }
        });
    });

    function loadTasks() {
        $.ajax({
            url: 'php/get_tasks.php',
            type: 'GET',
            success: function(response) {
                $('#taskList').html(response);
            }
        });
    }

    $(document).on('click', '.delete-task', function() {
        const taskId = $(this).data('id');
        $.ajax({
            url: 'php/delete_task.php',
            type: 'POST',
            data: { id: taskId },
            success: function(response) {
                loadTasks();
            }
        });
    });

    $(document).on('click', '.toggle-complete', function() {
        const taskId = $(this).data('id');
        $.ajax({
            url: 'php/toggle_complete.php',
            type: 'POST',
            data: { id: taskId },
            success: function(response) {
                loadTasks();
            }
        });
    });
});
