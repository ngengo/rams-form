@extends('layouts.app')

@section('header-right')
    <a href="#" id="logoutLink" class="header-button" title="Logout">
        <i class="fas fa-sign-out-alt"></i>
    </a>

    <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endsection

@section('content')
    <div class="dashboard-wrapper">

        <h2 class="dashboard-title">ADMIN DASHBOARD</h2>

        <div class="search-container">
            <i class="fas fa-search search-icon"></i>
            <input type="text" placeholder="Search keywords" class="search-bar">
            <i class="fas fa-times cancel-icon"></i>
            <button type="button" class="enter-btn">
                <i class="fas fa-arrow-right"></i>
            </button>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>DATE SUBMITTED</th>
                    <th>TYPE OF ACTIVITY</th>
                    <th>CLUB NAME</th>
                    <th>DATE OF ACTIVITY</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($forms as $index => $form)
                    <tr data-id="{{ $form->id }}">

                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($form->today_date)->format('d/m/Y') }}</td>
                        <td>{{ $form->activity_type }}</td>
                        <td>{{ $form->club_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($form->activity_date)->format('d/m/Y') }}</td>
                        <td>
                            <select class="status-dropdown colored-dropdown" data-last-value="{{ $form->status }}">
                                <option value="PENDING" {{ $form->status == 'PENDING' ? 'disabled' : '' }}>PENDING</option>
                                <option value="APPROVED" {{ $form->status == 'APPROVED' ? 'selected' : '' }}>APPROVED
                                </option>
                                <option value="REJECTED" {{ $form->status == 'REJECTED' ? 'selected' : '' }}>REJECTED
                                </option>
                            </select>
                        </td>
                        <td>
                            <a href="{{ route('admin.download', $form->id) }}" class="download-btn" title="Download PDF">
                                <i class="fas fa-download"></i>
                            </a>

                        </td>
                    </tr>
                @endforeach
            </tbody>


        </table>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Logout
            const logoutLink = document.getElementById('logoutLink');
            const logoutForm = document.getElementById('logoutForm');

            logoutLink.addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will be logged out.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, logout',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        logoutForm.submit();
                    }
                });
            });

            // Search
            const searchInput = document.querySelector(".search-bar");
            const cancelIcon = document.querySelector(".cancel-icon");
            const enterBtn = document.querySelector(".enter-btn");
            const tableRows = document.querySelectorAll(".admin-table tbody tr");

            function filterTable(query) {
                tableRows.forEach(row => {
                    const cells = row.querySelectorAll("td");
                    let matchFound = false;

                    cells.forEach(cell => {
                        const dropdown = cell.querySelector('select');
                        const isActionColumn = cell.querySelector('button') || cell.querySelector(
                            'a');

                        if (dropdown || isActionColumn) return;

                        const originalText = cell.textContent;
                        const lowerText = originalText.toLowerCase();

                        if (lowerText.includes(query)) {
                            matchFound = true;
                            const regex = new RegExp('(${query})', 'gi');
                            const highlighted = originalText.replace(regex,
                                '<span class="highlight">$1</span>');
                            cell.innerHTML = highlighted;
                        } else {
                            cell.innerHTML = originalText;
                        }
                    });

                    row.style.display = matchFound || query === "" ? "" : "none";
                });
            }


            enterBtn.addEventListener("click", function() {
                filterTable(searchInput.value.toLowerCase());
            });

            searchInput.addEventListener("keydown", function(e) {
                if (e.key === "Enter") {
                    e.preventDefault();
                    filterTable(searchInput.value.toLowerCase());
                }
            });

            cancelIcon.addEventListener("click", function() {
                searchInput.value = "";
                filterTable("");
                searchInput.focus();
            });

            const statusDropdowns = document.querySelectorAll('.colored-dropdown');

            function updateDropdownColor(dropdown, value) {
                dropdown.classList.remove('pending', 'approved', 'rejected');
                if (value === 'PENDING') {
                    dropdown.classList.add('pending');
                } else if (value === 'APPROVED') {
                    dropdown.classList.add('approved');
                } else if (value === 'REJECTED') {
                    dropdown.classList.add('rejected');
                }
            }

            statusDropdowns.forEach(dropdown => {
                updateDropdownColor(dropdown, dropdown.value);

                dropdown.addEventListener('change', function() {
                    const selectedValue = this.value;
                    const row = dropdown.closest("tr");
                    const formId = row.dataset.id;

                    // Prevent selecting PENDING again if it's already changed
                    if (dropdown.dataset.locked === "true" && selectedValue === "PENDING") {
                        this.value = this.dataset.lastValue;
                        return;
                    }

                    Swal.fire({
                        title: 'Confirm Status Change',
                        text: `Are you sure you want to change status to "${selectedValue}"?`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#28a745',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, update',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            updateDropdownColor(dropdown, selectedValue);
                            dropdown.dataset.locked = "true";
                            dropdown.dataset.lastValue = selectedValue;

                            // 🚀 SEND TO BACKEND + TRIGGER EMAIL
                            fetch(`/admin/update-status/${formId}`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').getAttribute(
                                            'content'),
                                    },
                                    body: JSON.stringify({
                                        status: selectedValue
                                    })
                                })
                               .then(res => res.json())
                               .then(data => {
                                    if (data.success) {
                                        Swal.fire('Success','Status updated and email has been sent.', 'success');
                                    } else {
                                        Swal.fire('Warning','Status updated, but email failed.', 'warning');
                                    }
                                })
                                .catch(err => {
                                    Swal.fire('Error', 'Something went wrong while updating.', 'error');
                                });

                        } else {
                            dropdown.value = dropdown.dataset.lastValue || 'PENDING';
                            updateDropdownColor(dropdown, dropdown.value);
                        }
                    });
                });
            });
        });
    </script>
@endsection

@section('styles')
    <style>
        .dashboard-wrapper {
            max-width: 1100px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .dashboard-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .search-container {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 30px;
            padding: 8px 16px;
            gap: 10px;
            width: fit-content;
            margin: 0 auto 20px;
        }

        .search-bar {
            border: none;
            outline: none;
            font-size: 14px;
            width: 280px;
        }

        .search-icon,
        .cancel-icon {
            font-size: 16px;
            color: #555;
            cursor: pointer;
        }

        .enter-btn {
            border: none;
            background-color: #f0f0f0;
            padding: 6px 12px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
            color: #333;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .highlight {
            background-color: rgb(245, 245, 125);
            font-weight: bold;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .admin-table th,
        .admin-table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        .admin-table th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
        }

        .badge.pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .badge.approved {
            background-color: #d4edda;
            color: #155724;
        }

        .badge.rejected {
            background-color: #f8d7da;
            color: #b90819;
        }

        .download-btn i {
            color: #28a745;
        }

        .status-dropdown {
            padding: 5px 10px;
            border-radius: 20px;
            border: 1px solid #ccc;
            font-size: 13px;
            background-color: #f9f9f9;
            cursor: pointer;
        }

        .colored-dropdown {
            padding: 5px 10px;
            border-radius: 20px;
            border: 1px solid #ccc;
            font-size: 13px;
            font-weight: bold;
            background-color: #fff3cd;
            /* default yellow for pending */
            color: #856404;
            cursor: pointer;
            text-align: center;
        }

        .colored-dropdown.approved {
            background-color: #d4edda;
            color: #155724;
        }

        .colored-dropdown.rejected {
            background-color: #f8d7da;
            color: #b90819;
        }

        .swal2-popup {
            font-family: 'Segoe UI', sans-serif;
            border-radius: 10px !important;
            padding: 0.5em 2em 2em 2em !important;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .swal2-title {
            color: #000000 !important;
            font-weight: bold;
            font-size: 24px;
        }

        .swal2-confirm,
        .swal2-cancel {
            border-radius: 10px !important;
            padding: 10px 25px;
            font-weight: bold;
        }
    </style>
@endsection