<?php
// Dashboard
Breadcrumbs::register('dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', url('dashboard'));
});

// Dashboard > List Users
Breadcrumbs::register('users.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('List Users', route('users.index'));
});

// Dashboard > Create User
Breadcrumbs::register('users.create', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Create User', route('users.create'));
});

// Dashboard > Edit User
Breadcrumbs::register('users.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Edit User', route('users.edit', [ 'id' => $id ]));
});

// Dashboard > List Roles
Breadcrumbs::register('roles.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('List Roles', route('roles.index'));
});

// Dashboard > Create Role
Breadcrumbs::register('roles.create', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Create Role', route('roles.create'));
});

// Dashboard > Edit User
Breadcrumbs::register('roles.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Edit Role', route('roles.edit', [ 'id' => $id ]));
});

// Dashboard > List Subjects
Breadcrumbs::register('subjects.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('List Subjects', route('subjects.index'));
});

// Dashboard > Create Subject
Breadcrumbs::register('subjects.create', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Create Subject', route('subjects.create'));
});

// Dashboard > Edit Subject
Breadcrumbs::register('subjects.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Edit Subject', route('subjects.edit', [ 'id' => $id ]));
});

// Dashboard > List Students
Breadcrumbs::register('students.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('List Students', route('students.index'));
});

// Dashboard > Add Student
Breadcrumbs::register('students.create', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Add Student', route('students.create'));
});

// Dashboard > Edit Student
Breadcrumbs::register('students.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Edit Student', route('students.edit', [ 'id' => $id ]));
});

// Home > Blog > [Category] > [Page]
Breadcrumbs::register('page', function ($breadcrumbs, $page) {
    $breadcrumbs->parent('category', $page->category);
    $breadcrumbs->push($page->title, route('page', $page->id));
});

// Dashboard > List Semesters
Breadcrumbs::register('semesters.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('List Semesters', route('semesters.index'));
});

// Dashboard > Add Semester
Breadcrumbs::register('semesters.create', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Add Semester', route('semesters.create'));
});

// Dashboard > Edit Semester
Breadcrumbs::register('semesters.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Edit Semester', route('semesters.edit', [ 'id' => $id ]));
});

// Dashboard > List Batches
Breadcrumbs::register('batches.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('List Batches', route('batches.index'));
});

// Dashboard > Add Semester
Breadcrumbs::register('batches.create', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Add Batch', route('batches.create'));
});

// Dashboard > Edit Batches
Breadcrumbs::register('batches.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Edit Batch', route('batches.edit', [ 'id' => $id ]));
});

// Dashboard > Administrations
Breadcrumbs::register('administrations.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Administration', route('administrations.index'));
});

// Dashboard > Administration Scoring
Breadcrumbs::register('administrations.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Administration Scoring', route('administrations.edit', [ 'id' => $id ]));
});

// Dashboard > TPA
Breadcrumbs::register('tpas.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('TPA', route('tpas.index'));
});

// Dashboard > TPA Scoring
Breadcrumbs::register('tpas.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('TPA Scoring', route('tpas.edit', [ 'id' => $id ]));
});

// Dashboard > Auditions
Breadcrumbs::register('auditions.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Auditions', route('auditions.index'));
});

// Dashboard > Audition Scoring
Breadcrumbs::register('auditions.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Audition Scoring', route('auditions.edit', [ 'id' => $id ]));
});