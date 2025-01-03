        window.addEventListener('DOMContentLoaded', () => {
            const dataTable = $('#dataTable').DataTable({
                responsive: true,
                autoWidth: true,
                scrollX: true,
                scrollY: "75vh", // Corrected property name
                scrollCollapse: true,
                ajax: {
                    url: '/leads/data',
                    type: 'GET'
                    type: 'GET',
                    data: function(d) {
                        // Collect selected categories
                        d.category_id = [];
                        $('input[name="category_id[]"]:checked').each(function() {
                            d.category_id.push($(this).val());
                        });

                        d.brand_id = [];
                        $('input[name="brand_id[]"]:checked').each(function() {
                            d.brand_id.push($(this).val());
                        });

                        d.linkedin_link = [];
                        $('input[name="linkedin_link[]"]:checked').each(function() {
                            d.linkedin_link.push($(this).val());
                        });

                        d.company_name = [];
                        $('input[name="company_name[]"]:checked').each(function() {
                            d.company_name.push($(this).val());
                        });

                        d.contact_name = [];
                        $('input[name="contact_name[]"]:checked').each(function() {
                            d.contact_name.push($(this).val());
                        });

                        d.name_prefix = [];
                        $('input[name="name_prefix[]"]:checked').each(function() {
                            d.name_prefix.push($(this).val());
                        });

                        d.full_name = [];
                        $('input[name="full_name[]"]:checked').each(function() {
                            d.full_name.push($(this).val());
                        });

                        d.first_name = [];
                        $('input[name="first_name[]"]:checked').each(function() {
                            d.first_name.push($(this).val());
                        });

                        d.last_name = [];
                        $('input[name="last_name[]"]:checked').each(function() {
                            d.last_name.push($(this).val());
                        });

                        d.email = [];
                        $('input[name="email[]"]:checked').each(function() {
                            d.email.push($(this).val());
                        });

                        d.title_position = [];
                        $('input[name="title_position[]"]:checked').each(function() {
                            d.title_position.push($(this).val());
                        });

                        d.person_location = [];
                        $('input[name="person_location[]"]:checked').each(function() {
                            d.person_location.push($(this).val());
                        });

                        d.full_address = [];
                        $('input[name="full_address[]"]:checked').each(function() {
                            d.full_address.push($(this).val());
                        });

                        d.company_phone = [];
                        $('input[name="company_phone[]"]:checked').each(function() {
                            d.company_phone.push($(this).val());
                        });

                        d.company_head_count = [];
                        $('input[name="company_head_count[]"]:checked').each(function() {
                            d.company_head_count.push($(this).val());
                        });

                        d.country = [];
                        $('input[name="country[]"]:checked').each(function() {
                            d.country.push($(this).val());
                        });

                        d.city = [];
                        $('input[name="city[]"]:checked').each(function() {
                            d.city.push($(this).val());
                        });

                        d.state = [];
                        $('input[name="state[]"]:checked').each(function() {
                            d.state.push($(this).val());
                        });

                        d.tag = [];
                        $('input[name="tag[]"]:checked').each(function() {
                            d.tag.push($(this).val());
                        });

                        d.source_link = [];
                        $('input[name="source_link[]"]:checked').each(function() {
                            d.source_link.push($(this).val());
                        });

                        d.middle_name = [];
                        $('input[name="middle_name[]"]:checked').each(function() {
                            d.middle_name.push($(this).val());
                        });

                        d.sur_name = [];
                        $('input[name="sur_name[]"]:checked').each(function() {
                            d.sur_name.push($(this).val());
                        });

                        d.gender = [];
                        $('input[name="gender[]"]:checked').each(function() {
                            d.gender.push($(this).val());
                        });

                        d.personal_phone = [];
                        $('input[name="personal_phone[]"]:checked').each(function() {
                            d.personal_phone.push($(this).val());
                        });

                        d.employee_range = [];
                        $('input[name="employee_range[]"]:checked').each(function() {
                            d.employee_range.push($(this).val());
                        });

                        d.company_website = [];
                        $('input[name="company_website[]"]:checked').each(function() {
                            d.company_website.push($(this).val());
                        });

                        d.company_linkedin_link = [];
                        $('input[name="company_linkedin_link[]"]:checked').each(function() {
                            d.company_linkedin_link.push($(this).val());
                        });

                        d.company_hq_address = [];
                        $('input[name="company_hq_address[]"]:checked').each(function() {
                            d.company_hq_address.push($(this).val());
                        });

                        d.industry = [];
                        $('input[name="industry[]"]:checked').each(function() {
                            d.industry.push($(this).val());
                        });

                        d.revenue = [];
                        $('input[name="revenue[]"]:checked').each(function() {
                            d.revenue.push($(this).val());
                        });

                        d.street = [];
                        $('input[name="street[]"]:checked').each(function() {
                            d.street.push($(this).val());
                        });

                        d.zip_code = [];
                        $('input[name="zip_code[]"]:checked').each(function() {
                            d.zip_code.push($(this).val());
                        });

                        d.rating = [];
                        $('input[name="rating[]"]:checked').each(function() {
                            d.rating.push($(this).val());
                        });

                        d.sheet_name = [];
                        $('input[name="sheet_name[]"]:checked').each(function() {
                            d.sheet_name.push($(this).val());
                        });

                        d.job_link = [];
                        $('input[name="job_link[]"]:checked').each(function() {
                            d.job_link.push($(this).val());
                        });

                        d.job_role = [];
                        $('input[name="job_role[]"]:checked').each(function() {
                            d.job_role.push($(this).val());
                        });

                        d.checked_by = [];
                        $('input[name="checked_by[]"]:checked').each(function() {
                            d.checked_by.push($(this).val());
                        });

                        d.review = [];
                        $('input[name="review[]"]:checked').each(function() {
                            d.review.push($(this).val());
                        });
                        console.log('Categories:', d.category_id);
                        console.log('Brands:', d.brand_id);
                    }
                },
                columns: [{
                        data: 'id'},{data: 'linkedin_link'},
                        {data: 'company_name'},
                        {data: 'contact_name'},
                        {data: 'name_prefix'},
                        {data: 'full_name'},
                        {data: 'first_name'},
                        {data: 'last_name'},
                        {data: 'email'},
                        {data: 'title_position'},
                        {data: 'person_location'},
                        {data: 'full_address'},
                        {data: 'company_phone'},
                        {data: 'company_head_count'},
                        {data: 'country'},
                        {data: 'city'},
                        {data: 'state'},
                        {data: 'tag'},
                        {data: 'source_link'},
                        {data: 'middle_name'},
                        {data: 'sur_name'},
                        {data: 'gender'},
                        {data: 'personal_phone'},
                        {data: 'employee_range'},
                        {data: 'company_website'},
                        {data: 'company_linkedin_link'},
                        {data: 'company_hq_address'},
                        {data: 'industry'},
                        {data: 'revenue'},
                        {data: 'street'},
                        {data: 'zip_code'},
                        {data: 'rating'},
                        {data: 'sheet_name'},
                        {data: 'job_link'},
                        {data: 'job_role'},
                        {data: 'checked_by'},
                        {data: 'review'},
                        {data: 'created_at',
                            render: function(data) {
                                return moment(data).format(
                                    'DD-MMM-YYYY h:mm A'); // e.g., 26-Dec-2024 06:34 AM
                            }
                        },
                        {data: 'updated_at',
                            render: function(data) {
                                return moment(data).format(
                                    'DD-MMM-YYYY h:mm A'); // e.g., 26-Dec-2024 06:34 AM
                            }
                        }
                ],

                layout: {
                    topEnd: ['search'],
                    topStart: {
                        pageLength: true,
                        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5', 'colvis', 'print']
                    }
                },
                initComplete: function() {
                    var columnsToSearch = [1, 2, 3, 5, 6]; // Indices of columns to include (0-based)
                    var api = this.api();

                    // Create a new search row and prepend it to the thead
                    var searchRow = $('<tr></tr>');
                    $(api.table().header()).prepend(searchRow);

                    // Loop through all columns
                    api.columns().every(function(index) {
                        var column = this;

                        if (columnsToSearch.includes(index)) {
                            // Add an input to searchable columns
                            var title = $(column.header()).text(); // Get column header text
                            $('<th><input type="text" placeholder="Search ' + title +
                                    '" style="width:100%;" /></th>')
                                .appendTo(searchRow)
                                .find('input')
                                .on('keyup change clear', function() {
                                    if (column.search() !== this.value) {
                                        column.search(this.value).draw();
                                    }
                                });
                        } else {
                            // Add an empty cell for non-searchable columns
                            $('<th></th>').appendTo(searchRow);
                        }
                    });
                }
            });
            $(document).on('change',
              'input[name="category_id[]"],
                input[name="brand_id[]"],
                input[name="linkedin_link[]"],
                input[name="company_name[]"],
                input[name="contact_name[]"],
                input[name="name_prefix[]"],
                input[name="full_name[]"],
                input[name="first_name[]"],
                input[name="last_name[]"],
                input[name="email[]"],
                input[name="title_position[]"],
                input[name="person_location[]"],
                input[name="full_address[]"],
                input[name="company_phone[]"],
                input[name="company_head_count[]"],
                input[name="country[]"],
                input[name="city[]"],
                input[name="state[]"],
                input[name="tag[]"],
                input[name="source_link[]"],
                input[name="middle_name[]"],
                input[name="sur_name[]"],
                input[name="gender[]"],
                input[name="personal_phone[]"],
                input[name="employee_range[]"],
                input[name="company_website[]"],
                input[name="company_linkedin_link[]"],
                input[name="company_hq_address[]"],
                input[name="industry[]"],
                input[name="revenue[]"],
                input[name="street[]"],
                input[name="zip_code[]"],
                input[name="rating[]"],
                input[name="sheet_name[]"],
                input[name="job_link[]"],
                input[name="job_role[]"],
                input[name="checked_by[]"],
                input[name="review[]"]',
                function() {
                    dataTable.ajax.reload();
                }
            );

        });