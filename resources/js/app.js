// Import jQuery and make it globally accessible
import $ from 'jquery';
window.$ = window.jQuery = $;

// Import Bootstrap and DataTables
import './bootstrap';
import 'datatables.net';
import 'datatables.net-dt/css/dataTables.dataTables.css';

// Import DataTables Buttons Extension
import 'datatables.net-buttons/js/dataTables.buttons.min.js';
import 'datatables.net-buttons-dt/css/buttons.dataTables.css';

// Import Buttons for Excel, PDF, Copy, and Print
import jszip from 'jszip';
window.JSZip = jszip; // Required for Excel export

import pdfMake from 'pdfmake/build/pdfmake';
import pdfFonts from 'pdfmake/build/vfs_fonts';
// pdfMake.vfs = pdfFonts.pdfMake.vfs; // Required for PDF export

import 'datatables.net-buttons/js/buttons.html5.min.js'; // HTML5 export buttons
import 'datatables.net-buttons/js/buttons.print.min.js'; // Print button
import 'datatables.net-buttons/js/buttons.colVis.min.js'; // Column visibility button

// Import Flowbite (if needed)
import 'flowbite';

$('#UserTable').DataTable({
    processing: true,
    serverSide: true,
    scrollX: true,
    ajax: {
        url: '/users/data',  // The route returning JSON data
        type: 'GET'
    },
    columns: [
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'email', name: 'email' },
        { data: 'created_at', name: 'created_at' },
        {
            data: 'id', // The ID will be used for Edit, Show, Delete actions
            render: function(data, type, row) {
                return `
                    <a href="/users/${data}/show" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-3 py-1 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Show</a>
                    <a href="/users/${data}/edit" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-3 py-1  text-center me-2 mb-2 dark:focus:ring-yellow-900">Edit</a>
                    <button type="button" data-id="${data}" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-3 py-1 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                `;
            },
            orderable: false,  // Disable sorting for the action column
            searchable: false  // Disable searching for the action column
        }
    ],
    layout: {
        topEnd: ['search'],
        topStart: {
            pageLength: true,
            buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5', 'colvis', 'print']
        }
    }
});

// Handle Delete Button Clicks
$(document).on('click', '.delete-btn', function() {
    var userId = $(this).data('id');

    if (confirm('Are you sure you want to delete this user?')) {
        $.ajax({
            url: '/users/' + userId,
            type: 'DELETE',
            success: function(response) {
                alert('User deleted successfully!');
                $('#UserTable').DataTable().ajax.reload();  // Reload the table data after deletion
            },
            error: function() {
                alert('An error occurred while deleting the user.');
            }
        });
    }
});

$('#dataTable').DataTable({

        responsive: true,
        autoWidth: false,
        scrollX: true,
        layout: {
            topEnd: ['search'],
                // buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5', 'colvis', 'print']

            // },
            // topStart: ['pageLength', 'search'],
            // topStart: {'pageLength',
            //     buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5', 'colvis', 'print']
            // },
            topStart: {
                pageLength: true,
                buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5', 'colvis', 'print']
            }
        }
});

