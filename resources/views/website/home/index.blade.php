<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PetMarket - Buy & Sell Premium Pets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Navbar Styling -->
    <style>
        #mainNavbar {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease-in-out;
        }

        #mainNavbar.scrolled {
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        #mainNavbar .navbar-brand {
            font-size: 1.4rem;
            font-weight: 700;
            display: flex;
            align-items: center;
        }

        #mainNavbar .paw-bounce {
            animation: bounce 1.5s infinite;
            color: #0d6efd;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-4px);
            }
        }

        /* Navbar Links */
        #mainNavbar .nav-link {
            font-weight: 500;
            color: #333;
            margin-right: 1rem;
            transition: color 0.2s, transform 0.2s;
        }

        #mainNavbar .nav-link:hover,
        #mainNavbar .nav-link.active {
            color: #0d6efd;
            transform: translateY(-2px);
        }

        /* Search Bar */
        #mainNavbar .search-input {
            border-radius: 20px 0 0 20px;
            padding: 0.5rem 1rem;
        }

        #mainNavbar .search-btn {
            border-radius: 0 20px 20px 0;
            transition: all 0.3s;
        }

        #mainNavbar .search-btn:hover {
            background: #0d6efd;
            color: #fff;
        }

        /* Buttons */
        #mainNavbar .btn {
            border-radius: 25px;
            padding: 0.4rem 1rem;
        }

        /* Favorites Counter */
        #mainNavbar .favorites-counter {
            position: relative;
            font-size: 1.2rem;
            color: #e63946;
            cursor: pointer;
            transition: transform 0.2s;
        }

        #mainNavbar .favorites-counter:hover {
            transform: scale(1.1);
        }

        #mainNavbar .favorites-counter .badge {
            position: absolute;
            top: -8px;
            right: -12px;
            font-size: 0.7rem;
        }

        /* Mobile Adjustments */
        @media (max-width: 991px) {
            #mainNavbar .nav-link {
                margin: 0.5rem 0;
            }

            #mainNavbar .d-flex {
                margin-top: 1rem;
            }
        }
    </style>

    <!-- Divider -->
    <style>
        .divider {
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #0d6efd, #6610f2);
            border-radius: 10px;
            margin-top: 1rem;
        }

        /* Category Cards */
        .category-card {
            position: relative;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease-in-out;
            cursor: pointer;
            overflow: hidden;
        }

        .category-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        /* Icon styling */
        .category-card .category-icon i {
            transition: transform 0.3s ease;
        }

        .category-card:hover .category-icon i {
            transform: scale(1.15) rotate(5deg);
        }

        /* Overlay effect */
        .category-card .category-overlay {
            position: absolute;
            inset: 0;
            background: rgba(13, 110, 253, 0.85);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            color: #fff;
        }

        .category-card:hover .category-overlay {
            opacity: 1;
        }

        /* Texts */
        .category-card h5 {
            margin-bottom: 0.3rem;
            font-weight: 600;
            color: #212529;
        }

        .category-card p {
            font-size: 0.9rem;
            margin-bottom: 0;
        }

        /* Responsive tweak */
        @media (max-width: 767px) {
            .category-card {
                padding: 2rem 1rem;
            }
        }
    </style>

    <!-- Filter Section -->
    <style>
        #filterSection {
            background: #f8f9fa;
            border-radius: 0 0 12px 12px;
            box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.05);
        }

        /* Section title */
        #filterSection h5 {
            font-weight: 600;
            color: #212529;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        #filterSection h5::before {
            content: "\f0b0";
            /* FontAwesome filter icon */
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            color: #0d6efd;
        }

        /* Dropdown Styling */
        #filterSection .form-select {
            border-radius: 25px;
            padding: 0.35rem 1rem;
            font-size: 0.9rem;
            border: 1px solid #dee2e6;
            box-shadow: none;
            transition: all 0.2s ease-in-out;
        }

        #filterSection .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.25);
        }

        /* Dropdown hover effect */
        #filterSection .form-select:hover {
            border-color: #0d6efd;
        }

        /* Responsive */
        @media (max-width: 767px) {
            #filterSection .d-flex {
                flex-direction: column;
                gap: 0.6rem;
                align-items: stretch;
            }
        }
    </style>
    <!-- Pet Card -->
    <style>
        /* Featured Pets Section */
        #products {
            background-color: #f8f9fa;
            padding: 5rem 0;
        }

        /* Pet Cards */
        .pet-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            position: relative;
            border: none;
            margin-bottom: 1.5rem;
        }

        .pet-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.1);
        }

        /* Image container */
        .pet-img-container {
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .pet-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .pet-card:hover img {
            transform: scale(1.08);
        }

        /* Status Badges - Enhanced */
        .status-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            padding: 6px 12px;
            font-size: 0.75rem;
            font-weight: 700;
            border-radius: 20px;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            z-index: 2;
        }

        .status-badge.available {
            background: linear-gradient(135deg, #4CAF50, #2E7D32);
        }

        .status-badge.sold {
            background: linear-gradient(135deg, #F44336, #C62828);
        }

        .status-badge.discount {
            background: linear-gradient(135deg, #FF9800, #F57C00);
        }

        .status-badge.reserved {
            background: linear-gradient(135deg, #2196F3, #1565C0);
        }

        .status-badge.new {
            background: linear-gradient(135deg, #9C27B0, #7B1FA2);
        }

        /* Price Badge */
        .price-badge {
            position: absolute;
            bottom: 15px;
            left: 15px;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            font-weight: 700;
            font-size: 0.9rem;
            padding: 8px 14px;
            border-radius: 20px;
            backdrop-filter: blur(4px);
            z-index: 2;
        }

        /* Favorite Button */
        .favorite-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            transition: all 0.3s ease;
            color: #e63946;
            opacity: 0;
            transform: translateY(10px);
            z-index: 3;
        }

        .pet-card:hover .favorite-btn {
            opacity: 1;
            transform: translateY(0);
        }

        .favorite-btn:hover {
            background: #e63946;
            color: #fff;
            transform: scale(1.1) translateY(0);
        }

        /* View Details Button */
        .view-details-btn {
            position: absolute;
            bottom: 20px;
            right: 15px;
            background: rgba(33, 150, 243, 0.9);
            border: none;
            border-radius: 20px;
            padding: 8px 16px;
            color: white;
            font-weight: 600;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 12px rgba(33, 150, 243, 0.3);
            cursor: pointer;
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateY(10px);
            z-index: 3;
        }

        .pet-card:hover .view-details-btn {
            opacity: 1;
            transform: translateY(0);
        }

        .view-details-btn:hover {
            background: #0d6efd;
            transform: translateY(-2px) translateY(0);
        }

        .view-details-btn i {
            margin-right: 5px;
        }

        /* Card Body */
        .pet-card .card-body {
            padding: 1.25rem;
        }

        .pet-card .card-title {
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .pet-card .location {
            color: #6c757d;
            font-size: 0.85rem;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
        }

        .pet-card .location i {
            margin-right: 5px;
        }

        .pet-card .card-text {
            color: #6c757d;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 1rem;
        }

        /* Load More Button */
        #loadMoreBtn {
            border-radius: 30px;
            padding: 0.7rem 2.5rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            border: 2px solid #0d6efd;
            color: #0d6efd;
            background: transparent;
        }

        #loadMoreBtn:hover {
            background: #0d6efd;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        }

        #loadMoreBtn i {
            transition: transform 0.3s ease;
        }

        #loadMoreBtn:hover i {
            transform: translateX(3px);
        }

        /* Section Header */
        .divider {
            height: 4px;
            width: 80px;
            background: linear-gradient(90deg, #4CAF50, #2196F3);
            margin: 1rem auto;
            border-radius: 2px;
        }
    </style>


    <!-- Feature Cards -->
    <style>
        .feature-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease-in-out;
            position: relative;
            cursor: default;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        /* Feature Icon */
        .feature-icon i {
            background: rgba(13, 110, 253, 0.08);
            border-radius: 50%;
            padding: 20px;
            transition: all 0.4s ease;
        }

        .feature-card:hover .feature-icon i {
            transform: rotate(10deg) scale(1.15);
            background: rgba(13, 110, 253, 0.15);
        }

        /* Feature Title */
        .feature-card h4 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            color: #212529;
        }

        /* Feature Text */
        .feature-card p {
            font-size: 0.95rem;
            line-height: 1.5;
        }

        /* Divider alignment */
        #about .divider {
            margin-top: 1rem;
            margin-bottom: 1.5rem;
        }

        /* Responsive adjustments */
        @media (max-width: 767px) {
            .feature-card {
                padding: 2rem 1rem;
            }
        }
    </style>

    <!-- Stats Section -->
    <style>
        .stats-section {
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            position: relative;
            overflow: hidden;
        }

        /* Decorative background shapes */
        .stats-section::before {
            content: "";
            position: absolute;
            top: -50px;
            left: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            z-index: 0;
        }

        .stats-section::after {
            content: "";
            position: absolute;
            bottom: -60px;
            right: -60px;
            width: 250px;
            height: 250px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            z-index: 0;
        }

        /* Stat Items */
        .stat-item {
            position: relative;
            z-index: 1;
            padding: 1.5rem 1rem;
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-6px);
        }

        /* Numbers */
        .stat-item .counter {
            font-size: 2.8rem;
            color: #fff;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.25);
            animation: fadeInUp 1s ease forwards;
        }

        .stat-item p {
            font-size: 1rem;
            opacity: 0.9;
            margin-top: 0.5rem;
        }

        /* Animation */
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(15px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 767px) {
            .stat-item {
                padding: 1rem 0.5rem;
            }

            .stat-item .counter {
                font-size: 2rem;
            }
        }
    </style>

    <!-- Newsletter Section -->
    <style>
        .newsletter-section {
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
            position: relative;
            overflow: hidden;
        }

        /* Decorative background */
        .newsletter-section::before {
            content: "";
            position: absolute;
            top: -80px;
            right: -80px;
            width: 180px;
            height: 180px;
            background: rgba(13, 110, 253, 0.08);
            border-radius: 50%;
            z-index: 0;
        }

        .newsletter-section::after {
            content: "";
            position: absolute;
            bottom: -60px;
            left: -60px;
            width: 150px;
            height: 150px;
            background: rgba(102, 16, 242, 0.08);
            border-radius: 50%;
            z-index: 0;
        }

        /* Text */
        .newsletter-section h3 {
            font-size: 1.8rem;
            color: #212529;
            position: relative;
            z-index: 1;
        }

        .newsletter-section p {
            position: relative;
            z-index: 1;
        }

        /* Input Group */
        #newsletterForm .input-group {
            border-radius: 40px;
            overflow: hidden;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
            background: #fff;
            position: relative;
            z-index: 1;
        }

        #newsletterForm input {
            border: none;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            outline: none;
            box-shadow: none;
        }

        #newsletterForm input::placeholder {
            color: #aaa;
        }

        /* Button */
        #newsletterForm button {
            border-radius: 0;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        #newsletterForm button:hover {
            background: #0a58ca;
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 767px) {
            #newsletterForm input {
                font-size: 0.9rem;
            }

            #newsletterForm button {
                font-size: 0.9rem;
                padding: 0.65rem 1rem;
            }
        }
    </style>

    <!-- Footer -->
    <style>
        footer {
            background: #111;
            position: relative;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Headings */
        footer h4,
        footer h5 {
            color: #fff;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        /* Paragraph */
        footer p {
            color: #bbb;
            font-size: 0.95rem;
        }

        /* Links */
        footer a {
            color: #bbb;
            transition: color 0.3s ease, transform 0.2s;
            display: inline-block;
        }

        footer a:hover {
            color: #0d6efd;
            transform: translateX(3px);
        }

        /* Social Icons */
        footer .social-links a {
            font-size: 1.1rem;
            background: rgba(255, 255, 255, 0.08);
            padding: 8px 12px;
            border-radius: 50%;
            transition: all 0.3s ease-in-out;
        }

        footer .social-links a:hover {
            background: #0d6efd;
            color: #fff !important;
            transform: translateY(-3px);
        }

        /* Divider */
        footer hr {
            border-color: rgba(255, 255, 255, 0.1);
        }

        /* Bottom Section */
        footer .heartbeat {
            animation: heartbeat 1.5s infinite;
        }

        @keyframes heartbeat {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.3);
            }
        }

        /* Responsive */
        @media (max-width: 767px) {
            footer {
                text-align: center;
            }

            footer .text-md-end {
                text-align: center !important;
                margin-top: 0.5rem;
            }

            footer .social-links {
                margin-top: 1rem;
            }
        }
    </style>

    <!-- Mobile Bottom Navigation -->
    <style>
        .mobile-bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: #fff;
            border-top: 1px solid #eaeaea;
            display: flex;
            justify-content: space-around;
            align-items: center;
            z-index: 1050;
            box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.08);
        }

        /* Nav Item */
        .mobile-bottom-nav .nav-item {
            flex: 1;
            text-align: center;
            position: relative;
        }

        .mobile-bottom-nav .nav-link {
            color: #6c757d;
            font-size: 0.8rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: all 0.3s ease;
            padding: 5px 0;
        }

        .mobile-bottom-nav .nav-link i {
            font-size: 1.2rem;
            margin-bottom: 2px;
            transition: transform 0.2s ease;
        }

        /* Active / Hover states */
        .mobile-bottom-nav .nav-link.active,
        .mobile-bottom-nav .nav-link:hover {
            color: #0d6efd;
        }

        .mobile-bottom-nav .nav-link.active i,
        .mobile-bottom-nav .nav-link:hover i {
            transform: scale(1.2);
        }

        /* Favorites Badge */
        .mobile-bottom-nav .mobile-fav-badge {
            position: absolute;
            top: 3px;
            right: 25%;
            background: #dc3545;
            color: #fff;
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 50%;
            font-weight: bold;
        }

        /* Only show on mobile */
        @media (min-width: 992px) {
            .mobile-bottom-nav {
                display: none;
            }
        }
    </style>

    <!-- Style the button -->
    <style>
        .go-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            display: none;
            /* Hidden by default */
            background-color: #333;
            color: white;
            border: none;
            padding: 12px 16px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
            z-index: 1000;
            transition: opacity 0.3s;
        }

        .go-to-top:hover {
            background-color: #555;
        }
    </style>

    <!-- Modal Customization -->
    <style>
        #petDetailModal .modal-content {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            border: none;
        }

        #petDetailModal .modal-header {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-bottom: 1px solid #e9ecef;
        }

        #petDetailModal .modal-title {
            font-size: 1.5rem;
            color: #212529;
        }

        #petDetailModal .btn-close {
            font-size: 1.2rem;
        }

        #petDetailModal .modal-body {
            padding: 1.5rem 2rem;
        }

        #petDetailModal .pet-details strong {
            display: inline-block;
            width: 90px;
            color: #495057;
        }

        #petDetailModal .badge {
            font-size: 0.85rem;
            padding: 0.45em 0.75em;
        }

        #petDetailModal .rating i {
            font-size: 1rem;
        }

        #petDetailModal .rating span {
            font-size: 0.9rem;
            color: #495057;
        }

        #petDetailModal .btn {
            border-radius: 50px;
            font-weight: 500;
        }

        #petDetailModal .btn i {
            font-size: 0.9rem;
        }

        #petDetailModal img {
            object-fit: cover;
            max-height: 300px;
            width: 100%;
            border-radius: 10px;
        }

        /* Optional: hover effect on buttons */
        #petDetailModal .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        #petDetailModal .btn-outline-primary:hover {
            background-color: #e9f2ff;
            border-color: #007bff;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            #petDetailModal .modal-dialog {
                max-width: 95%;
                margin: 1.75rem auto;
            }

            #petDetailModal img {
                max-height: 250px;
            }
        }
    </style>

    <!-- Toast Container -->
    <style>
        .toast-container {
            z-index: 1200;
            /* Ensure it's above modals and other content */
        }

        /* Toast Styling */
        #liveToast {
            min-width: 280px;
            max-width: 350px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            border: none;
            background-color: #ffffff;
            color: #212529;
            font-family: 'Segoe UI', sans-serif;
            animation: slideIn 0.5s ease-out;
        }

        /* Toast Header */
        #liveToast .toast-header {
            border-bottom: 1px solid #e9ecef;
            background-color: #f8f9fa;
            font-weight: 500;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        #liveToast .toast-header i {
            font-size: 1.1rem;
        }

        #liveToast .btn-close {
            font-size: 0.8rem;
        }

        /* Toast Body */
        #liveToast .toast-body {
            font-size: 0.9rem;
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
        }

        #liveToast .toast-body i {
            font-size: 1rem;
        }

        /* Success Icon */
        #liveToast .text-success {
            color: #28a745 !important;
        }

        /* Toast Slide-in Animation */
        @keyframes slideIn {
            0% {
                transform: translateX(100%) translateY(0);
                opacity: 0;
            }

            100% {
                transform: translateX(0) translateY(0);
                opacity: 1;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            #liveToast {
                max-width: 90%;
                min-width: auto;
            }
        }
    </style>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#home">
                <i class="fas fa-paw me-2 paw-bounce"></i>PetMarket
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Offcanvas for Mobile -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">
                <!-- <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"> -->
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body d-lg-flex justify-content-end align-items-center">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#categories">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#products">Pets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                    </ul>

                    <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                        <button class="btn btn-outline-primary me-2" id="loginBtn">
                            <i class="fas fa-sign-in-alt me-1"></i>Login
                        </button>
                        <button class="btn btn-primary" id="registerBtn">
                            <i class="fas fa-user-plus me-1"></i>Register
                        </button>

                        <!-- Favorites Counter -->
                        <div class="favorites-counter ms-2" id="favoritesCounter">
                            <i class="fas fa-heart"></i>
                            <span class="badge bg-danger" id="favCount">0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>



    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            </div>

            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <img src="https://images.pexels.com/photos/1108099/pexels-photo-1108099.jpeg?auto=compress&cs=tinysrgb&w=1200&h=600&fit=crop"
                        class="d-block w-100" alt="Pets and animals" style="height: 600px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <h1 class="display-4 fw-bold text-white mb-4">Find Your Perfect Pet Companion</h1>
                                    <p class="lead text-white mb-4">Discover premium pets from trusted sellers. Cows,
                                        goats, sheep, cats, dogs and more.</p>
                                    <div class="d-flex gap-3">
                                        <button class="btn btn-primary btn-lg px-4" data-target="#products">
                                            <i class="fas fa-search me-2"></i>Browse Pets
                                        </button>
                                        <button class="btn btn-outline-light btn-lg px-4" id="sellPetBtn">
                                            <i class="fas fa-plus me-2"></i>Sell Your Pet
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-6 d-none d-lg-block">
                                    <div class="d-flex gap-4">
                                        <div class="text-center p-3 bg-dark bg-opacity-50 rounded">
                                            <h3 class="text-white fw-bold">5,000+</h3>
                                            <p class="text-light">Happy Families</p>
                                        </div>
                                        <div class="text-center p-3 bg-dark bg-opacity-50 rounded">
                                            <h3 class="text-white fw-bold">15,000+</h3>
                                            <p class="text-light">Pets Adopted</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <img src="https://images.pexels.com/photos/1059823/pexels-photo-1059823.jpeg?auto=compress&cs=tinysrgb&w=1200&h=600&fit=crop"
                        class="d-block w-100" alt="Farm animals" style="height: 600px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <h1 class="display-4 fw-bold text-white mb-4">Premium Livestock & Farm Animals</h1>
                                    <p class="lead text-white mb-4">Quality cattle, goats, sheep and poultry from
                                        verified sellers across the region.</p>
                                    <div class="d-flex gap-3">
                                        <button class="btn btn-success btn-lg px-4" data-target="#products">
                                            <i class="fas fa-eye me-2"></i>View Livestock
                                        </button>
                                        <button class="btn btn-outline-light btn-lg px-4" data-target="#about">
                                            <i class="fas fa-info-circle me-2"></i>Learn More
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <img src="https://images.pexels.com/photos/1851164/pexels-photo-1851164.jpeg?auto=compress&cs=tinysrgb&w=1200&h=600&fit=crop"
                        class="d-block w-100" alt="Pet marketplace" style="height: 600px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <h1 class="display-4 fw-bold text-white mb-4">Trusted Pet Marketplace</h1>
                                    <p class="lead text-white mb-4">Safe, secure transactions with verified sellers and
                                        comprehensive pet profiles.</p>
                                    <div class="d-flex gap-3">
                                        <button class="btn btn-primary btn-lg px-4" data-target="#products">
                                            <i class="fas fa-rocket me-2"></i>Get Started
                                        </button>
                                        <button class="btn btn-outline-light btn-lg px-4" data-target="#about">
                                            <i class="fas fa-question-circle me-2"></i>How It Works
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- Categories Section -->
    <section id="categories" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-5 fw-bold text-dark">Browse by Category</h2>
                    <p class="lead text-muted">Find the perfect pet that matches your needs</p>
                    <div class="divider mx-auto"></div>
                </div>
            </div>

            <div class="row g-4" id="categoriesGrid">
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="category-card text-center p-4 h-100" data-category="cattle" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="category-icon mb-3">
                            <i class="fas fa-cow fa-3x text-primary"></i>
                        </div>
                        <h5 class="fw-bold">Cattle</h5>
                        <p class="text-muted small">Premium cows & bulls</p>
                        <div class="category-overlay">
                            <i class="fas fa-arrow-right fa-2x"></i>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-4 col-lg-2">
                    <div class="category-card text-center p-4 h-100" data-category="goats" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="category-icon mb-3">
                            <i class="fas fa-horse fa-3x text-success"></i>
                        </div>
                        <h5 class="fw-bold">Goats</h5>
                        <p class="text-muted small">Dairy & meat goats</p>
                        <div class="category-overlay">
                            <i class="fas fa-arrow-right fa-2x"></i>
                        </div>
                    </div>
                </div>



                <div class="col-6 col-md-4 col-lg-2">
                    <div class="category-card text-center p-4 h-100" data-category="sheep" data-aos="fade-up"
                        data-aos-delay="300">
                        <div class="category-icon mb-3">
                            <i class="fas fa-sheep fa-3x text-info"></i>
                        </div>
                        <h5 class="fw-bold">Sheep</h5>
                        <p class="text-muted small">Wool & meat sheep</p>
                        <div class="category-overlay">
                            <i class="fas fa-arrow-right fa-2x"></i>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-4 col-lg-2">
                    <div class="category-card text-center p-4 h-100" data-category="poultry" data-aos="fade-up"
                        data-aos-delay="400">
                        <div class="category-icon mb-3">
                            <i class="fas fa-egg fa-3x text-warning"></i>
                        </div>
                        <h5 class="fw-bold">Poultry</h5>
                        <p class="text-muted small">Chickens, ducks & more</p>
                        <div class="category-overlay">
                            <i class="fas fa-arrow-right fa-2x"></i>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-4 col-lg-2">
                    <div class="category-card text-center p-4 h-100" data-category="dogs" data-aos="fade-up"
                        data-aos-delay="500">
                        <div class="category-icon mb-3">
                            <i class="fas fa-dog fa-3x text-danger"></i>
                        </div>
                        <h5 class="fw-bold">Dogs</h5>
                        <p class="text-muted small">All breeds & sizes</p>
                        <div class="category-overlay">
                            <i class="fas fa-arrow-right fa-2x"></i>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-4 col-lg-2">
                    <div class="category-card text-center p-4 h-100" data-category="cats" data-aos="fade-up"
                        data-aos-delay="600">
                        <div class="category-icon mb-3">
                            <i class="fas fa-cat fa-3x text-secondary"></i>
                        </div>
                        <h5 class="fw-bold">Cats</h5>
                        <p class="text-muted small">Indoor & outdoor cats</p>
                        <div class="category-overlay">
                            <i class="fas fa-arrow-right fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Filter Section -->
    <section class="py-4 border-bottom" id="filterSection">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0">Filter & Search Pets</h5>
                </div>
                <div class="col-md-6">
                    <div class="d-flex gap-2 justify-content-md-end">
                        <select class="form-select form-select-sm" id="categoryFilter">
                            <option value="">All Categories</option>
                            <option value="cattle">Cattle</option>
                            <option value="goats">Goats</option>
                            <option value="sheep">Sheep</option>
                            <option value="poultry">Poultry</option>
                            <option value="dogs">Dogs</option>
                            <option value="cats">Cats</option>
                        </select>
                        <select class="form-select form-select-sm" id="priceFilter">
                            <option value="">All Prices</option>
                            <option value="0-100">$0 - $100</option>
                            <option value="100-500">$100 - $500</option>
                            <option value="500-1000">$500 - $1000</option>
                            <option value="1000+">$1000+</option>
                        </select>
                        <select class="form-select form-select-sm" id="locationFilter">
                            <option value="">All Locations</option>
                            <option value="Austin">Austin, TX</option>
                            <option value="Dallas">Dallas, TX</option>
                            <option value="Houston">Houston, TX</option>
                            <option value="San Antonio">San Antonio, TX</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Pets Section -->
    <section id="products" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-5 fw-bold text-dark">Featured Pets</h2>
                    <p class="lead text-muted">Discover our premium selection of healthy, well-cared for animals</p>
                    <div class="divider mx-auto"></div>
                </div>
            </div>

            <div class="row g-4" id="petsGrid">
                <!-- Pet Card 1 -->
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="pet-card h-100" data-pet-id="1">
                        <div class="pet-img-container">
                            <img src="https://images.pexels.com/photos/1108099/pexels-photo-1108099.jpeg?auto=compress&cs=tinysrgb&w=400&h=250&fit=crop"
                                class="card-img-top" alt="Premium Holstein Cow" loading="lazy">
                            <div class="status-badge available">Available</div>
                            <div class="status-badge discount" style="top: 50px;">15% Off</div>
                            <div class="price-badge">$2,500</div>
                            <button class="favorite-btn" data-pet-id="1">
                                <i class="fas fa-heart"></i>
                            </button>
                            <button class="view-details-btn" data-pet-id="1">
                                <i class="fas fa-eye"></i> Details
                            </button>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Premium Holstein Cow</h5>
                            <p class="location">
                                <i class="fas fa-map-marker-alt"></i>Farm Valley, TX
                            </p>
                            <p class="card-text">Healthy 3-year-old Holstein dairy cow. Excellent milk producer with
                                complete health records.</p>
                        </div>
                    </div>
                </div>

                <!-- Pet Card 2 -->
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="pet-card h-100" data-pet-id="2">
                        <div class="pet-img-container">
                            <img src="https://images.pexels.com/photos/3608542/pexels-photo-3608542.jpeg?auto=compress&cs=tinysrgb&w=400&h=250&fit=crop"
                                class="card-img-top" alt="Golden Retriever Puppy" loading="lazy">
                            <div class="status-badge available">Available</div>
                            <div class="status-badge new" style="top: 50px;">New</div>
                            <div class="price-badge">$800</div>
                            <button class="favorite-btn" data-pet-id="2">
                                <i class="fas fa-heart"></i>
                            </button>
                            <button class="view-details-btn" data-pet-id="2">
                                <i class="fas fa-eye"></i> Details
                            </button>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Golden Retriever Puppy</h5>
                            <p class="location">
                                <i class="fas fa-map-marker-alt"></i>Austin, TX
                            </p>
                            <p class="card-text">8-week-old Golden Retriever puppy. Vaccinated, dewormed, and ready for
                                a loving home.</p>
                        </div>
                    </div>
                </div>

                <!-- Pet Card 3 -->
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="pet-card h-100" data-pet-id="3">
                        <div class="pet-img-container">
                            <img src="https://images.pexels.com/photos/2318447/pexels-photo-2318447.jpeg?auto=compress&cs=tinysrgb&w=400&h=250&fit=crop"
                                class="card-img-top" alt="Boer Goat" loading="lazy">
                            <div class="status-badge sold">Sold</div>
                            <div class="price-badge">$450</div>
                            <button class="favorite-btn" data-pet-id="3">
                                <i class="fas fa-heart"></i>
                            </button>
                            <button class="view-details-btn" data-pet-id="3">
                                <i class="fas fa-eye"></i> Details
                            </button>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Boer Goat</h5>
                            <p class="location">
                                <i class="fas fa-map-marker-alt"></i>Dallas, TX
                            </p>
                            <p class="card-text">2-year-old Boer goat doe. Great for breeding or meat production.
                                Excellent health record.</p>
                        </div>
                    </div>
                </div>

                <!-- Pet Card 4 -->
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="pet-card h-100" data-pet-id="4">
                        <div class="pet-img-container">
                            <img src="https://images.pexels.com/photos/104827/cat-pet-animal-domestic-104827.jpeg?auto=compress&cs=tinysrgb&w=400&h=250&fit=crop"
                                class="card-img-top" alt="Persian Cat" loading="lazy">
                            <div class="status-badge available">Available</div>
                            <div class="price-badge">$300</div>
                            <button class="favorite-btn" data-pet-id="4">
                                <i class="fas fa-heart"></i>
                            </button>
                            <button class="view-details-btn" data-pet-id="4">
                                <i class="fas fa-eye"></i> Details
                            </button>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Persian Cat</h5>
                            <p class="location">
                                <i class="fas fa-map-marker-alt"></i>Houston, TX
                            </p>
                            <p class="card-text">Beautiful 1-year-old Persian cat. Spayed, vaccinated, and very friendly
                                with children.</p>
                        </div>
                    </div>
                </div>

                <!-- Pet Card 5 -->
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="pet-card h-100" data-pet-id="5">
                        <div class="pet-img-container">
                            <img src="https://images.pexels.com/photos/2647973/pexels-photo-2647973.jpeg?auto=compress&cs=tinysrgb&w=400&h=250&fit=crop"
                                class="card-img-top" alt="Merino Sheep" loading="lazy">
                            <div class="status-badge available">Available</div>
                            <div class="status-badge discount" style="top: 50px;">10% Off</div>
                            <div class="price-badge">$600</div>
                            <button class="favorite-btn" data-pet-id="5">
                                <i class="fas fa-heart"></i>
                            </button>
                            <button class="view-details-btn" data-pet-id="5">
                                <i class="fas fa-eye"></i> Details
                            </button>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Merino Sheep</h5>
                            <p class="location">
                                <i class="fas fa-map-marker-alt"></i>San Antonio, TX
                            </p>
                            <p class="card-text">Premium Merino wool sheep. 18-month-old ewe with excellent fleece
                                quality and genetics.</p>
                        </div>
                    </div>
                </div>

                <!-- Pet Card 6 -->
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="pet-card h-100" data-pet-id="6">
                        <div class="pet-img-container">
                            <img src="https://images.pexels.com/photos/162140/duckling-birds-yellow-fluffy-162140.jpeg?auto=compress&cs=tinysrgb&w=400&h=250&fit=crop"
                                class="card-img-top" alt="Pekin Ducklings" loading="lazy">
                            <div class="status-badge available">Available</div>
                            <div class="price-badge">$15/each</div>
                            <button class="favorite-btn" data-pet-id="6">
                                <i class="fas fa-heart"></i>
                            </button>
                            <button class="view-details-btn" data-pet-id="6">
                                <i class="fas fa-eye"></i> Details
                            </button>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Pekin Ducklings</h5>
                            <p class="location">
                                <i class="fas fa-map-marker-alt"></i>Plano, TX
                            </p>
                            <p class="card-text">2-week-old Pekin ducklings. Healthy and active. Sold in groups of 6 or
                                more.</p>
                        </div>
                    </div>
                </div>

                <!-- Pet Card 7 -->
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="pet-card h-100" data-pet-id="7">
                        <div class="pet-img-container">
                            <img src="https://images.pexels.com/photos/1108099/pexels-photo-1108099.jpeg?auto=compress&cs=tinysrgb&w=400&h=250&fit=crop"
                                class="card-img-top" alt="Jersey Cow with Calf" loading="lazy">
                            <div class="status-badge available">Available</div>
                            <div class="status-badge reserved" style="top: 50px;">Reserved</div>
                            <div class="price-badge">$3,200</div>
                            <button class="favorite-btn" data-pet-id="7">
                                <i class="fas fa-heart"></i>
                            </button>
                            <button class="view-details-btn" data-pet-id="7">
                                <i class="fas fa-eye"></i> Details
                            </button>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Jersey Cow with Calf</h5>
                            <p class="location">
                                <i class="fas fa-map-marker-alt"></i>Fort Worth, TX
                            </p>
                            <p class="card-text">4-year-old Jersey cow with 2-month-old calf. Excellent milk producer
                                and mother.</p>
                        </div>
                    </div>
                </div>

                <!-- Pet Card 8 -->
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="pet-card h-100" data-pet-id="8">
                        <div class="pet-img-container">
                            <img src="https://images.pexels.com/photos/1254140/pexels-photo-1254140.jpeg?auto=compress&cs=tinysrgb&w=400&h=250&fit=crop"
                                class="card-img-top" alt="Rhode Island Red Hens" loading="lazy">
                            <div class="status-badge available">Available</div>
                            <div class="price-badge">$25/each</div>
                            <button class="favorite-btn" data-pet-id="8">
                                <i class="fas fa-heart"></i>
                            </button>
                            <button class="view-details-btn" data-pet-id="8">
                                <i class="fas fa-eye"></i> Details
                            </button>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Rhode Island Red Hens</h5>
                            <p class="location">
                                <i class="fas fa-map-marker-alt"></i>Garland, TX
                            </p>
                            <p class="card-text">1-year-old laying hens. Excellent egg producers. Vaccinated and
                                healthy.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <button class="btn btn-outline-primary btn-lg" id="loadMoreBtn">
                    <i class="fas fa-plus me-2"></i>Load More Pets
                </button>
            </div>
        </div>
    </section>


    <!-- Features Section -->
    <section id="about" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-5 fw-bold text-dark">Why Choose PetMarket?</h2>
                    <p class="lead text-muted">Your trusted platform for safe, secure pet transactions</p>
                    <div class="divider mx-auto"></div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card text-center p-4 h-100" data-aos="fade-up" data-aos-delay="100">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-shield-alt fa-3x text-primary"></i>
                        </div>
                        <h4 class="fw-bold">Verified Sellers</h4>
                        <p class="text-muted">All sellers are thoroughly verified to ensure authenticity and
                            trustworthiness.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card text-center p-4 h-100" data-aos="fade-up" data-aos-delay="200">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-stethoscope fa-3x text-success"></i>
                        </div>
                        <h4 class="fw-bold">Health Guaranteed</h4>
                        <p class="text-muted">Complete health records and veterinary certifications for all animals.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card text-center p-4 h-100" data-aos="fade-up" data-aos-delay="300">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-handshake fa-3x text-info"></i>
                        </div>
                        <h4 class="fw-bold">Secure Transactions</h4>
                        <p class="text-muted">Safe payment processing and escrow services for peace of mind.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card text-center p-4 h-100" data-aos="fade-up" data-aos-delay="400">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-truck fa-3x text-warning"></i>
                        </div>
                        <h4 class="fw-bold">Delivery Support</h4>
                        <p class="text-muted">Coordinated transportation and delivery services available.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card text-center p-4 h-100" data-aos="fade-up" data-aos-delay="500">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-headset fa-3x text-danger"></i>
                        </div>
                        <h4 class="fw-bold">24/7 Support</h4>
                        <p class="text-muted">Round-the-clock customer support to assist with any questions or concerns.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card text-center p-4 h-100" data-aos="fade-up" data-aos-delay="600">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-star fa-3x text-secondary"></i>
                        </div>
                        <h4 class="fw-bold">Review System</h4>
                        <p class="text-muted">Comprehensive review and rating system for informed decisions.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5 bg-primary text-white stats-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <h2 class="display-4 fw-bold mb-0 counter" data-target="5000">0</h2>
                        <p class="mb-0">Happy Customers</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <h2 class="display-4 fw-bold mb-0 counter" data-target="15000">0</h2>
                        <p class="mb-0">Pets Sold</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <h2 class="display-4 fw-bold mb-0 counter" data-target="500">0</h2>
                        <p class="mb-0">Verified Sellers</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <h2 class="display-4 fw-bold mb-0 counter" data-target="99">0</h2>
                        <p class="mb-0">Satisfaction Rate</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-5 newsletter-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h3 class="fw-bold mb-3">Stay Updated</h3>
                    <p class="text-muted mb-4">Get notified about new pet listings and special offers</p>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <form id="newsletterForm">
                                <div class="input-group">
                                    <input type="email" class="form-control" placeholder="Enter your email address"
                                        id="newsletterEmail" required>
                                    <button class="btn btn-primary" type="submit" id="subscribeBtn">
                                        <i class="fas fa-envelope me-2"></i>Subscribe
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer id="contact" class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h4 class="fw-bold mb-3">
                        <i class="fas fa-paw me-2"></i>PetMarket
                    </h4>
                    <p class="text-light">Your trusted marketplace for buying and selling premium pets. Connecting
                        loving families with healthy, happy animals.</p>
                    <div class="social-links">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-6 mb-4">
                    <h5 class="fw-bold mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#home" class="text-light text-decoration-none">Home</a></li>
                        <li><a href="#categories" class="text-light text-decoration-none">Categories</a></li>
                        <li><a href="#products" class="text-light text-decoration-none">Pets</a></li>
                        <li><a href="#about" class="text-light text-decoration-none">About</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 col-6 mb-4">
                    <h5 class="fw-bold mb-3">Services</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none">Buy Pets</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Sell Pets</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Pet Care</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Support</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 col-6 mb-4">
                    <h5 class="fw-bold mb-3">Support</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none">Help Center</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Safety</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Privacy</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Terms</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 col-6 mb-4">
                    <h5 class="fw-bold mb-3">Contact</h5>
                    <ul class="list-unstyled">
                        <li class="text-light"><i class="fas fa-phone me-2"></i>(555) 123-4567</li>
                        <li class="text-light"><i class="fas fa-envelope me-2"></i>info@petmarket.com</li>
                        <li class="text-light"><i class="fas fa-map-marker-alt me-2"></i>123 Pet Street, TX</li>
                    </ul>
                </div>
            </div>

            <hr class="my-4">

            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-light">&copy; 2024 PetMarket. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <small class="text-light">Made with <i class="fas fa-heart text-danger heartbeat"></i> for pet
                        lovers</small>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Bottom Navigation -->
    <div class="mobile-bottom-nav flex d-lg-none">
        <div class="nav-item">
            <a href="#home" class="nav-link active">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="#categories" class="nav-link">
                <i class="fas fa-th-large"></i>
                <span>Categories</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="#products" class="nav-link">
                <i class="fas fa-search"></i>
                <span>Pets</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="#" class="nav-link" id="mobileFavorites">
                <i class="fas fa-heart"></i>
                <span>Favorites</span>
                <div class="mobile-fav-badge" id="mobileFavCount">0</div>
            </a>
        </div>
        <div class="nav-item">
            <a href="#contact" class="nav-link">
                <i class="fas fa-envelope"></i>
                <span>Contact</span>
            </a>
        </div>
    </div>

    <!-- Go to Top Button -->
    <button id="goToTop" class="go-to-top">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- Pet Detail Modal -->
    <div class="modal fade" id="petDetailModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="petModalTitle">Premium Holstein Cow</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="petModalBody">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="https://images.pexels.com/photos/1108099/pexels-photo-1108099.jpeg"
                                class="img-fluid rounded" alt="Premium Holstein Cow">
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <span class="badge bg-primary me-2">cattle</span>
                                <span class="badge bg-success">available</span>
                            </div>
                            <p class="text-muted mb-3">Healthy 3-year-old Holstein dairy cow. Excellent milk producer
                                with complete health records.</p>
                            <div class="pet-details">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <strong>Price:</strong> $2,500
                                    </div>
                                    <div class="col-6">
                                        <strong>Age:</strong> 3 years
                                    </div>
                                    <div class="col-6">
                                        <strong>Breed:</strong> Holstein
                                    </div>
                                    <div class="col-6">
                                        <strong>Gender:</strong> Female
                                    </div>
                                    <div class="col-12">
                                        <strong>Location:</strong>
                                        <i class="fas fa-map-marker-alt me-1"></i>Farm Valley, TX
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="rating mb-3">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <span class="ms-2">Rating: 5.0/5</span>
                                </div>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-primary flex-fill">
                                        <i class="fas fa-phone me-2"></i>Contact Seller
                                    </button>
                                    <button class="btn btn-outline-primary">
                                        <i class="fas fa-share me-2"></i>Share
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fas fa-paw text-primary me-2"></i>
                <strong class="me-auto">PetMarket</strong>
                <small class="text-muted">Just now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body" id="toastMessage">
                <i class="fas fa-check-circle text-success me-2"></i>
                Pet added to favorites successfully!
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        // Enhanced PetMarket JavaScript
        document.addEventListener('DOMContentLoaded', function() {

            // Navbar scroll effect
            window.addEventListener('scroll', function() {
                const navbar = document.getElementById('mainNavbar');
                if (window.scrollY > 100) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // Smooth scrolling for navigation links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        const offsetTop = target.offsetTop - 80;
                        window.scrollTo({
                            top: offsetTop,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Stats counter animation
            function animateCounters() {
                const counters = document.querySelectorAll('.counter');
                const speed = 200; // The lower the slower

                counters.forEach(counter => {
                    const updateCount = () => {
                        const target = +counter.getAttribute('data-target');
                        const count = +counter.innerText;

                        const increment = target / speed;

                        if (count < target) {
                            counter.innerText = Math.ceil(count + increment);
                            setTimeout(updateCount, 1);
                        } else {
                            counter.innerText = target;
                        }
                    };

                    updateCount();
                });
            }

            // Intersection Observer for animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        if (entry.target.classList.contains('stats-section')) {
                            animateCounters();
                        }
                    }
                });
            }, observerOptions);

            // Observe elements
            const statsSection = document.querySelector('.stats-section');
            if (statsSection) {
                observer.observe(statsSection);
            }

            // Category filtering
            document.querySelectorAll('.category-card').forEach(card => {
                card.addEventListener('click', function() {
                    const category = this.getAttribute('data-category');
                    filterPetsByCategory(category);
                });
            });

            // Filter functionality
            function filterPetsByCategory(category) {
                const categoryFilter = document.getElementById('categoryFilter');
                categoryFilter.value = category;

                // Scroll to products section
                document.getElementById('products').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

                // Add visual feedback
                showToast(`Showing ${category} pets`, 'info');
            }

            // Search functionality
            document.getElementById('searchForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const query = document.getElementById('searchInput').value.trim();
                if (query) {
                    showToast(`Searching for "${query}"...`, 'info');
                    // Implement actual search logic here
                    document.getElementById('products').scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });

            // Newsletter subscription
            document.getElementById('newsletterForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const email = document.getElementById('newsletterEmail').value;
                if (email) {
                    showToast('Successfully subscribed to newsletter!', 'success');
                    this.reset();
                }
            });

            // Load more functionality
            document.getElementById('loadMoreBtn').addEventListener('click', function() {
                const btn = this;
                const originalText = btn.innerHTML;

                // Loading state
                btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';
                btn.disabled = true;

                // Simulate loading
                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                    showToast('More pets loaded!', 'success');
                }, 1500);
            });

            // Initialize tooltips and popovers if Bootstrap components are used
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
    <script>
        // Get the button
        const goToTopButton = document.getElementById("goToTop");

        // Show button when scrolling down
        window.onscroll = function() {
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                goToTopButton.style.display = "block";
            } else {
                goToTopButton.style.display = "none";
            }
        };

        // Smooth scroll to top when button clicked
        goToTopButton.addEventListener("click", function() {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    </script>


</body>

</html>