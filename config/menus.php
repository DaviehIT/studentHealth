<?php
require_once __DIR__ . '/wrapper.php';
$userMenu = [
    ['title' => 'Dashboard', 'icon' => 'home', 'url'=>'/dashboard'], 
     ['title'=> 'Patients', 'icon'=>'hospital', 'url'=>'/dashboard/patients/index'],
    ['title' => 'Appointments', 'icon' => 'calendar', 'submenus' => [
        ['title' => 'Appointments status', 'url' => '/dashboard/appointment-status/index'],
        ['title' => 'New Appointment', 'url' => '/dashboard/appointments/index'],
    ]],
    ['title' => 'Staff', 'icon' => 'user-md', 'submenus' => [
        ['title' => 'Department', 'url' => '/dashboard/department/index'],
        ['title' => 'Staff', 'url' => '/dashboard/staff/index'],
    ]],
    ['title'=>'Medical Records','icon'=>'file-medical', 'url'=> '/dashboard/medical-records/index'],
    ['title'=> 'Pharmacy', 'icon'=>'medkit', 'url'=>'/dashboard/pharmacy/index'],
    ['title'=> 'Billing', 'icon'=>'money-bill', 'url'=>'/dashboard/billing/index'],

     ['title' => 'IAM & Admin', 'icon' => 'shield', 'submenus' => [
        ['title' => 'User Management', 'url' => '/dashboard/profile/index'],
        ['title' => 'Manage Roles', 'url' => '/dashboard/role/index'],
        ['title' => 'Manage Permissions', 'url' => '/dashboard/permission/index'],
        // ['title' => 'Manage Rules', 'url' => 'rule/index'],
    ]],
    
    

    ];

// return array_merge($userMenu, (new ConfigWrapper())->load('apiMenus'));
return $userMenu;
