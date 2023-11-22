$(document).ready(function () {
    $('#table_id').DataTable({
        paging: true,
        ordering: true, // Enable sorting
        order: [], // Default ordering (none)
        info: false,
        responsive: true,
    });
});