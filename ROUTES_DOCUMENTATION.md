# 🚛 Sahitya Logistic - Routes Documentation

## Table of Contents
- [Overview](#overview)
- [Authentication Routes](#authentication-routes)
- [Dashboard Routes](#dashboard-routes)
- [Admin Routes](#admin-routes)
- [Company Routes](#company-routes)
- [Driver Routes](#driver-routes)
- [Logistics Job Prices Routes](#logistics-job-prices-routes)
- [Route Middleware](#route-middleware)
- [API Examples](#api-examples)

---

## Overview

This document provides comprehensive documentation for all routes in the Sahitya Logistic Laravel application. The application uses role-based routing with three main user types: **Admin**, **Company**, and **Driver**.

### Base URL
- **Development**: `http://127.0.0.1:8000`
- **Production**: `https://your-domain.com`

---

## Authentication Routes

### Login Routes
| Method | URI | Name | Controller | Description |
|--------|-----|------|------------|-------------|
| GET | `/login` | `login` | `LoginController@showLoginForm` | Display login form |
| POST | `/login` | - | `LoginController@login` | Process login request |

**Example Usage:**
```php
// Redirect to login
return redirect()->route('login');

// Generate login URL
$loginUrl = route('login');
```

### Registration Routes
| Method | URI | Name | Controller | Description |
|--------|-----|------|------------|-------------|
| GET | `/register` | `register` | `RegisterController@showRegistrationForm` | Display registration form |
| POST | `/register` | - | `RegisterController@register` | Process registration request |

### Logout Route
| Method | URI | Name | Controller | Description |
|--------|-----|------|------------|-------------|
| POST | `/logout` | `logout` | `LoginController@logout` | Logout user |

**Example Usage:**
```blade
<!-- Logout Form -->
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>
```

---

## Dashboard Routes

### Main Dashboard
| Method | URI | Name | Controller | Description |
|--------|-----|------|------------|-------------|
| GET | `/dashboard` | `dashboard` | `DashboardController@index` | Main dashboard (role-based redirect) |

**Middleware:** `auth`

**Example Usage:**
```php
// Redirect to dashboard
return redirect()->route('dashboard');
```

---

## Admin Routes

**Prefix:** `/admin`  
**Middleware:** `auth`

### Admin Dashboard
| Method | URI | Name | Controller | Description |
|--------|-----|------|------------|-------------|
| GET | `/admin/dashboard` | `admin.dashboard` | `DashboardController@adminDashboard` | Admin dashboard with statistics |

### Admin User Management
| Method | URI | Name | Controller | Description |
|--------|-----|------|------------|-------------|
| GET | `/admin/drivers` | `admin.drivers` | `DashboardController@listDrivers` | View all drivers |
| GET | `/admin/companies` | `admin.companies` | `DashboardController@listCompanies` | View all companies |

### Admin Logistics Jobs
| Method | URI | Name | Controller | Description |
|--------|-----|------|------------|-------------|
| GET | `/admin/logistics-jobs` | `admin.logistics-jobs.index` | `LogisticsJobController@index` | List all logistics jobs |
| GET | `/admin/logistics-jobs/{id}` | `admin.logistics-jobs.show` | `LogisticsJobController@show` | View specific job details |
| GET | `/admin/logistics-jobs/{id}/edit` | `admin.logistics-jobs.edit` | `LogisticsJobController@edit` | Edit job form |
| PUT/PATCH | `/admin/logistics-jobs/{id}` | `admin.logistics-jobs.update` | `LogisticsJobController@update` | Update job |
| DELETE | `/admin/logistics-jobs/{id}` | `admin.logistics-jobs.destroy` | `LogisticsJobController@destroy` | Delete job |
| POST | `/admin/logistics-jobs/{id}/assign` | `admin.logistics-jobs.assign` | `LogisticsJobController@assign` | Assign job to driver |
| PATCH | `/admin/logistics-jobs/{id}/status` | `admin.logistics-jobs.update-status` | `LogisticsJobController@updateStatus` | Update job status |

**Example Usage:**
```php
// Admin job management
return redirect()->route('admin.logistics-jobs.index');
return redirect()->route('admin.logistics-jobs.show', $job->id);

// Admin user management
$driversUrl = route('admin.drivers');
$companiesUrl = route('admin.companies');
```

---

## Company Routes

**Prefix:** `/company`  
**Middleware:** `auth`

### Company Dashboard
| Method | URI | Name | Controller | Description |
|--------|-----|------|------------|-------------|
| GET | `/company/dashboard` | `company.dashboard` | `DashboardController@companyDashboard` | Company dashboard with statistics |

### Company Logistics Jobs
| Method | URI | Name | Controller | Description |
|--------|-----|------|------------|-------------|
| GET | `/company/logistics-jobs` | `company.logistics-jobs.index` | `LogisticsJobController@index` | List company's jobs |
| GET | `/company/logistics-jobs/{id}` | `company.logistics-jobs.show` | `LogisticsJobController@show` | View job details |
| GET | `/company/logistics-jobs/{id}/edit` | `company.logistics-jobs.edit` | `LogisticsJobController@edit` | Edit job form |
| PUT/PATCH | `/company/logistics-jobs/{id}` | `company.logistics-jobs.update` | `LogisticsJobController@update` | Update job |
| DELETE | `/company/logistics-jobs/{id}` | `company.logistics-jobs.destroy` | `LogisticsJobController@destroy` | Delete job |
| POST | `/company/logistics-jobs/{id}/assign` | `company.logistics-jobs.assign` | `LogisticsJobController@assign` | Assign job to driver |
| PATCH | `/company/logistics-jobs/{id}/status` | `company.logistics-jobs.update-status` | `LogisticsJobController@updateStatus` | Update job status |

**Example Usage:**
```php
// Company job management
return redirect()->route('company.logistics-jobs.index');
return redirect()->route('company.dashboard');
```

---

## Driver Routes

**Prefix:** `/driver`  
**Middleware:** `auth`

### Driver Dashboard
| Method | URI | Name | Controller | Description |
|--------|-----|------|------------|-------------|
| GET | `/driver/dashboard` | `driver.dashboard` | `DashboardController@driverDashboard` | Driver dashboard with available jobs |

### Driver Logistics Jobs
| Method | URI | Name | Controller | Description |
|--------|-----|------|------------|-------------|
| GET | `/driver/logistics-jobs` | `driver.logistics-jobs.index` | `LogisticsJobController@index` | List available/assigned jobs |
| GET | `/driver/logistics-jobs/create` | `driver.logistics-jobs.create` | `LogisticsJobController@create` | Create new job form |
| POST | `/driver/logistics-jobs` | `driver.logistics-jobs.store` | `LogisticsJobController@store` | Store new job |
| GET | `/driver/logistics-jobs/{id}` | `driver.logistics-jobs.show` | `LogisticsJobController@show` | View job details |
| GET | `/driver/logistics-jobs/{id}/edit` | `driver.logistics-jobs.edit` | `LogisticsJobController@edit` | Edit job form |
| PUT/PATCH | `/driver/logistics-jobs/{id}` | `driver.logistics-jobs.update` | `LogisticsJobController@update` | Update job |
| POST | `/driver/logistics-jobs/{id}/accept` | `driver.logistics-jobs.accept` | `LogisticsJobController@accept` | Accept pending job |
| PATCH | `/driver/logistics-jobs/{id}/status` | `driver.logistics-jobs.update-status` | `LogisticsJobController@updateStatus` | Update job status |

### Driver Job Filtering
The driver routes support query parameters for filtering:

- **Assigned Jobs**: `/driver/logistics-jobs?status=assigned&driver=me`
- **Completed Jobs**: `/driver/logistics-jobs?status=completed&driver=me`
- **Available Jobs**: `/driver/logistics-jobs` (default)

**Example Usage:**
```php
// Driver job management
return redirect()->route('driver.logistics-jobs.index');
return redirect()->route('driver.logistics-jobs.create');

// Filtered job views
$assignedJobsUrl = route('driver.logistics-jobs.index', ['status' => 'assigned', 'driver' => 'me']);
$completedJobsUrl = route('driver.logistics-jobs.index', ['status' => 'completed', 'driver' => 'me']);
```

---

## Logistics Job Prices Routes

**Middleware:** `auth` (Admin and Company users only)  
**Base URI:** `/logistics-job-prices`

### Job Prices CRUD
| Method | URI | Name | Controller | Description |
|--------|-----|------|------------|-------------|
| GET | `/logistics-job-prices` | `logistics-job-prices.index` | `LogisticsJobPriceController@index` | List all job prices |
| GET | `/logistics-job-prices/create` | `logistics-job-prices.create` | `LogisticsJobPriceController@create` | Create price form |
| POST | `/logistics-job-prices` | `logistics-job-prices.store` | `LogisticsJobPriceController@store` | Store new price |
| GET | `/logistics-job-prices/{id}` | `logistics-job-prices.show` | `LogisticsJobPriceController@show` | View price details |
| GET | `/logistics-job-prices/{id}/edit` | `logistics-job-prices.edit` | `LogisticsJobPriceController@edit` | Edit price form |
| PUT/PATCH | `/logistics-job-prices/{id}` | `logistics-job-prices.update` | `LogisticsJobPriceController@update` | Update price |
| DELETE | `/logistics-job-prices/{id}` | `logistics-job-prices.destroy` | `LogisticsJobPriceController@destroy` | Delete price |

**Access Control:**
- **Admin**: Can view/manage all prices
- **Company**: Can only view/manage their own prices
- **Driver**: No access

**Example Usage:**
```php
// Job prices management
return redirect()->route('logistics-job-prices.index');
return redirect()->route('logistics-job-prices.show', $price->id);

// Check if user can access
@if(auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'company')
    <a href="{{ route('logistics-job-prices.create') }}">Add Price</a>
@endif
```

---

## Route Middleware

### Authentication Middleware
All routes except authentication routes require the `auth` middleware:

```php
Route::middleware('auth')->group(function () {
    // Protected routes
});
```

### Role-Based Access Control
Routes are organized by user roles with prefixes:

- **Admin**: `/admin/*` - Full system access
- **Company**: `/company/*` - Company-specific access  
- **Driver**: `/driver/*` - Driver-specific access

---

## API Examples

### Blade Template Examples

```blade
<!-- Navigation Links -->
<a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
    Dashboard
</a>

<!-- Role-based links -->
@if(auth()->user()->user_type === 'admin')
    <a href="{{ route('admin.logistics-jobs.index') }}">Manage Jobs</a>
    <a href="{{ route('admin.drivers') }}">View Drivers</a>
@elseif(auth()->user()->user_type === 'company')
    <a href="{{ route('company.logistics-jobs.index') }}">My Jobs</a>
@elseif(auth()->user()->user_type === 'driver')
    <a href="{{ route('driver.logistics-jobs.index') }}">Available Jobs</a>
@endif

<!-- Form actions -->
<form action="{{ route('logistics-job-prices.store') }}" method="POST">
    @csrf
    <!-- form fields -->
</form>

<form action="{{ route('logistics-job-prices.destroy', $price) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>
```

### Controller Examples

```php
// Redirects based on user type
if (Auth::user()->user_type === 'admin') {
    return redirect()->route('admin.logistics-jobs.index');
} elseif (Auth::user()->user_type === 'company') {
    return redirect()->route('company.logistics-jobs.index');
} else {
    return redirect()->route('driver.logistics-jobs.index');
}

// URL generation
$editUrl = route('logistics-job-prices.edit', $price);
$showUrl = route('admin.logistics-jobs.show', $job);

// Route checking
if (request()->routeIs('admin.*')) {
    // Admin section logic
}
```

### JavaScript Examples

```javascript
// Dynamic route generation
const jobUrl = `{{ route('admin.logistics-jobs.show', ':id') }}`.replace(':id', jobId);

// Form submission
const form = document.querySelector('form');
form.action = `{{ route('logistics-job-prices.update', ':id') }}`.replace(':id', priceId);
```

---

## Route Permissions Summary

| User Type | Dashboard | Jobs Management | User Management | Price Management |
|-----------|-----------|-----------------|-----------------|------------------|
| **Admin** | ✅ All dashboards | ✅ All jobs | ✅ View all users | ✅ All prices |
| **Company** | ✅ Company dashboard | ✅ Company jobs only | ❌ No access | ✅ Own prices only |
| **Driver** | ✅ Driver dashboard | ✅ Available/assigned jobs | ❌ No access | ❌ No access |

---

## Error Handling

### Common HTTP Status Codes
- **200**: Success
- **302**: Redirect (successful form submission)
- **403**: Forbidden (unauthorized access)
- **404**: Not Found (invalid job/price ID)
- **422**: Validation Error (form validation failed)
- **500**: Server Error

### Authorization Checks
```php
// In controllers
if ($user->user_type === 'driver') {
    if ($logisticsJob->created_by !== $user->id && $logisticsJob->driver_id !== $user->id) {
        abort(403, 'Unauthorized to view this job.');
    }
}
```

---

## Version Information

- **Laravel Version**: 12.0
- **PHP Version**: 8.2+
- **Database**: MySQL
- **Authentication**: Laravel's built-in authentication
- **Authorization**: Role-based (admin/company/driver)

---

*Last Updated: August 7, 2025*  
*Documentation Version: 1.0*
