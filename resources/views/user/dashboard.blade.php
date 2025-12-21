@extends('layouts.frontend')

@section('title', 'My Dashboard')

@section('content')
<style>
.dashboard-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    background: #f8f9fa;
    min-height: 100vh;
}

.dashboard-header {
    background: white;
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.dashboard-header h1 {
    color: #2c3e50;
    font-size: 32px;
    font-weight: 700;
    margin: 0 0 10px 0;
}

.dashboard-header p {
    color: #6c757d;
    font-size: 16px;
    margin: 0;
}

.content-wrapper {
    display: flex;
    gap: 30px;
    align-items: flex-start;
}

.main-content {
    flex: 1;
    min-width: 0;
}

.sidebar {
    width: 320px;
    flex-shrink: 0;
}

/* Quick Actions Sidebar Styles */
.quick-actions-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-bottom: 20px;
}

.quick-actions-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 20px;
    text-align: center;
}

.quick-actions-header h5 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.quick-actions-header p {
    margin: 5px 0 0 0;
    font-size: 14px;
    opacity: 0.9;
}

.quick-actions-body {
    padding: 20px;
}

.quick-action-item {
    display: flex;
    align-items: center;
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 8px;
    background: #f8f9fa;
    text-decoration: none;
    color: inherit;
    transition: all 0.2s ease;
    border: 1px solid transparent;
}

.quick-action-item:hover {
    background: #e9ecef;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    text-decoration: none;
    color: inherit;
}

.quick-action-item:last-child {
    margin-bottom: 0;
}

.quick-action-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #007bff, #0056b3);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 16px;
    margin-right: 15px;
    flex-shrink: 0;
}

.quick-action-content h6 {
    margin: 0 0 3px 0;
    font-size: 14px;
    font-weight: 600;
    color: #2c3e50;
}

.quick-action-content p {
    margin: 0;
    font-size: 12px;
    color: #6c757d;
}

.quick-action-item:hover .quick-action-content h6 {
    color: #007bff;
}

/* Billing Overview Card */
.billing-overview-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.billing-overview-header {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    padding: 20px;
    text-align: center;
}

.billing-overview-header h5 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.billing-overview-body {
    padding: 20px;
}

.billing-overview-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #f1f3f4;
}

.billing-overview-item:last-child {
    border-bottom: none;
}

.billing-overview-label {
    color: #6c757d;
    font-size: 14px;
}

.billing-overview-value {
    font-weight: 600;
    font-size: 16px;
    color: #2c3e50;
}

.billing-overview-value.text-success {
    color: #28a745;
}

.billing-overview-value.text-warning {
    color: #ffc107;
}

.billing-overview-value.text-danger {
    color: #dc3545;
}

.stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    border-left: 4px solid #007bff;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
}

.stat-card:nth-child(2) {
    border-left-color: #28a745;
}

.stat-card:nth-child(3) {
    border-left-color: #17a2b8;
}

.stat-card:nth-child(4) {
    border-left-color: #ffc107;
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 15px;
    font-size: 20px;
    color: white;
}

.stat-card:nth-child(1) .stat-icon {
    background: #007bff;
}

.stat-card:nth-child(2) .stat-icon {
    background: #28a745;
}

.stat-card:nth-child(3) .stat-icon {
    background: #17a2b8;
}

.stat-card:nth-child(4) .stat-icon {
    background: #ffc107;
}

.stat-number {
    font-size: 28px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 5px;
}

.stat-label {
    color: #6c757d;
    font-size: 14px;
    font-weight: 500;
}

.alert-section {
    background: #fff3cd;
    border: 1px solid #ffeaa7;
    border-radius: 8px;
    padding: 15px 20px;
    margin-bottom: 30px;
    display: flex;
    align-items: center;
    gap: 15px;
}

.alert-section i {
    color: #856404;
    font-size: 20px;
}

.alert-section-content {
    color: #856404;
}

.alert-section-content strong {
    font-weight: 600;
}

.content-grid {
    display: grid;
    grid-template-columns: 1fr 350px;
    gap: 30px;
}

.main-column {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.main-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.card-header {
    background: #f8f9fa;
    padding: 20px 25px;
    border-bottom: 1px solid #dee2e6;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-title {
    color: #2c3e50;
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}

.btn-add {
    background: #007bff;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: background 0.2s ease;
}

.btn-add:hover {
    background: #0056b3;
    color: white;
}

.card-body {
    padding: 25px;
}

.view-all-link {
    text-align: center;
    padding-top: 15px;
    margin-top: 15px;
    border-top: 1px solid #f1f3f4;
}

.view-all-btn {
    color: #007bff;
    text-decoration: none;
    font-weight: 500;
    font-size: 14px;
    transition: color 0.2s ease;
}

.view-all-btn:hover {
    color: #0056b3;
}

/* Enhanced Activity Timeline */
.activity-timeline {
    position: relative;
    padding-left: 30px;
}

.activity-timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    padding-bottom: 25px;
}

.timeline-item:last-child {
    padding-bottom: 0;
}

.timeline-marker {
    position: absolute;
    left: -30px;
    top: 5px;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 12px;
    border: 2px solid white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.timeline-purchase {
    background: linear-gradient(135deg, #28a745, #20c997);
}

.timeline-download {
    background: linear-gradient(135deg, #17a2b8, #20c997);
}

.timeline-profile {
    background: linear-gradient(135deg, #007bff, #6610f2);
}

.timeline-renewal {
    background: linear-gradient(135deg, #ffc107, #fd7e14);
}

.timeline-content {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 15px 20px;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.timeline-content:hover {
    background: white;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transform: translateY(-2px);
}

.timeline-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.timeline-header h6 {
    margin: 0;
    font-weight: 600;
    color: #2c3e50;
    font-size: 14px;
}

.timeline-time {
    color: #6c757d;
    font-size: 12px;
    font-weight: 500;
}

.timeline-content p {
    margin: 0;
    color: #6c757d;
    font-size: 13px;
    line-height: 1.4;
}

/* Enhanced Stats Section */
.stats-section {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.stats-header {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    padding: 20px 25px;
    border-bottom: 1px solid #dee2e6;
}

.stats-title {
    color: #2c3e50;
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}

.stats-grid-enhanced {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 0;
}

.stat-card-enhanced {
    padding: 30px 25px;
    display: flex;
    align-items: center;
    gap: 20px;
    border-right: 1px solid #f1f3f4;
    transition: all 0.3s ease;
}

.stat-card-enhanced:last-child {
    border-right: none;
}

.stat-card-enhanced:hover {
    background: #f8f9fa;
}

.stat-icon-enhanced {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    transition: transform 0.3s ease;
}

.stat-card-enhanced:hover .stat-icon-enhanced {
    transform: scale(1.1);
}

.stat-icon-money {
    background: linear-gradient(135deg, #28a745, #20c997);
}

.stat-icon-download {
    background: linear-gradient(135deg, #17a2b8, #007bff);
}

.stat-icon-support {
    background: linear-gradient(135deg, #ffc107, #fd7e14);
}

.stat-details {
    flex: 1;
}

.stat-number-enhanced {
    font-size: 32px;
    font-weight: 800;
    color: #2c3e50;
    margin-bottom: 5px;
    line-height: 1;
}

.stat-label-enhanced {
    color: #6c757d;
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 8px;
}

.stat-change {
    font-size: 12px;
    font-weight: 600;
    padding: 4px 8px;
    border-radius: 20px;
    display: inline-block;
}

.stat-change.positive {
    background: #d4edda;
    color: #155724;
}

.stat-change.negative {
    background: #f8d7da;
    color: #721c24;
}

/* Billing Section */
.billing-item {
    padding: 15px 0;
    border-bottom: 1px solid #f1f3f4;
}

.billing-item:last-child {
    border-bottom: none;
}

.billing-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 5px;
}

.billing-label {
    color: #2c3e50;
    font-weight: 500;
    font-size: 14px;
}

.billing-amount {
    color: #007bff;
    font-weight: 600;
    font-size: 14px;
}

.billing-date {
    color: #6c757d;
    font-size: 12px;
}

.billing-link {
    display: block;
    text-align: center;
    padding-top: 15px;
    margin-top: 15px;
    border-top: 1px solid #f1f3f4;
    color: #007bff;
    text-decoration: none;
    font-weight: 500;
    font-size: 14px;
    transition: color 0.2s ease;
}

.billing-link:hover {
    color: #0056b3;
}

/* Enhanced Sidebar Cards */
.sidebar-card-enhanced {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-bottom: 20px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.sidebar-card-enhanced:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
}

.sidebar-header-enhanced {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    padding: 15px 20px;
    border-bottom: 1px solid #dee2e6;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.sidebar-title-enhanced {
    color: #2c3e50;
    font-size: 16px;
    font-weight: 600;
    margin: 0;
}

.billing-icon,
.downloads-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 14px;
}

.billing-icon {
    background: linear-gradient(135deg, #28a745, #20c997);
}

.downloads-icon {
    background: linear-gradient(135deg, #17a2b8, #007bff);
}

.sidebar-body-enhanced {
    padding: 20px;
}

/* Enhanced Billing Section */
.billing-amount-card {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    text-align: center;
}

.billing-amount-main {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.billing-label-enhanced {
    color: #6c757d;
    font-size: 13px;
    font-weight: 500;
}

.billing-amount-enhanced {
    color: #28a745;
    font-size: 24px;
    font-weight: 700;
}

.billing-date-enhanced {
    color: #6c757d;
    font-size: 12px;
}

.billing-stats {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 20px;
}

.billing-stat-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #f1f3f4;
}

.billing-stat-item:last-child {
    border-bottom: none;
}

.billing-stat-label {
    color: #2c3e50;
    font-size: 13px;
    font-weight: 500;
}

.billing-stat-value {
    color: #007bff;
    font-weight: 600;
    font-size: 14px;
}

.billing-link-enhanced {
    display: block;
    text-align: center;
    padding: 10px;
    background: #f8f9fa;
    border-radius: 8px;
    color: #007bff;
    text-decoration: none;
    font-weight: 500;
    font-size: 13px;
    transition: all 0.3s ease;
}

.billing-link-enhanced:hover {
    background: #007bff;
    color: white;
}

/* Billing History Section */
.billing-history-section {
    margin: 20px 0;
}

.billing-history-title {
    color: #2c3e50;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 15px;
    padding-bottom: 8px;
    border-bottom: 1px solid #e9ecef;
}

.billing-history-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 15px;
}

.billing-history-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px;
    background: #f8f9fa;
    border-radius: 8px;
    border: 1px solid #e9ecef;
    transition: all 0.2s ease;
}

.billing-history-item:hover {
    background: #e9ecef;
    transform: translateY(-1px);
}

.billing-history-info {
    flex: 1;
}

.billing-history-desc {
    display: flex;
    flex-direction: column;
    gap: 2px;
    margin-bottom: 4px;
}

.billing-history-product {
    color: #2c3e50;
    font-weight: 500;
    font-size: 13px;
}

.billing-history-plan {
    color: #6c757d;
    font-size: 11px;
    font-weight: 400;
}

.billing-history-meta {
    display: flex;
    gap: 10px;
}

.billing-history-date {
    color: #6c757d;
    font-size: 11px;
}

.billing-history-id {
    color: #007bff;
    font-size: 11px;
    font-family: monospace;
}

.billing-history-amount {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 2px;
}

.amount-value {
    color: #28a745;
    font-weight: 600;
    font-size: 14px;
}

.amount-status {
    font-size: 10px;
    padding: 2px 6px;
    border-radius: 4px;
    font-weight: 500;
}

.amount-status.active {
    background: #d4edda;
    color: #155724;
}

.amount-status.expired {
    background: #f8d7da;
    color: #721c24;
}

.amount-status.cancelled {
    background: #f8f9fa;
    color: #6c757d;
}

.billing-history-empty {
    text-align: center;
    padding: 30px 20px;
    color: #6c757d;
}

.billing-history-empty i {
    font-size: 24px;
    margin-bottom: 10px;
    display: block;
}

.billing-history-empty p {
    font-size: 13px;
    margin: 0;
}

/* Enhanced Downloads Section */
.downloads-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 20px;
}

.download-item-enhanced {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    background: #f8f9fa;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.download-item-enhanced:hover {
    background: #e9ecef;
    transform: translateX(5px);
}

.download-file-icon {
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg, #17a2b8, #007bff);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 14px;
    flex-shrink: 0;
}

.download-details {
    flex: 1;
}

.download-details h6 {
    margin: 0 0 3px 0;
    font-weight: 600;
    color: #2c3e50;
    font-size: 13px;
}

.download-size {
    color: #6c757d;
    font-size: 11px;
}

.download-time {
    color: #adb5bd;
    font-size: 11px;
    font-weight: 500;
}

.download-link-enhanced {
    display: block;
    text-align: center;
    padding: 10px;
    background: #f8f9fa;
    border-radius: 8px;
    color: #007bff;
    text-decoration: none;
    font-weight: 500;
    font-size: 13px;
    transition: all 0.3s ease;
}

.download-link-enhanced:hover {
    background: #007bff;
    color: white;
}

.main-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.card-header {
    background: #f8f9fa;
    padding: 20px 25px;
    border-bottom: 1px solid #dee2e6;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-title {
    color: #2c3e50;
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}

.btn-add {
    background: #007bff;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: background 0.2s ease;
}

.btn-add:hover {
    background: #0056b3;
    color: white;
}

.card-body {
    padding: 25px;
}

.subscriptions-table {
    width: 100%;
    border-collapse: collapse;
}

.subscriptions-table th {
    background: #f8f9fa;
    padding: 12px 15px;
    text-align: left;
    font-weight: 600;
    color: #495057;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 1px solid #dee2e6;
}

.subscriptions-table td {
    padding: 15px;
    border-bottom: 1px solid #f1f3f4;
    vertical-align: middle;
}

.subscriptions-table tr:hover {
    background: #f8f9fa;
}

.product-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.product-icon {
    width: 40px;
    height: 40px;
    background: #007bff;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 16px;
}

.product-details h6 {
    margin: 0 0 3px 0;
    font-weight: 600;
    color: #2c3e50;
    font-size: 14px;
}

.product-details small {
    color: #6c757d;
    font-size: 12px;
}

.badge {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 500;
    text-transform: uppercase;
}

.badge-primary {
    background: #007bff;
    color: white;
}

.badge-success {
    background: #28a745;
    color: white;
}

.badge-warning {
    background: #ffc107;
    color: #212529;
}

.badge-secondary {
    background: #6c757d;
    color: white;
}

.action-btns {
    display: flex;
    gap: 5px;
}

.btn-icon {
    width: 30px;
    height: 30px;
    border: 1px solid #dee2e6;
    background: white;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    text-decoration: none;
    font-size: 12px;
    transition: all 0.2s ease;
}

.btn-icon:hover {
    background: #007bff;
    color: white;
    border-color: #007bff;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
}

.empty-state i {
    font-size: 48px;
    color: #dee2e6;
    margin-bottom: 20px;
}

.empty-state h5 {
    color: #6c757d;
    margin-bottom: 10px;
    font-weight: 500;
}

.empty-state p {
    color: #adb5bd;
    margin-bottom: 20px;
}

.btn-primary {
    background: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: background 0.2s ease;
}

.btn-primary:hover {
    background: #0056b3;
    color: white;
}

.sidebar {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.sidebar-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.sidebar-header {
    background: #f8f9fa;
    padding: 15px 20px;
    border-bottom: 1px solid #dee2e6;
}

.sidebar-title {
    color: #2c3e50;
    font-size: 16px;
    font-weight: 600;
    margin: 0;
}

.sidebar-body {
    padding: 0;
}

.action-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 15px 20px;
    text-decoration: none;
    color: #2c3e50;
    border-bottom: 1px solid #f1f3f4;
    transition: background 0.2s ease;
}

.action-link:hover {
    background: #f8f9fa;
}

.action-link:last-child {
    border-bottom: none;
}

.action-link i {
    width: 32px;
    height: 32px;
    background: #007bff;
    color: white;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}

.action-content h6 {
    margin: 0 0 2px 0;
    font-weight: 500;
    font-size: 14px;
}

.action-content small {
    color: #6c757d;
    font-size: 12px;
}

.support-links {
    padding: 20px;
}

.support-link {
    display: block;
    background: #f8f9fa;
    color: #495057;
    padding: 10px 15px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 10px;
    transition: background 0.2s ease;
    border: 1px solid transparent;
}

.support-link:hover {
    background: #007bff;
    color: white;
}

.support-link:last-child {
    margin-bottom: 0;
}

@media (max-width: 968px) {
    .content-wrapper {
        flex-direction: column;
        gap: 20px;
    }
    
    .sidebar {
        width: 100%;
    }
    
    .stats-row {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
}

@media (max-width: 768px) {
    .dashboard-container {
        padding: 15px;
    }
    
    .dashboard-header h1 {
        font-size: 24px;
    }
    
    .stats-row {
        grid-template-columns: 1fr;
    }
    
    .card-header {
        flex-direction: column;
        gap: 10px;
        align-items: flex-start;
    }
    
    .subscriptions-table {
        font-size: 14px;
    }
    
    .subscriptions-table th,
    .subscriptions-table td {
        padding: 10px;
    }
    
    .product-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
}
</style>

<div class="dashboard-container">
    <!-- Header -->
    <div class="dashboard-header">
        <h1>Welcome back, {{ auth()->user()->name }}!</h1>
        <p>Manage your subscriptions and licenses from your personal dashboard.</p>
    </div>

    <!-- Stats Cards -->
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="stat-number">{{ $totalSubscriptions }}</div>
            <div class="stat-label">Total Subscriptions</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-number">{{ $activeSubscriptions }}</div>
            <div class="stat-label">Active Subscriptions</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-key"></i>
            </div>
            <div class="stat-number">{{ $totalLicenses }}</div>
            <div class="stat-label">Total Licenses</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <div class="stat-number">{{ $activeLicenses }}</div>
            <div class="stat-label">Active Licenses</div>
        </div>
    </div>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Main Content -->
        <div class="main-content">
            <!-- Alert -->
            @if($expiringSoon->count() > 0)
            <div class="alert-section">
                <i class="fas fa-exclamation-triangle"></i>
                <div class="alert-section-content">
                    <strong>{{ $expiringSoon->count() }} subscription(s) expiring soon!</strong> 
                    Renew your subscriptions to continue enjoying our services.
                </div>
            </div>
            @endif

            <!-- Recent Subscriptions -->
            <div class="main-card">
                <div class="card-header">
                    <h5 class="card-title">Recent Subscriptions</h5>
                    <a href="{{ route('products.index') }}" class="btn-add">
                        <i class="fas fa-plus"></i> Add New
                    </a>
                </div>
                <div class="card-body">
                    @if($recentSubscriptions->count() > 0)
                        <div style="overflow-x: auto;">
                            <table class="subscriptions-table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Plan</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Expires</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentSubscriptions->take(5) as $subscription)
                                        <tr>
                                            <td>
                                                <div class="product-info">
                                                    <div class="product-icon">
                                                        <i class="fas fa-cube"></i>
                                                    </div>
                                                    <div class="product-details">
                                                        <h6>{{ $subscription->product->name }}</h6>
                                                        <small>ID: {{ $subscription->id }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary">{{ ucfirst($subscription->plan) }}</span>
                                            </td>
                                            <td><strong>${{ number_format($subscription->amount, 2) }}</strong></td>
                                            <td>
                                                @if($subscription->status === 'active' && (!$subscription->expires_at || $subscription->expires_at->isFuture()))
                                                    <span class="badge badge-success">Active</span>
                                                @elseif($subscription->expires_at && $subscription->expires_at->isPast())
                                                    <span class="badge badge-warning">Expired</span>
                                                @else
                                                    <span class="badge badge-secondary">{{ ucfirst($subscription->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($subscription->expires_at)
                                                    <small class="{{ $subscription->expires_at->isPast() ? 'text-danger' : 'text-muted' }}">
                                                        {{ $subscription->expires_at->format('M d, Y') }}
                                                        @if($subscription->expires_at->isPast())
                                                            <br><span class="text-danger">({{ $subscription->expires_at->diffForHumans() }})</span>
                                                        @endif
                                                    </small>
                                                @else
                                                    <span class="text-muted">Never</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="action-btns">
                                                    @if($subscription->license)
                                                        <a href="{{ route('user.licenses') }}" class="btn-icon" title="View License Key: {{ $subscription->license->license_key }}">
                                                            <i class="fas fa-key"></i>
                                                        </a>
                                                    @endif
                                                    <button class="btn-icon" title="Renew Subscription" onclick="renewSubscription({{ $subscription->id }}, {{ $subscription->license->id ?? 'null' }}, '{{ $subscription->product->name }}', '{{ $subscription->plan }}', {{ $subscription->amount }}, '{{ $subscription->expires_at }}', {{ $subscription->product->price_monthly }}, {{ $subscription->product->price_yearly }})">
                                                        <i class="fas fa-sync"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="view-all-link">
                            <a href="{{ route('user.licenses') }}" class="view-all-btn">View All Licenses →</a>
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-shopping-cart"></i>
                            <h5>No subscriptions yet</h5>
                            <p>Get started by browsing our plugin collection.</p>
                            <a href="{{ route('products.index') }}" class="btn-primary">
                                <i class="fas fa-shopping-cart"></i> Browse Plugins
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="main-card">
                <div class="card-header">
                    <h5 class="card-title">Recent Activity</h5>
                    <div class="activity-filter">
                        <select class="filter-select">
                            <option>All Activity</option>
                            <option>Purchases</option>
                            <option>Downloads</option>
                            <option>Profile Updates</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="activity-timeline">
                        @if(isset($recentActivity) && $recentActivity->count() > 0)
                            @foreach($recentActivity as $activity)
                            <div class="timeline-item">
                                <div class="timeline-marker timeline-{{ $activity['type'] ?? 'default' }}">
                                    <i class="fas fa-{{ $activity['icon'] ?? 'circle' }}"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6>{{ $activity['title'] ?? 'Activity' }}</h6>
                                    <p>{{ $activity['description'] ?? 'No description' }}</p>
                                    <span class="activity-time">{{ $activity['time'] ?? 'Recently' }}</span>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="text-center text-muted py-4">
                                <i class="fas fa-clock fa-2x mb-2"></i>
                                <p>No recent activity found.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="stats-section">
                <div class="stats-header">
                    <h5 class="stats-title">Quick Stats</h5>
                </div>
                <div class="stats-grid-enhanced">
                    <div class="stat-card-enhanced">
                        <div class="stat-icon-enhanced stat-icon-money">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-details">
                            <div class="stat-number-enhanced">${{ number_format($totalSpent, 2) }}</div>
                            <div class="stat-label-enhanced">Total Spent</div>
                            <div class="stat-change positive">+${{ number_format($thisMonthSpent, 2) }} this month</div>
                        </div>
                    </div>
                    <div class="stat-card-enhanced">
                        <div class="stat-icon-enhanced stat-icon-download">
                            <i class="fas fa-download"></i>
                        </div>
                        <div class="stat-details">
                            <div class="stat-number-enhanced">{{ $totalLicenses }}</div>
                            <div class="stat-label-enhanced">Downloads</div>
                            <div class="stat-change positive">{{ $activeLicenses }} active</div>
                        </div>
                    </div>
                    <div class="stat-card-enhanced">
                        <div class="stat-icon-enhanced stat-icon-support">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-details">
                            <div class="stat-number-enhanced">2.3h</div>
                            <div class="stat-label-enhanced">Avg. Support Time</div>
                            <div class="stat-change negative">+15min slower</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Quick Actions Card 1 -->
            <div class="quick-actions-card">
                <div class="quick-actions-header">
                    <h5><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                    <p>Manage your account efficiently</p>
                </div>
                <div class="quick-actions-body">
                    <a href="{{ route('products.index') }}" class="quick-action-item">
                        <div class="quick-action-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Buy New License</h6>
                            <p>Purchase additional plugins</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('user.licenses') }}" class="quick-action-item">
                        <div class="quick-action-icon">
                            <i class="fas fa-key"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>My Licenses</h6>
                            <p>View and manage licenses</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('user.billing.history') }}" class="quick-action-item">
                        <div class="quick-action-icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Billing History</h6>
                            <p>View payment records</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Billing Overview Card -->
            <div class="billing-overview-card">
                <div class="billing-overview-header">
                    <h5><i class="fas fa-chart-bar me-2"></i>BILLING OVERVIEW</h5>
                </div>
                <div class="billing-overview-body">
                    
                    <div class="billing-overview-item">
                        <span class="billing-overview-label">Purchase Amount</span>
                        <span class="billing-overview-value text-success">${{ number_format($finalPurchaseAmount ?? 0, 2) }}</span>
                    </div>
                    <div class="billing-overview-item">
                        <span class="billing-overview-label">Renewal Amount</span>
                        <span class="billing-overview-value text-info">${{ number_format($finalRenewalAmount ?? 0, 2) }}</span>
                    </div>
                    <div class="billing-overview-item">
                        <span class="billing-overview-label">Total Spent</span>
                        <span class="billing-overview-value text-success">${{ number_format($totalSpent ?? 0, 2) }}</span>
                    </div>
                    <div class="billing-overview-item">
                        <span class="billing-overview-label">This Month</span>
                        <span class="billing-overview-value">${{ number_format($thisMonthSpent ?? 0, 2) }}</span>
                    </div>
                    <div class="billing-overview-item">
                        <span class="billing-overview-label">Active Subscriptions</span>
                        <span class="billing-overview-value">{{ $activeSubscriptions ?? 0 }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card 2 -->
            <div class="quick-actions-card">
                <div class="quick-actions-header" style="background: linear-gradient(135deg, #28a745, #20c997);">
                    <h5><i class="fas fa-cog me-2"></i>Account Actions</h5>
                    <p>Settings and support options</p>
                </div>
                <div class="quick-actions-body">
                    <a href="{{ route('user.profile') }}" class="quick-action-item">
                        <div class="quick-action-icon" style="background: linear-gradient(135deg, #28a745, #20c997);">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Account Settings</h6>
                            <p>Update profile information</p>
                        </div>
                    </a>
                    
                    <a href="#" onclick="showDashboardSupportModal()" class="quick-action-item">
                        <div class="quick-action-icon" style="background: linear-gradient(135deg, #28a745, #20c997);">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Get Support</h6>
                            <p>Contact support team</p>
                        </div>
                    </a>
                    
                    <a href="#" onclick="downloadAllData()" class="quick-action-item">
                        <div class="quick-action-icon" style="background: linear-gradient(135deg, #28a745, #20c997);">
                            <i class="fas fa-download"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Download Data</h6>
                            <p>Export all your data</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dashboard Support Modal -->
<div class="modal fade" id="dashboardSupportModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-headset me-2"></i>Dashboard Support
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <i class="fas fa-headset fa-3x text-primary mb-3"></i>
                    <h5>How can we help you?</h5>
                    <p class="text-muted">Our support team is here to assist you with any questions or issues.</p>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 border-primary">
                            <div class="card-body text-center">
                                <i class="fas fa-envelope fa-2x text-primary mb-2"></i>
                                <h6 class="card-title">Email Support</h6>
                                <p class="card-text small">support@moonplugins.com</p>
                                <small class="text-muted">Response within 24 hours</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 border-success">
                            <div class="card-body text-center">
                                <i class="fas fa-comments fa-2x text-success mb-2"></i>
                                <h6 class="card-title">Live Chat</h6>
                                <p class="card-text small">Available 9am-5pm EST</p>
                                <small class="text-muted">Instant response</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-3">
                    <label class="form-label">Describe your issue:</label>
                    <textarea class="form-control" rows="3" placeholder="Please describe your issue or question..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitDashboardSupportRequest()">
                    <i class="fas fa-paper-plane me-1"></i> Submit Request
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function showDashboardSupportModal() {
    const modal = new bootstrap.Modal(document.getElementById('dashboardSupportModal'));
    modal.show();
}

function submitDashboardSupportRequest() {
    const textarea = document.querySelector('#dashboardSupportModal textarea');
    const message = textarea.value.trim();
    
    if (!message) {
        alert('Please describe your issue before submitting.');
        return;
    }
    
    showNotification('Support request submitted successfully! We\'ll respond within 24 hours.', 'success');
    
    const modal = bootstrap.Modal.getInstance(document.getElementById('dashboardSupportModal'));
    modal.hide();
    textarea.value = '';
}

function downloadAllData() {
    // Collect basic user data
    const userData = {
        user: {
            name: "{{ auth()->user()->name }}",
            email: "{{ auth()->user()->email }}",
            created_at: "{{ auth()->user()->created_at }}"
        },
        total_subscriptions: {{ $totalSubscriptions }},
        active_subscriptions: {{ $activeSubscriptions }},
        total_licenses: {{ $totalLicenses }},
        active_licenses: {{ $activeLicenses }},
        total_spent: {{ $totalSpent }},
        this_month_spent: {{ $thisMonthSpent }},
        export_date: new Date().toISOString()
    };
    
    // Create and download the file
    const dataStr = JSON.stringify(userData, null, 2);
    const dataUri = 'data:application/json;charset=utf-8,'+ encodeURIComponent(dataStr);
    
    const exportFileDefaultName = 'user_data_export_' + new Date().toISOString().split('T')[0] + '.json';
    
    const linkElement = document.createElement('a');
    linkElement.setAttribute('href', dataUri);
    linkElement.setAttribute('download', exportFileDefaultName);
    linkElement.click();
    
    showNotification('All data exported successfully!', 'success');
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 5000);
}
</script>

<!-- Renewal Modal -->
<div class="modal fade" id="renewalModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-sync-alt me-2"></i>Renew Subscription
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="renewalForm" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Step 1: Renewal Details -->
                    <div id="renewalStep">
                        <div class="alert alert-info mb-3">
                            <i class="fas fa-info-circle me-2"></i>
                            Renew your subscription to continue enjoying premium features and updates.
                        </div>
                        
                        <input type="hidden" id="renewalSubscriptionId" name="subscription_id">
                        <input type="hidden" id="renewalLicenseId" name="license_id">
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">
                                    <i class="fas fa-cube me-1"></i>Plugin
                                </label>
                                <input type="text" class="form-control" id="renewalPluginName" readonly>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-calendar me-1"></i>Current Plan
                                </label>
                                <input type="text" class="form-control" id="renewalCurrentPlan" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-dollar-sign me-1"></i>Current Price
                                </label>
                                <input type="text" class="form-control" id="renewalCurrentPrice" readonly>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-calendar-alt me-1"></i>Renewal Period
                                </label>
                                <select class="form-select" id="renewalPeriod" name="renewal_period" required>
                                    <option value="monthly">Monthly</option>
                                    <option value="yearly">Yearly (Save 20%)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-tag me-1"></i>New Price
                                </label>
                                <input type="text" class="form-control" id="renewalNewPrice" readonly>
                                <input type="hidden" id="renewalAmount" name="amount">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-calendar-check me-1"></i>Start Date
                            </label>
                            <input type="date" class="form-control" id="renewalStartDate" name="start_date" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-calendar-times me-1"></i>End Date
                            </label>
                            <input type="date" class="form-control" id="renewalEndDate" name="end_date" readonly>
                        </div>
                        
                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <h6 class="card-title text-primary mb-2">
                                    <i class="fas fa-shield-alt me-2"></i>Payment Summary
                                </h6>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Subtotal:</span>
                                    <span id="subtotalAmount">$0.00</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center text-success">
                                    <strong>Total:</strong>
                                    <strong id="totalAmount">$0.00</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step 2: Payment Details -->
                    <div id="paymentStep" style="display: none;">
                        <h6 class="mb-3">
                            <i class="fas fa-credit-card me-2"></i>Payment Information
                        </h6>
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Cardholder Name</label>
                                <input type="text" class="form-control" id="cardholderName" placeholder="John Doe" required>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    You will be redirected to Razorpay to complete your payment securely.
                                </div>
                            </div>
                        </div>
                        
                        <div class="card border-warning bg-light mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-lock text-warning me-2"></i>
                                    <small class="mb-0">Your payment information is secure and encrypted</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="card-title text-primary mb-2">
                                    <i class="fas fa-receipt me-2"></i>Order Summary
                                </h6>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>Plugin:</span>
                                    <strong id="orderPluginName">-</strong>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>Plan:</span>
                                    <strong id="orderPlanName">-</strong>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>Duration:</span>
                                    <strong id="orderDuration">-</strong>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center text-success">
                                    <strong>Total Amount:</strong>
                                    <strong id="orderTotal">$0.00</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="renewalFooter">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Cancel
                        </button>
                        <button type="button" class="btn btn-success" onclick="showPaymentStep()">
                            <i class="fas fa-arrow-right me-1"></i> Proceed to Payment
                        </button>
                    </div>
                    <div id="paymentFooter" style="display: none;">
                        <button type="button" class="btn btn-secondary" onclick="showRenewalStep()">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </button>
                        <button type="button" class="btn btn-success" onclick="processPayment()">
                            <i class="fas fa-lock me-1"></i> Complete Payment
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
// Razorpay initialization not needed here as it's done on demand




function renewSubscription(subscriptionId, licenseId, pluginName, currentPlan, currentAmount, expiresAt, productMonthlyPrice, productYearlyPrice) {
    // Set the renewal form data
    document.getElementById('renewalSubscriptionId').value = subscriptionId;
    document.getElementById('renewalLicenseId').value = licenseId;
    document.getElementById('renewalPluginName').value = pluginName;
    document.getElementById('renewalCurrentPlan').value = currentPlan.charAt(0).toUpperCase() + currentPlan.slice(1);
    document.getElementById('renewalCurrentPrice').value = `$${parseFloat(currentAmount).toFixed(2)}`;
    
    // Use actual product prices from database
    let monthlyPrice = parseFloat(productMonthlyPrice) || 0;
    let yearlyPrice = parseFloat(productYearlyPrice) || (monthlyPrice * 12);
    
    console.log('Dashboard price calculation using database prices:', {
        currentPlan: currentPlan,
        currentAmount: currentAmount,
        productMonthlyPrice: productMonthlyPrice,
        productYearlyPrice: productYearlyPrice,
        finalMonthlyPrice: monthlyPrice,
        finalYearlyPrice: yearlyPrice
    });
    
    // Check if license is expired
    const today = new Date();
    const expiryDate = expiresAt ? new Date(expiresAt) : null;
    const isExpired = expiryDate ? expiryDate < today : true;
    
    let startDate;
    if (isExpired) {
        // License is expired, start from today
        startDate = today;
        console.log('License is expired, starting from today:', startDate.toISOString().split('T')[0]);
    } else {
        // License is still active, start from expiry date
        startDate = expiryDate;
        console.log('License is active, starting from expiry date:', startDate.toISOString().split('T')[0]);
    }
    
    // Set start date
    document.getElementById('renewalStartDate').value = startDate.toISOString().split('T')[0];
    
    // Show the modal first
    const renewalModal = new bootstrap.Modal(document.getElementById('renewalModal'));
    renewalModal.show();
    
    // Small delay to ensure modal is fully rendered, then set up everything
    setTimeout(() => {
        // Remove existing event listeners to prevent duplicates
        const periodElement = document.getElementById('renewalPeriod');
        const startDateElement = document.getElementById('renewalStartDate');
        
        if (periodElement && startDateElement) {
            // Clone elements to remove event listeners
            const newPeriodElement = periodElement.cloneNode(true);
            const newStartDateElement = startDateElement.cloneNode(true);
            
            periodElement.parentNode.replaceChild(newPeriodElement, periodElement);
            startDateElement.parentNode.replaceChild(newStartDateElement, startDateElement);
            
            // NOW set renewal period to current plan (default selection) - do this after cloning
            const renewalPeriodSelect = document.getElementById('renewalPeriod');
            if (renewalPeriodSelect) {
                renewalPeriodSelect.value = currentPlan;
                
                // Make sure the correct option is selected
                const options = renewalPeriodSelect.options;
                for (let i = 0; i < options.length; i++) {
                    if (options[i].value === currentPlan) {
                        options[i].selected = true;
                    } else {
                        options[i].selected = false;
                    }
                }
                
                console.log('Set renewal period to:', currentPlan, 'Current value:', renewalPeriodSelect.value);
            } else {
                console.log('Renewal period select element not found after cloning');
            }
            
            // Add fresh event listeners
            newPeriodElement.addEventListener('change', function() {
                updateRenewalPriceWithProductPrices(monthlyPrice, yearlyPrice, this.value);
                updateEndDate();
                updateDurationDisplay();
            });
            
            newStartDateElement.addEventListener('change', function() {
                updateEndDate();
                updateDurationDisplay();
            });
            
            // Initialize end date
            updateEndDate();
            
            // Calculate price based on actual product prices and current selection
            const selectedPeriod = document.getElementById('renewalPeriod').value;
            console.log('About to call updateRenewalPriceWithProductPrices with:', {
                monthlyPrice: monthlyPrice,
                yearlyPrice: yearlyPrice,
                selectedPeriod: selectedPeriod,
                currentPlan: currentPlan
            });
            updateRenewalPriceWithProductPrices(monthlyPrice, yearlyPrice, selectedPeriod);
        } else {
            console.error('Modal elements not found');
        }
    }, 100);
}

function updateRenewalPriceWithProductPrices(monthlyPrice, yearlyPrice, currentPlan) {
    const period = document.getElementById('renewalPeriod').value;
    let newAmount = 0;
    let priceText = '';
    
    console.log('updateRenewalPriceWithProductPrices called with:', {
        monthlyPrice: monthlyPrice,
        yearlyPrice: yearlyPrice,
        currentPlan: currentPlan,
        selectedPeriod: period,
        periodElement: document.getElementById('renewalPeriod'),
        periodElementValue: document.getElementById('renewalPeriod')?.value
    });
    
    switch(period) {
        case 'monthly':
            newAmount = monthlyPrice;
            priceText = `$${newAmount.toFixed(2)} / month`;
            console.log('Monthly case - newAmount:', newAmount, 'priceText:', priceText);
            break;
        case 'yearly':
            newAmount = yearlyPrice;
            priceText = `$${newAmount.toFixed(2)} / year (Save 20%)`;
            console.log('Yearly case - newAmount:', newAmount, 'priceText:', priceText);
            break;
        default:
            console.log('Unknown period:', period);
            newAmount = monthlyPrice;
            priceText = `$${newAmount.toFixed(2)} / month`;
    }
    
    console.log('Calculated renewal price:', {
        newAmount: newAmount,
        priceText: priceText
    });
    
    const newPriceElement = document.getElementById('renewalNewPrice');
    const amountElement = document.getElementById('renewalAmount');
    
    console.log('Elements found:', {
        newPriceElement: !!newPriceElement,
        amountElement: !!amountElement,
        newPriceValue: newPriceElement?.value,
        amountValue: amountElement?.value
    });
    
    if (newPriceElement && amountElement) {
        newPriceElement.value = priceText;
        amountElement.value = newAmount.toFixed(2);
        
        // Update payment summary
        document.getElementById('subtotalAmount').textContent = `$${newAmount.toFixed(2)}`;
        document.getElementById('totalAmount').textContent = `$${newAmount.toFixed(2)}`;
        
        console.log('Updated elements with new prices');
    } else {
        console.error('Could not find price elements to update');
    }
}

function updateRenewalPrice(baseAmount) {
    const period = document.getElementById('renewalPeriod').value;
    // Ensure baseAmount is a number
    const amount = parseFloat(baseAmount) || 0;
    let newAmount = amount;
    let priceText = '';
    
    switch(period) {
        case 'monthly':
            newAmount = amount;
            priceText = `$${newAmount.toFixed(2)} / month`;
            break;
        case 'yearly':
            newAmount = amount * 12 * 0.8; // 20% discount for yearly
            priceText = `$${newAmount.toFixed(2)} / year (Save 20%)`;
            break;
    }
    
    document.getElementById('renewalNewPrice').value = priceText;
    document.getElementById('renewalAmount').value = newAmount.toFixed(2);
    
    // Update payment summary
    document.getElementById('subtotalAmount').textContent = `$${newAmount.toFixed(2)}`;
    document.getElementById('totalAmount').textContent = `$${newAmount.toFixed(2)}`;
}

function updateEndDate() {
    const startDate = new Date(document.getElementById('renewalStartDate').value);
    const period = document.getElementById('renewalPeriod').value;
    let endDate = new Date(startDate);
    
    switch(period) {
        case 'monthly':
            endDate.setMonth(endDate.getMonth() + 1);
            break;
        case 'yearly':
            endDate.setFullYear(endDate.getFullYear() + 1);
            break;
    }
    
    document.getElementById('renewalEndDate').value = endDate.toISOString().split('T')[0];
}

// Update duration display function
function updateDurationDisplay() {
    const startDate = document.getElementById('renewalStartDate').value;
    const endDate = document.getElementById('renewalEndDate').value;
    const renewalPeriod = document.getElementById('renewalPeriod').value;
    
    if (startDate && endDate) {
        const start = new Date(startDate);
        const end = new Date(endDate);
        
        // Format dates for display
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        const formattedStart = start.toLocaleDateString('en-US', options);
        const formattedEnd = end.toLocaleDateString('en-US', options);
        
        // Calculate duration
        let durationText;
        if (renewalPeriod === 'monthly') {
            durationText = `${formattedStart} to ${formattedEnd}`;
        } else {
            durationText = `${formattedStart} to ${formattedEnd}`;
        }
        
        // Update order summary if payment step is visible
        const orderDurationElement = document.getElementById('orderDuration');
        if (orderDurationElement) {
            orderDurationElement.textContent = durationText;
        }
    }
}

// Handle form submission
document.getElementById('renewalForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    // Show loading state
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Processing...';
    submitBtn.disabled = true;
    
    // Submit the form
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Close modal and redirect to checkout
            bootstrap.Modal.getInstance(document.getElementById('renewalModal')).hide();
            
            // Show success message and redirect
            const alertHtml = `
                <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 9999;" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>Success!</strong> ${data.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
            document.body.insertAdjacentHTML('afterbegin', alertHtml);
            
            // Redirect to checkout after 2 seconds
            setTimeout(() => {
                if (data.redirect_url) {
                    window.location.href = data.redirect_url;
                } else {
                    window.location.reload();
                }
            }, 2000);
        } else {
            // Show error message
            alert('Error: ' + (data.message || 'Something went wrong. Please try again.'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error: Something went wrong. Please try again.');
    })
    .finally(() => {
        // Reset button state
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
});

// Step navigation functions
function showPaymentStep() {
    // Validate renewal details
    const subscriptionId = document.getElementById('renewalSubscriptionId').value;
    const renewalPeriod = document.getElementById('renewalPeriod').value;
    const amount = document.getElementById('renewalAmount').value;
    
    if (!subscriptionId || !renewalPeriod || !amount) {
        alert('Please fill in all renewal details before proceeding.');
        return;
    }
    
    // Update order summary using the duration display function
    document.getElementById('orderPluginName').textContent = document.getElementById('renewalPluginName').value;
    document.getElementById('orderPlanName').textContent = renewalPeriod.charAt(0).toUpperCase() + renewalPeriod.slice(1);
    updateDurationDisplay(); // This will update the orderDuration element
    document.getElementById('orderTotal').textContent = '$' + parseFloat(amount).toFixed(2);
    
    // Show payment step
    document.getElementById('renewalStep').style.display = 'none';
    document.getElementById('paymentStep').style.display = 'block';
    document.getElementById('renewalFooter').style.display = 'none';
    document.getElementById('paymentFooter').style.display = 'block';
}

function showRenewalStep() {
    // Show renewal step
    document.getElementById('renewalStep').style.display = 'block';
    document.getElementById('paymentStep').style.display = 'none';
    document.getElementById('renewalFooter').style.display = 'block';
    document.getElementById('paymentFooter').style.display = 'none';
}

// Payment processing function
async function processPayment() {
    // Validate payment details
    const cardholderName = document.getElementById('cardholderName').value;
    
    if (!cardholderName) {
        alert('Please enter the cardholder name.');
        return;
    }
    
    // Show loading state
    const payBtn = event.target;
    const originalText = payBtn.innerHTML;
    payBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Processing...';
    payBtn.disabled = true;
    
    try {
        // Create form data for backend processing
        const formData = new FormData();
        formData.append('license_id', document.getElementById('renewalLicenseId').value);
        formData.append('subscription_id', document.getElementById('renewalSubscriptionId').value);
        formData.append('renewal_period', document.getElementById('renewalPeriod').value);
        formData.append('amount', document.getElementById('renewalAmount').value);
        formData.append('start_date', document.getElementById('renewalStartDate').value);
        formData.append('end_date', document.getElementById('renewalEndDate').value);
        
        console.log('Creating Razorpay Order...');
        
        // Step 1: Create Order
        const response = await fetch('{{ route("user.subscriptions.renew.razorpay") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
            body: formData
        });

        const data = await response.json();
        
        if (!data.success) {
            throw new Error(data.message || 'Order creation failed');
        }

        // Step 2: Open Razorpay Checkout
        const options = {
            "key": data.key,
            "amount": data.amount,
            "currency": data.currency,
            "name": data.name,
            "description": data.description,
            "image": "https://assertivlogix.com/logo.png", // Replace with actual logo URL
            "order_id": data.order_id,
            "handler": async function (response){
                // Step 3: Verify Payment
                payBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Verifying...';
                
                try {
                    const verifyData = new FormData();
                    verifyData.append('razorpay_payment_id', response.razorpay_payment_id);
                    verifyData.append('razorpay_order_id', response.razorpay_order_id);
                    verifyData.append('razorpay_signature', response.razorpay_signature);
                    
                    // Add original renewal data for verification/processing
                    verifyData.append('license_id', document.getElementById('renewalLicenseId').value);
                    verifyData.append('subscription_id', document.getElementById('renewalSubscriptionId').value);
                    verifyData.append('renewal_period', document.getElementById('renewalPeriod').value);
                    verifyData.append('amount', document.getElementById('renewalAmount').value);
                    verifyData.append('start_date', document.getElementById('renewalStartDate').value);
                    verifyData.append('end_date', document.getElementById('renewalEndDate').value);

                    const verifyResponse = await fetch('{{ route("user.subscriptions.renew.verify") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                        },
                        body: verifyData
                    });

                    const verifyResult = await verifyResponse.json();

                    if (verifyResult.success) {
                        // Show success message
                        const modalBody = document.querySelector('#renewalModal .modal-body');
                        modalBody.innerHTML = `
                            <div class="text-center py-4">
                                <div class="mb-3">
                                    <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                                </div>
                                <h5 class="text-success mb-3">Payment Successful!</h5>
                                <p class="mb-3">${verifyResult.message}</p>
                                <div class="bg-light rounded p-3 mb-3">
                                    <small class="text-muted">Transaction ID: ${verifyResult.transaction_id || 'N/A'}</small>
                                </div>
                                <button type="button" class="btn btn-success" onclick="location.reload()">
                                    <i class="fas fa-check me-1"></i> Done
                                </button>
                            </div>
                        `;
                        
                        // Hide footer
                        document.querySelector('#renewalModal .modal-footer').style.display = 'none';
                        
                        // Auto refresh after 3 seconds
                        setTimeout(() => {
                            window.location.reload();
                        }, 3000);
                    } else {
                        throw new Error(verifyResult.message || 'Verification failed');
                    }
                } catch (verifyError) {
                    console.error('Verification Error:', verifyError);
                    alert('Payment verification failed: ' + verifyError.message);
                    payBtn.innerHTML = originalText;
                    payBtn.disabled = false;
                }
            },
            "prefill": data.prefill,
            "notes": data.notes,
            "theme": {
                "color": "#2563eb"
            },
            "modal": {
                "ondismiss": function(){
                    payBtn.innerHTML = originalText;
                    payBtn.disabled = false;
                }
            }
        };
        
        const rzp1 = new Razorpay(options);
        rzp1.on('payment.failed', function (response){
            alert('Payment Failed: ' + response.error.description);
            payBtn.innerHTML = originalText;
            payBtn.disabled = false;
        });
        
        rzp1.open();

    } catch (error) {
        console.error('Payment error:', error);
        alert('Payment failed: ' + (error.message || 'An error occurred. Please try again.'));
        payBtn.innerHTML = originalText;
        payBtn.disabled = false;
    }
}

</script>
@endsection
